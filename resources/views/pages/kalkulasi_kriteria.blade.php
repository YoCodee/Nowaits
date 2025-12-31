@extends('layouts.app')

@section('title', 'Kalkulasi Kriteria Buah - NoWaits')

@section('content')

<div class="py-8 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Kalkulasi Kriteria Buah (Kosong)</h1>
        <p class="text-gray-600 mb-6">Halaman ini menampilkan informasi mengenai kalkulasi kriteria buah. Saat ini belum ada data kriteria — area di bawah berisi placeholder untuk nilai yang harus diisi.</p>

        <div class="bg-gray-50 border border-dashed border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Status</h2>
            <p class="text-gray-600">Kriteria buah: <strong class="text-red-600">Kosong / Belum Dikonfigurasi</strong></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-bold text-lg mb-2">Apa itu "Kriteria Buah"?</h3>
                <p class="text-gray-600 text-sm">Kriteria buah adalah aturan/ambang untuk mengkategorikan hasil panen (mis. Grade A, B, C) berdasarkan atribut seperti kondisi fisik, ukuran, kematangan, dan kerusakan. Kriteria ini digunakan untuk menentukan tujuan penjualan (pasar premium, industri olahan, pakan, atau pupuk).</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-bold text-lg mb-2">Contoh Kalkulasi</h3>
                <p class="text-gray-600 text-sm mb-3">Contoh sederhana penilaian sebuah buah (skala 0-100):</p>
                <ul class="text-gray-600 text-sm list-disc pl-5">
                    <li>Penampilan (estetika): 40%</li>
                    <li>Kemampuan konsumsi (daging buah): 40%</li>
                    <li>Kondisi fisik (kerusakan): 20%</li>
                </ul>
                <p class="text-sm text-gray-600 mt-3">Skor total = 0.4×Penampilan + 0.4×Kemampuan + 0.2×Kondisi. Kategori dapat ditentukan berdasarkan rentang skor.</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Tabel Kriteria (Placeholder)</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 border">Kategori</th>
                        <th class="p-3 border">Skor Min</th>
                        <th class="p-3 border">Skor Max</th>
                        <th class="p-3 border">Penjelasan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 border">Grade A</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border text-gray-500">Belum diisi</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="p-3 border">Grade B</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border text-gray-500">Belum diisi</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Grade C</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border">—</td>
                        <td class="p-3 border text-gray-500">Belum diisi</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 text-sm text-gray-600">
                <p><strong>Catatan:</strong> Untuk mengisi kriteria, tambahkan konfigurasi pada panel admin atau melalui file konfigurasi yang digunakan aplikasi. Jika Anda ingin, saya bisa membantu membuat UI admin untuk mengatur kriteria ini.</p>
            </div>
        </div>
    </div>
</div>

@endsection
