/**
 * Contact Page Animations (Framer Motion / Motion library)
 */
import { animate, inView, stagger } from 'https://cdn.jsdelivr.net/npm/motion@11.11.17/+esm';

document.addEventListener('DOMContentLoaded', () => {
    initContactAnimations();
});

function initContactAnimations() {
    // 1. Hero Content
    const bannerItems = document.querySelectorAll('.js-banner-item');
    if (bannerItems.length) {
        animate(
            bannerItems,
            { opacity: [0, 1], y: [40, 0] },
            { delay: stagger(0.15, { startDelay: 0.2 }), duration: 1.2, easing: [0.22, 1, 0.36, 1] }
        );
    }

    // 2. Contact Info Cards
    inView('.js-contact-info', ({ target }) => {
        const cards = target.querySelectorAll('.js-info-card');
        if (cards.length) {
            animate(
                cards,
                { opacity: [0, 1], y: [20, 0] },
                { delay: stagger(0.1), duration: 0.7, easing: "ease-out" }
            );
        }
    });

    // 3. Contact Form
    inView('.js-contact-form-section', ({ target }) => {
        animate(
            target,
            { opacity: [0, 1], y: [30, 0] },
            { duration: 0.8, easing: "ease-out" }
        );
    });

    console.log('Contact Page Animations Initialized (Motion)');
}
