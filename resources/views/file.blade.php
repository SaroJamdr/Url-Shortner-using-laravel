@extends('layouts.app')

@section('content')
    <form action="{{route('hs')}}" method="post" enctype="multipart/form-data">
    {{-- <form action=""> --}}
        @csrf
      
        <br>

    <label for="file">Upload your file</label><br>
    @error('file')
        <span style="color: red">{{$message}}</span>
    @enderror
    <input type="file" name="file" value=""><br>
    <button type="submit">Submit</button>

    </form>

    @if (Session::has('path'))
    <div>
        <img src="{{Storage::url(Session::get('path'))}}" alt="">
    </div>
    @endif

@endsection