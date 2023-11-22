
<!--I used bootstrap for the forms to register gym: https://getbootstrap.com/docs/5.0/forms/form-control/-->
<!--I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel -->
    <link rel="stylesheet" type="text/css" href="/getStarted.css"> 

 
<div class="container">
<div class="card-header">Edit Gym Details</div>
<form method="post" action="{{route('UpdateGym',  ['Gym_id' => $gym->Gym_id])}}" enctype="multipart/form-data">
@csrf
@method("patch")

    <div class="mb">
        <label class="label">Name of your Fitness Centre</label>
        <input type="text" name="name" value="{{$gym->name}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Location</label>
        <input type="text" name="location" value="{{$gym->location}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Opening Hours</label>
        <input type="text" name="opening_hours" value="{{$gym->opening_hours}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="number" name="phone_number" value="{{$gym->phone_number}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Email Adress</label>
        <input type="email" name="email" value="{{$gym->email}}" class="form-control" required>
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
        <textarea class="form-control" name="description" value="{{$gym->description}}" required rows="3"></textarea>
    </div>

    <div class="mb">
        <label class="label">Logo</label>
        <input type="file" name="logo" value="{{$gym->logo}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Banner</label>
        <input type="file" name="banner" value="{{$gym->banner}}" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Additional Image to be displayed on website</label>
        <input type="file" name="extra_image" value="{{$gym->extra_image}}" class="form-control" required>
    </div>
        <button type="submit">Update </button>
         
</form>
</div>
