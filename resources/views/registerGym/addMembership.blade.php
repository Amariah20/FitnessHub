@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="{{ route('memberships.store') }}">
@csrf

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Price of Membership</label>
        <input type="number" name="price" class="form-control" id="" placeholder="">
    </div>
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <textarea class="form-control" name="description" id="" rows="3"></textarea>
    </div>

    <!--<input type="hidden" name="gym_id" value="{{ auth()->user()->gym_id }}">-->

    

    <button type="submit">Add Another Membership </button><br>
        <button type="submit">Continue </button>

         
</form>
</div>

@endSection