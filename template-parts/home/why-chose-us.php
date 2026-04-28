<section class="py-24 bg-gray-50 overflow-hidden" id="why-choose">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="reveal text-4xl font-extrabold text-secondary mb-6"><?php echo esc_html( t('home.why_choose.title') ); ?></h2>
            <p class="reveal text-text-gray"><?php echo esc_html( t('home.why_choose.description') ); ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="dynamic-features-wrapper">
        </div>
    </div>
</section>

<style>
    .reveal,
    .feature-box {
        opacity: 0;
        transform: translateY(20px);
        will-change: transform, opacity;
    }
</style>