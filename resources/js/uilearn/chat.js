import { $, $$, renderMarkdown, typeInto, escapeHtml, readJson } from './helpers.js';

const csrf = () =>
    document.querySelector('meta[name="csrf-token"]')?.content ?? '';

/**
 * Antarmuka chat yang dipakai di halaman AI Chat dan di panel saat latihan.
 * opts: { log, form, input, send, chips?, clearBtn?, status?, source, getContext? }
 */
export function createChat(opts) {
    const { log, form, input, send, source } = opts;
    let busy = false;

    const scroll = () => {
        log.scrollTop = log.scrollHeight;
    };

    function bubble(role, html) {
        const wrap = document.createElement('div');
        wrap.className = `msg-in flex ${role === 'user' ? 'justify-end' : ''}`;
        const b = document.createElement('div');
        b.className =
            role === 'user'
                ? 'max-w-[85%] rounded-xl rounded-br-sm bg-[#363B6C] px-4 py-2.5 text-sm text-[#EAEDFE] dark:bg-[#A8A3E3] dark:text-[#363B6C]'
                : 'prose-chat glass-recessed max-w-[92%] px-4 py-3 text-sm leading-relaxed';
        b.innerHTML = html;
        wrap.appendChild(b);
        log.appendChild(wrap);
        scroll();
        return b;
    }

    function setRemaining(n) {
        if (!opts.status) return;
        opts.status.textContent =
            n === null || n === undefined
                ? 'Pro · tanpa batas pesan'
                : `Free · sisa ${n} pesan hari ini`;
    }

    function notice(text, url) {
        const el = bubble(
            'assistant',
            `<p>${escapeHtml(text)}</p>` +
                (url
                    ? `<p><a class="font-medium underline underline-offset-2" href="${escapeHtml(url)}">Lihat paket Pro</a></p>`
                    : ''),
        );
        return el;
    }

    async function submit(text) {
        text = text.trim();
        if (!text || busy) return;
        busy = true;
        send.disabled = true;
        bubble('user', `<p>${escapeHtml(text)}</p>`);
        input.value = '';
        input.style.height = 'auto';
        const pending = bubble('assistant', '<span class="muted">AI sedang mengetik…</span>');
        pending.setAttribute('aria-busy', 'true');

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': csrf(),
                },
                body: JSON.stringify({
                    message: text,
                    source,
                    context: opts.getContext ? opts.getContext() : null,
                }),
            });
            const data = await res.json().catch(() => ({}));
            if (!res.ok) {
                pending.parentElement.remove();
                notice(
                    data.error ||
                        (res.status === 429
                            ? 'Terlalu banyak permintaan. Coba lagi sebentar.'
                            : 'Terjadi kesalahan. Coba lagi.'),
                    data.upgrade,
                );
                if ('remaining' in data) setRemaining(data.remaining);
            } else {
                pending.removeAttribute('aria-busy');
                await typeInto(pending, data.message.content, { onTick: scroll });
                setRemaining(data.remaining);
            }
        } catch {
            pending.parentElement.remove();
            notice('Koneksi bermasalah. Periksa internet Anda lalu coba lagi.');
        } finally {
            busy = false;
            send.disabled = false;
            input.focus();
        }
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        submit(input.value);
    });
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            submit(input.value);
        }
    });
    input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 160) + 'px';
    });
    opts.chips?.forEach((c) =>
        c.addEventListener('click', () => submit(c.dataset.q || c.textContent)),
    );

    if (opts.clearBtn) {
        opts.clearBtn.addEventListener('click', async () => {
            if (!confirm('Hapus seluruh riwayat chat?')) return;
            const res = await fetch(opts.clearBtn.dataset.url, {
                method: 'DELETE',
                headers: { Accept: 'application/json', 'X-CSRF-TOKEN': csrf() },
            });
            if (res.ok) {
                log.innerHTML = '';
                greet();
            }
        });
    }

    function greet() {
        if (opts.greeting) bubble('assistant', renderMarkdown(opts.greeting));
    }

    return {
        bubble,
        greet,
        submit,
        setRemaining,
        load(messages) {
            messages.forEach((m) =>
                bubble(m.role, m.role === 'user' ? `<p>${escapeHtml(m.content)}</p>` : renderMarkdown(m.content)),
            );
        },
    };
}

export function initChatPage() {
    const log = $('#chat-log');
    if (!log || !$('#chat-form')) return;

    const chat = createChat({
        log,
        form: $('#chat-form'),
        input: $('#chat-input'),
        send: $('#chat-send'),
        chips: $$('#chat-chips [data-q]'),
        clearBtn: $('#chat-clear'),
        status: $('#chat-status'),
        source: 'page',
        greeting:
            'Halo! Saya asisten UI/UX UIlearn. Tanyakan apa saja soal **tata letak**, **warna**, atau **typography**.',
    });

    const history = readJson('chat-history') || [];
    if (history.length) chat.load(history);
    else chat.greet();
    log.scrollTop = log.scrollHeight;
}
