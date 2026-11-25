import { $, $$ } from './helpers.js';

export function initLayout() {
    /* Tema gelap/cerah (tersimpan) */
    const root = document.documentElement;
    const themeBtn = $('#theme-toggle');
    function applyTheme(dark, persist) {
        root.classList.toggle('dark', dark);
        if (themeBtn)
            themeBtn.setAttribute(
                'aria-label',
                dark ? 'Ganti ke mode cerah' : 'Ganti ke mode gelap',
            );
        const meta = $('meta[name="theme-color"]');
        if (meta) meta.setAttribute('content', dark ? '#363B6C' : '#EAEDFE');
        if (persist) {
            try {
                localStorage.setItem('uilearn-theme', dark ? 'dark' : 'light');
            } catch {}
        }
        if (window.CyberCanvas) window.CyberCanvas.refreshTheme();
    }
    applyTheme(root.classList.contains('dark'), false);
    if (themeBtn)
        themeBtn.addEventListener('click', () =>
            applyTheme(!root.classList.contains('dark'), true),
        );

    /* Menu mobile */
    const menuBtn = $('#menu-toggle');
    const menu = $('#mobile-menu');
    if (menuBtn && menu) {
        menuBtn.addEventListener('click', () => {
            const open = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', String(!open));
            menu.classList.toggle('hidden', open);
        });
    }

    /* Grid panduan (Rule of Thirds & Golden Ratio): pilihan tersimpan, jadi tetap
       aktif saat berpindah halaman. Status awal sudah dipulihkan di <head> agar tanpa kedip. */
    const GRID_SEL = '#grid-toggle, [data-grid-toggle]';
    const gridOn = () => root.getAttribute('data-grid') === 'on';

    // Pastikan overlay ada (mis. jika markup layout belum memuatnya)
    function ensureOverlay() {
        let el = document.getElementById('composition-grid-overlay');
        if (!el) {
            el = document.createElement('div');
            el.id = 'composition-grid-overlay';
            el.className = 'grid-overlay pointer-events-none fixed inset-0 z-50';
            el.setAttribute('aria-hidden', 'true');
            el.innerHTML =
                '<div class="mx-auto h-full max-w-6xl px-4 sm:px-6 grid-line-x"><div class="grid h-full grid-cols-3 grid-line-x">' +
                '<div class="relative grid-line-r"><div class="grid-dot absolute left-0 top-[33.33%] h-3 w-3 -translate-x-1/2 -translate-y-1/2 rounded-full"></div></div>' +
                '<div class="relative grid-line-r"></div><div class="relative"></div></div></div>';
            document.body.appendChild(el);
        }
        return el;
    }
    const overlay = ensureOverlay();

    function paintGrid() {
        const on = gridOn();
        overlay.classList.toggle('hidden', !on); // kompatibel dengan markup lama
        $$(GRID_SEL).forEach((b) => b.setAttribute('aria-pressed', String(on)));
    }
    paintGrid();

    // Delegasi klik: tetap bekerja untuk tombol mana pun (desktop & menu mobile)
    document.addEventListener('click', (e) => {
        if (!e.target.closest(GRID_SEL)) return;
        const next = !gridOn();
        if (next) root.setAttribute('data-grid', 'on');
        else root.removeAttribute('data-grid');
        try {
            localStorage.setItem('uilearn-grid', next ? 'on' : 'off');
        } catch {}
        paintGrid();
    });
    // sinkron antar tab / jendela
    window.addEventListener('storage', (e) => {
        if (e.key !== 'uilearn-grid') return;
        if (e.newValue === 'on') root.setAttribute('data-grid', 'on');
        else root.removeAttribute('data-grid');
        paintGrid();
    });

    /* Dialog konfirmasi (Sign out, hapus akun, dst.): <button data-dialog="id"> membuka <dialog id="id"> */
    $$('[data-dialog]').forEach((btn) =>
        btn.addEventListener('click', () => {
            const dlg = document.getElementById(btn.dataset.dialog);
            if (dlg && typeof dlg.showModal === 'function') dlg.showModal();
        }),
    );
    $$('dialog [data-close]').forEach((btn) =>
        btn.addEventListener('click', () => btn.closest('dialog').close()),
    );
    $$('dialog.confirm-dialog').forEach((dlg) =>
        dlg.addEventListener('click', (e) => {
            if (e.target === dlg) dlg.close(); // klik latar menutup
        }),
    );
    // Dialog yang berisi error validasi dibuka ulang otomatis
    $$('dialog[data-open-on-load]').forEach((dlg) => dlg.showModal());

    /* Riak pada tombol utama */
    $$('[data-ripple]').forEach((el) =>
        el.addEventListener('click', () => {
            const r = el.getBoundingClientRect();
            if (window.CyberCanvas)
                window.CyberCanvas.ripple(
                    r.left + r.width / 2,
                    r.top + r.height / 2,
                );
        }),
    );
}
