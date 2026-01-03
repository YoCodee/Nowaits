<section id="testimonial-section" class="py-24 bg-white font-sans overflow-hidden">
    {{-- Inline Styles for this section --}}
    <style>
        .font-serif-custom {
            font-family: "Instrument Serif", serif;
        }
        .font-serif-italic {
            font-family: "Instrument Serif", serif;
            font-style: italic;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 md:px-12">

        {{-- SECTION HEADER --}}
        <div class="text-center mb-16 opacity-0 translate-y-[30px]" id="testimonial-header">
            <span class="inline-block px-4 py-1.5 rounded-full border border-[#022c22]/10 bg-[#022c22]/5 text-[#022c22] text-sm font-bold tracking-wider uppercase mb-6">
                Stories
            </span>
            <h2 class="text-4xl md:text-7xl font-bold text-[#022c22] leading-tight">
                Testimonial <br />
                <span class="font-serif-italic font-normal text-[#1a4036]">
                    Client Kami
                </span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">

            {{-- LEFT COLUMN: IMAGE --}}
            <div class="col-span-12 md:col-span-7 h-[600px] relative rounded-[35px] overflow-hidden group">
                <img
                    src="{{ asset('images/Heroimg.png') }}"
                    alt="Happy Farmer"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                />
                {{-- Decorative Badge --}}
                <div class="absolute bottom-8 right-8 text-white text-6xl font-semibold tracking-tighter">
                    10.9K+
                </div>
            </div>

            {{-- RIGHT COLUMN: SCROLLING TESTIMONIALS --}}
            <div class="col-span-12 md:col-span-5 h-[600px] relative overflow-hidden mask-image-gradient">
                {{-- Gradient Masks to fade top/bottom --}}
                <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-white to-transparent z-10 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-white to-transparent z-10 pointer-events-none"></div>

                {{-- Scrolling Wrapper --}}
                <div id="testimonial-wrapper" class="flex flex-col gap-6">
                    @php
                        $testimonials = [
                            [
                                'text' => "Sejak pakai Nowaits, hasil panen jeruk saya meningkat 50%. Fitur deteksinya sangat akurat!",
                                'rating' => 5,
                                'name' => "Pak Budi Santoso",
                                'role' => "Petani Jeruk - Malang",
                                'image' => "https://i.pravatar.cc/150?u=budi",
                                'bg' => 'bg-[#022c22]',
                                'text_color' => 'text-white'
                            ],
                            [
                                'text' => "Suplay buah untuk pabrik jus kami jadi jauh lebih stabil dan berkualitas. Highly recommended.",
                                'rating' => 5,
                                'name' => "CV. Segar Alami",
                                'role' => "Mitra Industri",
                                'image' => "https://i.pravatar.cc/150?u=segar",
                                'bg' => 'bg-[#f4f4f5]', // zinc-100
                                'text_color' => 'text-slate-800'
                            ],
                            [
                                'text' => "Aplikasi ini mudah digunakan bahkan untuk orang tua seperti saya. Penjualan jadi lebih cepat.",
                                'rating' => 4,
                                'name' => "Ibu Siti Aminah",
                                'role' => "Petani Apel",
                                'image' => "https://i.pravatar.cc/150?u=siti",
                                'bg' => 'bg-[#799379]',
                                'text_color' => 'text-white'
                            ],
                            [
                                'text' => "Transparansi harganya mantap. Kami jadi percaya mengambil stok besar dari petani mitra Nowaits.",
                                'rating' => 5,
                                'name' => "Toko Buah Laris",
                                'role' => "Mitra Retail",
                                'image' => "https://i.pravatar.cc/150?u=laris",
                                'bg' => 'bg-[#f4f4f5]',
                                'text_color' => 'text-slate-800'
                            ],
                        ];

                        // Duplicate for smooth loop
                        $allTestimonials = array_merge($testimonials, $testimonials);
                    @endphp

                    @foreach($allTestimonials as $item)
                        <div class="{{ $item['bg'] }} {{ $item['text_color'] }} p-8 rounded-[30px] relative shrink-0">
                            {{-- Stars --}}
                            <div class="flex mb-4 text-yellow-400 gap-1 text-sm">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $item['rating'])
                                        <span>★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>

                            <p class="text-sm md:text-base leading-relaxed mb-6 font-medium opacity-90">
                                "{{ $item['text'] }}"
                            </p>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white/20">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm">{{ $item['name'] }}</h4>
                                    <p class="text-xs opacity-70">{{ $item['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- CTA BOTTOM --}}
        <div class="bg-[#022c22] rounded-[30px] p-8 md:p-12 flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden group">
            <div class="relative z-10">
                 <h3 class="text-white text-3xl md:text-4xl font-serif-custom font-normal mb-2">
                    Siap bergabung dengan kami?
                </h3>
                 <p class="text-white/60 text-sm md:text-base">Jadilah bagian dari revolusi pertanian Indonesia.</p>
            </div>

            <button class="relative z-10 bg-white text-[#022c22] px-8 py-4 rounded-full font-bold hover:bg-[#bef264] transition-colors duration-300 shadow-lg">
                Gabung Sekarang
            </button>

            {{-- Decor --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#bef264] rounded-full mix-blend-overlay filter blur-[60px] opacity-10 group-hover:opacity-20 transition-opacity"></div>
        </div>
    </div>
</section>

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            const gsap = window.gsap;
            const container = document.querySelector('#testimonial-wrapper');
            const header = document.querySelector('#testimonial-header');

            if(gsap && container) {
                // Intro Animation for Header
                gsap.to(header, {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: header,
                        start: "top 80%"
                    }
                });

                // Infinite Vertical Scroll
                // The total height of one set is 50% of the container since we duplicated it once.
                // We want to move from 0% to -50% (scrolling up to show the next set).

                // Wait for images/layout
                const totalHeight = container.scrollHeight;
                const oneSetHeight = totalHeight / 2;

                // Move UP continuously
                gsap.to(container, {
                    y: -oneSetHeight, // Move up by half the total height
                    duration: 20, // Adjust speed (seconds)
                    ease: "none",
                    repeat: -1
                });

                // Pause on hover (Optional, nice to have)
                container.addEventListener("mouseenter", () => gsap.globalTimeline.pause());
                container.addEventListener("mouseleave", () => gsap.globalTimeline.resume());
            }
        }, 500);
    });
</script>
