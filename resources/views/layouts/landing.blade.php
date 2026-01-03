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
    </script>
</body>
</html>
