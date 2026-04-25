<?php
/**
 * Component: Investment Properties Listing
 */
$json_file = get_template_directory() . '/data/investments.json';
$invest_properties = [];
$current_lang = \Estatery\Core\Translator::getInstance()->getLang();

if (file_exists($json_file)) {
    $json_data = file_get_contents($json_file);
    $parsed_data = json_decode($json_data, true);
    $raw_properties = $parsed_data['root']['property'] ?? [];

    foreach ($raw_properties as $prop) {
        $mapped = \Estatery\Core\Translator::map_property_data($prop, $current_lang);
        $mapped['is_investment'] = true;
        $invest_properties[] = $mapped;
    }
}
?>

<section class="py-24 bg-white overflow-hidden js-invest-props-section">
    <div class="container mx-auto px-6 ">
        
        <div class="max-w-3xl mb-16 js-invest-props-header">
            <h2 class="text-secondary font-bold uppercase tracking-[0.2em] text-[10px] mb-4 js-invest-prop-item">
                <?php echo esc_html( t('pages.invest.properties_label') ?: 'Exclusive Opportunities' ); ?>
            </h2>
            <h3 class="text-4xl md:text-5xl font-serif font-bold text-slate-900 leading-tight js-invest-prop-item">
                <?php echo esc_html( t('pages.invest.properties_title') ?: 'Prime Real Estate Investment Portfolio' ); ?>
            </h3>
            <p class="text-slate-500 mt-6 text-lg leading-relaxed js-invest-prop-item">
                <?php echo esc_html( t('pages.invest.properties_subtitle') ?: 'Discover hand-picked properties with high yield potential and strong capital appreciation in the most sought-after areas of Alicante.' ); ?>
            </p>
        </div>

        <?php if (!empty($invest_properties)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 js-invest-props-grid">
                <?php 
                foreach ($invest_properties as $property) {
                    get_template_part('template-parts/properties/property-card', null, ['property' => $property]);
                }
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                <p class="text-slate-400 font-medium italic"><?php echo esc_html( t('pages.invest.no_properties') ?: 'More investment opportunities are being analyzed. Check back soon.' ); ?></p>
            </div>
        <?php endif; ?>

    </div>
</section>

<script>
(function() {
    function initInvestPropsAnims() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
        
        gsap.registerPlugin(ScrollTrigger);
        const section = document.querySelector(".js-invest-props-section");
        if (!section) return;

        const headerItems = section.querySelectorAll(".js-invest-prop-item");
        const grid        = section.querySelector(".js-invest-props-grid");
        const cards       = grid ? grid.querySelectorAll("article") : [];

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 80%",
                toggleActions: "play none none none",
                once: true
            }
        });

        // 1. Header reveal
        if (headerItems.length) {
            gsap.set(headerItems, { opacity: 0, y: 30 });
            tl.to(headerItems, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.12,
                ease: "power3.out"
            });
        }

        // 2. Cards stagger
        if (cards.length) {
            gsap.set(cards, { opacity: 0, y: 50 });
            tl.to(cards, {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.1,
                ease: "power4.out",
                clearProps: "transform,opacity"
            }, "-=0.4");
        }
    }

    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        initInvestPropsAnims();
    } else {
        window.addEventListener('load', initInvestPropsAnims);
        setTimeout(initInvestPropsAnims, 600);
    }
})();
</script>