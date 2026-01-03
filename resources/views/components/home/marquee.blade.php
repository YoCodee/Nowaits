<div class="w-full mt-16 py-10 border-t border-[rgba(255,255,255,0.1)] flex flex-col items-center gap-10 overflow-hidden">
    <div class="text-sm font-semibold text-gray-400 text-center">
        Connecting the Farmers <span class="text-[#bef264]">Greatest Companies</span> to their Customers
    </div>

    {{-- Marquee Container --}}
    <div class="w-full relative overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex w-max animate-marquee gap-16 items-center opacity-60 hover:opacity-100 transition-opacity duration-300">
            @for ($i = 0; $i < 2; $i++)
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 bg-gray-500 rounded-full"></div> FocalPoint
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 border-2 border-gray-500 rounded-full"></div> Polymath
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 bg-gray-300 transform rotate-45"></div> Lightbox
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <svg class="w-6 h-6 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 19h20L12 2zm0 3l7.5 12h-15L12 5z" />
                    </svg> Alt+Shift
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 bg-gray-500 rounded-sm transform rotate-12"></div> Nietzsche
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 border border-gray-400 rotate-45"></div> Acme Corp
                </span>
                <span class="font-bold text-xl flex items-center gap-3 text-gray-400">
                    <div class="w-5 h-5 rounded-full border border-dashed border-gray-400"></div> Sphere
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
