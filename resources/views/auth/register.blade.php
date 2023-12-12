@extends('layouts.app')
@section('content')

<form action="{{route('register')}}" method="post">
@csrf
<br>
<label for="name">Name:</label><br>
<input type="text" name='name'>
@error('name')
<span style="color: red">{{$message}}</span>
@enderror<br>

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

<label for="conf_assword">Confirm Password:</label><br>
<input type="password" name='conf_password'>
@error('conf_password')
<span style="color: red">{{$message}}</span>
@enderror<br><br>

<button type="submit">Register</button>

</form>

@endsection