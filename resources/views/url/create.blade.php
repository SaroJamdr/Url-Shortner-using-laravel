@extends('layouts.app')

@section('content')
    Create your Url here!!
    <br><br>
    <form action="{{route('urls.create')}}" method="post">
    @csrf
    <label for="original url">Input your Url</label><br>
    @error('url')
        <span style="color: red">{{$message}}</span>
    @enderror
    <input type="text" name="url" value="">
    <button type="submit">Submit</button>

    </form>

@endsection