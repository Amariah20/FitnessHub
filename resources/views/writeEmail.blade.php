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




<div class="container">
<div class="card-header"><img src="{{ asset('images/FitnessHubLogo.png') }}"  width="400" height="70"></div>
 
<form method="GET" action="{{ route('sendMail', ) }}">
@csrf

    <div class="mb">
        <label class="label">Subject of Email</label>
        <input type="text" name="subject" class="form-control" required>
    </div>
 
       <div class="mb">
        <label class="label">Email Message</label>
        <textarea class="form-control" name="message"  rows="3" required></textarea>
    </div>


    

  
        <button type="submit">Send Email</button>

         
</form>
</div>

@endSection