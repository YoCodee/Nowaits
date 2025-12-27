import "./bootstrap";

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// Contoh penggunaan:
// gsap.to(".box", { rotation: 27, x: 100, duration: 1 });
