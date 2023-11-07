@extends('layouts.app')

@section('content')
NOTE: Figure out which piece of info to display here in addition to gym name. what's most important for customers?
    @foreach($gyms as $gym)
<ul> 
   <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
    Location: {{$gym->location}}
   
</ul> 
    @endforeach
   


@endsection()