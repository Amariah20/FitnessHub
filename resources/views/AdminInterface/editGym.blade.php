
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
    <link rel="stylesheet" type="text/css" href="/getStarted.css"> 

 
<div class="container">
<div class="card-header">Edit Gym Details</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('UpdateGym',  ['Gym_id' => $gym->Gym_id])}}" enctype="multipart/form-data">
@csrf
@method("patch")

    <div class="mb">
        <label class="label">Name of your Fitness Centre:</label>
        {{$gym->name}}
    </div>
    <div class="mb">
        <label class="label">Location</label>
        <input type="text" name="location" value="{{$gym->location}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Opening Hours</label>
        <input type="text" name="opening_hours" value="{{$gym->opening_hours}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="number" name="phone_number" value="{{$gym->phone_number}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Email Adress</label>
        <input type="email" name="email" value="{{$gym->email}}" required class="form-control">
    </div>
    <div class="mb">
        <label class="label">Instagram username</label>
        <input type="text" name="instagram" value="{{$gym->instagram}}" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Facebook Username</label>
        <input type="text" name="facebook" value="{{$gym->facebook}}" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Write a captivating description</label>
        <input class="form-control" name="description" value="{{$gym->description}}" required></input>
    </div>

    <div class="mb">
        <label class="label">Logo</label>

        <input type="file" name="logo" class="form-control">
        
    </div>
    <div class="mb">
        <label class="label">Banner</label>

        <input type="file" name="banner" class="form-control">
    </div>
    <div class="mb">
        <label class="label">Additional Image to be displayed on website</label>
        
        <input type="file" name="extra_image" class="form-control" >
    </div>
        <button type="submit">Update </button>
         
</form>
</div>
