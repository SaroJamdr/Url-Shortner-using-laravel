@extends('layouts.app')
@section('content')

<form action="{{route('login')}}" method="post">
@csrf
<br>
{{-- <label for="name">Name:</label><br>
<input type="text" name='name'>
@error('name')
<span style="color: red">{{$message}}</span>
@enderror<br> --}}

<label for="email">Email:</label><br>
<input type="email" name='email'>
@error('email')
<span style="color: red">{{$message}}</span>
@enderror<br>

<label for="password">Password:</label><br>
<input type="password" name='password'>
@error('password')
<span style="color: red">{{$message}}</span>
@enderror<br>
 

<button type="submit">Login</button>

</form>

@endsection