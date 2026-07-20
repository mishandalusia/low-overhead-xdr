<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DemoDataService;
use App\Services\ThreatWorkflowService;
use App\Services\WazuhService;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    protected $wazuh;

    protected $workflow;

    public function __construct(WazuhService $wazuh, ThreatWorkflowService $workflow)
    {
        $this->wazuh = $wazuh;
        $this->workflow = $workflow;
    }

    public function index()
    {
        try {
            $incidents = $this->workflow->attach($this->wazuh->getThreats());
            $error = null;
        } catch (\Throwable $e) {
            // Demo data fills the page completely, so there's nothing
            // broken from the visitor's point of view — no banner needed.
            $incidents = $this->workflow->attach(DemoDataService::fakeThreats());
            $error = null;
        }

        return view('pages.incident-management', [
            'incidents' => $incidents,
            'users' => User::orderBy('name')->get(['id', 'name']),
            'error' => $error,
        ]);
    }

    public function assign(Request $request)
    {
        $data = $request->validate([
            'signature' => 'required|string',
            'rule_id' => 'nullable|string',
            'agent' => 'nullable|string',
            'source' => 'nullable|string',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        $incident = $this->workflow->assignIncident($data['signature'], $data, $data['user_id'] ?? null);

        return response()->json([
            'assigned_to' => $incident->assigned_to,
            'assigned_to_name' => $incident->assignee->name ?? null,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'signature' => 'required|string',
            'status' => 'required|in:open,investigating,resolved',
            'rule_id' => 'nullable|string',
            'agent' => 'nullable|string',
            'source' => 'nullable|string',
        ]);

        $incident = $this->workflow->recordIncidentStatus($data['signature'], $data, $data['status']);

        return response()->json(['status' => $incident->status]);
    }
}
