<?php $how_we_work = t('pages.about.how_we_work'); ?>
<section class="py-14 bg-[#fcfcfc] overflow-hidden js-how-we-work">
    <div class="container mx-auto px-6 lg:px-12">

        <div class="max-w-3xl mb-16 lg:mb-24 js-process-header js-reveal-fade">
            <div class="inline-flex items-center gap-2.5 px-4 py-2 border border-secondary/20 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                <span class="text-secondary font-bold uppercase tracking-[0.3em] text-[10px]"><?php echo esc_html($how_we_work['badge']); ?></span>
            </div>
            <h2 class="text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-secondary tracking-tight leading-[1.1] mb-8 js-reveal-text">
                <?php echo $how_we_work['title']; ?>
            </h2>
            <p class="text-secondary/70 text-lg md:text-xl font-medium leading-relaxed max-w-2xl">
                <?php echo esc_html($how_we_work['subtitle']); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative js-process-grid">

            <!-- Connector line (desktop only) -->
            <div class="js-process-line absolute top-1/4 left-0 w-0 h-[1px] bg-primary/10 z-0 hidden lg:block"></div>

            <?php foreach ($how_we_work['steps'] as $index => $step): ?>
                <div class="js-process-step relative z-10 group p-8 rounded-xl bg-white border border-primary/5 hover:border-primary/20 hover:shadow-xl hover:shadow-primary/5 transition-all duration-500">

                    <div class="step-icon w-16 h-16 bg-white border border-primary/10 flex items-center justify-center rounded-full mb-6 group-hover:border-primary transition-colors duration-500 shadow-sm relative overflow-hidden">
                        <span class="text-secondary font-bold text-xl relative z-10"><?php echo esc_html($step['id']); ?></span>
                        <div class="absolute inset-0 bg-primary translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        <span class="text-white font-bold text-xl absolute z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"><?php echo esc_html($step['id']); ?></span>
                    </div>

                    <h4 class="text-xl font-bold text-secondary mb-3"><?php echo esc_html($step['title']); ?></h4>
                    <p class="body-copy mb-0 text-gray-500 leading-relaxed">
                        <?php echo esc_html($step['description']); ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>