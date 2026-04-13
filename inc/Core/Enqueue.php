<?php
namespace Estatery\Core;

/**
 * Controller for Asset Enqueuing
 */
class Enqueue {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function enqueue_assets() {
        // Main Stylesheet
        wp_enqueue_style( 'estatery-style', get_stylesheet_uri(), array(), '1.0.0' );

        // Tailwind CSS Output
        if ( file_exists( get_template_directory() . '/src/output.css' ) ) {
            wp_enqueue_style( 'estatery-tailwind', get_template_directory_uri() . '/src/output.css', array(), '1.0.0' );
        }

        // Swiper CSS
        wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );

        // GSAP CDN
        wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
        wp_enqueue_script( 'gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true );

        // Swiper JS
        wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

        // Lenis Smooth Scroll CDN
        wp_enqueue_script( 'lenis-cdn', 'https://cdn.jsdelivr.net/npm/lenis@1.1.9/dist/lenis.min.js', array(), '1.1.9', true );

        // Theme JS (Refactored jQuery version)
        wp_enqueue_script( 'estatery-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery', 'gsap', 'swiper-js'), '1.0.0', true );

        // Localize search/data for JS
        $feature_icons = [
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m23 6-9.5 9.5-5-5L1 18"></path><path d="M17 6h6v6"></path></svg>',
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>',
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>',
            '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><circle cx="9" cy="9" r="1"></circle><circle cx="12" cy="9" r="1"></circle><circle cx="15" cy="9" r="1"></circle></svg>'
        ];

        $features_data = t('home.why_choose.features');
        $features = [];
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

        wp_localize_script( 'estatery-theme', 'estateryData', [
            'why_choose_features' => $features
        ]);

        // Custom Main JS (Legacy/Other)
        wp_enqueue_script( 'estatery-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true );
        
        // Add module type to main.js if needed
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            if ('estatery-main' !== $handle) {
                return $tag;
            }
            return '<script type="module" src="' . esc_url($src) . '"></script>';
        }, 10, 3);
    }
}
