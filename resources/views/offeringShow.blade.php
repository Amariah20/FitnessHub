@extends('layouts.app')

@section('content')
<h1>{{$offering->name}}</h1>


<p>{{$offering->description}}</p>
<p>SCR {{$offering->price}}</p>
@endsection