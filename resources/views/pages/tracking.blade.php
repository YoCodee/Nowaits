@extends('layouts.app')

@section('title', 'Lacak Pengiriman')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Tracking Pengiriman</h1>

    <!-- TODO: Teman -> Buat form input Resi / ID Pengiriman -->
    <div class="flex gap-2 mb-8">
        <input type="text" placeholder="Masukkan ID Pengiriman..." class="flex-1 p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        <button class="bg-green-600 text-white px-6 py-3 rounded font-bold hover:bg-green-700">Cari</button>
    </div>

    <!-- TODO: Teman -> Tampilkan status pengiriman di sini (Dummy Data dulu) -->
    <!-- 
        Contoh:
        - 10:00 - Paket diambil kurir
        - 12:00 - Paket sampai di gudang mitra
    -->
    <div class="border border-gray-200 rounded p-6 bg-white shadow-sm">
        <p class="text-gray-400 italic text-center">Hasil tracking akan muncul di sini...</p>
    </div>
</div>
@endsection
