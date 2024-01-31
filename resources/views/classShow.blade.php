@extends('layouts.app')

@section('content')

<div class="class_show">
<h1>{{$class->name}}</h1>



    <h2>Description: </h2> 
      <p>  {{$class->description}} </p>

      <h2>Location:  </h2> 
    <p> {{$class->location}} </p>

    <h2>Schedule:  </h2> 
    <p>  {{$class->schedule}} </p>

    <h2>Duration:  </h2> 
    <p>  {{$class->duration}} </p>

    <h2>Capacity:  </h2> 
    <p>   {{$class->capacity}} People </p>
    
    <h2>Price:  </h2> 
    <p>  SCR {{$class->price}} </p>

</div>
@endsection