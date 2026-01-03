<section id="faq-section" class="py-24 bg-white relative overflow-hidden font-sans">

    <style>
        .font-serif-custom {
            font-family: "Instrument Serif", serif;
        }
        .faq-bubble-shadow {
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
    </style>

    {{-- Background Pattern (Dashed Grid) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
         style="background-image: linear-gradient(#022c22 1px, transparent 1px), linear-gradient(90deg, #022c22 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
        {{-- Header --}}
        <h2 class="text-5xl md:text-6xl font-bold text-[#022c22] mb-6 tracking-tight">FAQ</h2>
        <p class="text-gray-500 max-w-lg mx-auto mb-16 text-lg">
            Dapatkan jawaban cepat untuk pertanyaan Anda. <br class="hidden md:block">
            Untuk pemahaman lebih lanjut, hubungi kami.
        </p>

        {{-- FAQ List --}}
        <div class="flex flex-col gap-6 text-left" id="faq-list">

            {{-- Item 1 --}}
            <div class="faq-item group">
                <div class="flex items-start gap-4 justify-end cursor-pointer faq-trigger">
                    <div class="bg-[#022c22] text-white px-8 py-5 rounded-[24px] rounded-br-[4px] relative max-w-xl shadow-lg transition-transform duration-300 group-hover:-translate-y-1">
                        <h3 class="font-semibold text-lg">Apa itu Nowaits sebenarnya?</h3>
                    </div>
                    <button class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center shrink-0 hover:bg-[#bef264] transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#022c22] transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <div class="faq-answer h-0 overflow-hidden opacity-0">
                    <div class="flex items-end gap-4 mt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?u=admin" alt="Admin" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white text-slate-700 px-8 py-6 rounded-[24px] rounded-bl-[4px] max-w-2xl shadow-sm border border-gray-100 relative">
                            <p class="leading-relaxed">
                                Nowaits adalah platform manajemen limbah buah berbasis teknologi yang menghubungkan petani buah dengan mitra industri. Kami membantu mengurangi limbah pangan sekaligus meningkatkan pendapatan petani melalui sistem distribusi yang efisien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="faq-item group">
                <div class="flex items-start gap-4 justify-end cursor-pointer faq-trigger">
                    <div class="bg-[#022c22] text-white px-8 py-5 rounded-[24px] rounded-br-[4px] relative max-w-xl shadow-lg transition-transform duration-300 group-hover:-translate-y-1">
                        <h3 class="font-semibold text-lg">Bagaimana cara bergabung sebagai Mitra?</h3>
                    </div>
                    <button class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center shrink-0 hover:bg-[#bef264] transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#022c22] transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <div class="faq-answer h-0 overflow-hidden opacity-0">
                    <div class="flex items-end gap-4 mt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?u=support" alt="Support" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white text-slate-700 px-8 py-6 rounded-[24px] rounded-bl-[4px] max-w-2xl shadow-sm border border-gray-100 relative">
                            <p class="leading-relaxed">
                                Sangat mudah! Klik tombol "Join Now" di atas, pilih peran sebagai "Mitra", dan lengkapi profil usaha Anda. Tim kami akan memverifikasi data Anda dalam waktu 1x24 jam agar Anda bisa segera mulai mencari stok buah berkualitas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Item 3 --}}
            <div class="faq-item group">
                <div class="flex items-start gap-4 justify-end cursor-pointer faq-trigger">
                    <div class="bg-[#022c22] text-white px-8 py-5 rounded-[24px] rounded-br-[4px] relative max-w-xl shadow-lg transition-transform duration-300 group-hover:-translate-y-1">
                        <h3 class="font-semibold text-lg">Apakah ada biaya layanan?</h3>
                    </div>
                    <button class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center shrink-0 hover:bg-[#bef264] transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#022c22] transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <div class="faq-answer h-0 overflow-hidden opacity-0">
                    <div class="flex items-end gap-4 mt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?u=finance" alt="Finance" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white text-slate-700 px-8 py-6 rounded-[24px] rounded-bl-[4px] max-w-2xl shadow-sm border border-gray-100 relative">
                            <p class="leading-relaxed">
                                Pendaftaran 100% GRATIS. Kami hanya mengenakan biaya platform kecil sebesar 2% untuk setiap transaksi sukses yang terjadi antara Petani dan Mitra untuk pemeliharaan sistem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Item 4 --}}
            <div class="faq-item group">
                <div class="flex items-start gap-4 justify-end cursor-pointer faq-trigger">
                    <div class="bg-[#022c22] text-white px-8 py-5 rounded-[24px] rounded-br-[4px] relative max-w-xl shadow-lg transition-transform duration-300 group-hover:-translate-y-1">
                        <h3 class="font-semibold text-lg">Wilayah mana saja yang tercover?</h3>
                    </div>
                    <button class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center shrink-0 hover:bg-[#bef264] transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#022c22] transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

                <div class="faq-answer h-0 overflow-hidden opacity-0">
                    <div class="flex items-end gap-4 mt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            <img src="https://i.pravatar.cc/150?u=map" alt="Map" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white text-slate-700 px-8 py-6 rounded-[24px] rounded-bl-[4px] max-w-2xl shadow-sm border border-gray-100 relative">
                            <p class="leading-relaxed">
                                Saat ini kami fokus di wilayah Jawa timur, khususnya Malang, Batu, dan Surabaya. Namun kami sedang berekspansi ke Jawa Tengah dan Bali dalam waktu dekat.
                            </p>
                        </div>
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
            if(!gsap) return;

            const items = document.querySelectorAll('.faq-item');

            // Initial Animation
            gsap.from(items, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                scrollTrigger: {
                    trigger: "#faq-list",
                    start: "top 80%"
                }
            });

            // Interaction Logic
            items.forEach(item => {
                const trigger = item.querySelector('.faq-trigger');
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');

                let isOpen = false;

                trigger.addEventListener('click', () => {
                    // Close others (Accordion style - optional, disable if you want multiple open)
                    items.forEach(otherItem => {
                        if(otherItem !== item) {
                            const otherAnswer = otherItem.querySelector('.faq-answer');
                            const otherIcon = otherItem.querySelector('.faq-icon');
                             // Reset others
                            gsap.to(otherAnswer, { height: 0, opacity: 0, duration: 0.4, ease: "power2.inOut" });
                            gsap.to(otherIcon, { rotation: 0, duration: 0.3 });
                        }
                    });

                    // Toggle current
                    if (!isOpen) {
                        gsap.to(answer, {
                            height: "auto",
                            opacity: 1,
                            duration: 0.5,
                            ease: "power2.out"
                        });
                        gsap.to(icon, {
                            rotation: 45,
                            duration: 0.3,
                            ease: "back.out(1.7)"
                        });
                    } else {
                        gsap.to(answer, {
                            height: 0,
                            opacity: 0,
                            duration: 0.4,
                            ease: "power2.inOut"
                        });
                        gsap.to(icon, {
                            rotation: 0,
                            duration: 0.3
                        });
                    }
                    isOpen = !isOpen;
                });
            });

        }, 500);
    });
</script>
