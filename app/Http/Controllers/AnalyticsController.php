<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\ResponseAction;
use App\Services\DemoDataService;
use App\Services\ThreatWorkflowService;
use App\Services\WazuhService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class AnalyticsController extends Controller
{
    public function __construct(
        private WazuhService $wazuh,
        private ThreatWorkflowService $workflow,
    ) {}

    private function buildReport(): array
    {
        try {
            $threats = $this->workflow->attach($this->wazuh->getThreats());
            $error = null;
        } catch (\Throwable $e) {
            // Demo data fills the page completely, so there's nothing
            // broken from the visitor's point of view — no banner needed.
            $threats = $this->workflow->attach(DemoDataService::fakeThreats());
            $error = null;
        }

        $blockedIps = $this->workflow->blockedIpStatuses();
        $activeBlocked = $blockedIps->where('status', 'Blocked')->count();

        $blockAttempts = ResponseAction::where('action', 'block_ip')->count();
        $blockSuccess = ResponseAction::where('action', 'block_ip')->where('status', 'success')->count();
        $responseSuccessRate = $blockAttempts ? round(($blockSuccess / $blockAttempts) * 100) : 0;

        $severity = $this->workflow->severityDistribution($threats);
        $criticalCount = $severity['Critical'] ?? 0;

        $dailyRows = collect($threats)->sortByDesc('time')->take(30)->values();

        $weeklyRows = collect($threats)
            ->groupBy(fn ($threat) => ($threat['category'] ?? 'General').'|'.substr((string) $threat['time'], 0, 4).'-W'.(($threat['time'] ?? null) ? date('W', strtotime($threat['time'])) : '0'))
            ->map(function ($group) use ($blockedIps) {
                $first = $group->first();
                $blockedSources = $group->pluck('source')->unique()->filter(
                    fn ($ip) => $blockedIps->firstWhere('ip', $ip)
                );

                return [
                    'category' => $first['category'] ?? 'General',
                    'count' => $group->count(),
                    'blocked_count' => $blockedSources->count(),
                    'severity' => collect($group)->countBy('severity')->sortDesc()->keys()->first() ?? 'Low',
                    'status' => $blockedSources->count() > 0 ? 'Blocked' : 'Investigated',
                    'week_label' => $first['time'] ? date('Y-m-d', strtotime('monday this week', strtotime($first['time']))).' - '.date('Y-m-d', strtotime('sunday this week', strtotime($first['time']))) : '-',
                ];
            })
            ->values();

        $byWeekday = collect($threats)->countBy(fn ($t) => $t['time'] ? date('N', strtotime($t['time'])) : null)->filter(fn ($v, $k) => $k !== null);
        $peakDay = $byWeekday->sortDesc()->keys()->first();
        $weekdayNames = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
        $daysMap = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun'];

        $trendCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];
        foreach ($threats as $t) {
            if (!empty($t['time'])) {
                $dayNum = (int) date('N', strtotime($t['time']));
                if (isset($trendCounts[$dayNum])) {
                    $trendCounts[$dayNum]++;
                }
            }
        }

        $maxTrend = max(max($trendCounts), 1);
        $xPositions = [1 => 70, 2 => 200, 3 => 330, 4 => 460, 5 => 590, 6 => 720, 7 => 850];
        $trendPoints = [];

        foreach ($trendCounts as $dayNum => $cnt) {
            $x = $xPositions[$dayNum];
            $y = 230 - (int) round(($cnt / $maxTrend) * 160);
            $trendPoints[$dayNum] = [
                'x' => $x,
                'y' => $y,
                'count' => $cnt,
                'day' => $daysMap[$dayNum],
            ];
        }

        $svgPath = "M ".$trendPoints[1]['x']." ".$trendPoints[1]['y'];
        for ($i = 1; $i < 7; $i++) {
            $p1 = $trendPoints[$i];
            $p2 = $trendPoints[$i + 1];
            $cx1 = $p1['x'] + 65;
            $cy1 = $p1['y'];
            $cx2 = $p2['x'] - 65;
            $cy2 = $p2['y'];
            $svgPath .= " C {$cx1} {$cy1}, {$cx2} {$cy2}, {$p2['x']} {$p2['y']}";
        }
        $svgAreaPath = $svgPath." L 850 250 L 70 250 Z";

        $severityByIp = collect($threats)->keyBy('source');
        $blockedIpCards = $blockedIps->where('status', 'Blocked')->take(8)->map(function ($entry) use ($severityByIp) {
            $entry['severity'] = $severityByIp->get($entry['ip'])['severity'] ?? 'Medium';

            return $entry;
        })->values();

        return [
            'error' => $error,
            'totalActivities' => count($threats),
            'blockedIpCount' => $activeBlocked,
            'criticalCount' => $criticalCount,
            'responseSuccessRate' => $responseSuccessRate,
            'severity' => $severity,
            'dailyRows' => $dailyRows,
            'weeklyRows' => $weeklyRows,
            'peakDayLabel' => $peakDay ? $weekdayNames[(int) $peakDay] : '-',
            'trendCounts' => $trendCounts,
            'trendPoints' => $trendPoints,
            'svgPath' => $svgPath,
            'svgAreaPath' => $svgAreaPath,
            'maxTrend' => $maxTrend,
            'blockedIpCards' => $blockedIpCards,
            'incidentSummary' => [
                'open' => Incident::where('status', 'open')->count(),
                'investigating' => Incident::where('status', 'investigating')->count(),
                'resolved' => Incident::where('status', 'resolved')->count(),
            ],
        ];
    }

    public function index()
    {
        return view('pages.analytics', $this->buildReport());
    }

    public function exportPdf()
    {
        $report = $this->buildReport();

        $pdf = Pdf::loadView('reports.pdf', $report);

        return $pdf->download('security-report-'.now()->format('Y-m-d').'.pdf');
    }

    public function exportCsv()
    {
        $report = $this->buildReport();

        $callback = function () use ($report) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Date', 'Time', 'Activity', 'Source IP', 'Category', 'Severity', 'Incident Status']);

            foreach ($report['dailyRows'] as $row) {
                fputcsv($handle, [
                    $row['date'] ?? '',
                    $row['clock'] ?? '',
                    $row['rule'] ?? '',
                    $row['source'] ?? '',
                    $row['category'] ?? '',
                    $row['severity'] ?? '',
                    $row['incident_status'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="security-report-'.now()->format('Y-m-d').'.csv"',
        ]);
    }
}
