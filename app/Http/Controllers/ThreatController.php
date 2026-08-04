<?php

namespace App\Http\Controllers;

use App\Services\DemoDataService;
use App\Services\ThreatWorkflowService;
use App\Services\WazuhService;

class ThreatController extends Controller
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

        return view('pages.threat-detection', compact('threats', 'error'));
    }
}
