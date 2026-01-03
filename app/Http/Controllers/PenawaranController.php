<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\PermintaanMitra;
use App\Models\Buah;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PenawaranController extends Controller
{
    /**
     * Show the form for creating a new offer (Petani).
     */
    public function create($id_permintaan)
    {
        $permintaan = PermintaanMitra::with('user')->findOrFail($id_permintaan);
        
        // Ensure user is Petani
        if (Auth::user()->peran !== 'petani') abort(403);
        
        // Fetch User's Products (Buah)
        $buahs = Buah::where('id_pengguna', Auth::user()->id_pengguna)
            ->where('stok', '>', 0)
            ->get();

        return view('pages.marketplace.offer', compact('permintaan', 'buahs'));
    }

    /**
     * Store a newly created offer in storage.
     */
    public function store(Request $request, $id_permintaan)
    {
        $request->validate([
            'id_buah' => 'required|exists:buahs,id_buah',
            'harga_tawaran' => 'required|numeric|min:0',
            'pesan' => 'nullable|string',
        ]);

        Penawaran::create([
            'id_permintaan' => $id_permintaan,
            'id_petani' => Auth::user()->id_pengguna,
            'id_buah' => $request->id_buah,
            'harga_tawaran' => $request->harga_tawaran,
            'pesan' => $request->pesan,
            'status' => 'pending',
        ]);

        return redirect()->route('marketplace.index', ['tab' => 'cari'])
            ->with('success', 'Penawaran berhasil dikirim ke Mitra!');
    }

    /**
     * Accept an offer (Mitra).
     */
    public function accept($id)
    {
        $penawaran = Penawaran::with('permintaan')->findOrFail($id);

        if ($penawaran->permintaan->id_pengguna !== Auth::user()->id_pengguna) {
             abort(403);
        }

        // Update status offer
        $penawaran->update(['status' => 'accepted']);

        // Update request status to 'terpenuhi'
        $penawaran->permintaan->update(['status_tawaran' => 'terpenuhi']);

        // Reject other offers for the same request
        Penawaran::where('id_permintaan', $penawaran->id_permintaan)
            ->where('id_penawaran', '!=', $id)
            ->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Penawaran diterima. Silakan hubungi petani atau buat transaksi.');
    }

    /**
     * Reject an offer (Mitra).
     */
    public function reject($id)
    {
         $penawaran = Penawaran::with('permintaan')->findOrFail($id);

        if ($penawaran->permintaan->id_pengguna !== Auth::user()->id_pengguna) {
             abort(403);
        }

        $penawaran->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Penawaran ditolak.');
    }

    /**
     * Handle checkout for a specific offer.
     * Ensures a Postingan exists for the transaction.
     */
    public function checkout($id)
    {
        $penawaran = Penawaran::with(['buah', 'petani'])->findOrFail($id);

        if ($penawaran->status !== 'accepted') {
            return redirect()->back()->with('error', 'Penawaran belum diterima.');
        }

        // Find existing Postingan for this Buah
        $postingan = Postingan::where('id_buah', $penawaran->id_buah)->first();

        // If not found, create a hidden/new postingan primarily for this transaction
        if (!$postingan) {
            $postingan = Postingan::create([
                'id_pengguna' => $penawaran->id_petani,
                'id_buah' => $penawaran->id_buah,
                'tipe_postingan' => 'jual', // Default
                'judul_posting' => 'Penawaran Khusus: ' . $penawaran->buah->nama_buah,
                'keterangan' => 'Postingan otomatis untuk transaksi penawaran.',
                'total_harga' => 0, // Not strictly used for unit price
                'status' => 'aktif',
            ]);
        }

        // Redirect to the main checkout page with price override
        return redirect()->route('transaksi.checkout', [
            'id' => $postingan->id_posting, 
            'price' => $penawaran->harga_tawaran
        ]);
    }
}
