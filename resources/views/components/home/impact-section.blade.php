<section id="impact-section" class="w-full py-32 bg-white relative overflow-hidden flex flex-col items-center justify-center font-sans impact-section-wrapper">
    {{-- Inline Styles --}}
    <style>
        .impact-section-wrapper {
            font-family: sans-serif;
        }
        .font-serif-custom {
            font-family: "Instrument Serif", serif;
        }
        .font-serif-italic {
            font-family: "Instrument Serif", serif;
            font-style: italic;
        }
    </style>

    {{-- Decorative Radial Gradients --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#bef264] rounded-full mix-blend-multiply filter blur-[120px] opacity-30 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gray-200 rounded-full mix-blend-multiply filter blur-[120px] opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 w-full impact-container">
        {{-- Header --}}
        <div id="impact-title" class="text-center mb-20 opacity-0 translate-y-[50px]">
            <span class="inline-block px-4 py-1.5 rounded-full border border-[#022c22]/10 bg-[#022c22]/5 text-[#022c22] text-sm font-bold tracking-wider uppercase mb-6">
                Real Impact
            </span>
            <h2 class="text-4xl md:text-7xl font-bold text-[#022c22] leading-tight">
                Dampak Nyata <br />
                <span class="font-serif-italic font-normal text-[#1a4036]">
                    Untuk Indonesia
                </span>
            </h2>
        </div>

        {{-- Stats Grid --}}
        <div id="impact-grid" class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative">
            {{-- Connecting Lines for Desktop --}}
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-black/10 to-transparent -translate-y-1/2 z-0"></div>

            {{-- DATA DEFINITION --}}
            @php
                // Pre-processing
                $valWaste = $wasteSavedKg ?? 0;
                $valIncome = isset($pendapatanPetani) ? floor($pendapatanPetani / 1000000) : 0; 
                $valMitra = $mitraAktif ?? 0;

                $statsData = [
                    [
                        'id' => 1,
                        'value' => $valWaste,
                        'suffix' => 'Kg',
                        'prefix' => '',
                        'label' => 'Buah Terselamatkan',
                        'description' => 'Limbah pangan berkurang drastis.',
                        'color' => 'text-[#bef264]',
                    ],
                    [
                        'id' => 2,
                        'value' => $valIncome,
                        'suffix' => 'Juta',
                        'prefix' => 'Rp',
                        'label' => 'Pendapatan Petani',
                        'description' => 'Keuntungan tambahan yang sebelumnya hilang.',
                        'color' => 'text-[#022c22]',
                    ],
                    [
                        'id' => 3,
                        'value' => $valMitra,
                        'suffix' => '+',
                        'prefix' => '',
                        'label' => 'Mitra Bergabung',
                        'description' => 'UMKM & Industri pengolah buah.',
                        'color' => 'text-[#bef264]',
                    ],
                ];
            @endphp

            @foreach ($statsData as $stat)
                <div class="stat-item relative z-10 p-6 rounded-2xl transition-transform duration-500 hover:-translate-y-2 opacity-0 translate-y-[60px]">
                    {{-- Background glow on hover --}}
                    <div class="absolute inset-0 bg-gray-50 opacity-0 hover:opacity-100 rounded-2xl transition-opacity duration-500 -z-10 bg-white shadow-lg"></div>

                    <div class="text-6xl md:text-8xl font-bold mb-4 font-serif-custom {{ $stat['color'] }} flex items-center justify-center gap-2">
                        @if ($stat['prefix'])
                            <span class="text-4xl font-sans font-medium opacity-60 self-start mt-4">
                                {{ $stat['prefix'] }}
                            </span>
                        @endif

                        <span class="stat-value" data-value="{{ $stat['value'] }}">
                            0
                        </span>

                        @if ($stat['suffix'])
                            <span class="text-3xl font-sans font-medium opacity-60 self-end mb-4">
                                {{ $stat['suffix'] }}
                            </span>
                        @endif
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-2 tracking-wide uppercase">
                        {{ $stat['label'] }}
                    </h3>
                    <p class="text-gray-500 text-sm max-w-[200px] mx-auto leading-relaxed">
                        {{ $stat['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA / Tagline --}}
        <div class="mt-24 text-center">
            <p class="text-gray-400 text-lg">
                Dan angka ini
                <span class="text-[#022c22] font-bold italic">
                    terus bertambah
                </span>
                setiap harinya.
            </p>
        </div>
    </div>
</section>

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            const gsap = window.gsap;
            const ScrollTrigger = window.ScrollTrigger;

            if (gsap && ScrollTrigger) {
                const section = document.querySelector("#impact-section");
                const title = document.querySelector("#impact-title");
                const grid = document.querySelector("#impact-grid");
                const statItems = document.querySelectorAll(".stat-item");

                const ctx = gsap.context(() => {
                    // Background Parallax/Color Shift
                    gsap.to(section, {
                        scrollTrigger: {
                            trigger: section,
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true,
                        },
                        backgroundPosition: "50% 100%",
                        ease: "none",
                    });

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

                    // Staggered Stats Animation with Counter
                    statItems.forEach((item, i) => {
                        // Fade Up
                        gsap.fromTo(item,
                            { y: 60, opacity: 0 },
                            {
                                y: 0,
                                opacity: 1,
                                duration: 0.8,
                                delay: i * 0.2,
                                ease: "power3.out",
                                scrollTrigger: {
                                    trigger: grid,
                                    start: "top 75%",
                                }
                            }
                        );

                        // Counter Animation
                        const counter = item.querySelector(".stat-value");
                        const targetValue = parseInt(counter.dataset.value);

                        ScrollTrigger.create({
                            trigger: grid,
                            start: "top 75%",
                            once: true,
                            onEnter: () => {
                                gsap.to(counter, {
                                    innerHTML: targetValue,
                                    duration: 2.5,
                                    ease: "power2.out",
                                    snap: { innerHTML: 1 },
                                    onUpdate: function() {
                                        this.targets()[0].innerHTML = Math.ceil(this.targets()[0].innerHTML);
                                    }
                                });
                            }
                        });
                    });

                }, section);
            }
        }, 300);
    });
</script>
