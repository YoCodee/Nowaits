<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
    <h2 class="text-2xl font-bold text-[#022c22]">
        @if(auth()->user()->peran === 'petani')
            Halo, {{ auth()->user()->name }}! 👋
        @elseif(auth()->user()->peran === 'mitra')
            Halo, Mitra {{ auth()->user()->name }}! 👋
        @elseif(auth()->user()->peran === 'admin')
            Admin Dashboard
        @endif
    </h2>

    <div class="flex items-center gap-6">
        <div class="relative">
           
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
