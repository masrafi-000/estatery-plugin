/**
 * Animations Module (GSAP)
 */
export default class Animations {
    constructor() {
        this.init();
    }

    init() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }
        // Scroll animations for cards - only run if cards and trigger exist
        const cards = document.querySelectorAll('.gsap-card');
        const cardTrigger = document.querySelector('.animation-demo');
        
        if (cards.length > 0 && cardTrigger) {
            gsap.from(cards, {
                scrollTrigger: {
                    trigger: cardTrigger,
                    start: 'top 80%',
                },
                y: 60,
                opacity: 0,
                duration: 1,
                stagger: 0.2,
                ease: 'power3.out'
            });
        }

        // Scroll animations for reveal elements
        const reveals = document.querySelectorAll('.gsap-reveal');
        if (reveals.length > 0) {
            reveals.forEach(reveal => {
                gsap.from(reveal, {
                    scrollTrigger: {
                        trigger: reveal,
                        start: 'top 90%',
                    },
                    scale: 0.8,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'back.out(1.7)'
                });
            });
        }

        console.log('Animations Module Initialized');
    }
}
