<section class="properties-page bg-white min-h-screen">
    <!-- Section 1: Premium Hero Header (Dynamic Banner) -->
    <?php 
    $banner_title = t('pages.properties.title');
    $banner_subtitle = t('pages.properties.subtitle');
    $banner_image = "https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=2000"; 
    $banner_bg_text = "Market";
    include get_template_directory() . '/shared/dynamic-banner.php';
    ?>

    <div class="py-20 bg-[#f8fafc]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sidebar Filters (Left) -->
                <?php get_template_part('template-parts/properties/filters', 'sidebar'); ?>

                <!-- Grid Section (Right) -->
                <main class="lg:w-3/4">
                    <!-- Grid Header -->
                    <div class="flex flex-wrap items-center justify-between gap-6 mb-12" data-aos="fade-up">
                        <div>
                            <span class="text-primary font-bold text-xs uppercase tracking-widest block mb-2">Showing Result</span>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tighter  uppercase">
                                24 <span class="text-slate-400">Items Available</span>
                            </h2>
                        </div>
                        <div class="flex gap-4">
                            <select class="bg-white border-none rounded-2xl px-6 py-3 text-xs font-black uppercase tracking-widest text-slate-600 shadow-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none cursor-pointer">
                                <option>Newest First</option>
                                <option>Oldest First</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Main Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                        <?php
                        $properties = t('pages.properties.items');
                        if ( is_array($properties) ) :
                            foreach ( $properties as $property ) :
                                get_template_part('template-parts/properties/property', 'card', ['property' => $property]);
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <!-- Pagination Placeholder -->
                    <div class="mt-20 flex justify-center items-center gap-3">
                        <button class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-primary font-black shadow-sm bg-primary text-white">1</button>
                        <button class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 font-black hover:border-primary hover:text-primary transition-all">2</button>
                        <button class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 font-black hover:border-primary hover:text-primary transition-all">3</button>
                        <span class="text-slate-300 px-2 font-black">...</span>
                        <button class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 font-black hover:border-primary hover:text-primary transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </main>
            </div>
        </div>
    </div>

 
   
    <!-- Section 5: Call to Action -->
    <?php get_template_part('template-parts/properties/cta', 'block'); ?>
</section>
