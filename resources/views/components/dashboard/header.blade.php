<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
    <h2 class="text-2xl font-bold text-[#022c22]">
        @if(auth()->user()->peran === 'petani')
            Halo, Pak {{ auth()->user()->name }}! 👋
        @elseif(auth()->user()->peran === 'mitra')
            Halo, Mitra {{ auth()->user()->name }}! 👋
        @elseif(auth()->user()->peran === 'admin')
            Admin Dashboard
        @endif
    </h2>

    <div class="flex items-center gap-6">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <div class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></div>
        </div>

        <div class="flex items-center gap-3 pl-6 border-l border-gray-100">
            <div class="text-right hidden md:block">
                <span class="block text-sm font-bold text-gray-800">
                    {{ auth()->user()->name }}
                </span>
                <span class="block text-xs text-gray-400 capitalize">{{ auth()->user()->peran }}</span>
            </div>
            <div class="w-10 h-10 bg-[#bef264] rounded-full flex items-center justify-center text-[#022c22] font-bold">
                {{ substr(strtoupper(auth()->user()->peran), 0, 1) }}
            </div>
        </div>
    </div>
</header>
