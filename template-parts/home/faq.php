<section class="py-24 bg-white overflow-hidden" id="faq-section">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-4xl font-extrabold text-secondary mb-6">Frequently Asked Questions</h2>
            <p class="text-secondary">Everything you need to know about the platform.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <div class="lg:w-5/12 w-full">
                <div class="bg-gray-50 p-10 rounded-[2.5rem] border border-gray-100 sticky top-10">
                    <h3 class="text-3xl font-bold text-secondary mb-6">Need More Help?</h3>
                    <p class="text-secondary mb-8">Our support team is here for you.</p>
                    <a href="#"
                        class="bg-secondary text-white px-8 py-4 rounded-2xl font-bold inline-block hover:bg-blue-600 transition-all">
                        Contact Support
                    </a>
                </div>
            </div>

            <div class="lg:w-7/12 space-y-4 w-full relative" id="accordion-container">
                <?php
                $faq_query = new WP_Query(['post_type' => 'faq', 'posts_per_page' => -1, 'order' => 'ASC']);
                if ($faq_query->have_posts()) :
                    while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                <div class="faq-card bg-gray-50 border border-gray-100 rounded-2xl overflow-hidden mb-4">
                    <button class="faq-toggle w-full flex items-center justify-between p-7 text-left outline-none">
                        <span class="text-lg font-bold text-secondary pr-4"><?php the_title(); ?></span>
                        <span class="faq-icon text-blue-500 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer hidden px-7 pb-7 text-secondary leading-relaxed">
                        <div class="w-full h-px bg-gray-200 mb-5"></div>
                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Prevent layout collapse when items hide */
#accordion-container {
    min-height: 400px;
}

.faq-card.active {
    background-color: #fff !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.15);
    z-index: 20;
    position: relative;
}

.faq-card.active .faq-icon {
    transform: rotate(180deg);
}

.faq-card {
    will-change: transform, opacity;
    display: block;
    /* Ensure visibility */
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return;

    const faqToggles = document.querySelectorAll('.faq-toggle');
    const faqCards = document.querySelectorAll('.faq-card');

    faqToggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const parent = toggle.parentElement;
            const answer = toggle.nextElementSibling;
            const isActive = parent.classList.contains('active');

            if (!isActive) {
                // Open this one
                parent.classList.add('active');
                gsap.set(answer, {
                    display: 'block'
                });
                gsap.fromTo(answer, {
                    opacity: 0,
                    height: 0
                }, {
                    opacity: 1,
                    height: 'auto',
                    duration: 0.5,
                    ease: "power2.out"
                });

                // Move others away
                faqCards.forEach((card, index) => {
                    if (card !== parent) {
                        const xSide = index % 2 === 0 ? -150 : 150;
                        gsap.to(card, {
                            xPercent: xSide,
                            autoAlpha: 0,
                            scale: 0.7,
                            height: 0,
                            marginBottom: 0,
                            pointerEvents: 'none',
                            duration: 0.8,
                            ease: "expo.inOut"
                        });
                    }
                });
            } else {
                // Close this one
                parent.classList.remove('active');
                gsap.to(answer, {
                    height: 0,
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => {
                        gsap.set(answer, {
                            display: 'none'
                        });
                    }
                });

                // Bring others back
                faqCards.forEach((card) => {
                    gsap.to(card, {
                        xPercent: 0,
                        autoAlpha: 1,
                        scale: 1,
                        height: 'auto',
                        marginBottom: '1rem',
                        pointerEvents: 'auto',
                        duration: 0.8,
                        ease: "back.out(1.2)",
                        clearProps: "transform,scale,margin-bottom"
                    });
                });
            }
        });
    });
});
</script>