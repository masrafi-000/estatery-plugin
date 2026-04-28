/**
 * Animations Module (Framer Motion / Motion library)
 * Professional Text & UI reveal system
 */
import { animate, inView, stagger } from 'https://cdn.jsdelivr.net/npm/motion@11.11.17/+esm';

export default class Animations {
    constructor() {
        this.init();
    }

    init() {
        this.initTextAnimations();
        this.initSectionReveals();
        this.initGlobalTransitions();
        console.log('Animations Module Initialized (Professional Mode)');
    }

    /**
     * Smooth text splitting and reveal
     */
    initTextAnimations() {
        const textElements = document.querySelectorAll('.js-reveal-text');
        
        textElements.forEach(el => {
            const text = el.innerText.trim();
            if (!text) return;

            // Split text into words for a staggered "reveal"
            const words = text.split(/\s+/);
            el.innerHTML = words.map(word => `<span class="inline-block overflow-hidden"><span class="inline-block opacity-0 translate-y-full">${word}&nbsp;</span></span>`).join('');
            
            inView(el, ({ target }) => {
                const spans = target.querySelectorAll('span > span');
                animate(
                    spans,
                    { opacity: [0, 1], y: ["100%", "0%"] },
                    { 
                        delay: stagger(0.04), 
                        duration: 0.8, 
                        easing: [0.22, 1, 0.36, 1] 
                    }
                );
            }, { margin: "0px 0px -50px 0px" });
        });
    }

    /**
     * General section/element reveals
     */
    initSectionReveals() {
        // Generic fade-up reveal
        inView('.js-reveal-fade', ({ target }) => {
            animate(
                target,
                { opacity: [0, 1], y: [30, 0] },
                { duration: 0.8, easing: [0.22, 1, 0.36, 1] }
            );
        }, { margin: "0px 0px -50px 0px" });

        // Staggered children reveal
        const staggerContainers = document.querySelectorAll('.js-reveal-stagger');
        staggerContainers.forEach(container => {
            inView(container, ({ target }) => {
                const children = target.children;
                animate(
                    children,
                    { opacity: [0, 1], y: [20, 0] },
                    { delay: stagger(0.1), duration: 0.6, easing: "ease-out" }
                );
            });
        });

        // Global Footer Animations
        const footer = document.querySelector(".js-footer-section");
        if (footer) {
            inView(footer, ({ target }) => {
                const items = target.querySelectorAll(".container > *");
                animate(
                    items,
                    { opacity: [0, 1], y: [20, 0] },
                    { delay: stagger(0.1), duration: 0.8, easing: "ease-out" }
                );
            });
        }
    }

    /**
     * Add smooth transitions to links and buttons
     */
    initGlobalTransitions() {
        const buttons = document.querySelectorAll('button, .btn, .button, a');
        buttons.forEach(btn => {
            btn.style.transition = 'all 0.4s cubic-bezier(0.22, 1, 0.36, 1)';
        });
    }
}
