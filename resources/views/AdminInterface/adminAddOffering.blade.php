@extends('layouts.adminPage')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--<link rel="stylesheet" type="text/css" href="/getStarted.css"> -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif



<div id="add-admin" class="container">
<div class="card-header">Add New Service</div>
<form method="POST" action="{{ route('AdminOfferingStore', ['Gym_id' => $Gym_id]) }}">
@csrf

<div class="form-group">
        <label>Name of Service</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="number" name="price" class="form-control"  required>
    </div>
   
    <div class="form-group">
        <label>Write a brief description</label>
        <textarea class="form-control" name="description"  rows="3" required></textarea>
    </div>
  
    <button id="add-info-button" class="btn btn-success" type="submit">Add</button>
         <br>

         
</form>
</div>

@endSection