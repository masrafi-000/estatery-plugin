/**
 * Smooth Scroll Module (Lenis)
 * Refactored to remove GSAP dependency
 */
export default class SmoothScroll {
    constructor() {
        this.lenis = null;
        this.init();
    }

    init() {
        if (typeof Lenis === 'undefined') return;

        this.lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        const raf = (time) => {
            this.lenis.raf(time);
            requestAnimationFrame(raf);
        };

        requestAnimationFrame(raf);

        console.log('Lenis Module Initialized (Vanilla)');
    }
}
