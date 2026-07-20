<script>
    // reveal-on-scroll — fade-in + slide-up for cards as they enter the
    // viewport, instead of the old page-load keyframe (which had already
    // finished playing on a wall-clock timer by the time you scrolled to
    // a below-the-fold card, so it just looked static).
    (function () {
        // Auto-tag every existing card so .reveal-on-scroll stays a
        // reusable, addable primitive (works on any future element too)
        // while still covering every card on every page for free.
        document.querySelectorAll('.bento-card').forEach(function (el) {
            el.classList.add('reveal-on-scroll');
        });

        var items = document.querySelectorAll('.reveal-on-scroll');
        if (!items.length) return;

        // Stagger by position among siblings within the same parent, so a
        // row of cards flows in one after another instead of popping in
        // all at once — capped so a long list doesn't pile up a huge delay.
        // Cards already inside the viewport on page load (the stat cards,
        // Top Threat Types, Threat Severity Distribution — anything above
        // the fold) get IntersectionObserver's first callback almost
        // immediately, i.e. during page load itself. A 0.15s base delay
        // gives the page a beat to settle first so that reveal is a
        // visible moment instead of blending into the initial paint;
        // below-the-fold cards (Recent Alerts, Alert History, etc.) keep
        // the same base since their trigger is the scroll itself, not load.
        var parentCounters = new WeakMap();
        items.forEach(function (el) {
            var parent = el.parentElement;
            var count = parentCounters.get(parent) || 0;
            el.style.setProperty('--reveal-delay', (0.15 + Math.min(count * 0.07, 0.35)) + 's');
            parentCounters.set(parent, count + 1);
        });

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    // Fires once — scrolling a card back out and in again
                    // (common when working the dashboard day to day)
                    // should not replay the animation.
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        items.forEach(function (el) {
            observer.observe(el);
        });
    })();

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
