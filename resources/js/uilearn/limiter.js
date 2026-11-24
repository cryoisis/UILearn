/**
 * Pembatas pesan AI untuk halaman latihan (paket Free).
 *
 * Aturan: Free boleh mengirim `max` pesan. Setelah kuota habis, AI terkunci
 * selama `cooldownMin` menit (default 30) dan otomatis terbuka lagi.
 * Status tersimpan di localStorage agar tetap berlaku setelah refresh.
 * Pro tidak dibatasi (limiter tidak dibuat).
 *
 * Catatan: penyimpanan di browser hanya untuk tampilan. Penegakan sebenarnya
 * harus tetap dilakukan server (balas 429 + retry_after, lihat chat.js).
 */
const KEY = 'uilearn-exercise-ai-limit';

const pad = (n) => String(n).padStart(2, '0');
export const fmtClock = (ms) => {
    const t = Math.max(0, Math.ceil(ms / 1000));
    return `${pad(Math.floor(t / 60))}:${pad(t % 60)}`;
};
const fmtTime = (ts) =>
    new Date(ts).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

export function createLimiter({ max = 5, cooldownMin = 30, userId = 'guest', onChange }) {
    const storageKey = `${KEY}:${userId}`;
    const cooldownMs = cooldownMin * 60 * 1000;
    let state = { used: 0, lockUntil: 0 };
    let timer = null;

    try {
        const raw = JSON.parse(localStorage.getItem(storageKey) || 'null');
        if (raw && typeof raw.used === 'number') state = raw;
    } catch {}

    const save = () => {
        try {
            localStorage.setItem(storageKey, JSON.stringify(state));
        } catch {}
    };

    const locked = () => state.lockUntil > Date.now();

    function snapshot() {
        const now = Date.now();
        const isLocked = state.lockUntil > now;
        return {
            max,
            cooldownMin,
            remaining: isLocked ? 0 : Math.max(0, max - state.used),
            locked: isLocked,
            msLeft: isLocked ? state.lockUntil - now : 0,
            lockUntil: state.lockUntil,
            totalMs: cooldownMs,
            readyAt: isLocked ? fmtTime(state.lockUntil) : null,
        };
    }

    function tick() {
        if (state.lockUntil && state.lockUntil <= Date.now()) {
            // jeda selesai -> kuota penuh lagi
            state = { used: 0, lockUntil: 0 };
            save();
            clearInterval(timer);
            timer = null;
            onChange?.(snapshot(), { justUnlocked: true });
            return;
        }
        onChange?.(snapshot(), {});
    }

    function ensureTimer() {
        if (locked() && !timer) timer = setInterval(tick, 1000);
    }

    function lockFor(ms = cooldownMs) {
        state.lockUntil = Date.now() + ms;
        state.used = max;
        save();
        ensureTimer();
        onChange?.(snapshot(), {});
    }

    return {
        canSend: () => !locked() && state.used < max,
        /** Dipanggil setelah satu pesan berhasil terkirim. */
        consume() {
            state.used += 1;
            if (state.used >= max) lockFor();
            else {
                save();
                onChange?.(snapshot(), {});
            }
        },
        /** Dipanggil bila server menjawab 429 / sisa 0. */
        lockFor,
        /** Selaraskan dengan angka "remaining" dari server bila ada. */
        sync(remaining) {
            if (typeof remaining !== 'number') return;
            state.used = Math.max(0, max - remaining);
            if (remaining <= 0) return lockFor();
            save();
            onChange?.(snapshot(), {});
        },
        snapshot,
        start() {
            if (state.lockUntil && !locked()) {
                state = { used: 0, lockUntil: 0 };
                save();
            }
            ensureTimer();
            onChange?.(snapshot(), {});
        },
    };
}
