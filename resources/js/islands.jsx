import { createRoot } from 'react-dom/client';
import StatCards from './components/StatCards';
import SeverityChart from './components/SeverityChart';

function readJson(id) {
    const el = document.getElementById(id);
    return el ? JSON.parse(el.textContent) : null;
}

const statCardsRoot = document.getElementById('stat-cards-root');
if (statCardsRoot) {
    createRoot(statCardsRoot).render(<StatCards summary={readJson('dashboard-summary-data')} />);
}

const severityChartRoot = document.getElementById('severity-chart-root');
if (severityChartRoot) {
    createRoot(severityChartRoot).render(
        <SeverityChart
            severity={readJson('dashboard-severity-data')}
            topThreats={readJson('dashboard-top-threats-data')}
        />
    );
}
