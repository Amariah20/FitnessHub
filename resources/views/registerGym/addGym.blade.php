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
<!--used bootstrap for cards throughout the application:https://getbootstrap.com/docs/4.3/components/card/-->
<!--icons: https://icons.getbootstrap.com/icons/info-circle/-->
    <link rel="stylesheet" type="text/css" href="/getStarted.css"> 


<div class="add-gym">



<div class="container">
<h7>Step 1 of 5</h7>
<div class="card-header"><h1>Gym Information</h1></div>
<div class="register-info">
<div class="register">
        <form method="POST" action="{{ route('gym.store') }}" enctype="multipart/form-data">
        @csrf

            <div class="mb">
                <label class="label">Name of your Fitness Centre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb">
                <label class="label">General Location</label><br>
                <select name="general_location" >
                    <option value="" disabled selected>Select Location</option>
                    <option value ="north">North</option>
                    <option value ="east">East</option>
                    <option value ="south">South</option>
                    <option value ="west">West</option>
                    <option value ="central">Central</option>
                </select>
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

        <div class="info">
        <div class="card" style="width: 18rem; margin-top:5px">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">The name cannot be changed at a later date. Please ensure that it is correct.</p>
                        
                    </div>
        </div>

        <div class="card" style="width: 18rem; margin-top:115px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Please specifiy your opening hours in detail. If you have different opening hours for different days, please separate them with a dot (.) </p>
                        <p class="card-text">   For example: Monday to Friday 6am to 7pm. Saturday 9am to 12pm.</p>
                        
                    </div>
        </div>


        <div class="card" style="width: 18rem; margin-top:100px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Reveal the excellence of your gym and persuade customers to join by describing its exceptional features and benefits.</p>
                        
                    </div>
        </div>
        </div>
</div>
</div>


@endsection