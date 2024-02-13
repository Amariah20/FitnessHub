@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 
<div class="container">
<h7>Step 6 of 6</h7>
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



   

   



<div class="add-gym">
<div class="card-header"><h1>GPS Info</h1></div>
<div class="register-info">
<div class="register">
<form method="POST" action="{{ route('gps.store') }}">
@csrf

<!--
    <div class="mb">
        <label class="label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>-->
    <div class="mb">
        <label class="label">Latitude</label>
        <input type="float" name="latitude" class="form-control"  >
    </div>

    <div class="mb">
        <label class="label">Longitude</label>
        <input type="float" name="longitude" class="form-control"  >
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


  
        <button type="submit">Add </button>
        <br><br><br>
        
        @if(session('success'))
            <button type="submit"> <a href="{{ route('AdminFirst') }}">Next</a></button>
        @endif

         
</form>
</div>

                       
    


<div class="info">

        <div class="card" style="width: 18rem; margin-top:220px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Tell customers the purpose of the class, which muscle groups are targeted, and what they can expect.</p>
                       
                        
                    </div>
        </div>


        <div class="card" style="width: 18rem; margin-top:90px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Please state the number of people that can participate in this class.</p>
                        
                    </div>
        </div>
        <div class="card" style="width: 18rem; margin-top:35px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">If the class is included with the membership, please say so in the description, and set the price as 0.</p>
                        
                    </div>
        </div>
        </div>
</div>

@endSection