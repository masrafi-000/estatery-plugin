<div class="swiper-slide h-auto">
    <div class="property-card bg-white rounded-[1.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 h-full flex flex-col group">
        <div class="relative h-48 overflow-hidden">
            <img src="<?php echo esc_url($property['image'] ?: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1200'); ?>"
                class="img-zoom w-full h-full object-cover transition-transform duration-[1.5s]"
                alt="<?php echo esc_attr($property['title']); ?>">
            <div class="absolute top-4 left-4 flex flex-col gap-2">
                <?php if (!empty($property['new_build'])): ?>
                <span class="bg-accent text-white text-[9px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-lg">
                    <?php echo esc_html(t('pages.property_details.new_build')); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">
                <a href="<?php echo esc_url(\Estatery\Core\Translator::getInstance()->resolve_nav_url('/property-details') . '?id=' . esc_attr($property['id'])); ?>"
                    class="text-inherit hover:text-primary transition-colors">
                    <?php echo esc_html($property['title']); ?>
                </a>
            </h3>

            <div class="flex items-center text-slate-400 text-xs font-medium mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" class="mr-1 text-primary">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span class="truncate"><?php echo esc_html($property['location']); ?></span>
            </div>

            <div class="grid grid-cols-3 gap-2 py-4 border-y border-slate-50 mb-5 text-center">
                <div>
                    <span class="block text-slate-900 font-black text-xs"><?php echo esc_html($property['beds']); ?></span>
                    <span class="text-[9px] text-slate-400 uppercase font-bold"><?php echo esc_html( t('home.featured.beds') ); ?></span>
                </div>
                <div class="border-x border-slate-50">
                    <span class="block text-slate-900 font-black text-xs"><?php echo esc_html($property['baths']); ?></span>
                    <span class="text-[9px] text-slate-400 uppercase font-bold"><?php echo esc_html( t('home.featured.baths') ); ?></span>
                </div>
                <div>
                    <span class="block text-slate-900 font-black text-xs"><?php echo (int)($property['pool'] ?? 0); ?></span>
                    <span class="text-[9px] text-slate-400 uppercase font-bold"><?php echo esc_html( t('home.featured.pool') ); ?></span>
                </div>
            </div>

            <div class="mt-auto flex justify-between items-center">
                <span class="text-primary font-black text-lg tracking-tighter"><?php echo esc_html($property['price']); ?></span>
                <a href="<?php echo esc_url(\Estatery\Core\Translator::getInstance()->resolve_nav_url('/property-details') . '?id=' . esc_attr($property['id'])); ?>"
                    class="p-2.5 bg-slate-900 text-white rounded-xl hover:bg-primary transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
