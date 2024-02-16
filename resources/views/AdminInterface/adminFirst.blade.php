@extends('layouts.app')

@section('content')
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
<link rel="stylesheet" type="text/css" href="/getStarted.css">
<div class="admin-first">


<div class="container">

<h1 class="h1-admin-first">Welcome, {{$user->name}}!</h1> <br>

<form method="get" action="{{ route('AdminWelcome')}}">
<h2 class="h2-admin-first">Please select which gym you want to view to get started </h2> <br>


    @csrf 
   
    <select id="dropdown_select_gym"  style=" border-radius: 10px; width:50%; height: 50px;" name="SelectedGymID">
        <option value= "Select">Click here to select gym</option>
        @foreach($gym as $gym)
       
            <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
            
        @endforeach
    </select> <br><br>


    <button type="submit" class="admin-first-select">Get Started</button>
</form>
</div>
@endsection


