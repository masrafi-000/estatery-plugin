<?php
namespace Estatery\Core;

/**
 * Handle AJAX requests for properties
 */
class AjaxHandler {
    public function __construct() {
        add_action('wp_ajax_get_featured_properties', [$this, 'get_featured_properties']);
        add_action('wp_ajax_nopriv_get_featured_properties', [$this, 'get_featured_properties']);
    }

    public function get_featured_properties() {
        $lang = sanitize_key($_POST['lang'] ?? 'en');
        $cache_key = 'estatery_featured_properties_' . $lang;
        
        $featured = get_transient($cache_key);

        if (false === $featured) {
            $json_file = get_template_directory() . '/data/properties.json';
            if (!file_exists($json_file)) {
                wp_send_json_error('Data file not found');
            }

            $raw_json = file_get_contents($json_file);
            $data = json_decode($raw_json, true);
            $raw_properties = $data['root']['property'] ?? [];

            // Filter for New Builds first
            $filtered = array_filter($raw_properties, function($item) {
                return isset($item['new_build'][0]) && $item['new_build'][0] === "1";
            });

            // If we have more than 12 new builds, take 12. If less, supplement with first ones.
            if (count($filtered) < 12) {
                $count_needed = 12 - count($filtered);
                $non_new_builds = array_slice(array_filter($raw_properties, function($item) {
                    return !isset($item['new_build'][0]) || $item['new_build'][0] !== "1";
                }), 0, $count_needed);
                $filtered = array_merge($filtered, $non_new_builds);
            } else {
                $filtered = array_slice($filtered, 0, 12);
            }

            $featured = [];
            foreach ($filtered as $prop) {
                $featured[] = Translator::map_property_data($prop, $lang);
            }

            set_transient($cache_key, $featured, HOUR_IN_SECONDS);
        }

        ob_start();
        if (!empty($featured)) {
            foreach ($featured as $property) {
                include get_template_directory() . '/template-parts/home/card-featured.php';
            }
        }
        $html = ob_get_clean();

        wp_send_json_success(['html' => $html]);
    }
}
