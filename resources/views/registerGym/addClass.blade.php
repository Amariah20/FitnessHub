@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="{{ route('class.store') }}">
@csrf

    <div class="mb">
        <label class="label">Class Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Class Location</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Description</label>
        <textarea class="form-control" name="description" required rows="3"></textarea>
    </div>
    <div class="mb">
        <label class="label">Capacity</label>
        <input type="number" name="capacity" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Duration (in minutes)</label>
        <input type="number" name="duration" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Price</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    
    <div class="mb">
    <label class="label">Which gym do you want to associate with this class?</label>
    <select name="SelectedGymID">
    <option>Select Gym</option>
            @foreach($gym as $gym)
                
                <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
            @endforeach
       
    </select>
</div>
    
        <button type="submit">Continue </button>
         
</form>
</div>

@endSection