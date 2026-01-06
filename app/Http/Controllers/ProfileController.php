<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        // Get the first address if exists, or null
        $alamat = $user->alamats()->first();

        return view('pages.profile', compact('user', 'alamat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'no_telepon' => 'required|string|max:20',
            'label_alamat' => 'required|string|max:50',
            'alamat_lengkap' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nama_bank' => 'nullable|string|max:50',
            'no_rekening' => 'nullable|string|max:50',
        ]);

        // Update User Phone
        $user->update([
            'no_telepon' => $request->no_telepon
        ]);

        // Update or Create Address
        AlamatPengguna::updateOrCreate(
            ['id_pengguna' => $user->id_pengguna],
            [
                'id_alamat' => (string) Str::uuid(), // Only used if creating
                'label_alamat' => $request->label_alamat,
                'alamat_lengkap' => $request->alamat_lengkap,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }
}
