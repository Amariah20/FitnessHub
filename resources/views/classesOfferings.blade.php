@extends('layouts.app')

@section('content')
<h1>Classes and Offerings</h1>
<h2>Classes:</h2>
    @foreach($classes as $class)
       <a href= "{{route('classShow', ['Class_id'=>$class->Class_id])}}"> <p>{{ $class->name }}</p></a>
       
        <hr>
    @endforeach

    <h2>Offerings:</h2>
    @foreach($offerings as $offering)
        <p>{{ $offering->name }}</p>
        
        <hr>
    @endforeach

@endsection