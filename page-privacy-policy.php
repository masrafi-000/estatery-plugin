<?php
/**
 * Template Name: Privacy Policy
 */

get_header();

$banner_title    = t('pages.privacy_policy.hero.title');
$banner_bg_text  = t('pages.privacy_policy.hero.bg_text');
$banner_subtitle = t('pages.privacy_policy.hero.subtitle');

$shared_banner_path = get_template_directory() . '/shared/dynamic-banner.php';

if ( file_exists( $shared_banner_path ) ) {
    include $shared_banner_path;
}

?>

<section class="max-w-4xl mx-auto px-4 py-20 font-sans text-slate-900 leading-relaxed space-y-12">
    <div class="prose prose-slate max-w-none">
        <h2 class="text-3xl font-serif font-bold text-slate-900 mb-6"><?php echo esc_html( t('pages.privacy_policy.content.title') ); ?></h2>
        <p class="text-lg text-slate-600 mb-10 pb-10 border-b border-gray-100">
            <?php echo esc_html( t('pages.privacy_policy.content.description') ); ?>
        </p>
        
        <?php
        $sections = t('pages.privacy_policy.content.sections');
        if ( is_array($sections) ) {
            foreach ( $sections as $section ) {
                echo '<div class="mb-10">';
                if (!empty($section['title'])) {
                    echo '<h3 class="text-2xl font-bold text-slate-800 mb-4">' . esc_html($section['title']) . '</h3>';
                }
                if (!empty($section['text'])) {
                    echo '<p class="text-base text-slate-600 leading-loose">' . esc_html($section['text']) . '</p>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>
