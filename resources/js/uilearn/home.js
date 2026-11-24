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
