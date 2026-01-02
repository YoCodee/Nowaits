<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\PermintaanMitra;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch Postingan Petani (Supply) -> Tipe 'jual'
        $querySupply = Postingan::with(['buah.penilaian', 'user.alamatPengguna'])
            ->where('status', 'aktif')
            ->where('tipe_postingan', 'jual')
            ->where('judul_posting', 'not like', 'Penawaran Khusus%');

        // Optional: Filter logic if needed later (e.g. search)
        if ($request->has('search')) {
            $search = $request->search;
            $querySupply->whereHas('buah', function ($q) use ($search) {
                $q->where('nama_buah', 'like', "%{$search}%");
            });
        }

        // Filter Criteria (0-1)
        if ($request->has('min_kulit')) {
            $querySupply->whereHas('buah.penilaian', function ($q) use ($request) {
                $q->where('skor_kulit', '>=', $request->min_kulit);
            });
        }
        if ($request->has('min_bentuk')) {
            $querySupply->whereHas('buah.penilaian', function ($q) use ($request) {
                $q->where('skor_bentuk', '>=', $request->min_bentuk);
            });
        }
         if ($request->has('min_tekstur')) {
            $querySupply->whereHas('buah.penilaian', function ($q) use ($request) {
                $q->where('skor_tekstur', '>=', $request->min_tekstur);
            });
        }
        
        $supplies = $querySupply->latest()->get();

        // 2. Fetch Permintaan Mitra (Demand)
        // Filter by status 'aktif'
        $queryDemand = PermintaanMitra::with(['user.alamatPengguna'])
            ->where('status_tawaran', 'aktif');
            
        if ($request->has('search')) {
             $queryDemand->where('nama_buah_dicari', 'like', "%{$request->search}%");
        }

        $demands = $queryDemand->latest()->get();

        // 3. Calculate Price Range for Sidebar (based on Supply)
        $prices = $supplies->map(function ($post) {
            return $post->buah->harga_akhir;
        })->toArray();
        
        $minPrice = (!empty($prices)) ? min($prices) : 0;
        $maxPrice = (!empty($prices)) ? max($prices) : 0;

        return view('pages.marketplace.index', compact('supplies', 'demands', 'minPrice', 'maxPrice'));
    }

    public function show($id)
    {
        $postingan = Postingan::with(['buah.penilaian', 'user.alamatPengguna'])
            ->where('id_posting', $id)
            ->firstOrFail();

        return view('pages.marketplace.show', compact('postingan'));
    }
}
