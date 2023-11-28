@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 
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
@if(session('success_equipment'))
    <div class="alert alert-success">
        {{ session('success_equipment') }}
    </div>

   
    <button type="submit"> <a href="{{ route('AdminFirst') }}">Next</a></button>
   
@endif



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="{{ route('equipment.store') }}">
@csrf

    <div class="mb">
        <label class="label">Name of Equipment</label>
        <input type="text" name="name" class="form-control">
    </div>
 
       <div class="mb">
        <label class="label">Write a brief description</label>
        <textarea class="form-control" name="description"  rows="3"></textarea>
    </div>

    <div class="mb">
    <label class="label">Which gym do you want to associate with this equipment?</label>
    <select name="SelectedGymID">
    <option>Select Gym</option>
            @foreach($gym as $gym)
                
                <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
            @endforeach
       
    </select>
</div>


    <!--<input type="hidden" name="gym_id" value="{{ auth()->user()->gym_id }}">-->

    

  
        <button type="submit">Add </button>

         
</form>
</div>

@endSection