@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--used bootstrap for cards throughout the application:https://getbootstrap.com/docs/4.3/components/card/-->
<!--icons: https://icons.getbootstrap.com/icons/info-circle/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 

<div class="container">
<h7>Step 2 of 5</h7>
@if($errors->any())

@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="add-gym">

@if(session('success_membership'))
    <div class="alert alert-success">
        {{ session('success_membership') }}
    </div>

   
    
@endif



<div class="card-header"><h1>Memberships</h1></div>
<div class="register-info">
<div class="register">
<form method="POST" action="{{ route('membership.store') }}">
@csrf

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Membership Price (SCR)</label>
        <input type="number" name="price" class="form-control"  required>
    </div>
 
    <div class="mb">
        <label class="label">Membership Description</label>
        <textarea class="form-control" name="description"  rows="3" required></textarea>
    </div>
    
    <div class="mb">
        <label class="label">Membership type</label>
        <select name="membership_type" >
            <option value="" disabled selected>Select Membership Type</option>
            <option value ="annual">Annual</option>
            <option value ="monthly">Monthly</option>
            <option value ="weekly">Weekly</option>
            <option value ="daily">Daily</option>
        </select>
    </div>
    

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
    <br><br><br>
    @if(session('success_membership'))
    

   
    <button  type="submit"> <a href="{{ route('class.create') }}">Next</a></button>
@endif


         
</form>

</div>

<div class="info">
        <div class="card" style="width: 18rem; margin-top:5px">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Example of membership names: Daily pass, Monthly subscription, Annual membership, etc</p>
                        
                    </div>
        </div>

        
       
        </div>
</div>

@endSection