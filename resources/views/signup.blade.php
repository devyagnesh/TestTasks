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
            <h2 class="mb-2 form-title">SignUp</h2>
            @if (session('error'))
                <div class="alert alert-danger mb-2">{{ session('error') }}</div>

                @elseif ($errors->any())
                <div class="alert alert-danger mb-2">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('postSignup') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf

                <label for="profilePicture" class="upload-profile-wrapper">
                    <input type="file" name="profilePicture" id="profilePicture" class="input-controller" />
                    <svg xmlns="http://www.w3.org/2000/svg" height="40" width="44" viewBox="0 0 640 512">
                        <path
                            d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                            fill="#434343" />
                    </svg>
                </label>

                <div class="form-group mt-2">
                    <input type="text" name="name" id="name" class="input-controller"
                        placeholder="Your name" />
                </div>
                <div class="form-group mt-2">
                    <input type="email" name="email" id="email" class="input-controller"
                        placeholder="Email address" />
                </div>

                <div class="form-group mt-2">
                    <input type="password" name="password" id="password" class="input-controller"
                        placeholder="Password" />
                </div>

                <button type="submit" name="signin" id="signin" class="btn btn-form-action">Sign Up</button>
                <p class="text-right text-go-signup">already have an account? <a
                        href="{{ route('viewLogin') }}">Signin</a></p>
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/d9739c7805.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
