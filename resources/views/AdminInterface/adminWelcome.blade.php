@extends('layouts.adminPage')

@section('content')
<!--I used bootstrap for tables:https://getbootstrap.com/docs/4.0/content/tables/ -->
<!--I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
<h1>Welcome, {{$user->name}}</h1>
<br><br>

<h2>Business Information</h2>
@if (session('Success'))
                <h6 class="alert alert-success">{{ session('Success') }}</h6>
            @endif


<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Edit</th>
     

    </tr>
  </thead>

  <tbody>
    <tr>
      <th scope="row">Business Name</th>
      <td> {{$gym->name}}</td>
      <td><a href="{{route('EditGym', ['Gym_id' => $Gym_id] )}}"><button type= "submit">Edit</button></a></td>
      
      
    </tr>
    <tr>
      <th scope="row">Description</th>
      <td>{{$gym->description}}</td>
      <td><button type= "submit">Edit</button></td>
      
    </tr>
    <tr>
      <th scope="row">Location</th>
      <td> {{$gym->location}}</td>
      <td><button type= "submit">Edit</button></td>
     
    </tr>
    <tr>
      <th scope="row">Opening Hours</th>
      <td> {{$gym-> opening_hours}}</td>
      <td><button type= "submit">Edit</button></td>
    </tr>
    <tr>
      <th scope="row">Phone Number</th>
      <td>{{$gym->phone_number}}</td>
      <td><button type= "submit">Edit</button></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td> {{$gym->email}}</td>
      <td><button type= "submit">Edit</button></td>
    </tr>
    <tr>
      <th scope="row">Instagram</th>
      <td>  {{$gym->instagram}}</td>
      <td><button type= "submit">Edit</button></td>
    </tr>
    <tr>
      <th scope="row">Facebook</th>
      <td> {{$gym->facebook}}</td>
      <td><button type= "submit">Edit</button></td>
    </tr>
  </tbody>
</table>






@endsection