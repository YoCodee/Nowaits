<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nowaits - @yield('title', 'Home')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts for the design -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="antialiased bg-[#0a1f18] text-white">
    @yield('content')

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#bef264',
                    color: '#022c22'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ef4444',
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `
                        <ul style="text-align: left;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                    confirmButtonColor: '#ef4444',
                });
            @endif
        });
    </script>

    @stack('scripts')
    
    <script type="module">
        document.addEventListener("DOMContentLoaded", () => {
             // 1. Initialize Lenis globally
            const lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                smooth: true,
            });
            window.lenis = lenis;

            // 2. Connect to GSAP ScrollTrigger
            if (window.gsap && window.ScrollTrigger) {
                lenis.on('scroll', window.ScrollTrigger.update);
                
                window.gsap.ticker.add((time) => {
                    lenis.raf(time * 1000);
                });
                
                window.gsap.ticker.lagSmoothing(0);
            } else {
                 // Fallback RAF if GSAP not ready immediately (though it should be)
                 function raf(time) {
                    lenis.raf(time);
                    requestAnimationFrame(raf);
                }
                requestAnimationFrame(raf);
            }
            
            // 3. Handle Anchor Links for Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId !== '#') {
                         const targetElement = document.querySelector(targetId);
                         if (targetElement) {
                             lenis.scrollTo(targetElement);
                             // Update URL hash without jumping
                             history.pushState(null, null, targetId);
                         }
                    }
                });
            });

            // 4. Check for hash in URL on load (for cross-page navigation)
            if (window.location.hash) {
                const targetElement = document.querySelector(window.location.hash);
                if (targetElement) {
                     // Small delay to ensure layout is ready
                    setTimeout(() => {
                        lenis.scrollTo(targetElement);
                    }, 500); 
                }
            }
        });
            // 5. Scroll to Top Logic
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');
            const faqSection = document.getElementById('faq-section');

            if (scrollToTopBtn) {
                lenis.on('scroll', ({ scroll }) => {
                    let shouldShow = false;

                    if (faqSection) {
                         // Show when FAQ section starts entering the viewport (bottom of screen)
                         // trigger point: Section Top - Window Height
                        const triggerPoint = faqSection.offsetTop - window.innerHeight + 200; 
                        if (scroll > triggerPoint) {
                            shouldShow = true;
                        }
                    } else {
                        // Fallback for pages without FAQ section (though button only on Home now)
                        if (scroll > 500) shouldShow = true; 
                    }

                    if (shouldShow) {
                        scrollToTopBtn.classList.remove('translate-y-20', 'opacity-0');
                    } else {
                        scrollToTopBtn.classList.add('translate-y-20', 'opacity-0');
                    }
                });

                // Scroll to top on click
                scrollToTopBtn.addEventListener('click', () => {
                    lenis.scrollTo(0);
                });
            }
        });
    </script>
    
    
</body>
</html>
