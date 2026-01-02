<x-guest-layout>
    <div class="min-h-screen bg-[#f3f4f6] pb-20">
        <!-- Navbar Minimalis -->
        <div class="bg-white border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
                <a href="{{ route('marketplace.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-[#022c22] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span class="font-bold">Kembali ke Market</span>
                </a>
                <div class="flex items-center gap-2">
                     <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-[#022c22] text-xs">
                        {{ substr($postingan->user->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-bold text-gray-900">{{ $postingan->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Left: Image Gallery -->
                <div class="space-y-4">
                    <div class="bg-white rounded-[2rem] p-2 shadow-sm border border-gray-100 overflow-hidden">
                        @if($postingan->buah->gambar)
                            <img src="{{ asset('storage/' . $postingan->buah->gambar) }}" class="w-full aspect-square object-cover rounded-[1.5rem]">
                        @else
                            <div class="w-full aspect-square bg-gray-50 rounded-[1.5rem] flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                        @endif
                    </div>

                    <!-- Criteria Badges -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                            <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">KULIT</span>
                            <div class="text-[#022c22] font-bold text-lg">{{ $postingan->buah->penilaian->skor_kulit * 100 }}%</div>
                            <span class="text-[10px] text-gray-500">{{ Str::limit($postingan->buah->penilaian->deskripsi_kulit, 15) }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                            <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">BENTUK</span>
                            <div class="text-[#022c22] font-bold text-lg">{{ $postingan->buah->penilaian->skor_bentuk * 100 }}%</div>
                             <span class="text-[10px] text-gray-500">{{ Str::limit($postingan->buah->penilaian->deskripsi_bentuk, 15) }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                            <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">TEKSTUR</span>
                            <div class="text-[#022c22] font-bold text-lg">{{ $postingan->buah->penilaian->skor_tekstur * 100 }}%</div>
                             <span class="text-[10px] text-gray-500">{{ Str::limit($postingan->buah->penilaian->deskripsi_tekstur, 15) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Product Info -->
                <div class="flex flex-col h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                             <span class="inline-block bg-[#bef264] text-[#022c22] text-xs font-bold px-2 py-1 rounded-md mb-2">Grade B (Berdasarkan Skor)</span>
                             <h1 class="text-3xl font-bold text-[#022c22] leading-tight">{{ $postingan->judul_posting }}</h1>
                             <p class="text-gray-500 mt-1">{{ $postingan->buah->nama_buah }} • Stok: <span class="text-gray-900 font-bold">{{ $postingan->buah->stok }} Kg</span></p>
                        </div>
                        <div class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-lg text-sm font-bold flex items-center gap-1">
                            <span>★ {{ number_format($postingan->buah->penilaian->total_skor_akhir * 5, 1) }}</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-gray-100 mb-6 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wide">Deskripsi Produk</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ $postingan->keterangan ?? 'Tidak ada deskripsi tambahan.' }}
                        </p>

                        <div class="flex items-center gap-2 text-sm text-gray-500 bg-gray-50 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lokasi: {{ $postingan->user->alamatPengguna->kota ?? $postingan->user->alamatPengguna->alamat_lengkap ?? 'Belum diset' }}
                        </div>
                    </div>

                    <div class="mt-auto bg-white border border-gray-200 p-6 rounded-[2rem] shadow-lg sticky bottom-4">
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <span class="block text-xs text-gray-400 mb-1">Harga Penawaran</span>
                                <div class="flex items-baseline gap-2">
                                     <span class="text-3xl font-bold text-[#022c22]">Rp {{ number_format($postingan->buah->harga_akhir, 0, ',', '.') }}</span>
                                     <span class="text-sm text-gray-400 font-medium">/ kg</span>
                                </div>
                                @if($postingan->buah->harga_awal > $postingan->buah->harga_akhir)
                                    <span class="text-xs text-gray-400 line-through">Rp {{ number_format($postingan->buah->harga_awal, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <form action="{{ route('chat.start') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="id_posting" value="{{ $postingan->id_posting }}">
                                    <a href="{{ route('chat.start', $postingan->id_posting) }}" >
                                        <button type="submit" class="w-full bg-white border-2 border-[#022c22] hover:cursor-pointer text-[#022c22] py-3 rounded-xl font-bold hover:bg-gray-50 transition-colors">
                                            Chat Petani        
                                        </button>
                                    </a>
                                
                            </form>

                            @auth
                                @if(auth()->user()->peran == 'mitra')
                                    @if($postingan->buah->stok > 0)
                                        <a href="{{ route('transaksi.checkout', $postingan->id_posting) }}" class="flex-2 bg-[#022c22] text-[#bef264] py-3 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all text-center flex items-center justify-center">
                                            Beli Sekarang
                                        </a>
                                    @else
                                        <button disabled class="flex-2 bg-gray-300 text-gray-500 py-3 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            Stok Habis
                                        </button>
                                    @endif
                                @else
                                    <button disabled class="flex-2 bg-gray-200 text-gray-400 py-3 rounded-xl font-bold cursor-not-allowed">
                                        Khusus Mitra
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="flex-2 bg-[#022c22] text-[#bef264] py-3 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all text-center flex items-center justify-center">
                                    Login untuk Membeli
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- More from Seller (Optional placeholder) -->
            <div class="mt-16">
                <h3 class="font-bold text-xl text-gray-800 mb-6">Produk Lain dari Petani Ini</h3>
                 <div class="bg-gray-50 rounded-2xl p-8 text-center text-gray-400 border border-gray-200 border-dashed">
                    Segera Hadir
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
