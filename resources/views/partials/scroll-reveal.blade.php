<script>
    // reveal-on-scroll — fade-in + slide-up for cards as they enter the
    // viewport, instead of the old page-load keyframe (which had already
    // finished playing on a wall-clock timer by the time you scrolled to
    // a below-the-fold card, so it just looked static).
    function initReveal() {
        // Auto-tag all cards, panels, and stat elements across all pages
        document.querySelectorAll('.bento-card, .dashboard-stat-card, .tdx-summary-card, .agp-summary-card, .brp-summary-card, .inc-summary-card, .rpt-summary-card').forEach(function (el) {
            el.classList.add('reveal-on-scroll');
        });

        document.querySelectorAll('.tdx-panel, .agp-panel, .brp-panel, .inc-panel, .rpt-mode-panel, .panel, .card').forEach(function (el) {
            if (!el.classList.contains('reveal-on-scroll')) {
                el.classList.add('reveal-panel');
            }
        });

        document.querySelectorAll('.page-heading, .tdx-heading, .agp-heading, .brp-heading, .inc-heading, .rpt-hero').forEach(function (el) {
            el.classList.add('reveal-heading');
        });

        document.querySelectorAll('.table tbody tr, .agp-agent-row, .brp-ip-row, .rpt-activity-row, .tdx-alert-card').forEach(function (el, idx) {
            el.classList.add('animated-list-item');
            el.style.setProperty('--i', idx % 10);
        });

        var targets = document.querySelectorAll('.reveal-on-scroll, .reveal-panel, .reveal-heading, .animated-list-item');
        if (!targets.length) return;

        // Calculate staggered entrance delay per parent container
        var parentCounters = new WeakMap();
        targets.forEach(function (el) {
            if (el.classList.contains('animated-list-item')) return;
            var parent = el.parentElement;
            var count = parentCounters.get(parent) || 0;
            el.style.setProperty('--reveal-delay', (0.08 + Math.min(count * 0.08, 0.40)) + 's');
            parentCounters.set(parent, count + 1);
        });

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    requestAnimationFrame(function () {
                        entry.target.classList.add('in-view');
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05, rootMargin: '50px' });

        targets.forEach(function (el) {
            observer.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReveal);
    } else {
        initReveal();
    }

    // Bottom scroll-fade — signals "there's more below", hidden once the
    // page is already scrolled to its end (or the content fits without
    // scrolling at all).
    (function () {
        var fade = document.createElement('div');
        fade.className = 'scroll-fade-bottom';
        document.body.appendChild(fade);

        function sync() {
            var doc = document.documentElement;
            var scrollable = doc.scrollHeight > window.innerHeight + 4;
            var atBottom = window.scrollY + window.innerHeight >= doc.scrollHeight - 4;
            fade.classList.toggle('is-visible', scrollable && !atBottom);
        }

        window.addEventListener('scroll', sync, { passive: true });
        window.addEventListener('resize', sync);
        window.addEventListener('load', sync);
        document.addEventListener('DOMContentLoaded', sync);
    })();
</script>
