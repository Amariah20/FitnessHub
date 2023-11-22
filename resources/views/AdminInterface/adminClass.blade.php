@extends('layouts.adminPage')

@section('content')

@foreach($classes as $class)
    <h1>{{$class->name}}</h1>

    <p>Description: {{$class->description}}</p>
    <p>Location: {{$class->location}}</p>
    <p>Schedule: {{$class->schedule}}</p>
    <p>Duration: {{$class->duration}}</p>
    <p>Maximum number of person per class (capacity):{{$class->capacity}}</p>
    <p>Price: {{$class->price}}</p>

@endforeach

@endsection