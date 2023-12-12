<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    {{-- talwind cdn link --}}
</head>
<body>
    <nav style="width: 100%; background: rgb(20, 20, 92); text-align: center;">

@guest
        <li><a href="{{route('register')}}">Register</a></li>
        <li><a href="{{route('login')}}">Login</a></li> 
@endguest

@auth
    <li>
        <a href="{{route('profile')}}">Profile Update</a>
    </li>
        <li>
            <form action="{{route('logout')}}" method="POST">
                @csrf
            <button type="submit">Logout, {{auth()->user()->name}}</button>
        </form>
        </li>
    
@endauth


    </nav>

    @yield('content')
    
</body>
</html>