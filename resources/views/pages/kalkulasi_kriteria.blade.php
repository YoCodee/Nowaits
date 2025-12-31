@extends('layouts.app')

@section('title', 'Kalkulasi Kriteria Buah - NoWaits')

@section('content')

<div class="py-8 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4"> Kriteria Buah </h1>
        <p class="text-gray-600 mb-6">Berikut adalah kriteria buah yang dapat petani tawarkan kepada mitra dan mitra dapatkan dari petani. Skor penilaian kriteria buah dari skala 0-1.</p>
        <div class="mb-16">
            <div class="flex items-center justify-center mb-8">
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
                <h2 class="px-4 text-xl md:text-2xl font-serif text-green-600 uppercase tracking-widest text-center">
                    1. Kondisi Kulit 
                </h2>
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/skin_condition.jpg') }}" 
                         alt="Buah Grade A" 
                         class="rounded-lg shadow-md w-full object-cover h-64 md:h-72">
                </div>
                <div class="w-full md:w-1/2">
                    <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                       Dalam penentuan harga berdasarkan kondisi kulit, semakin sempurna sesuai standar estetika pasar kondisi kulit buah maka skor akan semakin tinggi dan harga semakin tinggi. Sebaliknya jika ada kekurangan seperti bercak, warna tidak rata, berlubang dan lain-lainnya, tetap ada nilainya namun harga akan sedikit berkurang berdasarkan seberapa parah kekurangan tersebut.  
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-16">
            <div class="flex items-center justify-center mb-8">
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
                <h2 class="px-4 text-xl md:text-2xl font-serif text-green-600 uppercase tracking-widest text-center">
                    2. Bentuk
                </h2>
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/deformed_fruits.jpg') }}"
                         alt="Buah Grade B" 
                         class="rounded-lg shadow-md w-full object-cover h-64 md:h-72">
                </div>
                <div class="w-full md:w-1/2">
                    <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                    Skor penilaian bentuk dilihat dari keseragaman dan standar bentuk buah ideal di pasar. Jika bentuk tidak beraturan atau cacat maka skor akan semakin rendah dan harga juga akan berkurang. 
                    </p>
                    
                </div>
            </div>
        </div>

        <div class="mb-16">
            <div class="flex items-center justify-center mb-8">
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
                <h2 class="px-4 text-xl md:text-2xl font-serif text-green-600 uppercase tracking-widest text-center">
                    3. Tekstur dan Warna
                </h2>
                <div class="h-px bg-gray-300 w-12 md:w-24"></div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/texturecolor_fruits.jpg') }}" 
                         alt="Buah Grade C" 
                         class="rounded-lg shadow-md w-full object-cover h-64 md:h-72">
                </div>
                <div class="w-full md:w-1/2">
                    <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                    Pada kategori ini tingkat kematangan buah menjadi penentu naik turunnya harga. Kematangan ditentukan dari tekstur saat diberi tekanan dan kepekatan warna buah. Semakin matang sempurna suatu buah maka harga mengikuti harga ideal pasar. Akan tetapi, bila terlalu matang atau kurang matang/mentah maka skor tergolong rendah dan harga jual berkurang.
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <div class="bg-green-50 rounded-2xl p-8 md:p-12 border border-green-100 shadow-sm relative overflow-hidden">
                
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-green-100 rounded-full opacity-50 blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-4">Mengapa Klasifikasi Ini Penting?</h2>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-10">
                        
                        <div class="w-full md:w-1/2 order-2 md:order-1">
                            <ul class="space-y-6">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white text-green-600 flex items-center justify-center shadow-sm font-bold text-lg">1</div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-900">Mendukung Gerakan Zero Waste</h4>
                                        <p class="text-gray-600 text-sm mt-1">Berbagai kualitas buah layak dan dapat dimanfaatkan meski kekurangan dari satu atau lebih aspeknya.</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white text-green-600 flex items-center justify-center shadow-sm font-bold text-lg">2</div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-900">Efisiensi Sumber Daya</h4>
                                        <p class="text-gray-600 text-sm mt-1">Tidak ada air, pupuk, dan tenaga kerja yang terbuang sia-sia untuk menumbuhkan "sampah".</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white text-green-600 flex items-center justify-center shadow-sm font-bold text-lg">3</div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-900">Kepercayaan Mitra</h4>
                                        <p class="text-gray-600 text-sm mt-1">Klasifikasi yang jujur membuat pembeli industri percaya dan berlangganan rutin.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="w-full md:w-1/2 order-1 md:order-2">
                            <img src="{{ asset('images/happy_farmer.jpg') }}" 
                                 alt="Petani Bahagia" 
                                 class="rounded-xl shadow-lg w-full object-cover h-64 md:h-80 border-4 border-white transform rotate-2 hover:rotate-0 transition duration-300">
                        </div>

                    </div>
                </div>
        </div>

    </div>
</div>

@endsection