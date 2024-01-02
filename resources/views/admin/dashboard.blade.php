<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <title>Test Task</title>
</head>

<body class="antialiased" id="body">
    <div class="wrapper vh100 d-flex align-items-center justify-content-center"
        style="flex-direction: column;gap:.5rem;">
        <div style="width: 50rem;display:flex;align-items:center;justify-content:flex-end;margin:1rem 0;">
            <a href="{{route('export')}}" style="padding:1rem; font-size:1.4rem;font-weight:bold;color:rgb(208, 124, 64);background-color:#fff;border:.1rem solid #404040;width:10rem;text-align:center;border-radius:1rem;">Export</a>
        </div>
        @foreach ($otherUsers as $user)
            <div class="card p2 radius-5 width-40 d-flex align-items-center user-list-card"
                style="justify-content: flex-start;gap:1rem;">
                <div class="image">
                    @if ($user['profile_picture'])
                        <img src="{{ Storage::url($user['profile_picture']) }}" alt="" />
                    @else
                        <h1>?</h1>
                    @endif
                </div>
                <div class="d-flex align-items-center"
                    style="flex-direction: column;gap:.5rem;align-items:flex-start;font-size:1.2rem;">
                    <p>{{ $user['name'] }}</p>
                    <p>{{ $user['email'] }}</p>
                </div>
                <div class="actions d-flex" style="flex-grow:1;justify-content:flex-end;">
                    <div class="d-flex align-items-center" style="justify-content:flex-end;gap:2rem;" id="action">
                        <button class="btn btn-delete" style="border:none;background:transparent;outline:none;" data-id={{$user['id']}}>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="20" viewBox="0 0 448 512">
                                <path fill="rgb(215, 45, 91)"
                                    d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                            </svg>
                        </button>
                        <a href="/update/{{$user['id']}}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                <path fill="rgb(208, 124, 64)"
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </a>
                    </div>


                </div>
            </div>
        @endforeach
    </div>
    </div>
<script src="{{asset('js/app.js')}}"></script>
</body>

</html>
