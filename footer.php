<?php
$footer_menus = [
    [
        "title" => t('footer.menus.quick_links'),
        "links" => [
            ["label" => t('footer.links.buy'), "url" => "#"],
            ["label" => t('footer.links.rent'), "url" => "#"],
            ["label" => t('footer.links.sell'), "url" => "#"],
            ["label" => t('footer.links.services'), "url" => "#"],
        ]
    ],
    [
        "title" => t('footer.menus.company'),
        "links" => [
            ["label" => t('footer.links.about'), "url" => "#"],
            ["label" => t('footer.links.contact'), "url" => "#"],
            ["label" => t('footer.links.careers'), "url" => "#"],
            ["label" => t('footer.links.blog'), "url" => "#"],
        ]
    ],
    [
        "title" => t('footer.menus.legal'),
        "links" => [
            ["label" => t('footer.links.privacy'), "url" => "#"],
            ["label" => t('footer.links.terms'), "url" => "#"],
            ["label" => t('footer.links.cookie'), "url" => "#"],
        ]
    ]
];

$social_links = [
    "facebook" => [
        "url"  => "https://facebook.com/yourpage",
        "icon" => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>'
    ],
    "twitter" => [
        "url"  => "https://twitter.com/yourhandle",
        "icon" => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>'
    ],
    "instagram" => [
        "url"  => "https://instagram.com/yourprofile",
        "icon" => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.584.07-4.849c.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>'
    ],
    "linkedin" => [
        "url"  => "https://linkedin.com/in/yourprofile",
        "icon" => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path></svg>'
    ]
];
?>

<footer class="bg-white pt-16 pb-8 border-t border-gray-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">

            <div class="lg:col-span-2">
                <a href="index.php" class="inline-block mb-3">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png"
                        alt="Capital Union Logo" class="h-auto w-30">
                </a>
                <p class="text-text-gray max-w-sm leading-relaxed text-base">
                    <?php echo esc_html( t('footer.tagline') ); ?>
                </p>
            </div>

            <?php foreach ($footer_menus as $menu): ?>
                <div>
                    <h4 class="text-lg font-bold text-secondary mb-6"><?php echo esc_html( $menu['title'] ); ?></h4>
                    <ul class="space-y-4">
                        <?php foreach ($menu['links'] as $link): ?>
                            <li>
                                <a href="<?php echo esc_url($link['url']); ?>" class="text-text-gray hover:text-primary transition-colors duration-300">
                                    <?php echo esc_html( $link['label'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-text-gray text-sm">
                © <?php echo date('Y'); ?> Estatery. <?php echo esc_html( t('footer.copyright') ); ?>
            </p>

            <div class="flex items-center gap-6">
                <?php foreach ($social_links as $name => $data): ?>
                    <a href="<?php echo $data['url']; ?>" target="_blank"
                        class="text-secondary hover:text-primary transition-all duration-300 transform hover:-translate-y-1"
                        aria-label="<?php echo $name; ?>">
                        <?php echo $data['icon']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>