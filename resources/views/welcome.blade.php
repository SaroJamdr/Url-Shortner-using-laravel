@extends('layouts.app')

@section('content')
Welcome 

@auth
<a href="{{route('urls')}}">
    <h1>Urls</h1>
    </a>
@endauth
@endsection