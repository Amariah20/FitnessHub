<!--this is good for buttons/forms designs & images etc: https://www.youtube.com/watch?v=Xel-0xPJECc-->
@extends('layouts.app')

@section('content')
<!--I used this for help: https://www.youtube.com/watch?v=Xel-0xPJECc-->
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
<form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
@csrf
    
        
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
    <div class="mb">
    <label class="label">Which gym do you want to associate with these images?</label>
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