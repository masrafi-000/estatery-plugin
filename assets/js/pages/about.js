/**
 * About Page Animations (Framer Motion / Motion library)
 */
import { animate, inView, stagger } from 'https://cdn.jsdelivr.net/npm/motion@11.11.17/+esm';

document.addEventListener('DOMContentLoaded', () => {
    initAboutAnimations();
});

function initAboutAnimations() {
    // 1. Hero Content (Animate on load)
    const bannerItems = document.querySelectorAll('.js-banner-item');
    const bannerBgText = document.querySelector('.js-banner-bg-text');

    if (bannerItems.length) {
        animate(
            bannerItems,
            { opacity: [0, 1], y: [40, 0] },
            { 
                delay: stagger(0.15, { startDelay: 0.3 }),
                duration: 1.2,
                easing: [0.22, 1, 0.36, 1]
            }
        );
    }

    if (bannerBgText) {
        animate(
            bannerBgText,
            { opacity: [0, 0.1], x: [100, 0] },
            { duration: 2, easing: [0.22, 1, 0.36, 1], delay: 0.5 }
        );
    }

    // 2. Our Story Section
    inView('.js-about-story', ({ target }) => {
        const images = target.querySelectorAll('.js-story-images img');
        const textItems = target.querySelectorAll('.js-story-text > *');
        const thumbnails = target.querySelectorAll('.js-story-thumbnails > *');

        if (images.length) {
            animate(
                images,
                { opacity: [0, 1], y: [25, 0], scale: [1.02, 1] },
                { delay: stagger(0.1), duration: 0.8, easing: "ease-out" }
            );
        }

        if (textItems.length) {
            animate(
                textItems,
                { opacity: [0, 1], x: [20, 0] },
                { delay: stagger(0.1, { startDelay: 0.2 }), duration: 0.7, easing: "ease-out" }
            );
        }

        if (thumbnails.length) {
            animate(
                thumbnails,
                { opacity: [0, 1], scale: [0.92, 1] },
                { delay: stagger(0.1, { startDelay: 0.5 }), duration: 0.5, easing: [0.34, 1.56, 0.64, 1] }
            );
        }
    });

    // 3. Strategic Philosophy
    inView('.js-philosophy-section', ({ target }) => {
        const headerItems = target.querySelectorAll('.js-philosophy-header > *');
        const cards = target.querySelectorAll('.js-value-card');

        if (headerItems.length) {
            animate(
                headerItems,
                { opacity: [0, 1], y: [15, 0] },
                { delay: stagger(0.1), duration: 0.6, easing: "ease-out" }
            );
        }

        if (cards.length) {
            animate(
                cards,
                { opacity: [0, 1], y: [20, 0], scale: [0.98, 1] },
                { delay: stagger(0.1, { startDelay: 0.2 }), duration: 0.7, easing: "ease-out" }
            );
        }
    });

    // 4. Leadership Section
    inView('.js-leadership-section', ({ target }) => {
        const image = target.querySelector('.js-leadership-image');
        const contentItems = target.querySelectorAll('.js-leadership-content > *');
        const card = target.querySelector('.js-leadership-card');
        const counter = target.querySelector('.js-count-up');

        if (image) {
            animate(image, { opacity: [0, 1], y: [25, 0] }, { duration: 0.8, easing: "ease-out" });
        }

        if (contentItems.length) {
            animate(
                contentItems,
                { opacity: [0, 1], x: [20, 0] },
                { delay: stagger(0.08, { startDelay: 0.3 }), duration: 0.7, easing: "ease-out" }
            );
        }

        if (card) {
            animate(
                card,
                { opacity: [0, 1], scale: [0.85, 1] },
                { delay: 0.6, duration: 0.6, easing: [0.34, 1.56, 0.64, 1] }
            );
        }

        if (counter) {
            const targetVal = parseInt(counter.dataset.target, 10) || 0;
            animate(0, targetVal, {
                duration: 2,
                delay: 0.8,
                onUpdate: latest => counter.textContent = Math.round(latest)
            });
        }
    });

    // 5. How We Work (Process)
    inView('.js-how-we-work', ({ target }) => {
        const headerItems = target.querySelectorAll('.js-process-header > *');
        const line = target.querySelector('.js-process-line');
        const steps = target.querySelectorAll('.js-process-step');

        if (headerItems.length) {
            animate(
                headerItems,
                { opacity: [0, 1], y: [15, 0] },
                { delay: stagger(0.1), duration: 0.6, easing: "ease-out" }
            );
        }

        if (line) {
            animate(line, { width: ["0%", "100%"] }, { delay: 0.4, duration: 0.8, easing: "ease-in-out" });
        }

        if (steps.length) {
            animate(
                steps,
                { opacity: [0, 1], y: [20, 0] },
                { delay: stagger(0.1, { startDelay: 0.5 }), duration: 0.7, easing: "ease-out" }
            );
        }
    });

    console.log('About Page Animations Initialized (Motion)');
}
