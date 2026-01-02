<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Buah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->peran !== 'petani') {
            abort(403);
        }

        $postingans = Postingan::where('id_pengguna', $user->id_pengguna)
            ->with(['buah.penilaian'])
            ->latest()
            ->get();

        return view('pages.dashboard.petani.postingan.index', compact('postingans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get fruit stocks that are NOT currently in an active posting
        // This prevents double posting the same stock item
        $activePostingBuahIds = Postingan::where('id_pengguna', Auth::user()->id_pengguna)
            ->where('status', 'aktif')
            ->pluck('id_buah')
            ->toArray();

        $buahs = Buah::where('id_pengguna', Auth::user()->id_pengguna)
            ->whereNotIn('id_buah', $activePostingBuahIds)
            ->get();

        return view('pages.dashboard.petani.postingan.create', compact('buahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buah' => 'required|exists:buahs,id_buah',
            'judul_posting' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $buah = Buah::findOrFail($request->id_buah);

        // Auto-calculate total price based on Stock post
        $totalHarga = $buah->stok * $buah->harga_akhir;

        Postingan::create([
            'id_pengguna' => Auth::user()->id_pengguna,
            'id_buah' => $buah->id_buah,
            'tipe_postingan' => 'jual',
            'judul_posting' => $request->judul_posting,
            'keterangan' => $request->keterangan,
            'total_harga' => $totalHarga,
            'status' => 'aktif',
        ]);

        return redirect()->route('postingan.index')->with('success', 'Postingan berhasil diterbitkan ke Marketplace!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postingan = Postingan::where('id_posting', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        return view('pages.dashboard.petani.postingan.edit', compact('postingan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postingan = Postingan::where('id_posting', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        $request->validate([
            'judul_posting' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:aktif,terjual,dibatalkan',
        ]);

        // Recalculate price in case stock or price changed in Buah Data
        // Ideally, we should listen to Buah updates, but this ensures consistency on update
        $buah = $postingan->buah;
        $totalHarga = $buah->stok * $buah->harga_akhir;

        $postingan->update([
            'judul_posting' => $request->judul_posting,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'total_harga' => $totalHarga, 
        ]);

        return redirect()->route('postingan.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postingan = Postingan::where('id_posting', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        $postingan->delete();

        return redirect()->route('postingan.index')->with('success', 'Postingan berhasil dihapus!');
    }
}
