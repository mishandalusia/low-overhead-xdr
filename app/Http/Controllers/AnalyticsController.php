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
