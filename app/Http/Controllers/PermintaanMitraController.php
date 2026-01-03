<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanMitraController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->peran !== 'mitra') {
            abort(403);
        }

        // Fetch requests with their associated offers count
        $permintaans = PermintaanMitra::where('id_pengguna', $user->id_pengguna)
            ->withCount(['penawarans' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->latest()
            ->get();

        return view('pages.dashboard.mitra.permintaan.index', compact('permintaans'));
    }

    public function show($id)
    {
        // Show details and list of offers for this request
        $permintaan = PermintaanMitra::with(['penawarans.petani', 'penawarans.buah.penilaian'])
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->findOrFail($id);

        return view('pages.dashboard.mitra.permintaan.show', compact('permintaan'));
    }

    public function create()
    {
        return view('pages.dashboard.mitra.permintaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_buah_dicari' => 'required|string|max:255',
            'jumlah_dicari_kg' => 'required|integer|min:1',
            'harga_ajuan_per_kg' => 'required|numeric|min:0',
            'min_skor_kualitas' => 'required|numeric|min:0|max:1',
            'deskripsi_tambahan' => 'nullable|string',
        ]);

        PermintaanMitra::create([
            'id_pengguna' => Auth::user()->id_pengguna,
            'nama_buah_dicari' => $request->nama_buah_dicari,
            'jumlah_dicari_kg' => $request->jumlah_dicari_kg,
            'harga_ajuan_per_kg' => $request->harga_ajuan_per_kg,
            'min_skor_kualitas' => $request->min_skor_kualitas,
            'deskripsi_tambahan' => $request->deskripsi_tambahan,
            'status_tawaran' => 'aktif',
        ]);

        return redirect()->route('permintaan-mitra.index')->with('success', 'Permintaan stok berhasil dibuat!');
    }

    public function edit($id)
    {
        $permintaan = PermintaanMitra::where('id_permintaan', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        return view('pages.dashboard.mitra.permintaan.edit', compact('permintaan'));
    }

    public function update(Request $request, $id)
    {
        $permintaan = PermintaanMitra::where('id_permintaan', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        $request->validate([
            'nama_buah_dicari' => 'required|string|max:255',
            'jumlah_dicari_kg' => 'required|integer|min:1',
            'harga_ajuan_per_kg' => 'required|numeric|min:0',
            'min_skor_kualitas' => 'required|numeric|min:0|max:1',
            'deskripsi_tambahan' => 'nullable|string',
            'status_tawaran' => 'required|in:aktif,terpenuhi,dibatalkan',
        ]);

        $permintaan->update([
            'nama_buah_dicari' => $request->nama_buah_dicari,
            'jumlah_dicari_kg' => $request->jumlah_dicari_kg,
            'harga_ajuan_per_kg' => $request->harga_ajuan_per_kg,
            'min_skor_kualitas' => $request->min_skor_kualitas,
            'deskripsi_tambahan' => $request->deskripsi_tambahan,
            'status_tawaran' => $request->status_tawaran,
        ]);

        return redirect()->route('permintaan-mitra.index')->with('success', 'Permintaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $permintaan = PermintaanMitra::where('id_permintaan', $id)
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->firstOrFail();

        $permintaan->delete();

        return redirect()->route('permintaan-mitra.index')->with('success', 'Permintaan berhasil dihapus!');
    }
}
