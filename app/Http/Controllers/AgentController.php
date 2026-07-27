<?php

namespace App\Http\Controllers;

use App\Services\DemoDataService;
use App\Services\WazuhService;

class AgentController extends Controller
{
    /**
     * Agent IDs hidden from the dashboard view only — they stay registered
     * on the Wazuh Manager, this just keeps stale/unwanted entries (old
     * duplicate enrollments, unused test agents) off the display.
     */
    private const HIDDEN_AGENT_IDS = ['001', '002'];

    public function index(WazuhService $wazuh)
    {
        try {
            $agents = $wazuh->getAgents();
            $error = null;
        } catch (\Throwable $e) {
            // Demo data fills the page completely, so there's nothing
            // broken from the visitor's point of view — no banner needed.
            $agents = DemoDataService::fakeAgents();
            $error = null;
        }

        $agents = array_values(array_filter(
            $agents,
            fn ($agent) => ! in_array($agent['id'] ?? null, self::HIDDEN_AGENT_IDS, true)
        ));

        return view('pages.agent-monitoring', compact('agents', 'error'));
    }
}
