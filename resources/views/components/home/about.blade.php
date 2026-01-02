<section class="bg-white py-16 md:py-24 px-6 md:px-12 w-full text-[#022c22] rounded-t-[2rem] md:rounded-t-[3rem] -mt-10 relative z-20">
    <div class="max-w-7xl mx-auto">
        {{-- Header Section --}}
        <div class="flex flex-col lg:flex-row justify-between gap-8 md:gap-12 mb-12 md:mb-20">
            <h2 class="text-3xl md:text-6xl font-semibold max-w-xs leading-tight">
                Tentang <br /> Kami
            </h2>
            <div class="max-w-3xl">
                <p class="text-xl md:text-3xl leading-snug font-medium mb-6">
                    Nowaits memberdayakan petani dengan menyalurkan buah Grade B atau
                    'Imperfect' yang sering ditolak pasar konvensional, namun masih
                    sangat layak konsumsi. Kami menetapkan Standar Kualitas Umum yang
                    ketat untuk memastikan kelayakan konsumsi, memungkinkan Mitra
                    mendapatkan stok berkualitas dengan harga jauh lebih hemat.
                </p>
                <p class="text-gray-500 mb-8 text-lg">
                    Solusi Cerdas untuk Petani, Keuntungan Lebih untuk Mitra.
                </p>
                <button class="bg-[#bef264] text-[#022c22] px-8 py-4 rounded-full font-bold text-base flex items-center gap-3 hover:bg-[#a3e635] transition-all hover:scale-105 active:scale-95 cursor-pointer shadow-lg">
                    Learn More
                    <div class="w-6 h-6 bg-[#022c22] rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#bef264" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                </button>
            </div>
        </div>

        {{-- Cards Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Card 1 - Image Background --}}
            <div class="relative h-[500px] rounded-[2rem] overflow-hidden group shadow-xl">
                <img src="{{ asset('images/BuahTidakTerjual.webp') }}" alt="Fresh Vegetables" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-between text-white">
                    <div class="flex justify-between items-start">
                        <span class="text-5xl font-semibold">45%</span>
                        <div class="w-10 h-10 bg-[#bef264] rounded-full flex items-center justify-center text-[#022c22]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3">
                            Ditolak Karena "Wajah"
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                            Hampir separuh hasil panen ditolak supermarket hanya karena
                            bentuk tidak sempurna, ukuran kecil, atau sedikit goresan,
                            meski rasanya lezat.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Card 2 - Image Background (Farmer) --}}
            <div class="relative h-[500px] rounded-[2rem] overflow-hidden group shadow-xl">
                <img src="{{ asset('images/pexels-frida-flowers-xtradry-446122876-15450930.jpg') }}" alt="Local Farmer" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-between text-white">
                    <div class="flex justify-between items-start">
                        <span class="text-5xl font-semibold">13Jt</span>
                        <div class="w-10 h-10 bg-[#bef264] rounded-full flex items-center justify-center text-[#022c22]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3">Ton Sampah Pangan</h3>
                        <p class="text-gray-300 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                            Indonesia menghasilkan jutaan ton sampah makanan per tahun.
                            Sebagian besar adalah buah & sayur yang sebenarnya belum busuk
                            dan masih layak konsumsi.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Card 3 - Text Based (White/Light) --}}
            <div class="relative h-[500px] rounded-[2rem] overflow-hidden group shadow-xl">
                <img src="{{ asset('images/NutrisiSempurna.avif') }}" alt="Nutrisi Sempurna" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-between text-white">
                    <div class="flex justify-between items-start">
                        <span class="text-5xl font-semibold">100%</span>
                        <div class="w-10 h-10 bg-[#bef264] rounded-full flex items-center justify-center text-[#022c22]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3">
                            Nutrisi Tetap Sempurna
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0">
                            Di balik "ketidaksempurnaan" fisiknya, kandungan vitamin,
                            mineral, dan rasa buah-buahan ini 100% sama dengan buah
                            premium grade A di supermarket.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
