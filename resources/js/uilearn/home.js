import { $, $$, readJson, typeInto, escapeHtml } from './helpers.js';

/* Contoh interaksi AI di Dashboard: pertanyaan preset, jawaban dummy (tanpa API). */
export function initHomeDemo() {
    const root = $('#ai-demo');
    if (!root) return;
    const presets = readJson('ai-demo-data') || [];
    const log = $('#ai-demo-log', root);
    const chips = $$('[data-preset]', root);
    let busy = false;

    chips.forEach((chip) =>
        chip.addEventListener('click', async () => {
            const preset = presets.find((p) => p.id === chip.dataset.preset);
            if (!preset || busy) return;
            busy = true;
            chips.forEach((c) =>
                c.setAttribute('aria-pressed', String(c === chip)),
            );

            log.innerHTML = `
              <div class="flex justify-end"><p class="max-w-[85%] rounded-xl rounded-br-sm bg-[#363B6C] px-4 py-2.5 text-sm text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">${escapeHtml(preset.q)}</p></div>
              <div class="flex"><div id="ai-demo-answer" class="prose-chat glass-recessed max-w-[92%] px-4 py-3 text-sm leading-relaxed" aria-live="polite"><span class="muted">AI sedang mengetik…</span></div></div>`;
            await new Promise((r) => setTimeout(r, 350));
            await typeInto($('#ai-demo-answer', log), preset.a);
            busy = false;
        }),
    );

    // Tampilkan pertanyaan pertama agar demo tidak kosong
    chips[0]?.click();
}

const GC_CODE = `.daftar {
  display: grid;
  gap: 1.25rem;
  max-width: 420px;
  margin-inline: auto;
  padding: 1.75rem;
  background: #fff;
  border-radius: 1rem;
  box-shadow: 0 10px 30px -12px rgb(54 59 108 / .25);
}

.baris { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }

label { font: 600 .65rem/1 ui-monospace; letter-spacing: .08em; text-transform: uppercase; }

h2 { font-size: 1.5rem; font-weight: 700; }

input { border: 1px solid #C6C9E7; border-radius: .5rem; padding: .55rem .75rem; }

.tombol { background: #363B6C; color: #EAEDFE; border-radius: .5rem; padding: .55rem 1rem; }`;

const GC_PREVIEW_HTML = `
  <div class="w-full max-w-[420px] rounded-2xl bg-white p-7 shadow-[0_10px_30px_-12px_rgb(54_59_108/0.25)]">
    <p class="font-mono text-[0.65rem] font-semibold uppercase tracking-[0.08em] text-[#363B6C]/70">Daftar akun</p>
    <h2 class="mt-2 text-2xl font-bold tracking-tight text-[#363B6C]">Buat akun Anda</h2>
    <p class="mt-3 text-sm leading-relaxed text-[#363B6C]/70">Terapkan Golden Ratio dan keterbacaan teks ideal.</p>
    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
      <input type="text" placeholder="Nama" class="rounded-lg border border-[#C6C9E7] px-3 py-2.5 text-sm text-[#363B6C] placeholder:text-[#363B6C]/45 focus:border-[#363B6C] focus:outline-none">
      <input type="email" placeholder="Email" class="rounded-lg border border-[#C6C9E7] px-3 py-2.5 text-sm text-[#363B6C] placeholder:text-[#363B6C]/45 focus:border-[#363B6C] focus:outline-none">
    </div>
    <div class="mt-5 flex items-center gap-4">
      <button type="button" class="rounded-lg bg-[#363B6C] px-5 py-2.5 text-sm font-semibold text-[#EAEDFE]">Daftar</button>
      <button type="button" class="text-sm font-medium text-[#363B6C] underline underline-offset-4">Batal</button>
    </div>
  </div>`;
  
export function initGoldenCode() {
    const root = $('#gc');
    if (!root) return;
    const text = $('#gc-text');
    const caret = $('#gc-caret');
    const pre = $('#gc-code');
    const preview = $('#gc-preview');
    const grid = $('#gc-grid');
    const tabCode = $('#gc-tab-code');
    const tabPrev = $('#gc-tab-preview');
    const auto = $('#gc-auto');
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let run = 0;
    let timer = null;

    function show(which) {
        const isPrev = which === 'preview';
        pre.classList.toggle('hidden', isPrev);
        preview.classList.toggle('hidden', !isPrev);
        preview.classList.toggle('flex', isPrev);
        tabCode.setAttribute('aria-pressed', String(!isPrev));
        tabPrev.setAttribute('aria-pressed', String(isPrev));
        if (isPrev) {
            // mulai dari 1:1, lalu beranimasi ke 1,618 : 1 sesuai kode
            grid.style.gridTemplateColumns = '1fr 1fr';
            $('#gc-w1').textContent = '50%';
            $('#gc-w2').textContent = '50%';
            requestAnimationFrame(() =>
                requestAnimationFrame(() => {
                    grid.style.gridTemplateColumns = '1.618fr 1fr';
                    $('#gc-w1').textContent = '61,8%';
                    $('#gc-w2').textContent = '38,2%';
                }),
            );
        }
    }

    function type() {
        const id = ++run;
        clearTimeout(timer);
        show('code');
        text.textContent = '';
        caret.classList.remove('hidden');
        if (reduce) {
            text.textContent = GC_CODE;
            caret.classList.add('hidden');
            return;
        }
        let i = 0;
        const step = () => {
            if (id !== run) return; // dibatalkan (ulang / ganti tab)
            i += 1;
            text.textContent = GC_CODE.slice(0, i);
            pre.scrollTop = pre.scrollHeight;
            if (i < GC_CODE.length) {
                timer = setTimeout(step, GC_CODE[i - 1] === '\n' ? 140 : 26);
            } else {
                caret.classList.add('hidden');
                if (auto.checked) timer = setTimeout(() => id === run && show('preview'), 900);
            }
        };
        step();
    }

    tabCode.addEventListener('click', () => {
        run += 1; // hentikan ketikan yang berjalan, tampilkan kode lengkap
        clearTimeout(timer);
        text.textContent = GC_CODE;
        caret.classList.add('hidden');
        show('code');
    });
    tabPrev.addEventListener('click', () => {
        run += 1;
        clearTimeout(timer);
        text.textContent = GC_CODE;
        caret.classList.add('hidden');
        show('preview');
    });
    $('#gc-replay').addEventListener('click', type);
    $('#gc-copy').addEventListener('click', async (e) => {
        const btn = e.currentTarget;
        try {
            await navigator.clipboard.writeText(GC_CODE);
            btn.textContent = 'Tersalin ✓';
        } catch {
            btn.textContent = 'Gagal';
        }
        setTimeout(() => (btn.textContent = 'Salin'), 1600);
    });

    // Mulai mengetik saat kartu terlihat di layar
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                io.disconnect();
                type();
            }
        }, { threshold: 0.4 });
        io.observe(root);
    } else type();
}
