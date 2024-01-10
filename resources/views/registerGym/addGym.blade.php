@extends('layouts.app')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>
@endif
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 



<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
<form method="POST" action="{{ route('gym.store') }}" enctype="multipart/form-data">
@csrf

    <div class="mb">
        <label class="label">Name of your Fitness Centre(this cannot be changed)</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Location</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Opening Hours</label>
        <input type="text" name="opening_hours" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="number" name="phone_number" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Email Adress</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Instagram username</label>
        <input type="text" name="instagram" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Facebook Username</label>
        <input type="text" name="facebook" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Write a captivating description</label>
        <textarea class="form-control" name="description" required rows="3"></textarea>
    </div>

    <div class="mb">
        <label class="label">Logo</label>
        <input type="file" name="logo" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Banner</label>
        <input type="file" name="banner" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Additional Image to be displayed on website</label>
        <input type="file" name="extra_image" class="form-control" required>
    </div>
        <button type="submit">Add </button>
         
</form>
</div>

@endsection