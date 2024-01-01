<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <title>Test Task</title>
</head>

<body class="antialiased">
    <div class="wrapper vh100 d-flex align-items-center justify-content-center">
        <div class="card p2 radius-5 width-40">
            <div class="profile-Wrapper">
                @if ($me->profile_picture)
                <img src="{{ Storage::url($me->profile_picture) }}" alt="{{ $me->name }}" />
                @else
                <h2>?</h2>    
                @endif
            </div>
            <h2 class="profile-name">{{ $me->name }}</h2>
            <div class="extra-profile-info">
                <div>
                    {{ $me->email }}
                </div>
                <div class="extra-profile-info-status">
                    Non-Admin
                </div>
            </div>
            <form method="post" action="{{route('postLogout')}}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</body>

</html>
