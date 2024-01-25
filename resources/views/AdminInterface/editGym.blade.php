@extends('layouts.adminPage')

@section('content')

<!--I used bootstrap for the forms to register/edit gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
    <!--<link rel="stylesheet" type="text/css" href="/getStarted.css"> -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
 
<div id="edit" class="container">
<div class="card-header">Edit Gym Details</div>

<form method="post" action="{{route('UpdateGym',  ['Gym_id' => $gym->Gym_id])}}" enctype="multipart/form-data">
@csrf
@method("patch")

    

    <div class="form-group">
        <label>Fitness Centre Name:</label>
        <input class="form-control" type="text" placeholder="{{$gym->name}}" readonly>
    </div>

    <div class="form-group">
    <label>Description</label>
    <input class="form-control" name="description" value="{{$gym->description}}" required></input>
  </div>
  
  <div class="form-group">
    <label>General Location</label><br>
    <select  class="form-control form-control-lg" name="general_location" value="{{$gym->general_location}}">
            <option value= "{{$gym->general_location}}">{{$gym->general_location}}</option>
            <option value ="north">North</option>
            <option value ="east">East</option>
            <option value ="south">South</option>
            <option value ="west">West</option>
            <option value ="central">Central</option>
        </select>
  </div>
  
  <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" value="{{$gym->location}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Opening Hours</label>
    <input type="text" name="opening_hours" value="{{$gym->opening_hours}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Phone Number</label>
    <input type="number" name="phone_number" value="{{$gym->phone_number}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Email Address</label>
    <input type="email" name="email" value="{{$gym->email}}" required class="form-control">
  </div>
   
  <div class="form-group">
    <label>Instagram Username</label>
    <input type="text" name="instagram" value="{{$gym->instagram}}" class="form-control">
  </div>
  <div class="form-group">
    <label>Facebook Username</label>
    <input type="text" name="facebook" value="{{$gym->facebook}}" class="form-control">
  </div>

  <div class="form-group">
    <label>Logo</label>
    <input type="file" class="form-control-file" name="logo" class="form-control">
  </div>
  <div class="form-group">
    <label>Banner</label>
    <input type="file" class="form-control-file" name="banner" class="form-control">
  </div>

  <div class="form-group">
    <label>Additional Image</label>
    <input type="file" class="form-control-file" name="extra_image" class="form-control" >
  </div>
  

  <button id="update-button" type= "submit" class="btn btn-info">Update </button> <br>
         
</form>
</div>

  <!--
<div class="mb">
        <label class="label">Fitness Centre Name:</label>
        {{$gym->name}}
    </div>
    

    <div class="mb">
        <label class="label">General Location</label>
        <select name="general_location" value="{{$gym->general_location}}">
            <option value= "{{$gym->general_location}}">{{$gym->general_location}}</option>
            <option value ="north">North</option>
            <option value ="east">East</option>
            <option value ="south">South</option>
            <option value ="west">West</option>
            <option value ="central">Central</option>
        </select>
    </div>

    <div class="mb">
        <label class="label">Location</label>
        <input type="text" name="location" value="{{$gym->location}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Opening Hours</label>
        <input type="text" name="opening_hours" value="{{$gym->opening_hours}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="number" name="phone_number" value="{{$gym->phone_number}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Email Adress</label>
        <input type="email" name="email" value="{{$gym->email}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Instagram username</label>
        <input type="text" name="instagram" value="{{$gym->instagram}}" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Facebook Username</label>
        <input type="text" name="facebook" value="{{$gym->facebook}}" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Write a captivating description</label>
        <input class="form-control" name="description" value="{{$gym->description}}" required></input>
    </div>

    <div class="mb">
        <label class="label">Logo</label>

        <input type="file" name="logo" class="form-control">
        
    </div>
    <div class="mb">
        <label class="label">Banner</label>

        <input type="file" name="banner" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Additional Image to be displayed on website</label>
        
        <input type="file" name="extra_image" class="form-control" >
    </div>
        <button type="submit">Update </button> 
         
</form>
</div>-->

@endsection
