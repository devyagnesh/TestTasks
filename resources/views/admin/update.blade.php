<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <title>Update Profile</title>
</head>

<body class="antialiased">
    <div class="wrapper vh100 d-flex align-items-center justify-content-center">
        <div class="card p2 radius-5 width-40">
            <h2 class="mb-2 form-title">Update Profile</h2>
            @if (session('error'))
                <div class="alert alert-danger mb-2">{{ session('error') }}</div>
            @elseif ($errors->any())
                <div class="alert alert-danger mb-2">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('postUpdateProfile') }}" method="post" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}" />
                <label for="profilePicture" class="upload-profile-wrapper">
                    <input type="file" name="profilePicture" id="profilePicture" class="input-controller" />

                    @if ($user->profile_picture)
                        <img src="{{ Storage::url($user->profile_picture) }}" alt="" />
                    @else
                        <h2>?</h2>
                    @endif
                </label>

                <div class="form-group mt-2">
                    <input type="text" name="name" id="name" class="input-controller" placeholder="Your name"
                        value="{{ $user->name }}" />
                </div>
                <div class="form-group mt-2">
                    <input type="email" name="email" id="email" class="input-controller"
                        placeholder="Email address" value="{{ $user->email }}" />
                </div>


                <button type="submit" name="signin" id="signin" class="btn btn-form-action">Update Profile</button>
                <a href="{{route('viewDashboard')}}" class="btn btn-form-action" style="text-align: center;background-color:rgb(249, 44, 119);">Cancel</a>
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/d9739c7805.js" crossorigin="anonymous"></script>
</body>

</html>
