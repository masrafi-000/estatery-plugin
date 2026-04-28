(function($) {
    'use strict';

    $(function() {
        /**
         * 1. Mobile Navigation Drawer
         */
        const $drawer = $('#mobile-drawer');
        const $content = $('#drawer-content');
        const $overlay = $('#drawer-overlay');
        const $toggle = $('#mobile-toggle');
        const $close = $('#drawer-close');

        function openDrawer() {
            $drawer.removeClass('invisible pointer-events-none').addClass('visible');
            $overlay.removeClass('opacity-0').addClass('opacity-100');
            $content.removeClass('-translate-x-full').addClass('translate-x-0');
            $('body').css('overflow', 'hidden');
        }

        function closeDrawer() {
            $overlay.removeClass('opacity-100').addClass('opacity-0');
            $content.removeClass('translate-x-0').addClass('-translate-x-full');
            setTimeout(() => {
                $drawer.removeClass('visible').addClass('invisible pointer-events-none');
                $('body').css('overflow', '');
            }, 500);
        }

        if ($toggle.length) $toggle.on('click', openDrawer);
        if ($close.length) $close.on('click', closeDrawer);
        if ($overlay.length) $overlay.on('click', closeDrawer);


        /**
         * 2. Language Switcher — jQuery CSS layer ONLY
         */
        const $langTrigger    = $('#lang-select-trigger');
        const $langMenu       = $('#lang-options-list');
        const $langChevron    = $('#lang-select-chevron');
        const $langOptionBtns = $('.lang-option-btn');

        function toggleLangMenu() {
            const isOpen = $langMenu.hasClass('active-menu');
            if (!isOpen) {
                $langMenu.removeClass('opacity-0 invisible translate-y-6 pointer-events-none')
                          .addClass('opacity-100 visible translate-y-0 pointer-events-auto active-menu');
                $langChevron.addClass('rotate-180');
                $langTrigger.attr('aria-expanded', 'true');
            } else {
                $langMenu.addClass('opacity-0 invisible translate-y-6 pointer-events-none')
                          .removeClass('opacity-100 visible translate-y-0 pointer-events-auto active-menu');
                $langChevron.removeClass('rotate-180');
                $langTrigger.attr('aria-expanded', 'false');
            }
        }

        if ($langTrigger.length && $langMenu.length) {
            $langTrigger.on('click', function(e) {
                e.stopPropagation();
                toggleLangMenu();
            });

            $langOptionBtns.on('click', function() {
                if ($langMenu.hasClass('active-menu')) toggleLangMenu();
            });

            $(document).on('click', function(e) {
                if (!$langMenu.is(e.target) && $langMenu.has(e.target).length === 0 &&
                    !$langTrigger.is(e.target) && $langTrigger.has(e.target).length === 0) {
                    if ($langMenu.hasClass('active-menu')) toggleLangMenu();
                }
            });
        }


        /**
         * 3. Hero Filter Tabs Logic
         */
        $('.filter-tab').on('click', function() {
            $('.filter-tab').removeClass('bg-primary text-white active').addClass('bg-white/90 text-slate-900');
            $(this).addClass('bg-primary text-white active').removeClass('bg-white/90 text-slate-900');
            $('#listing-type-input').val($(this).data('type'));
        });

        console.log('Theme Base Logic Initialized');
    });

})(jQuery);
