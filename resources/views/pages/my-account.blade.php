@php
    use Illuminate\Support\Facades\Auth;

    $activeUser = Auth::user();

    $roleLabel = match ($activeUser->email) {
        'lead@lox.com' => 'Group Leader',
        'webadmin@lox.com' => 'Web Administrator',
        'analyst@lox.com' => 'Security Analyst',
        default => 'Administrator',
    };
@endphp

@extends('layouts.app-dashboard')

@section('title', 'My Account')
@section('subtitle', 'View and manage your account information')

@section('content')
<div class="profile-page-grid">
    <div class="profile-info-card">
        <div class="profile-large-avatar"></div>

        <h2>{{ $roleLabel }}</h2>
        <p>{{ $activeUser->email }}</p>

        <span class="role-badge">{{ $roleLabel }}</span>
    </div>

    <div class="profile-detail-card">
        <h3>Account Information</h3>

        <div class="profile-row">
            <span>Full Name</span>
            <strong>{{ $roleLabel }}</strong>
        </div>

        <div class="profile-row">
            <span>Email Address</span>
            <strong>{{ $activeUser->email }}</strong>
        </div>

        <div class="profile-row">
            <span>Role</span>
            <strong>{{ $roleLabel }}</strong>
        </div>

        <div class="profile-row">
            <span>Status</span>
            <strong class="status-active">Active</strong>
        </div>

        <button class="primary-action-btn">Edit Profile</button>
    </div>
</div>
@endsection