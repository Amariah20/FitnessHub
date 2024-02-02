@extends('layouts.adminPage')

@section('content')
<!--I used bootstrap for tables:https://getbootstrap.com/docs/4.0/content/tables/ -->
<!--I used this for help with updating all info: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
<h1 class="welcome">Welcome, {{$user->name}}!</h1>
<br><br>

<h2 class="business-name">Business Information</h2><br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
@if (session('Success'))
                <h6 class="alert alert-success">{{ session('Success') }}</h6>
            @endif


<div class="business-info">


<div class="info">
  <h4>Business Name:</h4> <h3>{{$gym->name}}</h3>
  </div>
   
  <div class="info">   
  <h4>Description: </h4> <h3>{{$gym->description}}</h3>
  </div>
   
  <div class="info">   
  <h4> Location: </h4> <h3>{{$gym->location}}</h3>
  </div>
      
  <div class="info">
  <h4>General Location: </h4> <h3> {{$gym->general_location}}</h3>
  </div>
    
  <div class="info">
  <h4>Opening Hours: </h4> <h3>{{$gym-> opening_hours}}</h3>
  </div>
   
  <div class="info">
  <h4>Phone Number: </h4> <h3>{{$gym->phone_number}}</h3>
  </div>
  
  <div class="info">
  <h4> Email: </h4> <h3>{{$gym->email}}</h3>
  </div>

<?php
    use Illuminate\Support\Str;
    $instaUsername = Str::substr($gym->instagram, 26);
    
    $instaUsername= rtrim($instaUsername, '/');
    $facebookUsername = Str::substr($gym->facebook,25);
    $facebookUsername = rtrim ($facebookUsername, '/');
    
    ?>

  <div class="info">
  <h4> Instagram: </h4> <h3>{{$instaUsername}}</h3>
  </div> 

  <div class="info">
  <h4> Facebook: </h4> <h3>{{ $facebookUsername }}</h3>
  </div><div class="info">
  


</div>

<br><br>
<div class="edit-padding">
<a href="{{route('EditGym', ['Gym_id' => $Gym_id] )}}"><button type= "submit" class="btn btn-info">Edit Business Information</button></a>
</div>


@endsection