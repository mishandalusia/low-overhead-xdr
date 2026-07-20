<canvas id="flickeringGrid" style="position: fixed; inset: 0; z-index: 0; pointer-events: none; opacity: 0.5;"></canvas>

<script>
    (function () {
        const canvas = document.getElementById('flickeringGrid');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        // Bigger cells + capped frame rate — this used to redraw ~4000+ dots
        // every single animation frame uncapped, which was a real source of
        // jank on pages with lots of other stuff going on.
        const cellSize = 34;
        const dotSize = 2.2;
        const targetFrameInterval = 1000 / 30;
        let cells = [];
        let lastFrameTime = 0;

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const cols = Math.ceil(canvas.width / cellSize);
            const rows = Math.ceil(canvas.height / cellSize);

            cells = [];
            for (let y = 0; y < rows; y++) {
                for (let x = 0; x < cols; x++) {
                    cells.push({
                        x: x * cellSize + cellSize / 2,
                        y: y * cellSize + cellSize / 2,
                        alpha: Math.random() * 0.35,
                        target: Math.random() * 0.35,
                    });
                }
            }
        }

        function draw(time) {
            requestAnimationFrame(draw);

            if (document.hidden) return;
            if (time - lastFrameTime < targetFrameInterval) return;
            lastFrameTime = time;

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(139, 92, 246, 1)';

            for (let i = 0; i < cells.length; i++) {
                const cell = cells[i];
                cell.alpha += (cell.target - cell.alpha) * 0.05;

                if (Math.abs(cell.target - cell.alpha) < 0.01 && Math.random() < 0.01) {
                    cell.target = Math.random() * 0.35;
                }

                ctx.globalAlpha = cell.alpha;
                ctx.beginPath();
                ctx.arc(cell.x, cell.y, dotSize, 0, Math.PI * 2);
                ctx.fill();
            }

            ctx.globalAlpha = 1;
        }

        window.addEventListener('resize', resize);
        resize();
        requestAnimationFrame(draw);
    })();
</script>
