export const $ = (sel, root = document) => root.querySelector(sel);
export const $$ = (sel, root = document) =>
    Array.from(root.querySelectorAll(sel));

export const escapeHtml = (s) =>
    s
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');

export const wait = (ms) => new Promise((r) => setTimeout(r, ms));
export const prefersReducedMotion = () =>
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

export function readJson(id) {
    const el = document.getElementById(id);
    if (!el) return null;
    try {
        return JSON.parse(el.textContent);
    } catch {
        return null;
    }
}

/* Markdown ringan: paragraf, daftar (- / 1.), **tebal**, `kode`. Teks di-escape dulu. */
function inline(s) {
    return escapeHtml(s)
        .replace(/`([^`]+)`/g, '<code>$1</code>')
        .replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
}

export function renderMarkdown(text) {
    return text
        .split(/\n{2,}/)
        .map((chunk) => chunk.trim())
        .filter(Boolean)
        .map((chunk) => {
            const lines = chunk.split('\n');
            const items = lines.filter((l) => /^\s*([-*]|\d+\.)\s+/.test(l));
            if (items.length && items.length === lines.length) {
                const tag = /^\s*\d+\./.test(lines[0]) ? 'ol' : 'ul';
                return `<${tag}>${lines.map((l) => `<li>${inline(l.replace(/^\s*([-*]|\d+\.)\s+/, ''))}</li>`).join('')}</${tag}>`;
            }
            return `<p>${lines.map(inline).join('<br>')}</p>`;
        })
        .join('');
}

/* Mengetik per kata untuk efek balasan AI (langsung penuh jika reduced-motion). */
export async function typeInto(el, text, { delay = 28, onTick } = {}) {
    if (prefersReducedMotion()) {
        el.innerHTML = renderMarkdown(text);
        onTick?.();
        return;
    }
    const words = text.split(/(\s+)/);
    let shown = '';
    for (let i = 0; i < words.length; i += 2) {
        shown += words.slice(i, i + 2).join('');
        el.innerHTML = renderMarkdown(shown);
        onTick?.();
        await wait(delay);
    }
    el.innerHTML = renderMarkdown(text);
    onTick?.();
}
