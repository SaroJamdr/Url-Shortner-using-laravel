@extends('layouts.app')

@section('content')
@if (Session::has('success'))
<div style="color: green">
    {{Session::get('success')}}
</div>
@endif

    <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
    {{-- <form action=""> --}}
        @csrf
      
        <br>

    <label for="file">Update your profile</label><br>
    @error('name')
        <span style="color: red">{{$message}}</span>
    @enderror
    <input type="text" name="name" value="{{auth()->user()->name}}"><br>
    <button type="submit">Submit</button>

    </form>

    

@endsection