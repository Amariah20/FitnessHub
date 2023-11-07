@extends('layouts.app')

@section('content')
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="/storeGym">
@csrf

    <div class="mb">
        <label class="label">Name of your Fitness Centre</label>
        <input type="text" name="name" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Location</label>
        <input type="text" name="location" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Opening Hours</label>
        <input type="text" name="opening_hours" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="number" name="phone_number" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Email Adress</label>
        <input type="email" name="email" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Instagram username</label>
        <input type="text" name="instagram" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Facebook Username</label>
        <input type="text" name="facebook" class="form-control" id="" placeholder="">
    </div>
    <div class="mb">
        <label class="label">Write a captivating description</label>
        <textarea class="form-control" name="description" id="" rows="3"></textarea>
    </div>
        <button type="submit">Continue </button>
         
</form>
</div>

@endSection