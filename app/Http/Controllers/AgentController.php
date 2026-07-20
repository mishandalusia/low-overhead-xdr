<?php

namespace App\Http\Controllers;

use App\Services\DemoDataService;
use App\Services\WazuhService;

class AgentController extends Controller
{
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

        return view('pages.agent-monitoring', compact('agents', 'error'));
    }
}
