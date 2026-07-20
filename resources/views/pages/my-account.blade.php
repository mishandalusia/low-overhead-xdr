@php
    use Illuminate\Support\Facades\Auth;

    $activeUser = $activeUser ?? Auth::user();

    $roleLabels = [
        'super_admin' => 'Administrator',
        'security_analyst' => 'Security Analyst',
        'web_administrator' => 'Web Administrator',
        'group_leader' => 'Group Leader',
    ];
    $roleLabel = $roleLabels[$activeUser->role] ?? ucwords(str_replace('_', ' ', $activeUser->role ?? 'Administrator'));

    $initials = collect(explode(' ', trim($activeUser->name)))
        ->filter()
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

@extends('layouts.app-dashboard')

@section('title', 'My Account')
@section('subtitle', 'View and manage your account information')

@section('content')

@if (session('status'))
    <div class="account-flash" id="accountFlash">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg>
        <span>{{ session('status') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="account-flash account-flash-error" id="accountFlashError">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg>
        <span>{{ $errors->first() }}</span>
    </div>
@endif

<div class="profile-page-grid">
    <div class="profile-info-card bento-card">
        <form method="POST" action="{{ route('my.account.avatar') }}" enctype="multipart/form-data" id="avatarForm">
            @csrf
            <div class="profile-large-avatar">
                <div class="profile-avatar-photo">
                    @if ($activeUser->avatar_path)
                        <img src="{{ asset('storage/'.$activeUser->avatar_path) }}" alt="{{ $activeUser->name }}">
                    @else
                        <span>{{ $initials }}</span>
                    @endif
                </div>

                <label for="avatarInput" class="avatar-edit-btn" title="Change photo">
                    <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path d="m5.433 13.917 1.262-3.155a4 4 0 0 1 .886-1.343l6.918-6.918a2.121 2.121 0 0 1 3 3l-6.918 6.918a4 4 0 0 1-1.343.886l-3.155 1.262a.5.5 0 0 1-.65-.65Z"/><path d="M3.5 5.75c0-.966.784-1.75 1.75-1.75H10a.75.75 0 0 1 0 1.5H5.25a.25.25 0 0 0-.25.25v9.5a.25.25 0 0 0 .25.25h9.5a.25.25 0 0 0 .25-.25V10a.75.75 0 0 1 1.5 0v5.25a1.75 1.75 0 0 1-1.75 1.75h-9.5a1.75 1.75 0 0 1-1.75-1.75v-9.5Z"/></svg>
                </label>
                <input type="file" name="avatar" id="avatarInput" accept="image/png,image/jpeg,image/webp" hidden>
            </div>
        </form>

        <h2>{{ $activeUser->name }}</h2>
        <p>{{ $activeUser->email }}</p>

        <span class="role-badge">{{ $roleLabel }}</span>
        <small class="avatar-hint">JPG, PNG or WEBP, up to 10MB</small>
    </div>

    <div class="profile-detail-card bento-card">
        <h3>Account Information</h3>

        <form method="POST" action="{{ route('my.account.profile') }}" id="profileForm">
            @csrf
            <div class="profile-row">
                <span>Full Name</span>
                <strong class="profile-row-value" id="nameView">{{ $activeUser->name }}</strong>
                <input type="text" name="name" class="profile-row-input" id="nameInput" value="{{ $activeUser->name }}" maxlength="100" required hidden>
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
                <strong class="status-active"><i></i>Active</strong>
            </div>

            <div class="profile-actions">
                <button type="button" class="primary-action-btn" id="editProfileBtn">Edit Profile</button>
                <button type="submit" class="save-action-btn" id="saveProfileBtn" hidden>Save Changes</button>
                <button type="button" class="cancel-action-btn" id="cancelProfileBtn" hidden>Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    .account-flash {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 18px;
        margin-bottom: 22px;
        border-radius: 14px;
        background: rgba(34, 197, 94, 0.10);
        border: 1px solid rgba(34, 197, 94, 0.25);
        color: #15803d;
        font-size: 13px;
        font-weight: 750;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .account-flash-error {
        background: rgba(239, 68, 68, 0.10);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #dc2626;
    }

    .profile-page-grid {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 22px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .profile-page-grid {
            grid-template-columns: 1fr;
        }
    }

    .profile-info-card,
    .profile-detail-card {
        background: var(--card-bg, #ffffff);
        border-radius: 22px;
        border: 1px solid rgba(139, 92, 246, 0.12);
        box-shadow: 0 16px 34px rgba(139, 92, 246, 0.10);
        padding: 30px 26px;
    }

    .profile-info-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-large-avatar {
        position: relative;
        width: 96px;
        height: 96px;
        margin-bottom: 16px;
    }

    .profile-avatar-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
        color: #ffffff;
        font-size: 30px;
        font-weight: 900;
        box-shadow: 0 14px 30px rgba(217, 70, 239, 0.28);
    }

    .profile-avatar-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-edit-btn {
        position: absolute;
        right: -2px;
        bottom: -2px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #ffffff;
        color: var(--accent-purple);
        border: 2px solid var(--bg-main, #FAF8FC);
        box-shadow: 0 6px 14px rgba(88, 28, 135, 0.22);
        cursor: pointer;
        transition: transform 0.18s ease, background-color 0.18s ease;
    }

    .avatar-edit-btn:hover {
        background: #F3E8FF;
        transform: scale(1.06);
    }

    .avatar-edit-btn.is-uploading {
        pointer-events: none;
        animation: avatarUploadSpin 0.8s linear infinite;
    }

    @keyframes avatarUploadSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .avatar-hint {
        display: block;
        margin-top: 10px;
        font-size: 11px;
        font-weight: 650;
        color: var(--text-body);
        opacity: 0.75;
    }

    .profile-info-card h2 {
        font-size: 19px;
        font-weight: 900;
        color: var(--text-heading);
        margin: 0 0 4px;
    }

    .profile-info-card p {
        font-size: 13px;
        font-weight: 650;
        color: var(--text-body);
        margin: 0;
    }

    .role-badge {
        display: inline-block;
        margin-top: 14px;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(139, 92, 246, 0.12);
        color: var(--accent-purple);
        font-size: 12px;
        font-weight: 850;
    }

    .profile-detail-card h3 {
        font-size: 16px;
        font-weight: 850;
        color: var(--text-heading);
        margin: 0 0 6px;
    }

    .profile-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 15px 0;
        border-bottom: 1px solid #EFE9F7;
    }

    .profile-row:last-of-type {
        border-bottom: none;
    }

    .profile-row > span {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-body);
        flex-shrink: 0;
    }

    .profile-row > strong {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-heading);
        text-align: right;
    }

    .profile-row-input {
        max-width: 240px;
        height: 38px;
        padding: 0 12px;
        border-radius: 10px;
        border: 1px solid #E5DFF0;
        background: #FAF8FC;
        font-family: var(--font-main);
        font-size: 13px;
        font-weight: 750;
        color: var(--text-heading);
        text-align: right;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .profile-row-input:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        background: #ffffff;
    }

    .status-active {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #16a34a !important;
    }

    .status-active i {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #16a34a;
    }

    .profile-actions {
        display: flex;
        gap: 10px;
        margin-top: 22px;
    }

    .primary-action-btn,
    .save-action-btn,
    .cancel-action-btn {
        height: 42px;
        padding: 0 20px;
        border-radius: 12px;
        border: none;
        font-family: var(--font-main);
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
    }

    .primary-action-btn,
    .save-action-btn {
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(139, 92, 246, 0.28);
    }

    .primary-action-btn:hover,
    .save-action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(139, 92, 246, 0.34);
    }

    .cancel-action-btn {
        background: #F5F1FB;
        color: var(--text-body);
    }

    .cancel-action-btn:hover {
        background: #EDE5F9;
    }
