<?php
$features_data = t('home.why_choose.features');
$features = [];

// Prepare icons and background colors (which aren't in JSON)
$feature_icons = [
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m23 6-9.5 9.5-5-5L1 18"></path><path d="M17 6h6v6"></path></svg>',
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>',
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>',
    '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><circle cx="9" cy="9" r="1"></circle><circle cx="12" cy="9" r="1"></circle><circle cx="15" cy="9" r="1"></circle></svg>'
];

if (is_array($features_data)) {
    foreach ($features_data as $index => $f) {
        $features[] = [
            'id' => $index + 1,
            'title' => $f['title'],
            'description' => $f['description'],
            'icon' => $feature_icons[$index] ?? '',
            'bgColor' => 'bg-blue-50'
        ];
    }
}
?>

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
        transform: translateY(40px);
        will-change: transform, opacity;
    }
</style>

<script>
    const features = <?php echo json_encode($features); ?>;

    const featureWrapper = document.getElementById('dynamic-features-wrapper');

    if (featureWrapper) {
        featureWrapper.innerHTML = features.map(feature => `
            <div class="feature-box p-10 bg-white rounded-[2.5rem] border border-transparent hover:border-primary/20 transition-all flex flex-col items-start shadow-sm group hover:shadow-xl duration-500">
                <div class="w-16 h-16 ${feature.bgColor} text-primary rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                    ${feature.icon}
                </div>
                <h3 class="text-2xl font-bold text-secondary mb-4">${feature.title}</h3>
                <p class="text-text-gray text-base leading-relaxed">
                    ${feature.description}
                </p>
            </div>
        `).join('');
    }

    window.addEventListener('load', () => {
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // Header Section Animation
            gsap.to(".reveal", {
                scrollTrigger: {
                    trigger: "#why-choose",
                    start: "top 80%",
                    toggleActions: "play none none none"
                },
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power3.out"
            });

            // Feature Cards Staggered Animation
            gsap.to(".feature-box", {
                scrollTrigger: {
                    trigger: "#dynamic-features-wrapper",
                    start: "top 75%",
                    toggleActions: "play none none none"
                },
                opacity: 1,
                y: 0,
                stagger: 0.15,
                duration: 1,
                ease: "power4.out"
            });
        }
    });
</script>