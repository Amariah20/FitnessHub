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




<div id="write-email" class="container">
    <h1>Write a message to your subsribers</h1>
<div class="card-header"></div>
 
<form method="GET" action="{{ route('sendMail', ['Gym_id' => $Gym_id] ) }}">
@csrf

    <div class="form-group">
        <label>Subject of Email</label>
        <input type="text" name="subject" class="form-control" required>
    </div>
 
    <div class="form-group">
        <label>Email Message</label>
        <textarea class="form-control" name="message"  rows="3" required></textarea>
    </div>


    

  
    <button id="add-info-button" class="btn btn-success" type="submit">Send Email</button><br>

         
</form>
</div>

@endSection