@extends('layouts.app-dashboard')

@section('title', 'Dashboard')
@section('subtitle', 'Overview of your security environment')

@section('content')
    <section class="cards">
        <div class="card">
            <div class="card-top">
                <div class="card-icon">▥</div>
                <span>⋮</span>
            </div>
            <h3>Total Events</h3>
            <h2>12,540</h2>
            <p class="trend">↑ 18.6% Since last month</p>
        </div>

        <div class="card">
            <div class="card-top">
                <div class="card-icon">🔔</div>
                <span>⋮</span>
            </div>
            <h3>Active Alerts</h3>
            <h2>24</h2>
            <p class="trend danger">↑ 14.2% Since last week</p>
        </div>

        <div class="card">
            <div class="card-top">
                <div class="card-icon">⛨</div>
                <span>⋮</span>
            </div>
            <h3>Blocked IPs</h3>
            <h2>8</h2>
            <p class="trend">↓ 11.1% Since last week</p>
        </div>

        <div class="card">
            <div class="card-top">
                <div class="card-icon">▤</div>
                <span>⋮</span>
            </div>
            <h3>Open Incidents</h3>
            <h2>3</h2>
            <p class="trend">↓ 25% Since yesterday</p>
        </div>
    </section>

    <section class="dashboard-grid">
        <div class="panel">
            <div class="panel-header">
                <h3>Threat Severity <span style="color:#64748b; font-size:14px;">Last 7 Days</span></h3>
                <select class="filter">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>This month</option>
                </select>
            </div>

            <div class="placeholder-chart">
                Threat Severity Graphic Placeholder
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3>Top Threat Types</h3>
                <select class="filter">
                    <option>This Week</option>
                    <option>This Month</option>
                </select>
            </div>

            <div class="threat-list">
                <div class="threat-item"><span><i class="dot purple"></i>SQL Injection</span><strong>320</strong></div>
                <div class="threat-item"><span><i class="dot pink"></i>Brute Force</span><strong>280</strong></div>
                <div class="threat-item"><span><i class="dot orange"></i>Port Scan</span><strong>210</strong></div>
                <div class="threat-item"><span><i class="dot yellow"></i>Malware</span><strong>190</strong></div>
                <div class="threat-item"><span><i class="dot green"></i>XSS</span><strong>140</strong></div>
                <div class="threat-item"><span><i class="dot gray"></i>Others</span><strong>114</strong></div>
            </div>
        </div>
    </section>

    <section class="table-card">
        <div class="table-header">
            <h3>Recent Alerts</h3>
            <button class="filter">View all</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Severity</th>
                    <th>Alert Name</th>
                    <th>Source IP</th>
                    <th>Target</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><span class="badge critical">Critical</span></td>
                    <td>Brute Force Login Attempt</td>
                    <td>192.168.1.20</td>
                    <td>Web Server</td>
                    <td>2 minutes ago</td>
                    <td><span class="badge open">Open</span></td>
                    <td>⋯</td>
                </tr>

                <tr>
                    <td><span class="badge high">High</span></td>
                    <td>SQL Injection Detected</td>
                    <td>192.168.1.15</td>
                    <td>Database</td>
                    <td>10 minutes ago</td>
                    <td><span class="badge open">Open</span></td>
                    <td>⋯</td>
                </tr>

                <tr>
                    <td><span class="badge medium">Medium</span></td>
                    <td>Port Scan Detected</td>
                    <td>192.168.1.30</td>
                    <td>Firewall</td>
                    <td>30 minutes ago</td>
                    <td><span class="badge progress">In Progress</span></td>
                    <td>⋯</td>
                </tr>

                <tr>
                    <td><span class="badge low">Low</span></td>
                    <td>Malware Detected</td>
                    <td>192.168.1.45</td>
                    <td>Endpoint</td>
                    <td>1 hour ago</td>
                    <td><span class="badge closed">Closed</span></td>
                    <td>⋯</td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection