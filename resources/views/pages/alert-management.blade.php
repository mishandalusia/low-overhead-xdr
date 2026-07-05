@extends('layouts.app-dashboard')

@section('title', 'Alert Management')
@section('subtitle', 'Manage security alerts and response status')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">🚨</div>
        <h3>Total Alerts</h3>
        <h2>56</h2>
        <p class="trend danger">12 New Today</p>
    </div>

    <div class="card">
        <div class="card-icon">⚠️</div>
        <h3>Critical Alerts</h3>
        <h2>8</h2>
        <p class="trend danger">Needs Immediate Action</p>
    </div>

    <div class="card">
        <div class="card-icon">✅</div>
        <h3>Resolved Alerts</h3>
        <h2>41</h2>
        <p class="trend">73% Completed</p>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h2>Alert List</h2>
    </div>

    <table>

        <thead>
        <tr>
            <th>Alert ID</th>
            <th>Alert Name</th>
            <th>Severity</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        </thead>

        <tbody>

        <tr>
            <td>ALT-001</td>
            <td>SQL Injection Attempt</td>
            <td><span class="badge critical">Critical</span></td>
            <td><span class="badge critical">Open</span></td>
            <td>10:45 AM</td>
        </tr>

        <tr>
            <td>ALT-002</td>
            <td>Malware Detected</td>
            <td><span class="badge medium">High</span></td>
            <td><span class="badge medium">Investigating</span></td>
            <td>10:18 AM</td>
        </tr>

        <tr>
            <td>ALT-003</td>
            <td>Brute Force Login</td>
            <td><span class="badge medium">Medium</span></td>
            <td><span class="badge low">Monitoring</span></td>
            <td>09:53 AM</td>
        </tr>

        <tr>
            <td>ALT-004</td>
            <td>Port Scanning</td>
            <td><span class="badge low">Low</span></td>
            <td><span class="badge low">Resolved</span></td>
            <td>09:17 AM</td>
        </tr>

        <tr>
            <td>ALT-005</td>
            <td>Unauthorized Access</td>
            <td><span class="badge critical">Critical</span></td>
            <td><span class="badge medium">Investigating</span></td>
            <td>08:41 AM</td>
        </tr>

        <tr>
            <td>ALT-006</td>
            <td>Suspicious Process</td>
            <td><span class="badge medium">Medium</span></td>
            <td><span class="badge low">Resolved</span></td>
            <td>08:03 AM</td>
        </tr>

        </tbody>

    </table>

</div>

@endsection