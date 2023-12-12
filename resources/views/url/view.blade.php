{{-- @dd($url->visitors) --}}
@extends('layouts.app')
@section('content')
 
<h4>Analytics for the url : {{$url->original_url}}</h4>
<h4>Short url : {{$url->short_url}}</h4>
<h4>Visitor Count : {{$url->visitor_count}}</h4>


User Visitors

 <div>
    <table>
        <tr>
            <th>id</th>
            <th>ip</th>
            <th>User Agent</th>
            <th>Visited At</th>
        </tr>
      
       
        @foreach ($url->visitors as $visitor)
        <tr>
            <td>{{$visitor->id}}</td>
            <td>{{$visitor->ip}}</td>
            <td>{{$visitor->user_agent}}</td>
            <td>{{$visitor->created_at->diffForHumans()}}</td>
            
        @endforeach
    </table>
</div> 
 


@endsection