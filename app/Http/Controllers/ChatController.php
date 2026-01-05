<?php

namespace App\Http\Controllers;

use App\Models\Conversation; // Ganti Chat model lama dengan Conversation
use App\Models\Message;      // Model Message baru
use App\Models\Postingan;
use App\Events\MessageSent;  // Event Pusher
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show list of conversations (Inbox).
     * 
     */
    public function index()
    {
        $userId = Auth::user()->id_pengguna;

        // Ambil percakapan di mana user terlibat
        // Eager load: pesan terakhir, lawan bicara, dan info postingan
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->with(['lastMessage', 'posting', 'userOne', 'userTwo'])
            ->get()
            ->sortByDesc(function($conversation) {
                return $conversation->lastMessage->created_at ?? $conversation->created_at;
            });

        return view('pages.marketplace.chat.index', compact('conversations', 'userId'));
    }

    /**
     * Start chat from Marketplace (Product Page).
     * Logic: Cek apakah Room untuk produk ini sudah ada? Kalau belum, buat baru.
     */
    public function startChat(Request $request)
    {
        $request->validate(['id_posting' => 'required']);

        $posting = Postingan::findOrFail($request->id_posting);
        $myId = Auth::user()->id_pengguna;
        $sellerId = $posting->id_pengguna;

        if ($myId == $sellerId) {
            return back()->with('error', 'Tidak bisa chat diri sendiri.');
        }

        // Cek conversation spesifik untuk User A, User B, DAN Postingan X
        $conversation = Conversation::where('id_posting', $posting->id_posting)
            ->where(function($q) use ($myId, $sellerId) {
                $q->where(function($sub) use ($myId, $sellerId) {
                    $sub->where('user_one_id', $myId)->where('user_two_id', $sellerId);
                })->orWhere(function($sub) use ($myId, $sellerId) {
                    $sub->where('user_one_id', $sellerId)->where('user_two_id', $myId);
                });
            })->first();

        // Jika belum ada, buat room baru
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $myId,
                'user_two_id' => $sellerId,
                'id_posting' => $posting->id_posting // Simpan konteks postingan
            ]);
        }

        // Redirect ke halaman chat room
        return redirect()->route('chat.show', $conversation->id);
    }

    /**
     * Start chat from Offer (Penawaran).
     */
    public function startChatFromOffer($id)
    {
        $penawaran = \App\Models\Penawaran::with('buah')->findOrFail($id);
        $myId = Auth::user()->id_pengguna;
        $petaniId = $penawaran->id_petani;

        // Ensure Postingan exists for context (create hidden if needed)
        $posting = Postingan::where('id_buah', $penawaran->id_buah)->first();
        if (!$posting) {
            $posting = Postingan::create([
                'id_pengguna' => $petaniId,
                'id_buah' => $penawaran->id_buah,
                'tipe_postingan' => 'jual', 
                'judul_posting' => 'Penawaran Khusus: ' . ($penawaran->buah->nama_buah ?? 'Buah'),
                'keterangan' => 'Postingan otomatis untuk chat penawaran.',
                'total_harga' => 0, 
                'status' => 'aktif', // Hidden conceptually but active in DB
            ]);
        }

        // Find or Create Conversation
        $conversation = Conversation::where('id_posting', $posting->id_posting)
            ->where(function($q) use ($myId, $petaniId) {
                $q->where(function($sub) use ($myId, $petaniId) {
                    $sub->where('user_one_id', $myId)->where('user_two_id', $petaniId);
                })->orWhere(function($sub) use ($myId, $petaniId) {
                    $sub->where('user_one_id', $petaniId)->where('user_two_id', $myId);
                });
            })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $myId,
                'user_two_id' => $petaniId,
                'id_posting' => $posting->id_posting
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    /**
     * Show Chat Room.
     * Menggunakan ID Conversation agar Pusher Channel-nya unik.
     */
    // Di dalam App\Http\Controllers\ChatController.php
    public function show($conversation_id, Request $request)
    {
        // 1. Ambil conversation beserta relasi user-nya
        $conversation = Conversation::with(['userOne', 'userTwo'])->findOrFail($conversation_id);
        
        // 2. Tentukan user yang sedang login
        $currentUser = Auth::user();

        // 3. Tentukan LAWAN BICARA ($opponent)
        // Jika saya user_one, maka lawan saya user_two, dan sebaliknya.
        $opponent = ($conversation->user_one_id === $currentUser->id_pengguna) 
                    ? $conversation->userTwo 
                    : $conversation->userOne;

        // 4. Logic Tombol Kembali (Optional)
        $backUrl = $request->back_to_post 
                ? route('postingan.show', $request->back_to_post) // Sesuaikan nama route detail postinganmu
                : url('/dashboard'); // Default fallback

        // 5. Update status "Read" (opsional, biar pesan jadi terbaca saat dibuka)
        Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', $currentUser->id_pengguna)
            ->update(['is_read' => true]);

        // === PERBAIKAN UTAMA ADA DI SINI ===
        // Pastikan path view sesuai: 'pages.marketplace.chat.room'
        // Dan variabel 'opponent' & 'currentUser' dikirim lewat compact()
        return view('pages.marketplace.chat.room', compact('conversation', 'opponent', 'currentUser', 'backUrl'));
    }

    /**
     * Store new message (API / Axios).
     * Trigger Pusher Event di sini.
     */
    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);

        // Simpan pesan
        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => Auth::user()->id_pengguna,
            'body' => $request->message,
            'is_read' => false,
        ]);

        // Broadcast ke Pusher (Real-time!)
        // Pastikan Event MessageSent sudah dibuat seperti tutorial sebelumnya
        broadcast(new MessageSent($message))->toOthers();

        // Return JSON lengkap dengan data sender untuk frontend
        return response()->json($message->load('sender'));
    }

    /**
     * Fetch messages (API / Axios).
     */
    public function fetch($conversationId)
    {
        // Ambil pesan berdasarkan ID Room
        $messages = Message::where('conversation_id', $conversationId)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request, $conversation_id) 
    {
        // Validasi input
        $request->validate([
            'message' => 'required|string',
        ]);

        // Simpan pesan
        $message = Message::create([
            'conversation_id' => $conversation_id, // Ambil dari URL
            'sender_id' => Auth::user()->id_pengguna,
            'body' => $request->message,
            'is_read' => false,
        ]);

        // Broadcast ke Pusher
        broadcast(new MessageSent($message))->toOthers();

        // Return JSON
        return response()->json($message->load('sender'));
    }
}

