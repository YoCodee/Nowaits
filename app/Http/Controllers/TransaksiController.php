<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Transaksi;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of transactions for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        
        // If Mitra (Buyer) -> Show Purchases
        if ($user->peran == 'mitra') {
            $transaksis = Transaksi::with(['postingan.buah', 'penjual', 'pengiriman'])
                ->where('id_pembeli', $user->id_pengguna)
                ->orderBy('created_at', 'desc')
                ->get();
                
            return view('pages.dashboard.mitra.transaksi.index', compact('transaksis'));
        }
        
        // If Petani (Seller) -> Redirect to Incoming Orders
        if ($user->peran == 'petani') {
            return redirect()->route('transaksi.sales');
        }
        
        abort(403); 
    }

    /**
     * Display Incoming Orders for Petani
     */
    public function incomingOrders()
    {
        $user = Auth::user();
        
        if ($user->peran !== 'petani') abort(403);

        $transaksis = Transaksi::with(['postingan.buah', 'pembeli.alamatPengguna', 'pengiriman'])
            ->where('id_penjual', $user->id_pengguna)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.dashboard.petani.transaksi.index', compact('transaksis'));
    }

    /**
     * Show Payment Page for Mitra
     */
    public function showPayment($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // Security Check
        if (Auth::user()->id_pengguna !== $transaksi->id_pembeli) abort(403);
        
        return view('pages.dashboard.mitra.transaksi.payment', compact('transaksi'));
    }

    /**
     * Process Payment Upload
     */
    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'bukti_bayar.required' => 'Mohon unggah foto bukti pembayaran.',
            'bukti_bayar.image' => 'File harus berupa gambar.',
            'bukti_bayar.mimes' => 'Format file harus berupa jpeg, png, atau jpg.',
            'bukti_bayar.max' => 'Ukuran file tidak boleh lebih dari 2MB. Silakan kompres gambar Anda.',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        
        if ($request->hasFile('bukti_bayar')) {
            // Store file securely (hashed name)
            $path = $request->file('bukti_bayar')->store('payments', 'public');
            
            $transaksi->update([
                'bukti_bayar' => $path,
                'status' => 'menunggu_konfirmasi', // Trigger verification flow
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi Petani.');
    }

    /**
     * Petani Verifies Order
     */
    /**
     * Handle Order Confirmation Actions (Accept, Reject, Complete)
     */
    public function confirmOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $user = Auth::user();
        $action = $request->action;

        // Logic for Seller (Petani)
        if ($user->id_pengguna === $transaksi->id_penjual) {
            if ($action === 'accept') {
                // Stok sudah dikurangi saat pesanan dibuat, jadi hanya update status
                $transaksi->update(['status' => 'diproses']);
                
            } elseif ($action === 'reject') {
                $transaksi->update(['status' => 'dibatalkan']);

                // Kembalikan stok ke petani karena dibatalkan
                $transaksi->postingan->buah->increment('stok', $transaksi->jumlah_kg);
            }
        } 
        // Logic for Buyer (Mitra)
        elseif ($user->id_pengguna === $transaksi->id_pembeli) {
            if ($action === 'complete') {
                $transaksi->update(['status' => 'selesai']);

                // Auto-update shipping status if exists
                if ($transaksi->pengiriman) {
                    $transaksi->pengiriman->update([
                        'status' => 'sampai',
                        'tgl_diterima' => now(),
                    ]);
                }
            } else {
                abort(403, 'Unauthorized action for buyer.');
            }
        } else {
            abort(403);
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Petani Ships Order
     */
    public function shipOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        if (Auth::user()->id_pengguna !== $transaksi->id_penjual) abort(403);

        $request->validate([
            'ekspedisi' => 'required|string',
            'no_resi' => 'nullable|string',
            'foto_bukti_kirim' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_bukti_kirim')) {
            $fotoPath = $request->file('foto_bukti_kirim')->store('shipping_proofs', 'public');
        }

        Pengiriman::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'ekspedisi' => $request->ekspedisi,
            'no_resi' => $request->no_resi ?? '-',
            'foto_bukti_kirim' => $fotoPath,
            'catatan' => $request->catatan,
            'status' => 'dikirim'
        ]);

        $transaksi->update(['status' => 'dikirim']);

        return back()->with('success', 'Barang berhasil dikirim!');
    }

    /**
     * Track Order Map
     */
    public function trackOrder($id)
    {
        $transaksi = Transaksi::with(['postingan.buah', 'penjual.alamatPengguna', 'pembeli.alamatPengguna', 'pengiriman'])
            ->findOrFail($id);

        $user = Auth::user();

        // Access Control
        if ($user->id_pengguna !== $transaksi->id_pembeli && $user->id_pengguna !== $transaksi->id_penjual) {
            abort(403);
        }

        // Get Coordinates
        $sellerLat = $transaksi->penjual->alamatPengguna->latitude;
        $sellerLng = $transaksi->penjual->alamatPengguna->longitude;
        
        // Prefer snapshot if available, else current profile
        $buyerLat = $transaksi->alamat_pengiriman_snapshot['latitude'] ?? $transaksi->pembeli->alamatPengguna->latitude;
        $buyerLng = $transaksi->alamat_pengiriman_snapshot['longitude'] ?? $transaksi->pembeli->alamatPengguna->longitude;

        return view('pages.dashboard.transaksi.track', compact('transaksi', 'sellerLat', 'sellerLng', 'buyerLat', 'buyerLng'));
    }

    /**
     * Display checkout page for a specific product.
     */
    public function checkout($id)
    {
        $postingan = Postingan::with(['buah', 'user.alamatPengguna'])->findOrFail($id);
        $user = Auth::user();
        
        // Validation: Cannot buy own product
        if ($postingan->id_pengguna === $user->id_pengguna) {
            return redirect()->back()->with('error', 'Anda tidak bisa membeli produk sendiri.');
        }

        // Validation: Must have address
        if (!$user->alamatPengguna) {
            return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi alamat Anda sebelum bertransaksi.');
        }

        // Check for custom price offer (from Penawaran)
        $customPrice = request('price');
        if ($customPrice) {
            $postingan->buah->harga_akhir = $customPrice;
        }

        // Calculate Shipping
        $ongkir = 0;
        $jarak = 0;
        $sellerAddress = $postingan->user->alamatPengguna;
        $buyerAddress = $user->alamatPengguna;
        $canCalculateShipping = false;

        if ($sellerAddress && $sellerAddress->latitude && $sellerAddress->longitude &&
            $buyerAddress->latitude && $buyerAddress->longitude) {
            
            $jarak = $this->calculateDistance(
                $sellerAddress->latitude, 
                $sellerAddress->longitude,
                $buyerAddress->latitude,
                $buyerAddress->longitude
            );
            
            // Rate: Rp 5.000 per KM (Simplified)
            $ongkir = ceil($jarak * 5000); 
            $canCalculateShipping = true;
        }

        return view('pages.marketplace.checkout', compact('postingan', 'user', 'ongkir', 'jarak', 'canCalculateShipping'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_postingan' => 'required|exists:postingans,id_posting',
            'jumlah_kg' => 'required|numeric|min:1',
        ]);

        $postingan = Postingan::with('buah')->findOrFail($request->id_postingan);
        
        // Stock Check
        if ($request->jumlah_kg > $postingan->buah->stok) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Recalculate everything securely
        $user = Auth::user();
        $sellerAddress = $postingan->user->alamatPengguna;
        $buyerAddress = $user->alamatPengguna;
        
        $jarak = 0;
        $ongkir = 0;
        
        if ($sellerAddress && $sellerAddress->latitude && $sellerAddress->longitude &&
            $buyerAddress && $buyerAddress->latitude && $buyerAddress->longitude) {
            
            $jarak = $this->calculateDistance(
                $sellerAddress->latitude, 
                $sellerAddress->longitude,
                $buyerAddress->latitude,
                $buyerAddress->longitude
            );
            $ongkir = ceil($jarak * 5000); 
        }

        if ($request->has('custom_price')) {
             $pricePerKg = $request->custom_price;
        } else {
             $pricePerKg = $postingan->buah->harga_akhir;
        }

        $totalHargaBarang = $pricePerKg * $request->jumlah_kg;
        $biayaAdmin = ceil($totalHargaBarang * 0.025);
        $totalBayar = $totalHargaBarang + $ongkir + $biayaAdmin;

        $transaksi = Transaksi::create([
            'id_postingan' => $postingan->id_posting,
            'id_pembeli' => $user->id_pengguna,
            'id_penjual' => $postingan->id_pengguna,
            'jumlah_kg' => $request->jumlah_kg,
            'harga_per_kg' => $pricePerKg,
            'total_harga_barang' => $totalHargaBarang,
            'biaya_ongkir' => $ongkir,
            'jarak_km' => $jarak,
            'alamat_pengiriman_snapshot' => $buyerAddress->toArray(),
            'total_bayar' => $totalBayar,
            'status' => 'menunggu_pembayaran',
        ]);

        // Kurangi Stok Langsung saat Pesanan Dibuat
        $postingan->buah->decrement('stok', $request->jumlah_kg);

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Haversine Formula to calculate distance in KM
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the earth in km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c; // Distance in km

        return $distance;
    }
}
