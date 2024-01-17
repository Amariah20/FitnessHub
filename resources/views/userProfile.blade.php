@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif

<h1>User Information</h1>
<p>{{$user->name}}</p>
<p>{{$user->email}}</p>
<p>{{$user->date_of_birth}}</p>
<p>{{$user->address}}</p>

@if(!$favGyms==null)
 <h1>Your Favourite Gyms</h1>
 @foreach($favGyms as $gym)
 <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
 @endforeach
@endif

@endsection