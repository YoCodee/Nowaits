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
    </div>
