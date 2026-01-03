<section id="criteria-section" x-data="{
        activeSlide: 0,
        totalSlides: 3,
        nextSlide() {
            this.activeSlide = (this.activeSlide === this.totalSlides - 1) ? 0 : this.activeSlide + 1;
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide === 0) ? this.totalSlides - 1 : this.activeSlide - 1;
        },
        goToSlide(index) {
            this.activeSlide = index;
        }
    }" class="w-full py-24 bg-[#022c22] text-white font-sans relative overflow-hidden criteria-section-wrapper selection:bg-[#bef264] selection:text-[#022c22]">

    {{-- Inline Styles --}}
    <style>
        .font-serif-italic {
            font-family: "Instrument Serif", serif;
            font-style: italic;
        }
        .criteria-slider-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .criteria-slide {
            flex: 0 0 100%;
            width: 100%;
        }
        /* Hide scrollbar for neatness */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

    {{-- Background Decor --}}
    <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-[#bef264] opacity-[0.03] rounded-full blur-[120px] -translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-[#22c55e] opacity-[0.03] rounded-full blur-[100px] translate-y-1/3 translate-x-1/3 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 criteria-container">
        
        {{-- Flex Layout: Left Header, Right Slider --}}
        <div class="flex flex-col lg:flex-row gap-16 lg:gap-8 items-center">
            
            {{-- Left Side: Text --}}
            <div class="w-full lg:w-5/12 ml-0 lg:ml-8" id="criteria-text">
                 <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/5 backdrop-blur-md text-[#bef264] text-xs font-bold tracking-widest uppercase mb-6">
                    Our Quality Standard
                </span>
                <h2 class="text-4xl md:text-6xl font-bold leading-[1.1] mb-8">
                    3 Pilar Utama <br>
                    <span class="font-serif-italic font-normal text-[#bef264]">Kualitas Buah</span>
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed mb-10 max-w-md">
                    NoWaits menggunakan 3 parameter inti untuk menilai kualitas buah secara objektif. Setiap parameter memiliki bobot yang sama dalam menentukan harga akhir yang adil.
                </p>

                {{-- Slider Navigation Controls --}}
                <div class="flex items-center gap-4">
                    <button @click="prevSlide()" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#bef264] hover:border-[#bef264] hover:text-[#022c22] transition-all duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover:-translate-x-1 transition-transform"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
                    </button>
                    
                    {{-- Pagination Dots --}}
                    <div class="flex gap-2">
                         <template x-for="i in totalSlides">
                             <button @click="goToSlide(i-1)" 
                                 class="h-2 rounded-full transition-all duration-300" 
                                 :class="activeSlide === i-1 ? 'w-8 bg-[#bef264]' : 'w-2 bg-white/20 hover:bg-white/40'">
                             </button>
                         </template>
                    </div>

                    <button @click="nextSlide()" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#bef264] hover:border-[#bef264] hover:text-[#022c22] transition-all duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            {{-- Right Side: Slider --}}
            <div class="w-full lg:w-7/12 relative overflow-hidden rounded-[2.5rem] bg-white/5 border border-white/5 backdrop-blur-sm shadow-2xl">
                
                {{-- Decorative Elements on Card --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-[4rem] z-20"></div>

                <div class="criteria-slider-track" :style="`transform: translateX(-${activeSlide * 100}%)`">
                    
                    {{-- SLIDE 1: KULIT --}}
                    <div class="criteria-slide p-8 md:p-12 box-border">
                        <div class="flex justify-between items-start mb-12">
                            <div class="w-16 h-16 bg-[#bef264] rounded-2xl flex items-center justify-center text-[#022c22] shadow-[0_0_30px_rgba(190,242,100,0.3)]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                            </div>
                            <span class="text-6xl font-bold font-serif-italic text-white/5">01</span>
                        </div>
                        
                        <h3 class="text-3xl font-bold mb-4 text-white">Kondisi Kulit</h3>
                        <p class="text-gray-400 leading-relaxed mb-8 h-20">
                            Evaluasi visual permukaan kulit buah untuk mendeteksi bercak, goresan, atau perubahan warna yang mempengaruhi estetika namun belum tentu mempengaruhi rasa.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Mulus Sempurna</span>
                                <span class="text-[#bef264] font-bold">1.0 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Bercak Minor</span>
                                <span class="text-yellow-400 font-bold">0.5 - 0.9 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Cacat Visual</span>
                                <span class="text-red-400 font-bold">&lt; 0.5 Skor</span>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDE 2: BENTUK --}}
                    <div class="criteria-slide p-8 md:p-12 box-border">
                        <div class="flex justify-between items-start mb-12">
                             <div class="w-16 h-16 bg-[#bef264] rounded-2xl flex items-center justify-center text-[#022c22] shadow-[0_0_30px_rgba(190,242,100,0.3)]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <span class="text-6xl font-bold font-serif-italic text-white/5">02</span>
                        </div>
                        
                        <h3 class="text-3xl font-bold mb-4 text-white">Bentuk Fisik</h3>
                        <p class="text-gray-400 leading-relaxed mb-8 h-20">
                            Penilaian terhadap simetri dan proporsi buah. Buah dengan bentuk unik atau tidak standar seringkali memiliki rasa yang sama lezatnya.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Bentuk Ideal</span>
                                <span class="text-[#bef264] font-bold">1.0 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Sedikit Tidak Rata</span>
                                <span class="text-yellow-400 font-bold">0.5 - 0.9 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Bentuk Abstrak</span>
                                <span class="text-red-400 font-bold">&lt; 0.5 Skor</span>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDE 3: TEKSTUR --}}
                    <div class="criteria-slide p-8 md:p-12 box-border">
                        <div class="flex justify-between items-start mb-12">
                             <div class="w-16 h-16 bg-[#bef264] rounded-2xl flex items-center justify-center text-[#022c22] shadow-[0_0_30px_rgba(190,242,100,0.3)]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                            </div>
                            <span class="text-6xl font-bold font-serif-italic text-white/5">03</span>
                        </div>
                        
                        <h3 class="text-3xl font-bold mb-4 text-white">Kualitas Tekstur</h3>
                        <p class="text-gray-400 leading-relaxed mb-8 h-20">
                            Indikator kesegaran dan kematangan buah melalui tingkat kekerasan dan kepadatan daging buah.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Segar & Keras</span>
                                <span class="text-[#bef264] font-bold">1.0 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Mulai Melunak</span>
                                <span class="text-yellow-400 font-bold">0.5 - 0.9 Skor</span>
                            </div>
                             <div class="flex items-center justify-between p-4 rounded-xl bg-black/20 border border-white/5">
                                <span class="font-medium">Terlalu Lembek</span>
                                <span class="text-red-400 font-bold">&lt; 0.5 Skor</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- NEW Pricing Logic Section --}}
        <div class="mt-32 border-t border-white/10 pt-20" id="pricing-logic">
             <div class="text-center max-w-3xl mx-auto mb-16">
                <h3 class="text-3xl md:text-5xl font-bold mb-6">
                    Sistem Perhitungan <br />
                    <span class="text-[#bef264] font-serif-italic font-normal">Harga Transparan</span>
                </h3>
                <p class="text-gray-400 text-lg">
                    Kami menggunakan sistem <strong>"Diskon Ketidaksempurnaan"</strong>. Semakin rendah skor kualitas buah dari angka sempurna (1.0), semakin besar potongan harga yang didapatkan mitra.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                 {{-- Connector Line (Desktop) --}}
                 <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#bef264]/30 to-transparent -translate-y-1/2 z-0"></div>

                {{-- Step 1 --}}
                <div class="bg-[#022c22] border border-white/10 rounded-3xl p-8 relative z-10 text-center hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-2xl font-bold text-[#bef264] mx-auto mb-6 border border-white/10">1</div>
                    <h4 class="text-xl font-bold mb-3">Tentukan Harga Awal</h4>
                    <p class="text-sm text-gray-400">Petani menentukan harga pasar normal untuk buah kualitas terbaik mereka.</p>
                     <div class="mt-4 bg-white/5 py-2 px-4 rounded-lg inline-block text-xs font-mono text-[#bef264]">
                        Rp 10.000 / kg
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="bg-[#022c22] border border-[#bef264]/30 rounded-3xl p-8 relative z-10 text-center shadow-[0_0_50px_rgba(190,242,100,0.1)] transform scale-105">
                    <div class="w-16 h-16 bg-[#bef264] rounded-full flex items-center justify-center text-3xl font-bold text-[#022c22] mx-auto mb-6">2</div>
                    <h4 class="text-xl font-bold mb-3 text-[#bef264]">Hitung Potongan</h4>
                    <p class="text-sm text-gray-400">Sistem menghitung nilai kekurangan berdasarkan total skor kualitas.</p>
                    <div class="mt-4 bg-white/10 py-3 px-4 rounded-lg text-xs font-mono text-white text-left">
                        <div class="flex justify-between mb-1">
                            <span>Harga Awal</span> <span>10.000</span>
                        </div>
                        <div class="flex justify-between mb-1 text-red-300">
                             <span>Kekurangan (20%)</span> <span>x 0.2</span>
                        </div>
                        <div class="border-t border-white/20 mt-1 pt-1 flex justify-between font-bold">
                            <span>Potongan</span> <span>Rp 2.000</span>
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="bg-[#022c22] border border-white/10 rounded-3xl p-8 relative z-10 text-center hover:-translate-y-2 transition-transform duration-300">
                     <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-2xl font-bold text-[#bef264] mx-auto mb-6 border border-white/10">3</div>
                    <h4 class="text-xl font-bold mb-3">Harga Akhir</h4>
                    <p class="text-sm text-gray-400">Harga final didapatkan setelah mengurangi harga awal dengan potongan.</p>
                    <div class="mt-4 bg-[#bef264] py-2 px-4 rounded-lg inline-block text-lg font-bold text-[#022c22]">
                        Rp 8.000 / kg
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('kalkulasi.kriteria') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-[#022c22] bg-[#bef264] rounded-full hover:bg-white transition-all duration-300 shadow-[0_0_20px_rgba(190,242,100,0.4)] hover:shadow-[0_0_30px_rgba(255,255,255,0.4)] transform hover:scale-105">
                     Informasi Kriteria Lengkap
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
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
                const section = document.querySelector("#criteria-section");
                const textCol = document.querySelector("#criteria-text");
                const pricingLogic = document.querySelector("#pricing-logic");

                const ctx = gsap.context(() => {
                    // Animate Text Side
                    gsap.fromTo(textCol, 
                        { x: -50, opacity: 0 },
                        { 
                            x: 0, opacity: 1, duration: 1, ease: "power3.out",
                            scrollTrigger: { trigger: section, start: "top 60%" }
                        }
                    );

                    // Animate Pricing Logic
                    gsap.fromTo(pricingLogic.children, 
                        { y: 50, opacity: 0 },
                        {
                            y: 0, opacity: 1, duration: 0.8, stagger: 0.2, ease: "power3.out",
                            scrollTrigger: { trigger: pricingLogic, start: "top 70%" }
                        }
                    );

                }, section);
            }
        }, 300);
    });
</script>
