@extends('layouts.app-dashboard')

@section('title', 'Agent Monitoring')
@section('subtitle', 'Monitor all endpoint agents')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">🟢</div>
        <h3>Connected Agents</h3>
        <h2>132 / 142</h2>
        <p class="trend">93% Connected</p>
    </div>

    <div class="card">
        <div class="card-icon">🔴</div>
        <h3>Offline Agents</h3>
        <h2>10</h2>
        <p class="trend danger">Need Attention</p>
    </div>

    <div class="card">
        <div class="card-icon">💚</div>
        <h3>Average Health</h3>
        <h2>94%</h2>
        <p class="trend">Healthy</p>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h2>Connected Agent Status</h2>
    </div>

    <table>

        <thead>
        <tr>
            <th>Hostname</th>
            <th>IP Address</th>
            <th>Operating System</th>
            <th>Agent Status</th>
            <th>Agent Health</th>
            <th>Last Seen</th>
        </tr>
        </thead>

        <tbody>

        <tr>
            <td>DESKTOP-001</td>
            <td>192.168.1.20</td>
            <td>Windows 11</td>
            <td><span class="badge low">Online</span></td>
            <td><span class="badge low">98%</span></td>
            <td>Just Now</td>
        </tr>

        <tr>
            <td>SERVER-APP01</td>
            <td>192.168.1.50</td>
            <td>Ubuntu 24.04</td>
            <td><span class="badge medium">Busy</span></td>
            <td><span class="badge medium">74%</span></td>
            <td>1 Minute Ago</td>
        </tr>

        <tr>
            <td>CLIENT-008</td>
            <td>192.168.1.75</td>
            <td>Windows 10</td>
            <td><span class="badge critical">Offline</span></td>
            <td><span class="badge critical">21%</span></td>
            <td>15 Minutes Ago</td>
        </tr>

        <tr>
            <td>LAPTOP-SEC</td>
            <td>192.168.1.91</td>
            <td>Kali Linux</td>
            <td><span class="badge low">Online</span></td>
            <td><span class="badge low">96%</span></td>
            <td>30 Seconds Ago</td>
        </tr>

        <tr>
            <td>OFFICE-PC07</td>
            <td>192.168.1.34</td>
            <td>Windows 11</td>
            <td><span class="badge low">Online</span></td>
            <td><span class="badge low">99%</span></td>
            <td>5 Seconds Ago</td>
        </tr>

        <tr>
            <td>DB-SERVER02</td>
            <td>192.168.1.10</td>
            <td>Ubuntu Server</td>
            <td><span class="badge medium">Busy</span></td>
            <td><span class="badge medium">68%</span></td>
            <td>45 Seconds Ago</td>
        </tr>

        </tbody>

    </table>

</div>

@endsection