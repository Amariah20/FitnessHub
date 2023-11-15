@extends('layouts.app')

@section('content')
<h1>{{$offering->name}}</h1>


<p>{{$offering->description}}</p>
<p>{{$offering->price}}</p>
@endsection