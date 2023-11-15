@extends('layouts.app')

@section('content')
<h1>{{$class->name}}</h1>

<p>{{$class->name}}</p>
<p>{{$class->description}}</p>
<p>{{$class->location}}</p>
<p>{{$class->duration}}</p>
<p>{{$class->capacity}}</p>
<p>{{$class->price}}</p>
@endsection