<?php
$pages = ['properties', 'property-details', 'investment-details', 'about', 'contact', 'invest', 'privacy-policy', 'terms-of-service', 'cookie-policy', 'blog'];
foreach ($pages as $slug) {
    $en_id = get_posts(['post_type' => 'page', 'name' => $slug, 'post_status' => 'any', 'fields' => 'ids'])[0] ?? 0;
    if ($en_id) {
        foreach (['pl', 'hu'] as $lang) {
            if (!pll_get_post($en_id, $lang)) {
                $title = get_the_title($en_id) . ' (' . strtoupper($lang) . ')';
                $new_id = wp_insert_post([
                    'post_title' => $title,
                    'post_name' => $slug . '-' . $lang,
                    'post_status' => 'publish',
                    'post_type' => 'page'
                ]);
                update_post_meta($new_id, '_wp_page_template', get_post_meta($en_id, '_wp_page_template', true));
                pll_set_post_language($new_id, $lang);
                $translations = pll_get_post_translations($en_id);
                $translations[$lang] = $new_id;
                pll_save_post_translations($translations);
                echo 'Created ' . $title . "\n";
            }
        }
    }
}
