<div id="initial-loader" class="fixed inset-0 z-[9999] flex items-center justify-center min-h-screen bg-[#ffffff]">
    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 430.48 476.48" class="w-[80vw] max-w-[600px] h-auto">
        <defs>
            <style>
                .cls-1{fill:#044131;}
                .cls-2{font-size:142.21px;fill:#fff;}
                .cls-2,.cls-3{font-family:BerlinSansFBDemi-Bold, Berlin Sans FB Demi;font-weight:700;}
                .cls-3{font-size:119.75px;}
                .cls-3,.cls-4{fill:#bfd852;}
            </style>
        </defs>

        {{-- ORIGINALS --}}
        <g id="No">
            <rect class="cls-1" width="218.8" height="151.79" rx="6.8" />
            <text class="cls-2" transform="translate(25.98 129.91)">No</text>
        </g>

        <g id="wa">
            <rect class="cls-1" x="105.14" y="162.73" width="213.54" height="151.79" rx="13.28" />
            <text class="cls-3" transform="translate(123 278.5)">Wa</text>
        </g>

        <g id="its">
            <rect class="cls-1" x="219.42" y="324.69" width="209.76" height="151.79" rx="12.93" />
            <text class="cls-2" transform="translate(258.31 443.69)">its</text>
        </g>

        {{-- DUPLICATES --}}
        <g id="No_dup" style="opacity: 0">
            <rect class="cls-1" width="218.8" height="151.79" rx="6.8" />
            <text class="cls-2" transform="translate(25.98 129.91)">No</text>
        </g>

        <g id="wa_dup" style="opacity: 0">
            <rect class="cls-1" x="105.14" y="162.73" width="213.54" height="151.79" rx="13.28" />
            <text class="cls-3" transform="translate(123 278.5)">Wa</text>
        </g>

        <g id="its_dup" style="opacity: 0">
            <rect class="cls-1" x="219.42" y="324.69" width="209.76" height="151.79" rx="12.93" />
            <text class="cls-2" transform="translate(258.31 443.69)">its</text>
        </g>

        {{-- STATIC DECORATIONS --}}
        <g id="Luar2">
            <rect class="cls-4" x="0.48" y="332.92" width="195.99" height="141.27" />
            <rect class="cls-4" x="0.26" y="198.08" width="87.76" height="141.27" />
        </g>

        <g id="Luar1">
            <rect class="cls-4" x="243.02" y="6.24" width="186.97" height="141.27" />
            <rect class="cls-4" x="334.89" y="104.97" width="95.59" height="141.27" />
        </g>
    </svg>
</div>

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {
        // Hide main scrollbar during loading
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            const gsap = window.gsap;
            if (!gsap) return;

            const logoContainer = document.querySelector("#initial-loader");

            // --- CONSTANTS ---
            const duration = 1.5;
            const ease = "power3.inOut";

            const no_to_S0 = { x: -114, y: -162, opacity: 0 };
            const no_to_S1 = { x: 0, y: 0, opacity: 1 };
            const no_to_S2 = { x: 105, y: 162, opacity: 1 };
            const no_to_S3 = { x: 219, y: 324, opacity: 1 };
            const no_to_S4 = { x: 333, y: 486, opacity: 0 };

            const wa_to_S0 = { x: -219, y: -324, opacity: 0 };
            const wa_to_S1 = { x: -105, y: -162, opacity: 1 };
            const wa_to_S2 = { x: 0, y: 0, opacity: 1 };
            const wa_to_S3 = { x: 114, y: 162, opacity: 1 };
            const wa_to_S4 = { x: 228, y: 324, opacity: 0 };

            const its_to_S0 = { x: -333, y: -486, opacity: 0 };
            const its_to_S1 = { x: -219, y: -324, opacity: 1 };
            const its_to_S2 = { x: -114, y: -162, opacity: 1 };
            const its_to_S3 = { x: 0, y: 0, opacity: 1 };
            const its_to_S4 = { x: 114, y: 162, opacity: 0 };

            // --- INITIAL SETUP ---
            gsap.set("#No", no_to_S1);
            gsap.set("#wa", wa_to_S2);
            gsap.set("#its", its_to_S3);

            gsap.set("#No_dup", no_to_S0);
            gsap.set("#wa_dup", wa_to_S0);
            gsap.set("#its_dup", its_to_S0);

            // --- DECORATION ANIMATION ---
            gsap.to("#Luar1", {
                y: -20,
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
            });

            gsap.to("#Luar2", {
                y: 20,
                duration: 3.5,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 0.5,
            });

            // --- MAIN SEQUENCE ---
            const tl = gsap.timeline({ repeat: -1 });

            tl.to("#No", { ...no_to_S2, duration, ease }, "beat1")
              .to("#wa", { ...wa_to_S3, duration, ease }, "beat1")
              .to("#its", { ...its_to_S4, duration, ease }, "beat1")
              .to("#its_dup", { ...its_to_S1, duration, ease }, "beat1")
              .set("#its", its_to_S0)

              .to("#its_dup", { ...its_to_S2, duration, ease }, "beat2")
              .to("#No", { ...no_to_S3, duration, ease }, "beat2")
              .to("#wa", { ...wa_to_S4, duration, ease }, "beat2")
              .to("#wa_dup", { ...wa_to_S1, duration, ease }, "beat2")
              .set("#wa", wa_to_S0)

              .to("#wa_dup", { ...wa_to_S2, duration, ease }, "beat3")
              .to("#its_dup", { ...its_to_S3, duration, ease }, "beat3")
              .to("#No", { ...no_to_S4, duration, ease }, "beat3")
              .to("#No_dup", { ...no_to_S1, duration, ease }, "beat3")
              .set("#No", no_to_S0)

              .to("#No_dup", { ...no_to_S2, duration, ease }, "beat4")
              .to("#wa_dup", { ...wa_to_S3, duration, ease }, "beat4")
              .to("#its_dup", { ...its_to_S4, duration, ease }, "beat4")
              .to("#its", { ...its_to_S1, duration, ease }, "beat4")
              .set("#its_dup", its_to_S0)

              .to("#its", { ...its_to_S2, duration, ease }, "beat5")
              .to("#No_dup", { ...no_to_S3, duration, ease }, "beat5")
              .to("#wa_dup", { ...wa_to_S4, duration, ease }, "beat5")
              .to("#wa", { ...wa_to_S1, duration, ease }, "beat5")
              .set("#wa_dup", wa_to_S0)

              .to("#wa", { ...wa_to_S2, duration, ease }, "beat6")
              .to("#its", { ...its_to_S3, duration, ease }, "beat6")
              .to("#No_dup", { ...no_to_S4, duration, ease }, "beat6")
              .to("#No", { ...no_to_S1, duration, ease }, "beat6")
              .set("#No_dup", no_to_S0);

            // --- NAVIGATION / COMPLETION ---

            // Create Green Transition Layer dynamically or ensure it exists
            let transitionLayer = document.querySelector("#green-transition-layer");
            if (!transitionLayer) {
                transitionLayer = document.createElement("div");
                transitionLayer.id = "green-transition-layer";
                transitionLayer.style.position = "fixed";
                transitionLayer.style.top = "0";
                transitionLayer.style.left = "0";
                transitionLayer.style.width = "100%";
                transitionLayer.style.height = "100%";
                transitionLayer.style.backgroundColor = "#bef264"; // Lime Green
                transitionLayer.style.zIndex = "10000";
                transitionLayer.style.transform = "scaleY(0)";
                transitionLayer.style.transformOrigin = "bottom";
                document.body.appendChild(transitionLayer);
            }

            // Navigate after 10 seconds (aligned with logo duration)
            setTimeout(() => {
                // 1. Animate Green Layer Up (Consume Screen)
                gsap.to(transitionLayer, {
                    scaleY: 1,
                    duration: 0.8,
                    ease: "power4.inOut",
                    onComplete: () => {
                        // 2. Redirect while screen is green
                        document.body.style.overflow = '';
                        window.location.href = '/home?transition=true';
                    }
                });

                // Optional: Fade out logo slightly before green takes over
                gsap.to(logoContainer.querySelector("svg"), {
                    y: -50,
                    opacity: 0,
                    duration: 0.5,
                    ease: "power2.in"
                });

            }, 10000);

        }, 100); // Short delay to ensure window.gsap is populated if using defer
    });
</script>
