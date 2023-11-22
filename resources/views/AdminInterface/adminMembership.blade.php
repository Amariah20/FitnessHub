@extends('layouts.adminPage')

@section('content')

@foreach($memberships as $membership)
    <h1>{{$membership->name}}</h1>

    <p>Description: {{$membership->description}}</p>
  
    <p>Price: {{$membership->price}}</p>

@endforeach

@endsection