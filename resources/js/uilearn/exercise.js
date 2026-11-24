import { $, $$, readJson, escapeHtml } from './helpers.js';
import { createChat } from './chat.js';
import { createLimiter, fmtClock } from './limiter.js';

const LABEL = { mudah: 'Mudah', sedang: 'Sedang' };

export function initExercise() {
    const root = $('#exercise');
    if (!root) return;
    const data = readJson('exercise-data');
    if (!data) return;

    const intro = $('#ex-intro', root);
    const quiz = $('#ex-quiz', root);
    const result = $('#ex-result', root);
    const qs = data.questions;
    let index = 0;
    let score = 0;
    let answers = [];

    const els = {
        count: $('#ex-count', root),
        level: $('#ex-level', root),
        bar: $('#ex-bar', root),
        text: $('#ex-text', root),
        options: $('#ex-options', root),
        feedback: $('#ex-feedback', root),
        next: $('#ex-next', root),
    };

    /* ---------- Latihan ---------- */
    function show(el) {
        [intro, quiz, result].forEach((s) => s.classList.toggle('hidden', s !== el));
        el.querySelector('h1, h2, [tabindex="-1"]')?.focus?.();
        window.scrollTo({ top: root.offsetTop - 80, behavior: 'smooth' });
    }

    function render() {
        const q = qs[index];
        els.count.textContent = `Soal ${index + 1} dari ${qs.length}`;
        els.level.textContent = LABEL[q.level] || q.level;
        els.level.dataset.level = q.level;
        els.bar.style.width = `${(index / qs.length) * 100}%`;
        els.bar.parentElement.setAttribute('aria-valuenow', String(index));
        els.text.textContent = q.q;
        els.feedback.classList.add('hidden');
        els.next.classList.add('hidden');
        els.options.innerHTML = '';
        q.options.forEach((opt, i) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'option';
            b.dataset.i = String(i);
            b.innerHTML = `<span class="option-key" aria-hidden="true">${'ABCD'[i]}</span><span class="option-text">${escapeHtml(opt)}</span><span class="option-mark" aria-hidden="true"></span>`;
            b.addEventListener('click', () => choose(i));
            els.options.appendChild(b);
        });
        els.next.textContent = index === qs.length - 1 ? 'Lihat hasil' : 'Soal berikutnya';
        panelContext = contextFor(q);
    }

    function choose(i) {
        const q = qs[index];
        const ok = i === q.answer;
        if (ok) score++;
        answers.push({ q: q.q, ok, chosen: q.options[i], correct: q.options[q.answer], why: q.why });
        $$('.option', els.options).forEach((b, n) => {
            b.disabled = true;
            if (n === q.answer) {
                b.classList.add('is-correct');
                b.querySelector('.option-mark').textContent = '✓ Benar';
            } else if (n === i) {
                b.classList.add('is-wrong');
                b.querySelector('.option-mark').textContent = '✗ Kurang tepat';
            }
        });
        els.feedback.innerHTML = `<p class="font-semibold">${ok ? 'Tepat!' : 'Belum tepat.'}</p><p class="mt-1">${escapeHtml(q.why)}</p>`;
        els.feedback.classList.remove('hidden');
        els.next.classList.remove('hidden');
        els.next.focus();
    }

    function finish() {
        const pct = Math.round((score / qs.length) * 100);
        $('#ex-score', result).textContent = `${score} / ${qs.length}`;
        $('#ex-pct', result).textContent = `${pct}%`;
        $('#ex-msg', result).textContent =
            pct >= 80
                ? 'Hebat! Anda sudah menguasai dasar-dasar topik ini.'
                : pct >= 50
                  ? 'Bagus, tinggal sedikit lagi. Baca ulang bagian yang masih terasa kurang jelas, lalu coba lagi.'
                  : 'Tidak apa-apa. Baca ulang materinya, lalu coba lagi. Mengulang adalah cara belajar yang baik.';
        $('#ex-review', result).innerHTML = answers
            .map(
                (a, n) => `<li class="glass-recessed p-4">
                  <p class="text-sm font-semibold">${n + 1}. ${escapeHtml(a.q)}</p>
                  <p class="mt-1 text-sm">${a.ok ? '✓ Jawaban Anda benar' : '✗ Jawaban Anda: ' + escapeHtml(a.chosen)}</p>
                  ${a.ok ? '' : `<p class="text-sm">Jawaban tepat: ${escapeHtml(a.correct)}</p>`}
                  <p class="muted mt-1 text-sm">${escapeHtml(a.why)}</p></li>`,
            )
            .join('');
        els.bar.style.width = '100%';
        show(result);
    }

    function start() {
        index = 0;
        score = 0;
        answers = [];
        render();
        show(quiz);
    }

    $('#ex-start', root).addEventListener('click', start);
    $('#ex-retry', root).addEventListener('click', start);
    els.next.addEventListener('click', () => {
        if (index < qs.length - 1) {
            index++;
            render();
        } else {
            finish();
        }
    });

    /* ---------- Panel AI (slide panel, hanya untuk Pro) ---------- */
    const panel = $('#ai-panel');
    const openBtn = $('#ai-open');
    let panelContext = '';

    function contextFor(q) {
        // Opsi disertakan, jawaban benar TIDAK dikirim ke AI.
        return `Topik: ${data.title}. Soal: ${q.q} Pilihan: ${q.options.map((o, i) => 'ABCD'[i] + '. ' + o).join(' | ')}`;
    }

    if (panel && openBtn) {
        const closeBtn = $('#ai-close', panel);
        const setOpen = (open) => {
            panel.classList.toggle('translate-x-full', !open);
            panel.setAttribute('aria-hidden', String(!open));
            panel.inert = !open;
            openBtn.setAttribute('aria-expanded', String(open));
            if (open) $('#ai-input')?.focus();
        };
        setOpen(false);
        openBtn.addEventListener('click', () => setOpen(true));
        closeBtn.addEventListener('click', () => {
            setOpen(false);
            openBtn.focus();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && openBtn.getAttribute('aria-expanded') === 'true') setOpen(false);
        });

        if (data.canAsk) {
            const logEl = $('#ai-log');
            const inputEl = $('#ai-input');
            const sendEl = $('#ai-send');
            const chipEls = $$('#ai-chips [data-q]');

            /* Free: dibatasi + jeda 30 menit. Pro: tanpa batas. */
            let chat = null;
            let limiter = null;

            if (!data.isPro) {
                const dots = $('#ai-dots');
                const lockBox = $('#ai-lock');
                const countdown = $('#ai-countdown');
                const readyAt = $('#ai-ready-at');
                const lockBar = $('#ai-lock-bar');
                const status = $('#ai-status');
                const badge = $('#ai-open-badge');
                const side = $('#ai-side-status');

                const paint = (snap, ev) => {
                    const clock = fmtClock(snap.msLeft);
                    status.textContent = snap.locked
                        ? `Free · dijeda, aktif lagi pukul ${snap.readyAt}`
                        : `Free · sisa ${snap.remaining} dari ${snap.max} pesan`;
                    if (badge) badge.textContent = snap.locked ? clock : `${snap.remaining}/${snap.max}`;
                    if (side)
                        side.textContent = snap.locked
                            ? `Dijeda ${clock} · bisa dipakai lagi pukul ${snap.readyAt}`
                            : `Sisa ${snap.remaining} dari ${snap.max} pesan`;
                    if (dots)
                        dots.innerHTML = Array.from({ length: snap.max }, (_, i) =>
                            `<span class="h-2 w-2 rounded-full ${i < snap.remaining ? 'bg-[#363B6C] dark:bg-[#C6C9E7]' : 'bg-[#363B6C]/15 dark:bg-[#EAEDFE]/20'}"></span>`,
                        ).join('');
                    lockBox.classList.toggle('hidden', !snap.locked);
                    if (snap.locked) {
                        countdown.textContent = clock;
                        readyAt.textContent = snap.readyAt;
                        const done = 1 - snap.msLeft / snap.totalMs;
                        lockBar.style.width = `${Math.min(100, Math.max(0, done * 100))}%`;
                    }
                    inputEl.disabled = snap.locked;
                    sendEl.disabled = snap.locked;
                    chipEls.forEach((c) => (c.disabled = snap.locked));
                    inputEl.placeholder = snap.locked
                        ? `Dijeda. Bisa bertanya lagi pukul ${snap.readyAt}`
                        : 'Tanyakan soal ini…';
                    if (ev.justUnlocked && chat) {
                        chat.bubble(
                            'assistant',
                            '<p><strong>Jeda selesai.</strong> Kuota pesan Anda sudah terisi penuh lagi. Silakan bertanya.</p>',
                        );
                        inputEl.focus();
                    }
                };

                limiter = createLimiter({
                    max: data.limit.max,
                    cooldownMin: data.limit.cooldownMin,
                    userId: data.userId,
                    onChange: paint,
                });
            }

            chat = createChat({
                log: logEl,
                form: $('#ai-form'),
                input: inputEl,
                send: sendEl,
                chips: chipEls,
                status: data.isPro ? $('#ai-status') : null,
                source: 'exercise',
                limiter,
                getContext: () => panelContext,
                greeting: data.isPro
                    ? 'Bingung dengan soal ini? Tanyakan konsepnya. Saya akan memberi **petunjuk**, bukan langsung jawabannya.'
                    : `Bingung dengan soal ini? Tanyakan konsepnya. Saya akan memberi **petunjuk**, bukan langsung jawabannya.\n\nPaket Free: **${data.limit.max} pesan**, lalu AI dijeda **${data.limit.cooldownMin} menit**.`,
            });
            chat.greet();
            limiter?.start();
        }
    }
}
