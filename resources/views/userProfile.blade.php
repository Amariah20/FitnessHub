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


    <div class="profile">

<h1>User Information</h1>

<p>Name: {{$user->name}}</p>
<p>Email: {{$user->email}}</p>
<p>Date of Birth: {{$user->date_of_birth}}</p>
<p>Address: {{$user->address}}</p>
<form method="post" action="{{route('editUserDetails')}}">
    @csrf
    <input type="hidden"  name="user_id" value="{{$user->id}}">
   <button class="btn btn-success" type= "submit">Edit Your Information</button>
</form> <br><BR>

@if(!$favGyms==null)
 <h1>Your Favourite Gyms</h1>
 @foreach($favGyms as $gym)
 <li> <a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></li>
 @endforeach
@endif
    </div>

@endsection