@extends('layouts.app-dashboard')

@section('title', 'Threat Detection')
@section('subtitle', 'Monitor detected threats and anomaly activities')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">🚨</div>
        <h3>Detected Threats</h3>
        <h2>38</h2>
        <p class="trend danger">+6 Today</p>
    </div>

    <div class="card">
        <div class="card-icon">📈</div>
        <h3>Average Anomaly Score</h3>
        <h2>82</h2>
        <p class="trend">Normal Range</p>
    </div>

    <div class="card">
        <div class="card-icon">⚠️</div>
        <h3>High Risk Threats</h3>
        <h2>7</h2>
        <p class="trend danger">Immediate Review</p>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h2>Threat List</h2>
    </div>

    <table>

        <thead>

        <tr>
            <th>Threat</th>
            <th>Anomaly Score</th>
            <th>Risk Classification</th>
            <th>Status</th>
        </tr>

        </thead>

        <tbody>

        <tr>
            <td>SQL Injection</td>
            <td>96</td>
            <td><span class="badge critical">Critical</span></td>
            <td><span class="badge critical">Active</span></td>
        </tr>

        <tr>
            <td>Malware Detected</td>
            <td>88</td>
            <td><span class="badge medium">High</span></td>
            <td><span class="badge medium">Investigating</span></td>
        </tr>

        <tr>
            <td>Brute Force Attack</td>
            <td>72</td>
            <td><span class="badge medium">Medium</span></td>
            <td><span class="badge low">Monitoring</span></td>
        </tr>

        <tr>
            <td>Port Scan</td>
            <td>41</td>
            <td><span class="badge low">Low</span></td>
            <td><span class="badge low">Resolved</span></td>
        </tr>

        <tr>
            <td>XSS Attempt</td>
            <td>61</td>
            <td><span class="badge medium">Medium</span></td>
            <td><span class="badge medium">Investigating</span></td>
        </tr>

        </tbody>

    </table>

</div>


<div class="table-card" style="margin-top:30px;">

    <div class="table-header">
        <h2>Detection History</h2>
    </div>

    <table>

        <thead>

        <tr>
            <th>Time</th>
            <th>Threat</th>
            <th>Endpoint</th>
            <th>Result</th>
        </tr>

        </thead>

        <tbody>

        <tr>
            <td>10:42 AM</td>
            <td>SQL Injection</td>
            <td>SERVER-APP01</td>
            <td><span class="badge critical">Blocked</span></td>
        </tr>

        <tr>
            <td>10:18 AM</td>
            <td>Malware</td>
            <td>CLIENT-008</td>
            <td><span class="badge medium">Quarantined</span></td>
        </tr>

        <tr>
            <td>09:55 AM</td>
            <td>Brute Force</td>
            <td>DESKTOP-001</td>
            <td><span class="badge medium">Investigating</span></td>
        </tr>

        <tr>
            <td>09:21 AM</td>
            <td>Port Scan</td>
            <td>SERVER-DB02</td>
            <td><span class="badge low">Resolved</span></td>
        </tr>

        <tr>
            <td>08:43 AM</td>
            <td>XSS Attack</td>
            <td>WEB-01</td>
            <td><span class="badge low">Blocked</span></td>
        </tr>

        </tbody>

    </table>

</div>

@endsection