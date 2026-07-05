@section('title', 'Analytics')
@section('subtitle', 'Analyze security trends and system performance')@extends('layouts.app-dashboard')

@section('title','Analytics & Reports')
@section('subtitle','Security analytics and response statistics')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">📈</div>
        <h3>Attack Trends</h3>
        <h2>148</h2>
        <p class="trend">+12% This Week</p>
    </div>

    <div class="card">
        <div class="card-icon">🔥</div>
        <h3>Critical Severity</h3>
        <h2>14%</h2>
        <p class="trend danger">Highest Risk</p>
    </div>

    <div class="card">
        <div class="card-icon">📊</div>
        <h3>Response Rate</h3>
        <h2>96%</h2>
        <p class="trend">Excellent</p>
    </div>

</div>

<div class="table-card">

<div class="table-header">
<h2>Attack Trends</h2>
</div>

<table>

<thead>

<tr>
<th>Attack Type</th>
<th>Detected</th>
<th>Severity Distribution</th>
<th>Response Statistics</th>
</tr>

</thead>

<tbody>

<tr>
<td>SQL Injection</td>
<td>52</td>
<td><span class="badge critical">Critical</span></td>
<td>Resolved 48</td>
</tr>

<tr>
<td>Brute Force</td>
<td>39</td>
<td><span class="badge medium">High</span></td>
<td>Resolved 36</td>
</tr>

<tr>
<td>Malware</td>
<td>28</td>
<td><span class="badge medium">Medium</span></td>
<td>Resolved 26</td>
</tr>

<tr>
<td>Port Scan</td>
<td>17</td>
<td><span class="badge low">Low</span></td>
<td>Resolved 17</td>
</tr>

<tr>
<td>XSS</td>
<td>12</td>
<td><span class="badge low">Low</span></td>
<td>Resolved 12</td>
</tr>

</tbody>

</table>

</div>

@endsection