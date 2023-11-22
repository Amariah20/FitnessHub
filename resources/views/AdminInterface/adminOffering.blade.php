@extends('layouts.adminPage')

@section('content')

@foreach($offerings as $offering)
    <h1>{{$offering->name}}</h1>

    <p>Description: {{$offering->description}}</p>
    
   
    <p>Price: {{$offering->price}}</p>

@endforeach

@endsection