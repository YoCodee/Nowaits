<div id="features" class="w-full relative z-30 bg-white text-black overflow-hidden features-wrapper">
    {{-- Inline Style Block --}}
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap");

        .features-wrapper {
            font-family: "Instrument Serif", serif;
        }

        /* Sticky Section Centering */
        .sticky-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: visible; /* Important for absolute children */
        }

        .sticky-header-container {
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        .card-container-custom {
            display: flex;
            position: relative;
            height: 60vh;
            width: 75%; /* Initial Width */
            perspective: 1000px;
            transform-style: preserve-3d;
            margin: 0 auto; /* Force Centering */
        }

        .card-item {
            position: relative;
            flex: 1;
            aspect-ratio: 5/7;
            transform-style: preserve-3d;
            transform-origin: center;
            cursor: pointer;
        }

        /* Card Specifics for Initial State */
        #card-1 { border-radius: 20px 0 0 20px; }
        #card-3 { border-radius: 0 20px 20px 0; }

        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: inherit;
            overflow: hidden;
        }

        .card-back {
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }

        /* Mobile Responsive Overrides */
        @media (max-width: 999px) {
            .sticky-section {
                height: auto;
                padding: 4rem 1rem;
                display: block;
            }
            .sticky-header-container {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
                margin-bottom: 3rem;
            }
            .card-container-custom {
                width: 100% !important;
                height: auto;
                flex-direction: column;
                gap: 2rem;
            }
            .card-item {
                width: 100%;
                max-width: 400px;
                margin: 0 auto;
                border-radius: 20px !important;
                transform: none !important;
                aspect-ratio: auto;
                overflow: hidden;
                box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
            }
            #card-1, #card-3 {
                border-radius: 20px !important;
            }
            
            /* Reset 3D stacking for mobile */
            .card-face {
                display: none; /* Hide image face */
            }
            
            .card-back {
                display: flex !important; /* Force flex for content face */
                position: relative;
                width: 100%;
                height: 350px; /* Nice fixed height for card */
                transform: none;
                border-radius: 20px;
                backface-visibility: visible;
            }
        }
    </style>

    {{-- Sticky Section --}}
    <section class="sticky-section" id="sticky-section">
        <div class="sticky-header-container" id="sticky-header">
            <h1 class="text-4xl text-black md:text-7xl font-bold leading-none opacity-0 translate-y-10">
                Fitur yang kami Sediakan
            </h1>
        </div>

        <div class="card-container-custom" id="card-container">
            {{-- Card 1 --}}
            <div class="card-item" id="card-1">
                <div class="card-face">
                    <img src="{{ asset('images/00.jpg') }}" alt="Card 1" class="w-full h-full object-cover" />
                </div>
                <div class="card-face card-back bg-[#bef264] text-[#022c22] p-8 flex flex-col items-center justify-center text-center">
                    <span class="absolute top-8 left-8 opacity-40 text-2xl">
                        ( 01 )
                    </span>
                    <div class="w-16 h-16 mb-4 flex items-center justify-center bg-[#022c22]/10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">MarketPlace</h3>
                    <p class="text-lg font-medium opacity-80">
                        Pusat jual beli hasil panen 'Imperfect' dengan harga transparan dan akses langsung ke mitra.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="card-item" id="card-2">
                <div class="card-face">
                    <img src="{{ asset('images/10.jpg') }}" alt="Card 2" class="w-full h-full object-cover" />
                </div>
                <div class="card-face card-back bg-[#1a4036] text-white p-8 flex flex-col items-center justify-center text-center">
                    <span class="absolute top-8 left-8 opacity-60 text-2xl">
                        ( 02 )
                    </span>
                    <div class="w-16 h-16 mb-4 flex items-center justify-center bg-white/10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                            <line x1="8" y1="6" x2="16" y2="6"></line>
                            <line x1="16" y1="14" x2="16" y2="18"></line>
                            <path d="M16 10h.01"></path>
                            <path d="M12 10h.01"></path>
                            <path d="M8 10h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M12 18h.01"></path>
                            <path d="M8 18h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">Kalkulasi Harga</h3>
                    <p class="text-lg font-medium opacity-90">
                        Sistem penetapan harga cerdas berbasis AI yang menyesuaikan kondisi pasar dan kualitas.
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="card-item" id="card-3">
                <div class="card-face">
                    <img src="{{ asset('images/20.jpg') }}" alt="Card 3" class="w-full h-full object-cover" />
                </div>
                <div class="card-face card-back bg-[#022c22] text-white p-8 flex flex-col items-center justify-center text-center">
                    <span class="absolute top-8 left-8 opacity-40 text-2xl">
                        ( 03 )
                    </span>
                    <div class="w-16 h-16 mb-4 flex items-center justify-center bg-white/10 rounded-full">
                       <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <line x1="18" y1="20" x2="18" y2="10"></line>
                          <line x1="12" y1="20" x2="12" y2="4"></line>
                          <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">Dashboard Analitik</h3>
                    <p class="text-lg font-medium opacity-80">
                        Pantau tren penjualan, stok, dan pendapatan secara real-time dalam satu tampilan.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {
        // Wait for global dependencies (GSAP, ScrollTrigger, Lenis from app.js)
        setTimeout(() => {
            const gsap = window.gsap;
            const ScrollTrigger = window.ScrollTrigger;
            const Lenis = window.Lenis;

            if (gsap && ScrollTrigger && Lenis) {
                const lenis = window.lenis; // Assume global lenis instance availability

                // --- ANIMATION CONTEXT ---
                const containerRef = document.querySelector("#features"); // Acts as containerRef
                const stickySection = document.querySelector("#sticky-section"); // stickyRef
                const stickyHeader = document.querySelector("#sticky-header h1"); // headerRef
                const cardContainer = document.querySelector("#card-container"); // cardContainerRef

                const ctx = gsap.context(() => {
                  const mm = gsap.matchMedia();

                  let isGapAnimationCompleted = false;
                  let isFlipAnimationCompleted = false;

                  mm.add("(min-width: 1000px)", () => {
                    ScrollTrigger.create({
                      trigger: stickySection,
                      start: "top top",
                      end: `+=${window.innerHeight * 4}px`,
                      scrub: 1,
                      pin: true,
                      pinSpacing: true,
                      onUpdate: (self) => {
                        const progress = self.progress;

                        // 1. Header Animation - IMMEDIATE start
                        if (progress >= 0 && progress <= 0.15) {
                          const headerProgress = gsap.utils.mapRange(
                            0,
                            0.15,
                            0,
                            1,
                            progress
                          );
                          gsap.set(stickyHeader, {
                            y: gsap.utils.mapRange(0, 1, 40, 0, headerProgress),
                            opacity: gsap.utils.mapRange(0, 1, 0, 1, headerProgress),
                          });
                        } else if (progress > 0.15) {
                          gsap.set(stickyHeader, { y: 0, opacity: 1 });
                        }

                        // 2. Card Container Width - Sync with Header
                        if (progress <= 0.15) {
                          const widthPercentage = gsap.utils.mapRange(
                            0,
                            0.15,
                            75,
                            60,
                            progress
                          );
                          gsap.set(cardContainer, { width: `${widthPercentage}%` });
                        } else {
                          gsap.set(cardContainer, { width: "60%" });
                        }

                        // 3. Gap & Border Radius
                        if (progress >= 0.35 && !isGapAnimationCompleted) {
                          gsap.to(cardContainer, {
                            gap: "20px",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          gsap.to(".card-item", {
                            borderRadius: "20px",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          isGapAnimationCompleted = true;
                        } else if (progress < 0.35 && isGapAnimationCompleted) {
                          gsap.to(cardContainer, {
                            gap: "0px",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          gsap.to("#card-1", {
                            borderRadius: "20px 0 0 20px",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          gsap.to("#card-2", {
                            borderRadius: "0px",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          gsap.to("#card-3", {
                            borderRadius: "0 20px 20px 0",
                            duration: 0.5,
                            ease: "power3.out",
                          });
                          isGapAnimationCompleted = false;
                        }

                        // 4. Flip Animation
                        if (progress >= 0.7 && !isFlipAnimationCompleted) {
                          gsap.to(".card-item", {
                            rotationY: 180,
                            duration: 0.75,
                            ease: "power3.inOut",
                            stagger: 0.1,
                          });
                          gsap.to("#card-1", {
                            y: 30,
                            rotationZ: -15,
                            duration: 0.75,
                            ease: "power3.inOut",
                          });
                          gsap.to("#card-3", {
                            y: 30,
                            rotationZ: 15,
                            duration: 0.75,
                            ease: "power3.inOut",
                          });
                          isFlipAnimationCompleted = true;
                        } else if (progress < 0.7 && isFlipAnimationCompleted) {
                          gsap.to(".card-item", {
                            rotationY: 0,
                            duration: 0.75,
                            ease: "power3.inOut",
                            stagger: -0.1,
                          });
                          gsap.to(["#card-1", "#card-3"], {
                            y: 0,
                            rotationZ: 0,
                            duration: 0.75,
                            ease: "power3.inOut",
                          });
                          isFlipAnimationCompleted = false;
                        }
                      },
                    });
                  });

                  // Mobile Reset
                  mm.add("(max-width: 999px)", () => {
                    gsap.set([".card-item", cardContainer, stickyHeader], {
                      clearProps: "all",
                    });
                    // Ensure visibility on mobile
                    gsap.set(stickyHeader, { opacity: 1, y: 0 });
                  });
                }, containerRef); // Scope context to main container

            } else {
                console.error("GSAP, ScrollTrigger, or Lenis dependencies not found!");
            }
        }, 300); // Small delay to ensure scripts are loaded
    });
</script>
