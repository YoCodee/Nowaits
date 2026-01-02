<div class="w-full pt-10 pb-16 relative z-10 flex flex-col items-center">
    <div class="relative w-full max-w-5xl flex flex-col items-center text-center">
        {{-- Tag --}}
        <div class="inline-block bg-[#2f4f4f] bg-opacity-50 text-[#bef264] px-4 py-1.5 rounded-full text-xs font-semibold mb-8 anim-stagger hover:scale-105 transition-transform cursor-default border border-[#bef264]/20">
            Wasted Fruits
        </div>

        {{-- Headline --}}
        <h1 class="text-4xl md:text-7xl font-semibold leading-[1.1] mb-8 anim-stagger tracking-tight">
            No More Wasted <br class="hidden md:block" />
            Fruits:
            <span class="relative inline-block ml-3 px-2">
                <span class="relative z-10 text-[#c2e635]">Nowaits</span>
                {{-- Technology green background shape --}}
                <svg class="absolute inset-0 w-full h-full -z-0 text-[#064e3b] opacity-70" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,50 Q10,0 50,10 T100,50 T50,90 T0,50 Z" fill="currentColor" />
                </svg>
                <span class="absolute inset-0 bg-[#022c22] rounded-lg -z-10 transform -rotate-1 skew-x-3 scale-110 opacity-60"></span>
            </span>
        </h1>

        {{-- Description --}}
        <div class="max-w-2xl text-gray-900 text-lg anim-stagger leading-relaxed mb-10">
            <p class="mb-2">
                A digital platform reducing fruit waste by connecting farmers
                to partners
            </p>
            <p>
                with smart pricing, logistics tracking, and sustainable
                redistribution systems.
            </p>
        </div>

        {{-- Centered Buttons --}}
        <div class="flex items-center justify-center gap-5 anim-stagger mb-8">
            <a href="{{ route('marketplace.index') }}" class="bg-[#bef264] text-[#022c22] px-8 py-4 rounded-full font-bold text-base flex items-center gap-2 hover:bg-[#a3e635] transition-all hover:scale-105 active:scale-95 cursor-pointer shadow-[0_0_20px_rgba(190,242,100,0.3)]">
                Marketplace
            </a>
            <div class="w-12 h-12 border border-[#bef264] rounded-full flex items-center justify-center text-[#bef264] cursor-pointer hover:bg-[#bef264] hover:text-[#022c22] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Hero Image Section --}}
<div class="w-full mt-4 relative h-[450px] md:h-[550px] hero-image">
    {{--
      The Image Container.
      Rounded corners on Top-Right and Bottom-Left.
    --}}
    <div class="w-full h-full relative rounded-tr-[3rem] rounded-bl-[3rem] overflow-hidden">
        {{-- IMPORTANT: Ensure 'Heroimg.png' exists in public/images/ --}}
        <img src="{{ asset('images/Heroimg.png') }}" alt="Agricultural Drone" class="w-full h-full object-cover" />

        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[rgba(2,44,34,0.3)] to-transparent pointer-events-none"></div>
    </div>

    {{-- Top Left Custom Shape (Overlay) --}}
    <div class="hidden md:block absolute top-0 left-0 bg-[white] w-[260px] h-[100px] rounded-br-[4rem] z-10 pointer-events-none"></div>

    {{-- Buttons inside Top Left Shape --}}
    <div class="hidden md:flex absolute top-5 left-0 z-20 items-center gap-4 pl-0">
        <button class="bg-[#bef264] text-[#022c22] px-8 py-3.5 rounded-full font-bold text-sm tracking-wide hover:bg-[#a3e635] transition-transform active:scale-95 cursor-pointer shadow-lg whitespace-nowrap">
            Start Free Trial
        </button>
        <button class="w-12 h-12 border border-[#bef264] rounded-full flex items-center justify-center text-[#bef264] hover:bg-[#bef264] hover:text-[#022c22] transition-colors cursor-pointer bg-[#022c22]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="7" y1="17" x2="17" y2="7"></line>
                <polyline points="7 7 17 7 17 17"></polyline>
            </svg>
        </button>
    </div>

    {{-- Bottom Right Custom Shape (Cutout) --}}
    <div class="hidden md:block absolute bottom-0 right-0 bg-[white] w-[200px] h-[100px] rounded-tl-[4rem] z-10 pointer-events-none"></div>

    {{-- Buttons inside Bottom Right Shape --}}
    <div class="hidden md:flex absolute bottom-8 right-0 z-20 gap-4 pr-4">
        <button class="w-12 h-12 bg-[#bef264] rounded-full flex items-center justify-center text-[#022c22] hover:scale-110 transition-transform shadow-lg cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
        <button class="w-12 h-12 bg-[#1a4036] border border-[#2f554a] rounded-full flex items-center justify-center text-white hover:bg-[#2f554a] transition-all cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
</div>
