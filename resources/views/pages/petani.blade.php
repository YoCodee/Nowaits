@extends('layouts.app')

@section('title', 'Mitra Petani - NoWaits')

@section('content')
    @include('components.home.navbar')
<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* Style Hexagon & Font (Tetap) */
    .hexagon {
        width: 100%;
        height: 100%;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        object-fit: cover;
        /* Tambahan transisi halus saat hover */
        transition: transform 0.3s ease;
    }

    /* Efek hover sedikit membesar */
    .hexagon-wrapper:hover .hexagon {
        transform: scale(1.05);
    }

    body { font-family: 'Inter', sans-serif; }
</style>

<div class="relative bg-white overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-gray-50 to-white -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Solusi untuk Segala <span class="text-green-600">Hasil Panen</span>  Petani
                </h1>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    Menjembatani petani dengan mitra untuk mengurangi limbah pangan dan kerugian petani.                </p>
            </div>

            <div class="relative flex justify-center lg:justify-end items-center">
                <div class="relative w-[400px] h-[400px] hidden lg:block">

                    <div class="absolute top-0 right-10 w-48 h-52 hexagon-wrapper filter drop-shadow-lg">
                        <img src="{{ asset('images/good_fruits.jpg') }}" class="hexagon bg-gray-200" alt="Buah Sempurna Grade A">
                        <div class="absolute bottom-5 left-0 right-0 text-center">

                        </div>
                    </div>

                    <div class="absolute top-32 right-32 w-56 h-64 z-10 hexagon-wrapper filter drop-shadow-lg">
                        <img src="{{ asset('images/imperfect_fruits.png') }}" class="hexagon bg-gray-200" alt="Buah Kurang Sempurna Grade B">
                        <div class="absolute bottom-8 left-0 right-0 text-center">

                        </div>
                    </div>

                    <div class="absolute bottom-0 right-0 w-48 h-52 hexagon-wrapper filter drop-shadow-lg">
                         <img src="{{ asset('images/rotten_fruits.jpg') }}" class="hexagon bg-gray-200" alt="Limbah Organik Grade C">
                         <div class="absolute bottom-5 left-0 right-0 text-center">

                        </div>
                    </div>

                </div>

                <img src="{{ asset('images/good_fruits.jpg') }}" alt="Petani" class="block lg:hidden rounded-2xl shadow-xl w-full">
            </div>
        </div>
    </div>
</div>

<div class="py-16 bg-white" id="profit-check">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Dapatkan Profit dan Kurangi Food Waste</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                Petani rata-rata membuang <strong>30% hasil panen</strong> karena tidak memenuhi standar pasar atau hasil panen yang gagal. <br>
                Di NoWaits, semuanya itu tetap bernilai.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="p-8 rounded-2xl border border-red-100 bg-red-50/50 grayscale opacity-80 hover:opacity-100 transition">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-full bg-red-200 flex items-center justify-center text-red-700 font-bold mr-4">X</div>
                    <h3 class="text-xl font-bold text-gray-800">Cara Lama </h3>
                </div>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex items-start">
                        <span class="mr-2 text-red-500">⚠</span> Hanya menjual buah yang 'sempurna'.
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 text-red-500">⚠</span> Buah yang tidak memenuhi standar pasar dibuang atau dikasih cuma-cuma.
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 text-red-500">⚠</span> Limbah busuk menumpuk, mengundang hama lalat dan memperbanyak sampah.
                    </li>
                    <li class="flex items-start font-bold text-red-600 mt-4">
                        = Kerugian yang besar.
                    </li>
                </ul>
            </div>

            <div class="p-8 rounded-2xl border-2 border-green-500 bg-white shadow-xl transform scale-105 z-10">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-bold mr-4">✓</div>
                    <h3 class="text-xl font-bold text-gray-900">Cara NoWaits </h3>
                </div>
                <ul class="space-y-4 text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <strong>Buah sempurna:</strong> Dijual harga pasar premium.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <strong>Layak konsumsi tapi tidak estetik: </strong> Dibeli pabrik jus & keripik.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <strong>Tidak layak konsumsi:</strong> Dibeli peternak & pabrik pupuk.
                    </li>
                    <li class="flex items-start font-bold text-green-700 mt-4 text-lg">
                        = 100% Panen terjual semua dan tidak ada limbah.
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Siapa Pasarnya?</h2>
            <p class="text-gray-600 mt-2">Jangan khawatir soal pembeli. Kami sudah siapkan pasarnya untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4 text-2xl">🏭</div>
                <h4 class="font-bold text-lg mb-2">Industri Olahan</h4>
                <p class="text-sm text-gray-600">Pabrik selai dan saos tidak butuh buah cantik. Mereka butuh buah murah dan rasanya enak. Itulah pasar buah Grade B Anda.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="h-12 w-12 bg-amber-100 rounded-lg flex items-center justify-center mb-4 text-2xl">🐛</div>
                <h4 class="font-bold text-lg mb-2">Peternak Maggot (BSF)</h4>
                <p class="text-sm text-gray-600">Semakin busuk buahnya, semakin disukai maggot. Ubah limbah bau Anda menjadi pakan berprotein tinggi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 text-2xl">⚡</div>
                <h4 class="font-bold text-lg mb-2">Pembangkit Biogas</h4>
                <p class="text-sm text-gray-600">Limbah organik dalam jumlah besar bisa kami salurkan untuk diolah menjadi energi terbarukan.</p>
            </div>
        </div>
    </div>
</div>

<div class="py-16 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Cukup 3 Langkah Sederhana</h2>

        <div class="flex justify-center gap-8 mb-10 text-left flex-col md:flex-row">
            <div class="flex items-center">
                <span class="text-4xl font-bold text-gray-200 mr-3">1</span>
                <div>
                    <strong class="block text-gray-900">Daftar & Post</strong>
                    <span class="text-sm text-gray-500">Upload foto panen beserta kualitas yang ditawarkan.</span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-4xl font-bold text-gray-200 mr-3">2</span>
                <div>
                    <strong class="block text-gray-900">Terhubung Otomatis</strong>
                    <span class="text-sm text-gray-500">Sistem kami langsung menawarkan produk Anda ke mitra industri yang tepat.</span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-4xl font-bold text-gray-200 mr-3">3</span>
                <div>
                    <strong class="block text-gray-900">Transaksi Selesai</strong>
                    <span class="text-sm text-gray-500">Barang dijemput dan pembayaran langsung masuk ke rekening Anda.</span>
                </div>
            </div>
        </div>

        <div class="bg-green-50 p-8 rounded-2xl border border-green-100 inline-block w-full">
            <h3 class="text-xl font-bold text-green-900 mb-2">Siap Berkontribusi?</h3>
            <p class="text-green-800 mb-6">Bergabunglah dengan ratusan petani lainnya.</p>
            <a href="{{ Auth::check() ? route('dashboard') : route('register') }}" class="inline-block w-full md:w-auto px-10 py-4 bg-green-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-green-700 transition transform hover:-translate-y-1">
                {{ Auth::check() ? 'Ke Dashboard' : 'Daftar Jadi Petani Sekarang' }}
            </a>
            <p class="text-xs text-green-600 mt-4">*Pendaftaran 100% Gratis.</p>
        </div>
    </div>
</div>

@endsection
