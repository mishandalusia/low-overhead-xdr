<?php

namespace App\Http\Controllers;

use App\Services\WazuhService;

class AgentController extends Controller
{
    public function index(WazuhService $wazuh)
    {
        try {
            $agents = $wazuh->getAgents();
            $error = null;
        } catch (\Throwable $e) {
            $agents = [];
            $error = $e->getMessage();
        }

        return view('agent-monitoring', compact('agents', 'error'));
    }
}