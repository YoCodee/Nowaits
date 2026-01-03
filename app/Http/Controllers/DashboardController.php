<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buah;
use App\Models\User;
use App\Models\Postingan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->peran;

        $viewData = ['role' => $role];

        if ($role === 'petani') {
            // ... (Existing Petani Logic)
            $statuses = ['dikirim', 'selesai'];
            $pendapatanKotor = Transaksi::where('id_penjual', $user->id_pengguna)
                ->whereIn('status', $statuses)
                ->sum('total_bayar');

            $pendapatanBersih = Transaksi::where('id_penjual', $user->id_pengguna)
                ->whereIn('status', $statuses)
                ->sum('total_harga_barang');

            $buahTerjual = Transaksi::where('id_penjual', $user->id_pengguna)
                ->whereIn('status', $statuses)
                ->sum('jumlah_kg');

            $stok = Buah::where('id_pengguna', $user->id_pengguna)->sum('stok');

            $pesananTerbaru = Transaksi::with(['pembeli', 'postingan.buah'])
                ->where('id_penjual', $user->id_pengguna)
                ->latest()
                ->take(5)
                ->get();

            $viewData = array_merge($viewData, [
                'pendapatanKotor' => $pendapatanKotor,
                'pendapatanBersih' => $pendapatanBersih,
                'buahTerjual' => $buahTerjual,
                'stok' => $stok,
                'pesananTerbaru' => $pesananTerbaru
            ]);

        } elseif ($role === 'mitra') {
            // ... (Existing Mitra Logic)
            $statuses = ['dikirim', 'selesai'];
            
            $totalPembelianRp = Transaksi::where('id_pembeli', $user->id_pengguna)
                ->whereIn('status', $statuses)
                ->sum('total_bayar');

            $totalBuahDibeli = Transaksi::where('id_pembeli', $user->id_pengguna)
                ->whereIn('status', $statuses)
                ->sum('jumlah_kg');
            
            $requestAktif = \App\Models\PermintaanMitra::where('id_pengguna', $user->id_pengguna)
                ->where('status_tawaran', 'aktif')
                ->count();
                
            $permintaanAnda = \App\Models\PermintaanMitra::where('id_pengguna', $user->id_pengguna)
                ->latest()
                ->take(5)
                ->get();
                
            $viewData = array_merge($viewData, [
                'totalPembelianRp' => $totalPembelianRp,
                'totalBuahDibeli' => $totalBuahDibeli,
                'requestAktif' => $requestAktif,
                'permintaanAnda' => $permintaanAnda
            ]);
        } elseif ($role === 'admin') {
            // Admin Stats
            
            // 1. SDG Tracker
            // Total waste saved = Total fruit sold (as in, prevented from rotting/unsold). 
            // In a real app, this might be more specific (e.g., 'ugly' fruits saved), but user implies total sold.
            $wasteSavedKg = Transaksi::where('status', 'selesai')->sum('jumlah_kg');
            
            // Farmer Income Helped
            $pendapatanPetani = Transaksi::where('status', 'selesai')->sum('total_harga_barang');

            // Active Mitra
            $mitraAktif = User::where('peran', 'mitra')->count();

            // Total Users
            $totalPetani = User::where('peran', 'petani')->count();
            $totalMitra = $mitraAktif;
            $totalUser = User::count();

            // 2. Trends / Recent Activity (Latest Transactions)
            $recentTransactions = Transaksi::with(['penjual', 'pembeli', 'postingan.buah'])
                ->where('status', 'selesai')
                ->latest()
                ->take(5)
                ->get();

            // 3. Lists for Management
            $petaniList = User::where('peran', 'petani')->latest()->get();
            $mitraList = User::where('peran', 'mitra')->latest()->get();

            $viewData = array_merge($viewData, [
                'wasteSavedKg' => $wasteSavedKg,
                'pendapatanPetani' => $pendapatanPetani,
                'mitraAktif' => $mitraAktif,
                'totalPetani' => $totalPetani,
                'totalMitra' => $totalMitra,
                'totalUser' => $totalUser,
                'recentTransactions' => $recentTransactions,
                'petaniList' => $petaniList,
                'mitraList' => $mitraList,
            ]);
        }

        return view('pages.dashboard.index', $viewData);
    }
}
