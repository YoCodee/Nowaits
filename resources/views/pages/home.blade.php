@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="text-center py-12">
    <h1 class="text-4xl font-extrabold text-green-700 mb-4">Solusi Pertanian Tanpa Waste</h1>
    <p class="text-lg text-gray-600 mb-8">Jual hasil panenmu, temukan mitra, dan hitung keuntunganmu di sini.</p>
    
    <div class="flex justify-center gap-4">
        <!-- TODO: Teman -> Perbaiki link tombol CTA (Call to Action) ini -->
        <button class="px-6 py-3 bg-green-600 text-white font-semibold rounded hover:bg-green-700">Mulai Jual Panen</button>
        <button class="px-6 py-3 bg-white border border-green-600 text-green-600 font-semibold rounded hover:bg-green-50">Gabung Mitra</button>
    </div>
</section>

<!-- Features Section -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
    
    <!-- Feature: Calculator -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
        <h3 class="text-xl font-bold mb-2">Kalkulator Petani</h3>
        <p class="text-gray-500 mb-4">Hitung estimasi keuntungan penjualan mandiri vs mitra.</p>
        <!-- TODO: Teman -> Link ke halaman kalkulator -->
        <a href="{{ route('calculator') }}" class="text-green-600 font-medium hover:underline">Coba Hitung &rarr;</a>
    </div>

    <!-- Feature: Mitra Link -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
        <h3 class="text-xl font-bold mb-2">Jaringan Mitra</h3>
        <p class="text-gray-500 mb-4">Kerja sama dengan mitra tepercaya untuk distribusi.</p>
        <!-- TODO: Teman -> Link ke halaman daftar mitra -->
        <a href="#" class="text-green-600 font-medium hover:underline">Lihat Mitra &rarr;</a>
    </div>

    <!-- Feature: Tracking -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
        <h3 class="text-xl font-bold mb-2">Lacak Kurir</h3>
        <p class="text-gray-500 mb-4">Pantau pengiriman hasil panen secara real-time.</p>
        <!-- TODO: Teman -> Link ke halaman tracking -->
        <a href="{{ route('tracking') }}" class="text-green-600 font-medium hover:underline">Lacak Paket &rarr;</a>
    </div>

</div>
@endsection
