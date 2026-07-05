@extends('layouts.app-dashboard')

@section('title', 'Incident Tracking')
@section('subtitle', 'Track security incidents and investigation progress')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">📂</div>
        <h3>Total Incidents</h3>
        <h2>18</h2>
        <p class="trend">3 New Today</p>
    </div>

    <div class="card">
        <div class="card-icon">🕒</div>
        <h3>In Progress</h3>
        <h2>7</h2>
        <p class="trend danger">Under Investigation</p>
    </div>

    <div class="card">
        <div class="card-icon">✅</div>
        <h3>Resolved</h3>
        <h2>11</h2>
        <p class="trend">61% Completed</p>
    </div>

</div>


<div class="table-card">

    <div class="table-header">
        <h2>Incident Management</h2>
    </div>

    <table>

        <thead>

        <tr>
            <th>Incident ID</th>
            <th>Incident</th>
            <th>Status Tracking</th>
            <th>Investigation Notes</th>
            <th>Assigned To</th>
        </tr>

        </thead>

        <tbody>

        <tr>
            <td>INC-001</td>
            <td>SQL Injection</td>
            <td><span class="badge critical">Open</span></td>
            <td>Database logs are under review.</td>
            <td>Security Team A</td>
        </tr>

        <tr>
            <td>INC-002</td>
            <td>Malware Infection</td>
            <td><span class="badge medium">Investigating</span></td>
            <td>Endpoint isolated for malware analysis.</td>
            <td>IR Team</td>
        </tr>

        <tr>
            <td>INC-003</td>
            <td>Brute Force Login</td>
            <td><span class="badge low">Monitoring</span></td>
            <td>Account locked and login attempts monitored.</td>
            <td>SOC Analyst</td>
        </tr>

        <tr>
            <td>INC-004</td>
            <td>Port Scan</td>
            <td><span class="badge low">Resolved</span></td>
            <td>Firewall rules updated successfully.</td>
            <td>Network Team</td>
        </tr>

        <tr>
            <td>INC-005</td>
            <td>Unauthorized Access</td>
            <td><span class="badge critical">Open</span></td>
            <td>User privileges temporarily suspended.</td>
            <td>Admin Team</td>
        </tr>

        <tr>
            <td>INC-006</td>
            <td>Data Exfiltration Attempt</td>
            <td><span class="badge medium">Investigating</span></td>
            <td>Traffic capture is being analyzed.</td>
            <td>Cyber Response</td>
        </tr>

        </tbody>

    </table>

</div>

@endsection