<div class="auto-refresh-indicator" id="autoRefreshIndicator" title="Click to pause or resume auto-refresh">
    <span class="auto-refresh-dot"></span>
    <span id="autoRefreshText">Refreshing in 10s</span>
</div>

<style>
    .auto-refresh-indicator {
        position: fixed;
        right: 22px;
        bottom: 22px;
        z-index: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(139, 92, 246, 0.18);
        box-shadow: 0 10px 26px rgba(88, 28, 135, 0.14);
        font-size: 11px;
        font-weight: 750;
        color: var(--text-body);
        backdrop-filter: blur(8px);
        cursor: pointer;
        user-select: none;
        transition: box-shadow 0.15s ease, transform 0.15s ease;
    }

    .auto-refresh-indicator:hover {
        box-shadow: 0 12px 30px rgba(88, 28, 135, 0.20);
        transform: translateY(-1px);
    }

    .auto-refresh-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        flex-shrink: 0;
        animation: autoRefreshPulse 1.4s ease-in-out infinite;
    }

    .auto-refresh-dot.is-paused {
        background: #cbd5e1;
        animation: none;
    }

    @keyframes autoRefreshPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.45; transform: scale(0.8); }
    }

    @media (max-width: 900px) {
        .auto-refresh-indicator {
            display: none;
        }
    }
</style>

<script>
    // Auto-refresh — reloads the page every 10s so live Wazuh data (agents,
    // alerts, anomaly test results) shows up without a manual refresh.
    // Skips a tick (instead of reloading) while the alert-detail modal is
    // open or the user is actively typing in a text field, so a demo
    // in-progress isn't interrupted mid-interaction. Click the indicator to
    // turn it off entirely — the choice is remembered (localStorage) across
    // every page until turned back on.
    (function () {
        var INTERVAL_SECONDS = 10;
        var STORAGE_KEY = 'lox_autorefresh_off';
        var remaining = INTERVAL_SECONDS;
        var reloadTriggered = false;
        var manuallyOff = localStorage.getItem(STORAGE_KEY) === '1';
        var indicatorEl = document.getElementById('autoRefreshIndicator');
        var textEl = document.getElementById('autoRefreshText');
        var dotEl = document.querySelector('.auto-refresh-dot');

        function isBlocked() {
            if (document.querySelector('.alert-detail-modal.show')) {
                return true;
            }

            var active = document.activeElement;
            if (active && (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA')) {
                var type = (active.type || '').toLowerCase();
                if (type !== 'checkbox' && type !== 'radio' && type !== 'button' && type !== 'submit') {
                    return true;
                }
            }

            return false;
        }

        function render() {
            if (manuallyOff) {
                if (textEl) textEl.textContent = 'Auto-refresh off';
                if (dotEl) dotEl.classList.add('is-paused');
                return;
            }

            if (isBlocked()) {
                if (textEl) textEl.textContent = 'Paused';
                if (dotEl) dotEl.classList.add('is-paused');
                return;
            }

            if (dotEl) dotEl.classList.remove('is-paused');
            if (textEl) textEl.textContent = 'Refreshing in ' + remaining + 's';
        }

        function tick() {
            if (reloadTriggered || manuallyOff || isBlocked()) {
                render();
                return;
            }

            remaining -= 1;

            if (remaining <= 0) {
                reloadTriggered = true;
                if (textEl) textEl.textContent = 'Refreshing...';
                location.reload();
                return;
            }

            render();
        }

        if (indicatorEl) {
            indicatorEl.addEventListener('click', function () {
                manuallyOff = !manuallyOff;
                localStorage.setItem(STORAGE_KEY, manuallyOff ? '1' : '0');
                remaining = INTERVAL_SECONDS;
                render();
            });
        }

        render();
        setInterval(tick, 1000);
    })();
</script>
