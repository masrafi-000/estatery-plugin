/**
 * LanguageSwitcher — React-like state + URL-based language routing
 *
 * ARCHITECTURE (mirrors Next.js i18n routing):
 *
 *   State:  this.state = { activeLang, isOpen }
 *   Render: all DOM changes flow through render() — no side mutations
 *
 *   On language select:
 *     1. setState({ activeLang }) → render() updates trigger label immediately
 *     2. window.location.assign(data-url)
 *        data-url = current_page?set_lang={slug}  (set by PHP language-switcher.php)
 *     3. PHP init hook (functions.php) intercepts ?set_lang, calls setcookie(),
 *        redirects to clean URL.  Cookie is in the HTTP redirect response headers
 *        so it's stored by the browser BEFORE the next page loads.
 *     4. Every page: Translator.php reads $_COOKIE['pll_language'] → correct locale.
 *
 *   No AJAX. No race conditions. No cookie domain issues. Works on localhost.
 */
export default class LanguageSwitcher {

    // ── Init ──────────────────────────────────────────────────────────────────

    constructor() {
        this.wrapper      = document.getElementById('language-routing-wrapper');
        this.trigger      = document.getElementById('lang-select-trigger');
        this.triggerLabel = document.querySelector('#lang-select-trigger .lang-label');
        this.menu         = document.getElementById('lang-options-list');
        this.optionBtns   = document.querySelectorAll('.lang-option-btn');

        if (!this.trigger || !this.menu) return;

        // ── State ─────────────────────────────────────────────────────────────
        this.state = {
            // 'estatery_lang' is our cookie — Polylang never touches this name
            activeLang: this.readCookie('estatery_lang') || document.documentElement.getAttribute('data-lang') || 'en',
            isOpen:     false,
        };

        this.render();    // Sync UI from state on load
        this.bindEvents();

        console.log(`[LanguageSwitcher] Ready — lang: ${this.state.activeLang}`);
    }

    // ── State Management ──────────────────────────────────────────────────────

    setState(patch) {
        this.state = { ...this.state, ...patch };
        this.render();
    }

    /**
     * render() — single source of DOM truth.
     * Only this method may mutate the language-related DOM.
     */
    render() {
        // 1. Update trigger label
        if (this.triggerLabel) {
            this.triggerLabel.textContent = this.state.activeLang.toUpperCase();
        }

        // 2. Sync each option button's active state
        this.optionBtns.forEach(btn => {
            const slug     = btn.getAttribute('data-slug');
            const isActive = slug === this.state.activeLang;
            btn.classList.toggle('active-lang',          isActive);
            btn.classList.toggle('text-primary',         isActive);
            btn.classList.toggle('bg-primary/5',         isActive);
            btn.classList.toggle('text-gray-500',        !isActive);
            btn.classList.toggle('hover:bg-gray-50',     !isActive);
            btn.classList.toggle('hover:text-foreground',!isActive);
        });
    }

    // ── Event Binding ─────────────────────────────────────────────────────────

    bindEvents() {
        // Toggle dropdown
        this.trigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.state.isOpen ? this.closeMenu() : this.openMenu();
        });

        // Language option click
        this.optionBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                const slug = btn.getAttribute('data-slug');
                const url  = btn.getAttribute('data-url');   // ?set_lang=slug on current page

                if (!slug || slug === this.state.activeLang) return;

                this.selectLanguage(slug, url);
            });
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (this.wrapper && !this.wrapper.contains(e.target)) {
                this.closeMenu();
            }
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeMenu();
        });
    }

    // ── Language Selection ────────────────────────────────────────────────────

    /**
     * selectLanguage — the i18n routing action.
     *
     * Optimistically updates UI state, then navigates to ?set_lang=slug.
     * PHP handles cookie + redirect (same pattern as Next.js locale routing).
     */
    selectLanguage(slug, url) {
        // Optimistic state update — trigger label changes instantly
        this.setState({ activeLang: slug });
        this.closeMenu();

        // Navigate — PHP init hook will:
        //   setcookie('pll_language', slug, ...)  → in HTTP response headers
        //   wp_redirect(clean_url)                → browser stores cookie, follows redirect
        window.location.assign(url || window.location.href);
    }

    // ── Dropdown Animations ───────────────────────────────────────────────────

    openMenu() {
        this.setState({ isOpen: true });
        this.menu.classList.add('active');
        this.trigger.setAttribute('aria-expanded', 'true');

        if (typeof gsap !== 'undefined') {
            gsap.to(this.menu, { autoAlpha: 1, y: 0, duration: 0.4, ease: 'back.out(1.2)' });
        } else {
            Object.assign(this.menu.style, { opacity: '1', visibility: 'visible', transform: 'translateY(0)' });
        }
    }

    closeMenu() {
        if (!this.state.isOpen && !this.menu.classList.contains('active')) return;

        this.setState({ isOpen: false });
        this.trigger.setAttribute('aria-expanded', 'false');

        if (typeof gsap !== 'undefined') {
            gsap.to(this.menu, {
                autoAlpha: 0, y: 15, duration: 0.3, ease: 'power2.in',
                onComplete: () => this.menu.classList.remove('active'),
            });
        } else {
            Object.assign(this.menu.style, { opacity: '0', visibility: 'hidden', transform: 'translateY(15px)' });
            this.menu.classList.remove('active');
        }
    }

    // ── Utilities ─────────────────────────────────────────────────────────────

    readCookie(name) {
        const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : null;
    }
}
