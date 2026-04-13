<section class="relative min-h-[700px] lg:h-[90vh] flex items-center justify-center overflow-hidden bg-[#0a1d23]">

    <div id="hero-bg-container" class="absolute inset-0 z-0">
        <?php
        // Array of 5 High-Quality Real Estate Images (Fallbacks)
        $default_images = [
            'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=1920', // Modern Mansion
            'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?q=80&w=1920', // Luxury Interior
            'https://images.unsplash.com/photo-1600585154340-be6199f7d009?q=80&w=1920', // Modern Exterior
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1920', // Pool Villa
            'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?q=80&w=1920'  // Penthouse View
        ];

        for ($i = 1; $i <= 5; $i++) :
            // Get image from Customizer, if empty use default
            $custom_img = get_theme_mod("hero_bg_image_$i");
            $img_url = !empty($custom_img) ? $custom_img : $default_images[$i - 1];

            // Set first image as visible by default
            $opacity = ($i === 1) ? 'opacity-100' : 'opacity-0';
        ?>
            <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-[2000ms] ease-in-out <?php echo $opacity; ?>"
                style="background-image: linear-gradient(rgba(10, 29, 35, 0.4), rgba(10, 29, 35, 0.7)), url('<?php echo esc_url($img_url); ?>');">
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <span
            class="inline-block text-xs md:text-sm font-semibold mb-4 tracking-[0.2em] uppercase opacity-90 border-b border-primary pb-1">
            <?php echo esc_html( t('home.hero.agency_label') ); ?>
        </span>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 tracking-tight leading-[1.1]">
            <?php echo t('home.hero.title'); ?>
        </h1>

        <p class="max-w-2xl mx-auto text-gray-200 text-sm md:text-lg mb-12 leading-relaxed opacity-80">
            <?php echo esc_html( t('home.hero.description') ); ?>
        </p>

        <div class="max-w-6xl mx-auto">
            <div class="flex justify-center -mb-[1px] space-x-1">
                <button type="button"
                    class="filter-tab active px-10 py-3.5 bg-primary text-accent-primary font-bold rounded-t-xl transition-all"
                    data-type="buy"><?php echo esc_html( t('home.hero.tabs.buy') ); ?></button>
                <button type="button"
                    class="filter-tab px-10 py-3.5 bg-white/90 backdrop-blur-sm text-foreground font-bold rounded-t-xl"
                    data-type="rent"><?php echo esc_html( t('home.hero.tabs.rent') ); ?></button>
            </div>

            <div class="bg-white rounded-2xl lg:rounded-b-2xl lg:rounded-tr-none shadow-2xl p-6 lg:p-8">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">

                    <div class="flex flex-col gap-2 text-left">
                        <label class="text-[10px] font-bold text-secondary uppercase tracking-widest ml-1"><?php echo esc_html( t('home.hero.form.search_label') ); ?></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </span>
                            <input type="text" name="s" placeholder="<?php echo esc_attr( t('home.hero.form.search_placeholder') ); ?>"
                                class="w-full pl-11 pr-4 py-4 bg-surface rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-foreground text-sm">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-left">
                        <label
                            class="text-[10px] font-bold text-secondary uppercase tracking-widest ml-1"><?php echo esc_html( t('home.hero.form.location_label') ); ?></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </span>
                            <select name="location"
                                class="w-full pl-11 pr-4 py-4 bg-surface rounded-xl border-none text-secondary text-sm appearance-none cursor-pointer">
                                <option value=""><?php echo esc_html( t('home.hero.form.location_placeholder') ); ?></option>
                                <option value="dhaka"><?php echo esc_html( t('home.hero.form.location_options.dhaka') ); ?></option>
                                <option value="chittagong"><?php echo esc_html( t('home.hero.form.location_options.chittagong') ); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-left">
                        <label class="text-[10px] font-bold text-secondary uppercase tracking-widest ml-1"><?php echo esc_html( t('home.hero.form.type_label') ); ?></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 21h18M9 8h1M9 12h1M9 16h1M14 8h1M14 12h1M14 16h1M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
                                </svg>
                            </span>
                            <select name="type"
                                class="w-full pl-11 pr-4 py-4 bg-surface rounded-xl border-none text-secondary text-sm appearance-none cursor-pointer">
                                <option value="apartment"><?php echo esc_html( t('home.hero.form.property_types.apartment') ); ?></option>
                                <option value="luxury"><?php echo esc_html( t('home.hero.form.property_types.luxury') ); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit"
                            class="w-full h-[52px] bg-[#0a1d23] text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-black transition-all shadow-lg active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            <?php echo esc_html( t('home.hero.form.search_button') ); ?>
                        </button>
                    </div>

                    <input type="hidden" name="listing_type" id="listing-type-input" value="buy">
                </form>
            </div>
        </div>
    </div>

</section>