</style>

<script>
    (function () {
        const editBtn = document.getElementById('editProfileBtn');
        const saveBtn = document.getElementById('saveProfileBtn');
        const cancelBtn = document.getElementById('cancelProfileBtn');
        const nameView = document.getElementById('nameView');
        const nameInput = document.getElementById('nameInput');
        const originalName = nameInput.value;

        editBtn.addEventListener('click', function () {
            nameView.hidden = true;
            nameInput.hidden = false;
            nameInput.focus();
            nameInput.select();
            editBtn.hidden = true;
            saveBtn.hidden = false;
            cancelBtn.hidden = false;
        });

        cancelBtn.addEventListener('click', function () {
            nameInput.value = originalName;
            nameView.hidden = false;
            nameInput.hidden = true;
            editBtn.hidden = false;
            saveBtn.hidden = true;
            cancelBtn.hidden = true;
        });

        const avatarInput = document.getElementById('avatarInput');
        const avatarEditBtn = document.querySelector('.avatar-edit-btn');
        const avatarHint = document.querySelector('.avatar-hint');
        avatarInput.addEventListener('change', function () {
            if (avatarInput.files && avatarInput.files.length) {
                if (avatarHint) {
                    avatarHint.textContent = 'Uploading...';
                }
                if (avatarEditBtn) {
                    avatarEditBtn.classList.add('is-uploading');
                }
                document.getElementById('avatarForm').submit();
            }
        });

        const flash = document.getElementById('accountFlash');
        if (flash) {
            setTimeout(function () {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-6px)';
                setTimeout(function () { flash.remove(); }, 320);
            }, 3200);
        }
    })();
</script>
@endsection
