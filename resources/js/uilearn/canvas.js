(function () {
    const canvas = document.getElementById('ascii');
    const ctx = canvas.getContext('2d');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    const WAVE_SPEED = 520;
    const WAVE_LIFE = 2.8;
    const BAND = 64;
    const MAGNET_RADIUS = 140;

    let width = 0;
    let height = 0;
    let gap = 22;
    let points = [];
    let isDark = true;
    let running = false;
    const waves = [];
    const pointer = { x: -9999, y: -9999, active: false };

    /* Kondisi diam: hanya garis "-----". Simbol ">" dan "o" baru muncul
       sesaat ketika gelombang (klik / kursor) melewati titik. */
    function restingGlyph() {
        return '-';
    }

    function build() {
        points = [];
        const cols = Math.ceil(width / gap) + 1;
        const rows = Math.ceil(height / gap) + 1;
        const offsetX = (width - (cols - 1) * gap) / 2;
        const offsetY = (height - (rows - 1) * gap) / 2;
        for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
                points.push({
                    x: offsetX + c * gap,
                    y: offsetY + r * gap,
                    g: restingGlyph(),
                    dx: 0,
                    dy: 0,
                    e: 0,
                });
            }
        }
    }

    function resize() {
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        width = window.innerWidth;
        height = window.innerHeight;
        gap = width < 640 ? 18 : 22;
        canvas.width = Math.floor(width * dpr);
        canvas.height = Math.floor(height * dpr);
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        build();
        if (!running) draw(performance.now());
    }

    function draw(now) {
        ctx.clearRect(0, 0, width, height);
        ctx.font = `${Math.round(gap * 0.62)}px "Geist Mono", ui-monospace, monospace`;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        for (let i = waves.length - 1; i >= 0; i--) {
            if ((now - waves[i].t) / 1000 > WAVE_LIFE) waves.splice(i, 1);
        }

        const base = isDark ? '#C6C9E7' : '#363B6C';
        const baseAlpha = isDark ? 0.3 : 0.26;
        const animate = !reduceMotion.matches;

        for (const p of points) {
            let ox = 0;
            let oy = 0;
            let energy = 0;

            if (animate) {
                for (const w of waves) {
                    const age = (now - w.t) / 1000;
                    const radius = age * WAVE_SPEED;
                    const vx = p.x - w.x;
                    const vy = p.y - w.y;
                    const dist = Math.hypot(vx, vy) || 1;
                    const band = dist - radius;
                    if (Math.abs(band) < BAND * 1.6) {
                        const falloff = Math.exp(
                            -(band * band) / (2 * 26 * 26),
                        );
                        const decay = Math.max(0, 1 - age / WAVE_LIFE);
                        const amp = Math.cos(band / 20) * falloff * decay * 12;
                        ox += (vx / dist) * amp;
                        oy += (vy / dist) * amp;
                        energy += falloff * decay;
                    }
                }

                if (pointer.active) {
                    const vx = p.x - pointer.x;
                    const vy = p.y - pointer.y;
                    const dist = Math.hypot(vx, vy) || 1;
                    if (dist < MAGNET_RADIUS) {
                        const f = Math.pow(1 - dist / MAGNET_RADIUS, 2);
                        ox += (vx / dist) * f * 10;
                        oy += (vy / dist) * f * 10;
                        energy += f * 0.6;
                    }
                }
            }

            p.dx += (ox - p.dx) * 0.25;
            p.dy += (oy - p.dy) * 0.25;
            p.e += (energy - p.e) * 0.2;

            const e = Math.min(1, p.e);
            const glyph = e > 0.55 ? '>' : e > 0.22 ? 'o' : p.g;
            const hot = e > 0.5;
            ctx.fillStyle = hot ? (isDark ? '#EAEDFE' : '#363B6C') : base;
            ctx.globalAlpha = hot ? 0.45 + 0.5 * e : baseAlpha + e * 0.4;

            const x = p.x + p.dx;
            const y = p.y + p.dy;
            if (glyph === '>' && e > 0.3) {
                ctx.save();
                ctx.translate(x, y);
                ctx.rotate(Math.atan2(p.dy, p.dx));
                ctx.fillText(glyph, 0, 0);
                ctx.restore();
            } else {
                ctx.fillText(glyph, x, y);
            }
        }
        ctx.globalAlpha = 1;
    }

    function loop(now) {
        if (!running) return;
        draw(now);
        requestAnimationFrame(loop);
    }

    function start() {
        if (running || reduceMotion.matches || document.hidden) return;
        running = true;
        requestAnimationFrame(loop);
    }

    function stop() {
        running = false;
    }

    function ripple(x, y) {
        if (reduceMotion.matches) return;
        waves.push({ x, y, t: performance.now() });
        if (waves.length > 6) waves.shift();
    }

    function refreshTheme() {
        isDark = document.documentElement.classList.contains('dark');
        if (!running) draw(performance.now());
    }

    window.addEventListener('resize', resize);
    window.addEventListener('pointermove', (e) => {
        if (e.pointerType !== 'mouse') return;
        pointer.x = e.clientX;
        pointer.y = e.clientY;
        pointer.active = true;
    });
    document.documentElement.addEventListener('pointerleave', () => {
        pointer.active = false;
    });
    window.addEventListener('pointerdown', (e) => ripple(e.clientX, e.clientY));
    document.addEventListener('visibilitychange', () =>
        document.hidden ? stop() : start(),
    );
    reduceMotion.addEventListener('change', () => {
        if (reduceMotion.matches) {
            stop();
            points.forEach((p) => {
                p.dx = 0;
                p.dy = 0;
                p.e = 0;
            });
            draw(performance.now());
        } else {
            start();
        }
    });

    refreshTheme();
    resize();
    start();
    setTimeout(() => ripple(width / 2, height * 0.42), 400);

    window.UIlearnCanvas = window.CyberCanvas = { ripple, refreshTheme };
})();
