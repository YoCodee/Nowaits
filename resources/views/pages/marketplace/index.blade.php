<x-guest-layout>
    <div x-data="{
        activeTab: '{{ request('tab', 'jual') }}',
        priceMin: {{ $minPrice }},
        priceMax: {{ $maxPrice }},
        currentMin: {{ $minPrice }},
        currentMax: {{ $maxPrice }},
        search: ''
    }" class="min-h-screen bg-[#f3f4f6] p-4 md:p-8">

        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row items-center justify-between gap-4 max-w-7xl mx-auto w-full">
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-[#022c22] rounded-xl flex items-center justify-center text-[#bef264] font-bold text-xl hover:scale-105 transition-transform">
                    M
                </a>
                <span class="font-bold text-2xl text-gray-800 tracking-tight">
                    Market<span class="text-[#022c22]">Place</span>
                </span>
            </div>

            <!-- Search -->
            <form action="{{ route('marketplace.index') }}" method="GET" class="bg-white rounded-full flex items-center px-4 py-3 w-full max-w-xl shadow-sm border border-transparent focus-within:border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari buah..." class="ml-3 bg-transparent outline-none w-full text-sm text-gray-700 placeholder-gray-400">
            </form>

            <!-- User Menu -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-[#022c22]">Dashboard</a>
                    <div class="w-10 h-10 bg-[#022c22] text-[#bef264] rounded-full flex items-center justify-center font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-[#022c22]">Login</a>
                    <a href="{{ route('register') }}" class="bg-[#022c22] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#033a2d]">Register</a>
                @endauth
            </div>
        </header>

        <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">
                <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 flex-shrink-0 space-y-8 hidden lg:block">
                <form action="{{ route('marketplace.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Price Range -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-800">Filter Harga</h3>
                        </div>

                        <div class="mb-4 space-y-4">
                            <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#022c22]"
                                min="{{ $minPrice }}" max="{{ $maxPrice }}" x-model="currentMax">

                            <div class="flex justify-between text-xs font-bold text-[#022c22]">
                                <span class="bg-[#022c22] text-white px-2 py-1 rounded-lg">Rp <span x-text="currentMin.toLocaleString()"></span></span>
                                <span class="bg-[#022c22] text-white px-2 py-1 rounded-lg">Rp <span x-text="currentMax.toLocaleString()"></span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Criteria Filters -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6 space-y-6">
                         <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-gray-800">Kriteria Kualitas</h3>
                            <button type="submit" class="text-xs bg-[#bef264] px-2 py-1 rounded font-bold text-[#022c22]">Terapkan</button>
                        </div>

                        <!-- Kulit -->
                        <div>
                             <div class="flex justify-between text-xs mb-1">
                                <label class="font-bold text-gray-500">Min. Skor Kulit</label>
                                <span class="font-bold text-[#022c22]">{{ request('min_kulit', 0) }}</span>
                            </div>
                            <input type="range" name="min_kulit" min="0" max="1" step="0.1" value="{{ request('min_kulit', 0) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#022c22]">
                        </div>

                         <!-- Bentuk -->
                         <div>
                             <div class="flex justify-between text-xs mb-1">
                                <label class="font-bold text-gray-500">Min. Skor Bentuk</label>
                                <span class="font-bold text-[#022c22]">{{ request('min_bentuk', 0) }}</span>
                            </div>
                            <input type="range" name="min_bentuk" min="0" max="1" step="0.1" value="{{ request('min_bentuk', 0) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#022c22]">
                        </div>

                         <!-- Tekstur -->
                         <div>
                             <div class="flex justify-between text-xs mb-1">
                                <label class="font-bold text-gray-500">Min. Skor Tekstur</label>
                                <span class="font-bold text-[#022c22]">{{ request('min_tekstur', 0) }}</span>
                            </div>
                            <input type="range" name="min_tekstur" min="0" max="1" step="0.1" value="{{ request('min_tekstur', 0) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#022c22]">
                        </div>
                    </div>
                </form>

                <!-- Info Box -->
                <div class="bg-[#bef264]/20 p-5 rounded-2xl border border-[#bef264]">
                    <h3 class="font-bold text-[#022c22] mb-2">Tips Transaksi</h3>
                    <p class="text-xs text-[#022c22]/80 leading-relaxed">
                        Pastikan untuk selalu mengecek detail kondisi buah melalui foto dan deskripsi skor kualitas sebelum mengajukan pembelian.
                    </p>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Tabs -->
                <div class="bg-white p-2 rounded-2xl inline-flex mb-8 shadow-sm overflow-x-auto w-full md:w-auto">
                    <button @click="activeTab = 'jual'"
                        :class="activeTab === 'jual' ? 'bg-[#022c22] text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'"
                        class="flex-1 md:flex-none px-6 md:px-8 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        Stok Petani (Jual)
                    </button>
                    <button @click="activeTab = 'cari'"
                        :class="activeTab === 'cari' ? 'bg-[#022c22] text-white shadow-lg' : 'text-gray-500 hover:bg-gray-50'"
                        class="flex-1 md:flex-none px-6 md:px-8 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Permintaan Mitra (Cari)
                    </button>
                </div>

                <!-- Supply Grid (Petani Jualan) -->
                <div x-show="activeTab === 'jual'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($supplies as $post)
                        <!-- Filter by JS Price Range -->
                        <div x-show="{{ $post->buah->harga_akhir }} <= currentMax">
                            @if($post->buah->stok > 0)
                                <a href="{{ route('marketplace.show', $post->id_posting) }}" class="block bg-white rounded-[2rem] p-4 shadow-sm hover:shadow-lg transition-all duration-300 group flex flex-col relative h-full border border-transparent hover:border-gray-100 cursor-pointer">
                            @else
                                <div class="block bg-gray-50 rounded-[2rem] p-4 shadow-none border border-gray-100 flex flex-col relative h-full opacity-60 cursor-not-allowed">
                            @endif

                                <!-- Image Area -->
                                <div class="relative bg-[#f8f8f8] rounded-[1.5rem] mb-4 overflow-hidden h-48 group">
                                    @if($post->buah->gambar)
                                        <img src="{{ asset('storage/' . $post->buah->gambar) }}" class="w-full h-full object-cover {{ $post->buah->stok > 0 ? 'group-hover:scale-110 transition-transform duration-500' : 'grayscale' }}">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                        </div>
                                    @endif

                                    @if($post->buah->stok > 0)
                                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold shadow-sm flex items-center gap-1 text-[#022c22]">
                                            ★ {{ number_format($post->buah->penilaian->total_skor_akhir * 5, 1) }}
                                        </div>
                                    @else
                                        <div class="absolute inset-0 bg-black/10 flex items-center justify-center">
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm font-bold shadow-sm transform -rotate-6">Habis Terjual</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <h3 class="font-bold text-gray-800 text-md mb-1 line-clamp-2 leading-tight {{ $post->buah->stok > 0 ? 'group-hover:text-[#022c22]' : '' }}">
                                    {{ $post->judul_posting }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-4">{{ $post->user->name }} • {{ $post->user->alamatPengguna->kota ?? 'Lokasi via Chat' }}</p>

                                <div class="mt-auto flex items-center justify-between">
                                    <div class="flex flex-col">
                                        @if($post->buah->harga_awal > $post->buah->harga_akhir)
                                            <span class="text-xs text-gray-400 line-through">Rp {{ number_format($post->buah->harga_awal, 0, ',', '.') }}</span>
                                        @endif
                                        <div class="text-[#022c22] font-bold border border-[#022c22]/10 bg-[#022c22]/5 px-3 py-1.5 rounded-xl text-sm">
                                            Rp {{ number_format($post->buah->harga_akhir, 0, ',', '.') }} <span class="text-[10px] font-normal">/kg</span>
                                        </div>
                                    </div>

                                    @if($post->buah->stok > 0)
                                        <div class="w-10 h-10 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center hover:bg-[#bef264] hover:text-[#022c22] transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        </div>
                                    @else
                                         <div class="w-10 h-10 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center cursor-not-allowed">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </div>
                                    @endif
                                </div>

                            @if($post->buah->stok > 0)
                                </a>
                            @else
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Demand Grid (Mitra Cari) -->
                <div x-show="activeTab === 'cari'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(auth()->check() && auth()->user()->peran == 'mitra')
                        <a href="{{ route('permintaan-mitra.create') }}" class="bg-blue-50 border border-blue-100 rounded-[2rem] p-6 flex flex-col justify-center items-center text-center col-span-full py-8 hover:bg-blue-100 transition-colors cursor-pointer group">
                             <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                             </div>
                             <h3 class="font-bold text-blue-900 text-lg mb-2">Butuh Stok Besar?</h3>
                             <p class="text-blue-700 text-sm max-w-md">Klik kotak ini untuk pasang permintaan baru agar Petani bisa langsung menawarkan stok mereka.</p>
                        </a>
                    @endif

                    @foreach($demands as $req)
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100 group relative overflow-hidden">
                             <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-[4rem] -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>

                             <div class="relative z-10">
                                 <div class="flex items-center gap-3 mb-4">
                                     <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold overflow-hidden">
                                         {{ substr($req->user->name, 0, 1) }}
                                     </div>
                                     <div>
                                         <h4 class="font-bold text-gray-800 text-sm">{{ $req->user->name }}</h4>
                                         <span class="text-xs text-blue-500 bg-blue-50 px-2 py-0.5 rounded-full block w-fit">Mitra Verifikasi</span>
                                     </div>
                                 </div>

                                 <h3 class="text-lg font-bold text-[#022c22] mb-1 leading-tight">Mencari: {{ $req->nama_buah_dicari }}</h3>
                                 <p class="text-gray-500 text-xs mb-4">Jumlah dicari: <strong>{{ $req->jumlah_dicari_kg }} Kg</strong></p>

                                 <div class="flex flex-wrap gap-2 mb-4">
                                     <span class="text-[10px] uppercase font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded-md">Min Skor: {{ $req->min_skor_kualitas }}</span>
                                 </div>

                                 <div class="flex items-center justify-between border-t border-gray-50 pt-3">
                                     <div>
                                         <span class="block text-xs text-gray-400">Budget Ajuan</span>
                                         <span class="font-bold text-gray-700">Rp {{ number_format($req->harga_ajuan_per_kg, 0, ',', '.') }}</span>
                                     </div>
                                     @if(auth()->check() && auth()->user()->peran === 'petani')
                                         <a href="{{ route('penawaran.create', $req->id_permintaan) }}" class="bg-[#022c22] text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-[#bef264] hover:text-[#022c22] transition-colors">
                                             Tawarkan
                                         </a>
                                     @elseif(auth()->check() && auth()->user()->peran === 'mitra')
                                         <span class="text-xs text-gray-400 italic">Milik Anda</span>
                                     @else
                                         <a href="{{ route('login') }}" class="bg-gray-200 text-gray-500 px-4 py-2 rounded-xl text-xs font-bold hover:bg-gray-300">
                                             Login
                                         </a>
                                     @endif
                                 </div>
                             </div>
                        </div>
                    @endforeach
                </div>

            </main>
        </div>
    </div>
</x-guest-layout>
