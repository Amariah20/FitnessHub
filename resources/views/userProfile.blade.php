@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif


@if(!$favGyms==null)
 <h1>Your Favourite Gyms</h1>
 @foreach($favGyms as $gym)
 <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
 @endforeach
@endif

@endsection