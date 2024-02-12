@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 
<div class="container">
<h7>Step 4 of 5</h7>
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

@if(session('success_offering'))
    <div class="alert alert-success">
        {{ session('success_offering') }}
    </div>

   

   
@endif


<div class="add-gym">
<div class="card-header"><h1>GPS Info</h1></div>

<div class="register">
<form method="POST" action="{{ route('gps.store') }}">
@csrf

    <div class="mb">
        <label class="label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Latitude</label>
        <input type="float" name="latitude" class="form-control"  required>
    </div>

    <div class="mb">
        <label class="label">Longitude</label>
        <input type="float" name="longitude" class="form-control"  required>
    </div>



  
        <button type="submit">Add </button>
       

         
</form>


                       
    

</div>

@endSection