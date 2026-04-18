<script src="https://unpkg.com/lucide@latest"></script>

<?php
// Video Handling
$video_id    = get_theme_mod('hero_video_file');
$video_url   = $video_id ? wp_get_attachment_url($video_id) : get_template_directory_uri() . '/assets/images/hero-video.mp4';
?>

<section class="relative min-h-[100vh] flex items-center justify-center overflow-hidden bg-[#0a1d23]">

    <div id="hero-bg-container" class="absolute inset-0 z-0">
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#0a1d23]/80 via-transparent to-[#0a1d23]"></div>
        <video id="hero-video" autoplay muted loop playsinline preload="auto"
            class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 object-cover">
            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="container mx-auto px-4 relative z-20 text-center text-white">
        <span
            class="reveal-fade inline-block text-xs md:text-sm font-semibold mt-12 md:mt-0 mb-4 tracking-[0.2em] uppercase opacity-90 border-b border-primary pb-1">
            <?php echo esc_html( t('home.hero.agency_label') ); ?>
        </span>

        <h1 class="reveal-up text-4xl md:text-6xl lg:text-7xl font-serif font-bold mb-6 tracking-tight leading-[1.1]">
            <?php echo t('home.hero.title'); ?>
        </h1>

        <p class="reveal-up text-gray-200 text-sm md:text-lg mb-12 leading-relaxed opacity-90 max-w-2xl mx-auto">
            <?php echo esc_html( t('home.hero.description') ); ?>
        </p>

        <div class="reveal-up max-w-6xl mx-auto mb-12 md:mb-0">
            <!--
            <div class="flex justify-center -mb-[1px] space-x-1">
                <button type="button"
                    class="filter-tab active px-10 py-3.5 bg-primary text-white font-bold rounded-t-xl transition-all"
                    data-type="buy"><?php echo esc_html( t('home.hero.tabs.buy') ); ?></button>
                <button type="button"
                    class="filter-tab px-10 py-3.5 bg-white/90 text-slate-900 font-bold rounded-t-xl transition-all"
                    data-type="rent"><?php echo esc_html( t('home.hero.tabs.rent') ); ?></button>
            </div>
            -->

            <div
                class="bg-white/95 backdrop-blur-md rounded-2xl lg:rounded-b-2xl lg:rounded-tr-none shadow-2xl p-6 lg:p-8">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">

                    <div class="flex flex-col gap-2 text-left text-slate-900">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">
                            <?php echo esc_html( t('home.hero.form.search_label') ); ?>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                <i data-lucide="search"
                                    class="w-4 h-4 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                            </div>
                            <input type="text" name="s" placeholder="<?php echo esc_attr( t('home.hero.form.search_placeholder') ); ?>"
                                class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all placeholder:text-slate-400">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-left text-slate-900">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">
                            <?php echo esc_html( t('home.hero.form.location_label') ); ?>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                <i data-lucide="map-pin"
                                    class="w-4 h-4 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                            </div>
                            <select name="location"
                                class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none cursor-pointer appearance-none transition-all">
                                <option value=""><?php echo esc_html( t('home.hero.form.location_placeholder') ); ?></option>
                                <option value="dhaka"><?php echo esc_html( t('home.hero.form.location_options.dhaka') ); ?></option>
                                <option value="chittagong"><?php echo esc_html( t('home.hero.form.location_options.chittagong') ); ?></option>
                                <option value="mymensingh"><?php echo esc_html( t('home.hero.form.location_options.mymensingh') ); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-left text-slate-900">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">
                            <?php echo esc_html( t('home.hero.form.type_label') ); ?>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                <i data-lucide="home"
                                    class="w-4 h-4 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                            </div>
                            <select name="type"
                                class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none cursor-pointer appearance-none transition-all">
                                <option value="apartment"><?php echo esc_html( t('home.hero.form.property_types.apartment') ); ?></option>
                                <option value="luxury"><?php echo esc_html( t('home.hero.form.property_types.luxury') ); ?></option>
                                <option value="villa"><?php echo esc_html( t('home.hero.form.property_types.villa') ); ?></option>
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full h-[56px] bg-[#0a1d23] text-white rounded-xl font-bold hover:bg-primary hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/10">
                        <i data-lucide="search" class="w-5 h-5"></i>
                        <?php echo esc_html( t('home.hero.form.search_button') ); ?>
                    </button>

                    <input type="hidden" name="listing_type" id="listing-type-input" value="buy">
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();

            const video = document.getElementById('hero-video');
            if (video) {
                video.muted = true;
                video.play().catch(() => {
                    const playOnInteraction = () => {
                        video.play();
                        ['click', 'touchstart'].forEach(ev => window.removeEventListener(ev,
                            playOnInteraction));
                    };
                    ['click', 'touchstart'].forEach(ev => window.addEventListener(ev, playOnInteraction));
                });
            }

            const tabs = document.querySelectorAll('.filter-tab');
            const typeInput = document.getElementById('listing-type-input');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => {
                        t.classList.remove('bg-primary', 'text-white', 'active');
                        t.classList.add('bg-white/90', 'text-slate-900');
                    });

                    this.classList.add('bg-primary', 'text-white', 'active');
                    this.classList.remove('bg-white/90', 'text-slate-900');
                    typeInput.value = this.dataset.type;
                });
            });
        });
    </script>
</section>