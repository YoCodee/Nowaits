<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class ShippingReportController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::with(['transaksi.postingan.buah', 'transaksi.pembeli', 'transaksi.penjual', 'transaksi.postingan.user.alamatPengguna'])
            ->latest()
            ->paginate(15);

        return view('pages.dashboard.admin.pengiriman.index', compact('pengirimans'));
    }
}
