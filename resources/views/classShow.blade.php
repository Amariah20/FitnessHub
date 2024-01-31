@extends('layouts.app')

@section('content')
<h1>{{$class->name}}</h1>

<p>Description: {{$class->description}}</p>
<p>Location: {{$class->location}}</p>
<p>Schedule: {{$class->schedule}}</p>
<p>Duration: {{$class->duration}}</p>
<p>Maximum number of person per class (capacity):{{$class->capacity}}</p>
<p>Price: SCR {{$class->price}}</p>
@endsection