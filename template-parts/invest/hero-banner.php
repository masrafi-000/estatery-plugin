<?php
/**
 * Component: Investment Properties Hero Banner
 */
$banner_title = t('pages.invest.properties_title') ?: 'Investment Portfolio';
$banner_subtitle = t('pages.invest.properties_subtitle') ?: 'Discover high-yield real estate opportunities.';
$banner_image = "https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=2000"; 
$banner_bg_text = t('pages.invest.hero_banner.bg_text') ?? "Yield";
$banner_breadcrumbs = [
    ['label' => t('header.navigation.0.label') ?: 'Home', 'url' => site_url()],
    ['label' => t('header.navigation.3.label') ?: 'Invest', 'url' => home_url('/invest/')],
    ['label' => $banner_title, 'url' => '#']
];

include get_template_directory() . '/shared/dynamic-banner.php';
?>
