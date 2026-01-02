import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// Optional: GLOBAL usage for testing in browser console
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

import Lenis from "lenis";
window.Lenis = Lenis;
