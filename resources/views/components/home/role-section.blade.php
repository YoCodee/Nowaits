<section id="role-section" class="w-full py-24 px-6 md:px-12 bg-white text-[#022c22] overflow-hidden role-section-wrapper">
    {{-- Inline Styles for specific font if needed, assuming Instrument Serif is loaded globally or in features --}}
    <style>
        .role-section-wrapper {
            font-family: "Instrument Serif", serif;
        }
        .font-sans {
            font-family: sans-serif; /* Fallback or use Tailwind's font-sans */
        }
    </style>

    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h2 id="role-title" class="text-4xl md:text-7xl font-bold leading-none tracking-tight font-sans opacity-0 translate-y-[50px]">
                Siapa Anda dalam <br />
                <span class="text-[#bef264] px-2 bg-[#022c22] inline-block -rotate-1 transform mt-2">
                    Ekosistem Kami?
                </span>
            </h2>
            <p class="mt-6 text-gray-500 text-lg max-w-2xl mx-auto font-sans">
                Bergabunglah sebagai Petani untuk menjangkau pasar lebih luas, atau
                sebagai Mitra untuk mendapatkan pasokan berkualitas dengan harga
                terbaik.
            </p>
        </div>

        {{-- Roles Container --}}
        <div id="role-container" class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 font-sans">
            {{-- Petani Card --}}
            <div id="role-petani" class="group relative h-[600px] w-full rounded-[2.5rem] overflow-hidden cursor-pointer shadow-2xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(0,0,0,0.2)] opacity-0 translate-y-[100px]">
                {{-- Background Image --}}
                <div class="absolute inset-0">
                    <img src="{{ asset('images/petani.avif') }}" alt="Petani" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-[#022c22] via-[#022c22]/40 to-transparent opacity-90 transition-opacity duration-300 group-hover:opacity-80"></div>
                </div>

                {{-- Content --}}
                <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-end items-start text-white">
                    <div class="mb-6 transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                        <span class="bg-[#bef264] text-[#022c22] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                            Untuk Penjual
                        </span>
                        <h3 class="text-4xl md:text-5xl font-bold mb-3 leading-tight">
                            Petani
                        </h3>
                        <p class="text-gray-300 text-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 transform translate-y-4 group-hover:translate-y-0 max-w-sm">
                            Jual hasil panen Grade B Anda langsung ke pembeli tanpa
                            perantara. Ubah potensi rugi menjadi keuntungan pasti.
                        </p>
                    </div>

                    {{-- Decorative Line --}}
                    <div class="w-full h-[1px] bg-white/30 my-6 group-hover:bg-[#bef264] transition-colors duration-300"></div>

                    <div class="flex items-center gap-4 group/btn">
                        <a href="{{ route('petani') }}" class="text-xl font-bold flex items-center gap-2 group-hover:gap-4 transition-all duration-300">
                            Mulai Jualan
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#bef264]">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Mitra Card --}}
            <div id="role-mitra" class="group relative h-[600px] w-full rounded-[2.5rem] overflow-hidden cursor-pointer shadow-2xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(0,0,0,0.2)] opacity-0 translate-y-[100px]">
                {{-- Background Image --}}
                <div class="absolute inset-0">
                    <img src="{{ asset('images/mitra.avif') }}" alt="Mitra" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1a4036] via-[#1a4036]/40 to-transparent opacity-90 transition-opacity duration-300 group-hover:opacity-80"></div>
                </div>

                {{-- Content --}}
                <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-end items-start text-white">
                    <div class="mb-6 transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                        <span class="bg-white text-[#022c22] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                            Untuk Pembeli
                        </span>
                        <h3 class="text-4xl md:text-5xl font-bold mb-3 leading-tight">
                            Mitra
                        </h3>
                        <p class="text-gray-300 text-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 transform translate-y-4 group-hover:translate-y-0 max-w-sm">
                            Dapatkan pasokan buah layak konsumsi dengan harga miring.
                            Posting kebutuhan spesifik Anda dan biarkan petani memenuhi
                            permintaan.
                        </p>
                    </div>

                    {{-- Decorative Line --}}
                    <div class="w-full h-[1px] bg-white/30 my-6 group-hover:bg-white transition-colors duration-300"></div>

                    <div class="flex items-center gap-4 group/btn">
                        <a href="{{ route('mitra') }}" class="text-xl font-bold flex items-center gap-2 group-hover:gap-4 transition-all duration-300">
                            Gabung Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            const gsap = window.gsap;
            const ScrollTrigger = window.ScrollTrigger;

            if (gsap && ScrollTrigger) {
                const section = document.querySelector("#role-section");
                const title = document.querySelector("#role-title");
                const container = document.querySelector("#role-container");
                const petani = document.querySelector("#role-petani");
                const mitra = document.querySelector("#role-mitra");

                const ctx = gsap.context(() => {
                    // Title Animation
                    gsap.fromTo(title,
                        { y: 50, opacity: 0 },
                        {
                            y: 0,
                            opacity: 1,
                            duration: 1,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: title,
                                start: "top 80%",
                            }
                        }
                    );

                    // Cards Animation
                    gsap.fromTo([petani, mitra],
                        { y: 100, opacity: 0 },
                        {
                            y: 0,
                            opacity: 1,
                            duration: 1,
                            stagger: 0.2,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: container,
                                start: "top 75%",
                            }
                        }
                    );
                }, section);
            }
        }, 300);
    });
</script>
