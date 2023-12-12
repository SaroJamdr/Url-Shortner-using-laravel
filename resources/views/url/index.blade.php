{{-- @dd(Session::all()) --}}
@extends('layouts.app')

@section('content')

<a href="{{route('urls.create')}}">
<h1>Create a new Url</h1>
</a>

@if (Session::has('success'))
<span style="color: green;">{{Session::get('success')}}</span><br>
    
@endif

List all your Urls here.!!!
Total Urls: {{$count}}

<div>
    <table>
        <tr>
            <th>Sn</th>
            <th>Original Url</th>
            <th>Short Url</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
      
        @php
            $i = 1;
        @endphp
        @foreach ($urls as $url)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$url->original_url}}</td>
            <td>{{$url->short_url}}</td>
            <td><a href="{{route('hi',['id'=>$url->id])}}">Edit</a></td>
            {{-- <td><a href="{{route('urls.view',['id'=>$url->id])}}">View</a></td> --}}
            <td><a href="{{route('urls.review',$url->id)}}">View</a></td>

            <td>
                <form action="{{route('urls.delete',['id'=>$url->id])}}" method="POST">
                @csrf
            <button type="submit">Delete</button>
        </form>
            </td>
        </tr>
            
        @endforeach
    </table>
    <div>
        {{$urls->links('pagination::simple-tailwind')}}
    </div>
</div>


@endsection