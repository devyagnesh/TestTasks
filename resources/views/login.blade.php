<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
        <title>Test Task</title>
    </head>
    <body class="antialiased">
       <div class="wrapper vh100 d-flex align-items-center justify-content-center">
         <div class="card p2 radius-5 width-40">
            <h2 class="mb-2 form-title">Login</h2>
            @if (session('error'))
                <div class="alert alert-danger mb-2">{{session('error')}}</div>
            @endif
            <form action="{{route('postLogin')}}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" id="email" class="input-controller" placeholder="Email address"/>
                </div>

                <div class="form-group mt-2">
                    <input type="password" name="password" id="password" class="input-controller" placeholder="Password"/>
                </div>

                <button type="submit" name="signin" id="signin" class="btn btn-form-action">Sign In</button>
                <p class="text-right text-go-signup">Don't have an account? <a href="{{route('viewSignup')}}">Signup</a></p>
            </form>
         </div>
       </div>
    </body>
</html>
