@extends('layouts.adminPage')

@section('content')

<!--I used bootstrap for the forms to register/edit gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
    <!--<link rel="stylesheet" type="text/css" href="/getStarted.css"> -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
 
<div class="register-info">
<div class="register">
<div id="edit" class="container">
<div class="card-header">Edit Gym Details</div>

<form method="post" action="{{route('UpdateGym',  ['Gym_id' => $gym->Gym_id])}}" enctype="multipart/form-data">
@csrf
@method("patch")

    

    <div class="form-group">
        <label>Fitness Centre Name:</label>
        <input class="form-control" type="text" placeholder="{{$gym->name}}" readonly>
    </div>

    <div class="form-group">
    <label>Description</label>
    <input class="form-control" name="description" value="{{$gym->description}}" required></input>
  </div>
  
  <div class="form-group">
    <label>General Location</label><br>
    <select  class="form-control form-control-lg" name="general_location" value="{{$gym->general_location}}">
            <option value= "{{$gym->general_location}}">{{$gym->general_location}}</option>
            <option value ="north">North</option>
            <option value ="east">East</option>
            <option value ="south">South</option>
            <option value ="west">West</option>
            <option value ="central">Central</option>
        </select>
  </div>
  
  <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" value="{{$gym->location}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Opening Hours</label>
    <input type="text" name="opening_hours" value="{{$gym->opening_hours}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Phone Number</label>
    <input type="number" name="phone_number" value="{{$gym->phone_number}}" required class="form-control">
  </div>
  <div class="form-group">
    <label>Email Address</label>
    <input type="email" name="email" value="{{$gym->email}}" required class="form-control">
  </div>

  <?php
    use Illuminate\Support\Str;
    $instaUsername = Str::substr($gym->instagram, 26);
    
    $instaUsername= rtrim($instaUsername, '/');
    $facebookUsername = Str::substr($gym->facebook,25);
    $facebookUsername = rtrim ($facebookUsername, '/');
    
    ?>
   
  <div class="form-group">
    <label>Instagram Username</label>
    <input type="text" name="instagram" value="{{ $instaUsername}}" class="form-control">
  </div>
  <div class="form-group">
    <label>Facebook Username</label>
    <input type="text" name="facebook" value="{{ $facebookUsername }}" class="form-control">
  </div>

  <div class="form-group">
    <label>Logo</label>
    <input type="file" class="form-control-file" name="logo" class="form-control">
  </div>
  <div class="form-group">
    <label>Banner</label>
    <input type="file" class="form-control-file" name="banner" class="form-control">
  </div>

  <div class="form-group">
    <label>Additional Image</label>
    <input type="file" class="form-control-file" name="extra_image" class="form-control" >
  </div>

  
  
  <div class="form-group">
    <label>Latitude</label>
    <input type="text" name="latitude" value="{{ $gps->latitude }}" class="form-control">
  </div>

  <div class="form-group">
    <label>Longitude</label>
    <input type="text" name="longitude" value="{{  $gps->longitude  }}" class="form-control">
  </div>


  <button id="update-button" type= "submit" class="btn btn-info">Update </button> <br>
         
</form>
</div>



<div class="info-edit1">
<div class="card" style="width: 18rem; margin-bottom: 100px;">
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


        <div class="card" style="width: 18rem; margin-top:280px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        
                        <p class="card-text">Please enter a squared image (with equal width and height) for the logo. Please ensure that the banner is at least 1920x1080 pixels.</p>
                        
                    </div>
        </div>
        <div class="card" style="width: 35rem; margin-top:19px;">
            <div class="icon">
                <svg  xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"  class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </div>
                    <div class="card-body">
                        <!--the below instructions are from google maps documentation: https://support.google.com/maps/answer/18539?hl=en-GB&co=GENIE.Platform%3DDesktop  -->
                        <p class="card-text">In order to display your business on the map, please enter your latitude and longitude. This step is optional. 
                            <p class="card-text"> To get the coordinates for your business: </p>

                            <ul style=" font-size:20px;">
                                    <li> Open <a href= "https://www.google.com/maps" target="_blank" style="color:blue; text-decoration:underline;">Google Maps</a>.  </li>

                                    <li> Right-click the place or area on the map. </li>

                                    <li> This will open a pop-up window. You can find your latitude and longitude in decimal format at the top. </li>

                                    <li> To copy the coordinates automatically, left click on the latitude and longitude.</li></ul> </p>
                                    <p class="card-text">Alternatively, visit the following website <a href= "https://www.latlong.net/" target="_blank" style="color:blue; text-decoration:underline;">latlong.net</a> and follow the provided instructions to find your latitude and longitude.</p>
                       
                                    <p class="card-text">To format your coordinates so that they work in Google Maps, use decimal places in the following format: 
                                        <ul style=" font-size:20px;">
                                            <li>Correct: 41.40338, 2.17403 </li> 
                                             <li>Incorrect: 41,40338, 2,17403 </li> </ul></p>
                        
                    </div>
        </div>

        



</div>



</div>
</div>







@endsection
