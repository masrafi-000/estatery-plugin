/**
 * PageTransition Module
 * Pure CSS-based transitions — no Motion dependency, no async Promise bugs.
 */
export default class PageTransition {
    constructor() {
        this.loader = document.getElementById('page-loader');
        this.progress = document.getElementById('loader-progress');
        this._done = false; // Guard: ensure fadeOut only runs once

        if (!this.loader) return;

        this.initEntrance();
        this.bindLinks();
        this.bindCustomEvents();
    }

    /**
     * Listen for custom navigation triggers (e.g. language switcher)
     */
    bindCustomEvents() {
        window.addEventListener('page-exit', (e) => {
            const url = e.detail?.url;
            if (url) this.triggerExit(url);
        });
    }

    /**
     * Hide the loader when the page has finished loading
     */
    initEntrance() {
        const hide = () => {
            if (this._done) return;
            this._done = true;

            // Snap progress bar to full
            if (this.progress) this.progress.style.width = '100%';

            // CSS transition kicks in because we added opacity:0 via inline style
            // We give the progress bar 250ms to fill before fading out
            setTimeout(() => {
                this.loader.style.opacity = '0';
                this.loader.style.pointerEvents = 'none';

                // After transition ends, fully hide from layout
                setTimeout(() => {
                    this.loader.style.visibility = 'hidden';
                }, 600); // matches CSS transition duration (0.55s + buffer)
            }, 250);
        };

        // Run as soon as possible
        if (document.readyState === 'complete') {
            hide();
        } else {
            window.addEventListener('load', hide);
        }

        // Absolute hard fallback — never block the user longer than 2s
        setTimeout(hide, 2000);
    }

    /**
     * Intercept internal link clicks for smooth exit animation
     */
    bindLinks() {
        document.addEventListener('click', (e) => {
            const anchor = e.target.closest('a');
            if (!anchor) return;

            const href = anchor.getAttribute('href');
            const target = anchor.getAttribute('target');

            // Skip non-navigational links
            if (!href) return;
            if (href.startsWith('#') || href.startsWith('javascript:')) return;
            if (href.startsWith('mailto:') || href.startsWith('tel:')) return;
            if (target === '_blank') return;

            // Skip external links
            try {
                const parsed = new URL(href, window.location.origin);
                if (parsed.hostname !== window.location.hostname) return;
            } catch (_) {
                return;
            }

            // Same page? Skip transition.
            if (href === window.location.href || href === window.location.pathname) return;

            e.preventDefault();
            this.triggerExit(href);
        });

        // Restore state if navigating back/forward from cache
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) this._forceHide();
        });
    }

    /**
     * Show loader then navigate
     */
    triggerExit(url) {
        if (this.progress) this.progress.style.width = '0%';

        // Make loader visible and opaque
        this.loader.style.visibility = 'visible';
        this.loader.style.pointerEvents = 'auto';
        this.loader.style.opacity = '0'; // start transparent

        // Force a reflow so the browser registers the opacity:0 before animating to 1
        // eslint-disable-next-line no-unused-expressions
        this.loader.offsetHeight;

        // Fade in
        this.loader.style.opacity = '1';

        // Simulate progress bar filling during exit
        if (this.progress) {
            setTimeout(() => { this.progress.style.width = '60%'; }, 50);
            setTimeout(() => { this.progress.style.width = '90%'; }, 200);
        }

        // Navigate after the CSS fade-in completes (~550ms)
        setTimeout(() => {
            window.location.href = url;
        }, 580);
    }

    /**
     * Emergency: force-hide without animation
     */
    _forceHide() {
        this._done = true;
        this.loader.style.transition = 'none';
        this.loader.style.opacity = '0';
        this.loader.style.visibility = 'hidden';
        this.loader.style.pointerEvents = 'none';
    }
}
