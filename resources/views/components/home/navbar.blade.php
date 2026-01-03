<nav class="flex justify-between bg-[#022c22] rounded-full my-4 items-center px-6 md:px-12 py-6 max-w-7xl mx-auto w-full">
    <div class="flex items-center gap-2">
        {{-- Logo Icon --}}
        <div class="text-[#bef264] text-xl font-bold tracking-tight flex items-center gap-1">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 430.48 476.48" class="w-12 h-12">
                <defs>
                    <style>
                        .cls-1{fill:#044131;}
                        .cls-2{font-size:142.21px;fill:#fff;}
                        .cls-2,.cls-3{font-family:BerlinSansFBDemi-Bold, Berlin Sans FB Demi;font-weight:700;}
                        .cls-3{font-size:119.75px;}
                        .cls-3,.cls-4{fill:#bfd852;}
                    </style>
                </defs>

                {{-- ORIGINALS --}}
                <g id="No">
                    <rect class="cls-1" width="218.8" height="151.79" rx="6.8" />
                    <text class="cls-2" transform="translate(25.98 129.91)">No</text>
                </g>

                <g id="wa">
                    <rect class="cls-1" x="105.14" y="162.73" width="213.54" height="151.79" rx="13.28" />
                    <text class="cls-3" transform="translate(123 278.5)">Wa</text>
                </g>

                <g id="its">
                    <rect class="cls-1" x="219.42" y="324.69" width="209.76" height="151.79" rx="12.93" />
                    <text class="cls-2" transform="translate(258.31 443.69)">its</text>
                </g>

                {{-- DUPLICATES (For smooth loop) --}}
                <g id="No_dup" style="opacity: 0">
                    <rect class="cls-1" width="218.8" height="151.79" rx="6.8" />
                    <text class="cls-2" transform="translate(25.98 129.91)">No</text>
                </g>

                <g id="wa_dup" style="opacity: 0">
                    <rect class="cls-1" x="105.14" y="162.73" width="213.54" height="151.79" rx="13.28" />
                    <text class="cls-3" transform="translate(123 278.5)">Wa</text>
                </g>

                <g id="its_dup" style="opacity: 0">
                    <rect class="cls-1" x="219.42" y="324.69" width="209.76" height="151.79" rx="12.93" />
                    <text class="cls-2" transform="translate(258.31 443.69)">its</text>
                </g>

                {{-- STATIC DECORATIONS --}}
                <g id="Luar2">
                    <rect class="cls-4" x="0.48" y="332.92" width="195.99" height="141.27" />
                    <rect class="cls-4" x="0.26" y="198.08" width="87.76" height="141.27" />
                </g>

                <g id="Luar1">
                    <rect class="cls-4" x="243.02" y="6.24" width="186.97" height="141.27" />
                    <rect class="cls-4" x="334.89" y="104.97" width="95.59" height="141.27" />
                </g>
            </svg>
        </div>
    </div>

    <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-300">
        <a href="{{ request()->routeIs('home') ? '#about-us' : route('home').'#about-us' }}" class="hover:text-white transition-colors">About Us</a>
        <a href="{{ request()->routeIs('home') ? '#features' : route('home').'#features' }}" class="hover:text-white transition-colors">Features</a>
        <a href="{{ route('marketplace.index') }}" class="hover:text-white transition-colors">Marketplace</a>
        <a href="{{ request()->routeIs('home') ? '#testimonial-section' : route('home').'#testimonial-section' }}" class="hover:text-white transition-colors">Testimonial</a>
    </div>

    @auth
        <div class="hidden md:flex items-center space-x-4">
            <div class="relative group">
                <button class="flex items-center space-x-2 text-sm font-medium text-gray-300 hover:text-white focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-[#bef264]/20 flex items-center justify-center text-[#bef264]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-1 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                    <div class="px-4 py-3 border-b border-gray-50">
                        <p class="text-xs text-gray-500 mb-1">Signed in as</p>
                        <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider {{ Auth::user()->peran === 'petani' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ Auth::user()->peran }}
                        </span>
                    </div>

                    <div class="py-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#022c22] group/item">
                            <svg class="w-4 h-4 mr-3 text-gray-400 group-hover/item:text-[#022c22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            My Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#022c22] group/item">
                            <svg class="w-4 h-4 mr-3 text-gray-400 group-hover/item:text-[#022c22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                    </div>

                    <div class="border-t border-gray-50 mt-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="bg-white text-[#022c22] px-5 py-2.5 rounded-full text-sm font-bold hover:bg-gray-100 transition-colors cursor-pointer hidden sm:block">
            Login
        </a>
    @endauth
    <!-- Mobile Menu Button -->
    <div class="md:hidden flex items-center relative z-50">
        <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none transition-colors duration-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-[#022c22] text-white z-40 flex flex-col justify-center items-center gap-8"
        style="clip-path: circle(0% at 100% 0%); -webkit-clip-path: circle(0% at 100% 0%);">

        <a href="{{ request()->routeIs('home') ? '#about-us' : route('home').'#about-us' }}" class="mobile-link text-2xl font-bold hover:text-[#bef264] transition-colors">About Us</a>
        <a href="{{ request()->routeIs('home') ? '#features' : route('home').'#features' }}" class="mobile-link text-2xl font-bold hover:text-[#bef264] transition-colors">Features</a>
        <a href="{{ route('marketplace.index') }}" class="mobile-link text-2xl font-bold hover:text-[#bef264] transition-colors">Marketplace</a>
        <a href="{{ request()->routeIs('home') ? '#testimonial-section' : route('home').'#testimonial-section' }}" class="mobile-link text-2xl font-bold hover:text-[#bef264] transition-colors">Testimonial</a>

        <div class="w-16 h-1 bg-white/10 rounded-full mobile-link"></div>

        <div class="mobile-link flex flex-col items-center gap-6 w-full px-12">
            @auth
                <div class="flex flex-col items-center gap-2">
                     <div class="w-20 h-20 rounded-full bg-[#bef264]/20 flex items-center justify-center text-[#bef264] text-3xl font-bold mb-2">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <p class="text-xl font-bold">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                </div>
                 <a href="{{ route('dashboard') }}" class="text-lg hover:text-[#bef264]">My Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="text-lg hover:text-[#bef264]">My Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="w-full max-w-xs">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-red-600 transition-colors shadow-lg cursor-pointer">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-full max-w-xs bg-white text-[#022c22] px-8 py-4 rounded-full text-center text-lg font-bold hover:bg-gray-100 transition-colors cursor-pointer shadow-lg">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- GSAP CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconPath = btn.querySelector('path');

        let isOpen = false;

        // Define GSAP Timeline
        const tl = gsap.timeline({ paused: true });

        tl.to(menu, {
            clipPath: "circle(150% at 100% 0%)",
            webkitClipPath: "circle(150% at 100% 0%)",
            duration: 1,
            ease: "power4.inOut",
        })
        .from(".mobile-link", {
            y: 100,
            opacity: 0,
            stagger: 0.1,
            duration: 0.8,
            ease: "power3.out",
        }, "-=0.5");

        btn.addEventListener('click', function() {
            if (!isOpen) {
                tl.play();
                // Change icon to X
                gsap.to(btn, { rotation: 90, duration: 0.3 });
                // We'll trust the clip-path handling, but for accessibility we might want to handle aria-expanded
            } else {
                tl.reverse();
                // Change icon back
                gsap.to(btn, { rotation: 0, duration: 0.3 });
            }
            isOpen = !isOpen;
        });

        // Initial nav item animation (Desktop)
        gsap.from(".nav-item", {
            y: -20,
            opacity: 0,
            stagger: 0.1,
            duration: 1,
            ease: "power3.out",
            delay: 0.5,
        });
    });
</script>
