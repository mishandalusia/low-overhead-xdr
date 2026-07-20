<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Services\DemoDataService;
use App\Services\ThreatWorkflowService;
use App\Services\WazuhService;

class DashboardController extends Controller
{
    public function __construct(
        private WazuhService $wazuh,
        private ThreatWorkflowService $workflow,
    ) {}

    public function index()
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

        $activeAlerts = collect($threats)->where('incident_status', '!=', 'resolved')->count();
        $activeBlocks = $this->workflow->blockedIpStatuses()->where('status', 'Blocked')->count();
        $resolvedIncidents = Incident::where('status', 'resolved')->count();

        // Split by which of the two detection engines produced each alert —
        // makes it visible at a glance that both Suricata (network) and the
        // Python behaviour-detection service (ML) are actually contributing.
        $behaviourAlerts = collect($threats)->where('detection_source', 'Python Behaviour Detection')->count();
        $networkAlerts = count($threats) - $behaviourAlerts;

        $severity = $this->workflow->severityDistribution($threats);
        $topThreats = $this->workflow->topThreatTypes($threats);
        $sortedThreats = collect($threats)->sortByDesc('time')->values();

        return view('dashboard', [
            'totalThreats' => count($threats),
            'activeAlerts' => $activeAlerts,
            'activeBlocks' => $activeBlocks,
            'resolvedIncidents' => $resolvedIncidents,
            'behaviourAlerts' => $behaviourAlerts,
            'networkAlerts' => $networkAlerts,
            'severity' => $severity,
            'topThreats' => $topThreats,
            'recentAlerts' => $sortedThreats->take(5)->values(),
            'threatHistory' => $sortedThreats->take(50)->values(),
            'error' => $error,
        ]);
    }
}
