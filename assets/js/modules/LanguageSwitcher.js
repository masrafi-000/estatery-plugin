/**
 * LanguageSwitcher — React-like state + URL-based language routing
 * Refactored to use Motion library
 */
import { animate } from 'https://cdn.jsdelivr.net/npm/motion@11.11.17/+esm';

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
            activeLang: this.readCookie('estatery_lang') || document.documentElement.getAttribute('data-lang') || 'en',
            isOpen:     false,
        };

        this.render();    
        this.bindEvents();

        console.log(`[LanguageSwitcher] Ready — lang: ${this.state.activeLang}`);
    }

    setState(patch) {
        this.state = { ...this.state, ...patch };
        this.render();
    }

    render() {
        if (this.triggerLabel) {
            this.triggerLabel.textContent = this.state.activeLang.toUpperCase();
        }

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

    bindEvents() {
        this.trigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.state.isOpen ? this.closeMenu() : this.openMenu();
        });

        this.optionBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const slug = btn.getAttribute('data-slug');
                const url  = btn.getAttribute('data-url');
                if (!slug || slug === this.state.activeLang) return;
                this.selectLanguage(slug, url);
            });
        });

        document.addEventListener('click', (e) => {
            if (this.wrapper && !this.wrapper.contains(e.target)) {
                this.closeMenu();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeMenu();
        });
    }

    selectLanguage(slug, url) {
        this.setState({ activeLang: slug });
        this.closeMenu();
        
        // Trigger page transition
        window.dispatchEvent(new CustomEvent('page-exit', { 
            detail: { url: url || window.location.href } 
        }));
    }

    // ── Dropdown Animations ───────────────────────────────────────────────────

    openMenu() {
        this.setState({ isOpen: true });
        this.menu.classList.add('active');
        this.trigger.setAttribute('aria-expanded', 'true');

        animate(
            this.menu,
            { opacity: [0, 1], y: [15, 0], visibility: "visible" },
            { duration: 0.4, easing: [0.34, 1.56, 0.64, 1] }
        );
    }

    closeMenu() {
        if (!this.state.isOpen && !this.menu.classList.contains('active')) return;

        this.setState({ isOpen: false });
        this.trigger.setAttribute('aria-expanded', 'false');

        animate(
            this.menu,
            { opacity: [1, 0], y: [0, 15] },
            { duration: 0.3, easing: "ease-in" }
        ).finished.then(() => {
            this.menu.classList.remove('active');
            this.menu.style.visibility = "hidden";
        });
    }

    readCookie(name) {
        const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : null;
    }
}
