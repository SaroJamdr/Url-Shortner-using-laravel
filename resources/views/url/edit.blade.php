@extends('layouts.app')

@section('content')
    Edit your Url here!!
    <br><br>
    <form action="{{route('hi',$urls->id)}}" method="post">
    @csrf
    <label for="original url">Input your Url</label><br>
    @error('url')
        <span style="color: red">{{$message}}</span>
    @enderror
    <input type="text" name="url" value="{{$urls->original_url}}">
    <button type="submit">Submit</button>

    </form>

@endsection