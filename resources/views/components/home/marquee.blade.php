<div class="w-full mt-16 py-10 border-t border-[rgba(255,255,255,0.1)] flex flex-col items-center gap-10 overflow-hidden">
    <div class="text-sm font-semibold text-gray-400 text-center">
        Connecting Farmers with <span class="text-[#bef264]">Sustainable Partners</span>
    </div>

    {{-- Marquee Container --}}
    <div class="w-full relative overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex w-max animate-marquee gap-16 items-center opacity-70 hover:opacity-100 transition-opacity duration-300">
            @for ($i = 0; $i < 4; $i++) {{-- Increased loop for smoothness --}}
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                    <span class="text-[#bef264]">●</span> STOP FOOD WASTE
                </span>
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                   <span class="text-[#bef264]">●</span> MAXIMIZE VALUE
                </span>
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                    <span class="text-[#bef264]">●</span> SUSTAINABLE IMPACT
                </span>
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                    <span class="text-[#bef264]">●</span> FAIR PRICING
                </span>
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                    <span class="text-[#bef264]">●</span> CIRCULAR ECONOMY
                </span>
                <span class="font-bold text-2xl flex items-center gap-3 text-gray-500">
                    <span class="text-[#bef264]">●</span> NOWAITS ECOSYSTEM
                </span>
            @endfor
        </div>
    </div>
</div>

<style>
    .animate-marquee {
        animation: marquee 30s linear infinite;
    }
    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }
</style>
