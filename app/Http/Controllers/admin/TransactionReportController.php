<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['postingan.buah', 'pembeli', 'penjual'])
            ->latest()
            ->paginate(15);

        return view('pages.dashboard.admin.transaksi.index', compact('transaksis'));
    }
}
