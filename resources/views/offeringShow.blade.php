@extends('layouts.app')

@section('content')
<div class="class_show">
<h1>{{$offering->name}}</h1>

<h2>Description: </h2> 
<p>{{$offering->description}}</p>

<h2>Price:  </h2> 
<p>SCR {{$offering->price}}</p>
</div>
@endsection