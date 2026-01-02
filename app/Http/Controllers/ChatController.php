<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show list of conversations for the authenticated user.
     * Grouped by Partner AND Posting (Context).
     */
    public function index()
    {
        $userId = Auth::user()->id_pengguna;

        // Fetch messages involving the user, newest first
        $messages = Chat::with(['sender', 'receiver', 'posting'])
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $conversations = [];

        foreach ($messages as $m) {
            $partnerId = $m->sender_id === $userId ? $m->receiver_id : $m->sender_id;
            $postingId = $m->id_posting;
            
            // Unique key for conversation: Partner + Posting
            $key = $partnerId . '_' . $postingId;

            if (!isset($conversations[$key])) {
                $partner = User::find($partnerId);
                if (!$partner) continue;

                $posting = $m->posting; // Could be null if deleted or specific general chat
                
                $unread = Chat::where('sender_id', $partnerId)
                    ->where('receiver_id', $userId)
                    ->where('id_posting', $postingId)
                    ->where('is_read', false)
                    ->count();

                $conversations[$key] = [
                    'partner' => $partner,
                    'posting' => $posting, // Pass posting info
                    'id_posting' => $postingId,
                    'last_message' => $m->message,
                    'time' => $m->created_at,
                    'is_read' => $m->is_read,
                    'unread_count' => $unread,
                ];
            }
        }

        // Sort by latest message time
        usort($conversations, function ($a, $b) {
            return $b['time']->timestamp <=> $a['time']->timestamp;
        });

        return view('pages.chat.index', ['chats' => $conversations]);
    }

    /**
     * Initiate a chat from Marketplace (Product Page).
     */
    public function startChat(Request $request)
    {
        $request->validate([
            'id_posting' => 'required', // ID Posting
        ]);

        $posting = Postingan::findOrFail($request->id_posting);
        
        // Prevent chatting with self
        if ($posting->id_pengguna == Auth::user()->id_pengguna) {
             return redirect()->back()->with('error', 'Anda tidak dapat mengirim pesan ke diri sendiri.');
        }

        // Redirect to chat show page with correct partner and context
        return redirect()->route('chat.show', [
            'id' => $posting->id_pengguna, 
            'posting_id' => $posting->id_posting
        ]);
    }

    /**
     * Show a chat with a specific partner, optionally scoped to a posting.
     */
    public function show($id, Request $request)
    {
        $partner = User::findOrFail($id);
        $userId = Auth::user()->id_pengguna;
        $postingId = $request->query('posting_id');
        $posting = $postingId ? Postingan::find($postingId) : null;

        // Mark partner->me messages as read (scoped to posting if exists)
        $query = Chat::where('sender_id', $id)
            ->where('receiver_id', $userId)
            ->where('is_read', false);
            
        if ($postingId) {
            $query->where('id_posting', $postingId);
        }
        
        $query->update(['is_read' => true]);

        return view('pages.chat.show', compact('partner', 'posting'));
    }

    /**
     * Store a new chat message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id_pengguna',
            'message' => 'required|string',
            'id_posting' => 'nullable', // Should be validated if context is strictly required
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::user()->id_pengguna,
            'receiver_id' => $request->receiver_id,
            'id_posting' => $request->id_posting,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json($chat);
    }

    /**
     * Fetch messages between authenticated user and partner (JSON).
     */
    public function fetch($id, Request $request)
    {
        $userId = Auth::user()->id_pengguna;
        $postingId = $request->query('posting_id');

        // Mark messages from partner to user as read
        $markReadQuery = Chat::where('sender_id', $id)
            ->where('receiver_id', $userId)
            ->where('is_read', false);

        if ($postingId) {
            $markReadQuery->where('id_posting', $postingId);
        }
        $markReadQuery->update(['is_read' => true]);

        // Verify if postingId is needed for fetch
        $messages = Chat::where(function($q) use ($userId, $id, $postingId) {
             $q->where(function ($sub) use ($userId, $id) {
                 $sub->where('sender_id', $userId)->where('receiver_id', $id);
             })->orWhere(function ($sub) use ($userId, $id) {
                 $sub->where('sender_id', $id)->where('receiver_id', $userId);
             });
        });

        if ($postingId) {
            $messages->where('id_posting', $postingId);
        } else {
            // Optional: if no postingId, maybe show only chats with null posting? 
            // Or all chats? User request implies strict rooms. 
            // We'll stick to strict filtering if provided, else null.
             $messages->whereNull('id_posting');
        }

        $result = $messages->orderBy('created_at')->get();

        return response()->json($result);
    }
}
