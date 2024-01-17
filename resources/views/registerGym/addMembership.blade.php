@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 
@if($errors->any())

@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('success_membership'))
    <div class="alert alert-success">
        {{ session('success_membership') }}
    </div>

   
    <button type="submit"> <a href="{{ route('class.create') }}">Next</a></button>
@endif



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="{{ route('membership.store') }}">
@csrf

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Membership Price</label>
        <input type="number" name="price" class="form-control"  required>
    </div>
 
    <div class="mb">
        <label class="label">Membership Description</label>
        <textarea class="form-control" name="description"  rows="3" required></textarea>
    </div>
    <br>
    <div class="mb">
        <label class="label">Membership type</label>
        <select name="membership_type" >
            <option value="" disabled selected>Please Select Membership Type</option>
            <option value ="annual">Annual</option>
            <option value ="monthly">Monthly</option>
            <option value ="weekly">Weekly</option>
            <option value ="daily">Daily</option>
        </select>
    </div>
    <br><br>

    <div class="mb">
    <label class="label">Which gym do you want to associate with this membership?</label>
    <select name="SelectedGymID">
    <option>Select Gym</option>
            @foreach($gym as $gym)
                
                <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
            @endforeach
       
    </select>
</div>



    
    <button type="submit">Add </button>

         
</form>
</div>

@endSection