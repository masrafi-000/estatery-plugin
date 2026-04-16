/**
 * LanguageHandler — Boot-time language state utility
 *
 * Reads the active language from the pll_language cookie (which PHP sets
 * via the ?set_lang redirect flow) and exposes it as a data-lang attribute
 * on <html> so any JS module can read the current locale without fetching.
 */
export default class LanguageHandler {
    constructor() {
        // Read OUR cookie — 'estatery_lang', not 'pll_language' (Polylang's)
        this.activeLang = this.readCookie('estatery_lang') || 'en';
        document.documentElement.setAttribute('data-lang', this.activeLang);
        console.log(`[LangHandler] Active: ${this.activeLang}`);
    }

    readCookie(name) {
        const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : null;
    }
}
