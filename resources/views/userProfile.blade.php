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
<form method="get" action="{{route('editUserDetails')}}">
    @csrf
    <input type="hidden"  name="user_id" value="{{$user->id}}">
   <button type= "submit">Edit Your Information</button>
</form>

@if(!$favGyms==null)
 <h1>Your Favourite Gyms</h1>
 @foreach($favGyms as $gym)
 <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
 @endforeach
@endif

@endsection