<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petanis = User::with('alamatPengguna')
            ->where('peran', 'petani')
            ->latest()
            ->paginate(10);
            
        return view('pages.dashboard.admin.petani.index', compact('petanis'));
    }
}
