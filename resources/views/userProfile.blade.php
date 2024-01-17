@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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