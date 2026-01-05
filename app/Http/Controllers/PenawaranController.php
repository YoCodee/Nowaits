<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\PermintaanMitra;
use App\Models\Buah;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

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
        // Fetch User's Products (Buah) - Filter Matches (Case Insensitive)
        $searchKey = Str::lower($permintaan->nama_buah_dicari);

        $buahs = Buah::where('id_pengguna', Auth::user()->id_pengguna)
            ->where('stok', '>', 0)
            ->whereRaw('LOWER(nama_buah) LIKE ?', ['%' . $searchKey . '%']) // Filter logic
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
        $penawaran = Penawaran::with(['permintaan', 'buah', 'petani.alamatPengguna'])->findOrFail($id);
        $mitra = Auth::user();

        // 1. Validasi: Pastikan penawaran untuk user yang login
        if ($penawaran->permintaan->id_pengguna !== $mitra->id_pengguna) {
             abort(403);
        }

        // 2. Validasi: Alamat Mitra Wajib Ada (untuk hitung ongkir)
        if (!$mitra->alamatPengguna) {
             return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi alamat Anda untuk pengiriman sebelum menerima penawaran.');
        }

        DB::beginTransaction();
        try {
            // A. Update Status Penawaran & Permintaan
            $penawaran->update(['status' => 'accepted']);
            $penawaran->permintaan->update(['status_tawaran' => 'terpenuhi']);

            // Reject penawaran lain untuk permintaan ini
            Penawaran::where('id_permintaan', $penawaran->id_permintaan)
                ->where('id_penawaran', '!=', $id)
                ->update(['status' => 'rejected']);

            // B. Siapkan Postingan (Transaksi butuh ID Postingan)
            // Cek apakah buah ini sudah punya postingan? Jika belum, buat hidden postingan.
            $postingan = Postingan::where('id_buah', $penawaran->id_buah)->first();
            if (!$postingan) {
                $postingan = Postingan::create([
                    'id_pengguna' => $penawaran->id_petani,
                    'id_buah' => $penawaran->id_buah,
                    'tipe_postingan' => 'jual', 
                    'judul_posting' => 'Penawaran Khusus: ' . $penawaran->buah->nama_buah,
                    'keterangan' => 'Postingan otomatis untuk transaksi penawaran.',
                    'total_harga' => 0, 
                    'status' => 'aktif',
                ]);
            }

            // C. Hitung Ongkir & Jarak
            $sellerAddress = $penawaran->petani->alamatPengguna;
            $buyerAddress = $mitra->alamatPengguna;
            
            $jarak = 0;
            $ongkir = 0;
            
            if ($sellerAddress && $sellerAddress->latitude && $sellerAddress->longitude &&
                $buyerAddress->latitude && $buyerAddress->longitude) {
                
                $jarak = $this->calculateDistance(
                    $sellerAddress->latitude, 
                    $sellerAddress->longitude,
                    $buyerAddress->latitude,
                    $buyerAddress->longitude
                );
                // Rate: Rp 5.000 per KM
                $ongkir = ceil($jarak * 5000); 
            }

            // D. Hitung Total Harga
            // Asumsi: Deal quantity = permintaan quantity
            $jumlahKg = $penawaran->permintaan->jumlah_dicari_kg;
            
            // Cek Stok Real-time (PENTING)
            if ($penawaran->buah->stok < $jumlahKg) {
                 throw new \Exception('Stok petani tidak mencukupi untuk jumlah ini (' . $jumlahKg . 'kg).');
            }

            $hargaPerKg = $penawaran->harga_tawaran;
            $totalHargaBarang = $hargaPerKg * $jumlahKg;
            $biayaAdmin = ceil($totalHargaBarang * 0.025); // 2.5%
            $totalBayar = $totalHargaBarang + $ongkir + $biayaAdmin;

            // E. Buat Transaksi
            $transaksi = Transaksi::create([
                'id_postingan' => $postingan->id_posting,
                'id_pembeli' => $mitra->id_pengguna,
                'id_penjual' => $penawaran->id_petani,
                'jumlah_kg' => $jumlahKg,
                'harga_per_kg' => $hargaPerKg,
                'total_harga_barang' => $totalHargaBarang,
                'biaya_ongkir' => $ongkir,
                'jarak_km' => $jarak,
                'alamat_pengiriman_snapshot' => $buyerAddress->toArray(),
                'total_bayar' => $totalBayar,
                'status' => 'menunggu_pembayaran',
            ]);

            // F. Kurangi Stok Langsung
            $penawaran->buah->decrement('stok', $jumlahKg);

            DB::commit();

            // Redirect langsung ke halaman bayar / detail transaksi
            return redirect()->route('transaksi.payment', $transaksi->id_transaksi)
                ->with('success', 'Tawaran diterima! Pesanan otomatis dibuat. Silakan upload bukti pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Hitung jarak (Haversine) - Helper
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
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
