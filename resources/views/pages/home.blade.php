@extends('layouts.landing')

@section('title', 'Home')

@section('content')
<div class="bg-[white] min-h-screen text-black font-sans overflow-x-hidden selection:bg-[#bef264] selection:text-[#022c22]" id="home-container">

    <div id="page-transition-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #bef264; z-index: 9999; transform: scaleY(1); transform-origin: top;"></div>

    <script type="module">
        document.addEventListener("DOMContentLoaded", () => {
            const overlay = document.getElementById('page-transition-overlay');
            const urlParams = new URLSearchParams(window.location.search);
            const hasTransition = urlParams.get('transition');

            if (hasTransition === 'true') {

                setTimeout(() => {
                    window.gsap.to(overlay, {
                        scaleY: 0,
                        duration: 1.2,
                        ease: "power4.inOut",
                        onComplete: () => {
                            overlay.style.display = 'none';
                        }
                    });
                }, 200);
            } else {

                overlay.style.display = 'none';
            }
        });
    </script>

    @include('components.home.navbar')


    <main class="pb-12   mx-auto w-full flex flex-col items-center">
        <div class="px-6 md:px-12 max-w-7xl w-full">
            @include('components.home.hero')
            @include('components.home.marquee')
            @include('components.home.about')
        </div>

     @include('components.home.features')
    @include('components.home.role-section')
    @include('components.home.criteria-section')
    @include('components.home.impact-section')
    @include('components.home.testimonial-section')
    @include('components.home.faq-section')
    </main>

    <!-- Scroll to Top Button (Specific to Home) -->
    <button id="scrollToTopBtn" class="fixed bottom-8 right-8 z-50 bg-[#bef264] text-[#022c22] p-3 rounded-full shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 hover:scale-110 hover:shadow-xl focus:outline-none" aria-label="Scroll to Top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>
    </div>
