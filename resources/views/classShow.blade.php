@extends('layouts.app')

@section('content')
<h1>{{$class->name}}</h1>

<p>{{$class->description}}</p>
<p>{{$class->location}}</p>
<p>{{$class->schedule}}</p>
<p>{{$class->duration}}</p>
<p>{{$class->capacity}}</p>
<p>{{$class->price}}</p>
@endsection