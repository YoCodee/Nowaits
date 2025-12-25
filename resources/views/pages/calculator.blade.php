@extends('layouts.app')

@section('title', 'Kalkulator Harga')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Kalkulator Estimasi Harga</h1>
    
    <!-- TODO: Teman -> Buat logika kalkulator di sini -->
    <!-- 
        LOGIKA YANG PERLU DIBUAT (Front-end JS atau Backend Form):
        1. Input: Berat Panen (kg)
        2. Input: Harga Pasar per kg
        3. Input: Pilihan (Jual Mandiri / Ke Mitra)
        4. Output: 
           - Total Gross
           - Potongan Biaya Admin 
           - Estimasi Net Profit
    -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <p class="text-yellow-700">Area ini untuk fitur hitung-hitungan harga jual.</p>
    </div>
    
    <div class="border-2 border-dashed border-gray-300 h-64 flex items-center justify-center text-gray-400">
        [Layout Kalkulator]
    </div>
</div>
@endsection
