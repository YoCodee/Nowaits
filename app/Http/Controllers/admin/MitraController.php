<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = User::with('alamatPengguna')
            ->where('peran', 'mitra')
            ->latest()
            ->paginate(10);
            
        return view('pages.dashboard.admin.mitra.index', compact('mitras'));
    }
}
