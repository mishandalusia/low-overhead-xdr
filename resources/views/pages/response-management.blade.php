@extends('layouts.app-dashboard')

@section('title','Response Management')
@section('subtitle','Manage incident responses and blocked endpoints')

@section('content')

<div class="cards">

    <div class="card">
        <div class="card-icon">🚫</div>
        <h3>Blocked IPs</h3>
        <h2>18</h2>
        <p class="trend danger">2 Added Today</p>
    </div>

    <div class="card">
        <div class="card-icon">⚡</div>
        <h3>Response Actions</h3>
        <h2>47</h2>
        <p class="trend">Executed Successfully</p>
    </div>

    <div class="card">
        <div class="card-icon">🛡️</div>
        <h3>Blocked Hosts</h3>
        <h2>9</h2>
        <p class="trend">Protected</p>
    </div>

</div>

<div class="table-card">

<div class="table-header">
<h2>Blocked IP Management</h2>
</div>

<table>

<thead>

<tr>
<th>IP Address</th>
<th>Country</th>
<th>Reason</th>
<th>Response History</th>
<th>Unblock Action</th>
</tr>

</thead>

<tbody>

<tr>
<td>192.168.1.10</td>
<td>Indonesia</td>
<td>SQL Injection</td>
<td>Blocked 5 Jul 2026</td>
<td><span class="badge low">Available</span></td>
</tr>

<tr>
<td>103.24.88.91</td>
<td>Russia</td>
<td>Brute Force</td>
<td>Blocked 4 Jul 2026</td>
<td><span class="badge medium">Pending</span></td>
</tr>

<tr>
<td>172.16.5.41</td>
<td>China</td>
<td>Malware Traffic</td>
<td>Blocked 4 Jul 2026</td>
<td><span class="badge low">Available</span></td>
</tr>

<tr>
<td>10.10.1.50</td>
<td>USA</td>
<td>Port Scan</td>
<td>Blocked 3 Jul 2026</td>
<td><span class="badge critical">Restricted</span></td>
</tr>

<tr>
<td>185.42.61.91</td>
<td>Germany</td>
<td>XSS Attack</td>
<td>Blocked 2 Jul 2026</td>
<td><span class="badge low">Available</span></td>
</tr>

</tbody>

</table>

</div>

@endsection