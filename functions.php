<?php
/**
 * Estatery theme functions and definitions
 * MVC Architecture: Entry point for core controllers
 */

// Include core classes (Manual autoloader for simplicity)
require_once get_template_directory() . '/inc/Core/Setup.php';
require_once get_template_directory() . '/inc/Core/Enqueue.php';
require_once get_template_directory() . '/inc/Core/I18n.php';
require_once get_template_directory() . '/inc/Core/ThemeSetup.php';
require_once get_template_directory() . '/inc/Core/Translator.php';

// Instantiate Core Controllers
new Estatery\Core\Setup();
new Estatery\Core\Enqueue();
new Estatery\Core\I18n();

// Bootstrap pages and settings
\Estatery\Core\ThemeSetup::init();

// Global helper for translations (Like Next.js)
function t($key) {
    return \Estatery\Core\Translator::getInstance()->t($key);
}



// FAQ Custom Post Type Register
function register_faq_custom_post_type()
{
    $labels = [
        'name' => 'FAQs',
        'singular_name' => 'FAQ',
        'add_new' => 'Add New FAQ',
        'add_new_item' => 'Add New FAQ',
        'menu_name' => 'FAQs',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
    ];
    register_post_type('faq', $args);
}
add_action('init', 'register_faq_custom_post_type');
 
 
function insert_default_faqs()
{
    if (get_option('default_faqs_inserted')) return;
 
    $defaults = [
        ['q' => 'How do I start searching for a property?', 'a' => 'You can start by using our search bar at the top of the page.'],
        ['q' => 'Are the property listings verified?', 'a' => 'Yes, every listing on Estatery goes through a strict verification process.'],
        ['q' => 'Can I list my own property for sale?', 'a' => 'Absolutely! Click on the Sell Property button and follow the steps.'],
        ['q' => 'Is there any commission fee for buyers?', 'a' => 'We provide transparent pricing. Browsing is free.'],
        ['q' => 'How can I contact a real estate agent?', 'a' => 'Each detail page has a Contact Agent button.']
    ];
 
    foreach ($defaults as $faq) {
        wp_insert_post([
            'post_title'   => $faq['q'],
            'post_content' => $faq['a'],
            'post_status'  => 'publish',
            'post_type'    => 'faq',
        ]);
    }
    update_option('default_faqs_inserted', true);
}
add_action('admin_init', 'insert_default_faqs');