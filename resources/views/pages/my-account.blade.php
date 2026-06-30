@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>

    <link rel="stylesheet" href="{{ asset('css/lox-dashboard.css') }}">

    <style>
        .account-box{
            max-width:650px;
            margin:40px auto;
            background:#fff;
            padding:25px;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .avatar-big{
            width:80px;
            height:80px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
            font-weight:bold;
            color:#fff;
            background:linear-gradient(135deg,#7c3aed,#ec4899);
            overflow:hidden;
        }

        .avatar-big img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .form-group{
            margin-bottom:15px;
        }

        .form-group label{
            display:block;
            font-size:13px;
            margin-bottom:5px;
        }

        .form-group input{
            width:100%;
            padding:10px;
            border:1px solid #ddd;
            border-radius:8px;
        }

        .btn{
            width:100%;
            padding:12px;
            background:#7c3aed;
            color:#fff;
            border:none;
            border-radius:8px;
            cursor:pointer;
        }

        .top{
            display:flex;
            gap:15px;
            align-items:center;
            margin-bottom:20px;
        }
    </style>
</head>

<body class="dashboard-enter">

<div class="app">

    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/lox-logo.png') }}" class="logo-image">
            <div class="logo-text">
                <h2>LOX</h2>
                <p>Low-Overhead XDR</p>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('settings') }}" class="nav-link">Settings</a>
    </aside>

    <main class="main">

        <div class="account-box">

            <div class="top">

                <div class="avatar-big">
                    @if($user->avatar)
                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}">
                    @else
                        {{ strtoupper(substr($user->name ?? 'U',0,1)) }}
                    @endif
                </div>

                <div>
                    <h3 style="margin:0;">{{ $user->name }}</h3>
                    <small>{{ $user->email }}</small>
                </div>

            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label>Avatar</label>
                    <input type="file" name="avatar">
                </div>

                <button class="btn" type="submit">
                    Save Changes
                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>