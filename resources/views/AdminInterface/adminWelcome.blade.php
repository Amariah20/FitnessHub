@extends('layouts.adminPage')

@section('content')
<!--I used bootstrap for tables:https://getbootstrap.com/docs/4.0/content/tables/ -->
<!--I used this for help with updating all info: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
<h1 class="welcome">Welcome, {{$user->name}}</h1>
<br><br>

<h2>Business Information</h2><br>
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



<table class="table">
  <thead class="thead-light">
  

  <tbody>
    <tr>
      <th id="info" scope="row">Business Name</th>
      <td> {{$gym->name}}</td>
    
      
      
    </tr>
    <tr>
      <th id="info" scope="row">Description</th>
      <td>{{$gym->description}}</td>
   
      
    </tr>
    <tr>
      <th id="info" scope="row">Location</th>
      <td> {{$gym->location}}</td>
      
     
    </tr>

    </tr>
    <tr>
      <th id="info" scope="row">General Location</th>
      <td> {{$gym->general_location}}</td>
      
     
    </tr>
    <tr>
      <th id="info" scope="row">Opening Hours</th>
      <td> {{$gym-> opening_hours}}</td>
   
    </tr>
    <tr>
      <th id="info" scope="row">Phone Number</th>
      <td>{{$gym->phone_number}}</td>
     
    </tr>
    <tr>
      <th id="info" scope="row">Email</th>
      <td>{{$gym->email}}</td>

    </tr>
    <tr>
      <th scope="row" id="info">Instagram</th>
      <td>  {{$gym->instagram}}</td>
   
    </tr>
    <tr>
      <th id="info" scope="row">Facebook</th>
      <td> {{$gym->facebook}}</td>
  
    </tr>
  </tbody>
</table>
<br><br>
<a href="{{route('EditGym', ['Gym_id' => $Gym_id] )}}"><button type= "submit" class="btn btn-info">Edit Business Information</button></a>




@endsection