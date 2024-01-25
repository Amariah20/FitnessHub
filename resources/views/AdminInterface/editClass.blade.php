@extends('layouts.adminPage')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
<div id="edit" class="container">
<div class="card-header">Edit Class</div>

<form method="POST" action="{{route('UpdateClass',  ['Class_id' => $class->Class_id])}}">
@csrf
@method("patch")


<div class="form-group">
    <label>Class Name</label>
    <input type="text" name="name" class="form-control" value="{{$class->name}}" required>
</div>

<div class="form-group">
    <label>Class Location</label>
    <input type="text" name="location" class="form-control"  value="{{$class->location}}"  required>
</div>

<div class="form-group">
    <label>Description</label>
    <input class="form-control" name="description"  value="{{$class->description}}" required></input>
</div>

<div class="form-group">
    <label>Schedule</label>
    <input class="form-control" name="schedule"  value="{{$class->schedule}}" required></input>
</div>

<div class="form-group">
    <label>Capacity</label>
    <input type="number" name="capacity" class="form-control"  value="{{$class->capacity}}"  required>
</div>

<div class="form-group">
    <label>Duration (in minutes)</label>
    <input type="number" name="duration" class="form-control"  value="{{$class->duration}}"  required>
</div>

<div class="form-group">
    <label>Price</label>
    <input type="number" name="price" class="form-control"  value="{{$class->price}}"  required>
</div>

<button id="update-button" type= "submit" class="btn btn-info">Update </button> <br>
         
         </form>
         </div>

<!--    <div class="mb">
        <label color="black" class="label">Class Name</label>
        <input type="text" name="name" class="form-control" value="{{$class->name}}" required>
    </div>
    <div class="mb">
        <label class="label">Class Location</label>
        <input type="text" name="location" class="form-control"  value="{{$class->location}}"  required>
    </div>
    <div class="mb">
        <label class="label">Description</label>
        <input class="form-control" name="description"  value="{{$class->description}}" required></input>
    </div>
    <div class="mb">
        <label class="label">Schedule</label>
        <input class="form-control" name="schedule"  value="{{$class->schedule}}" required></input>
    </div>
    <div class="mb">
        <label class="label">Capacity</label>
        <input type="number" name="capacity" class="form-control"  value="{{$class->capacity}}"  required>
    </div>
    <div class="mb">
        <label class="label">Duration (in minutes)</label>
        <input type="number" name="duration" class="form-control"  value="{{$class->duration}}"  required>
    </div>
    <div class="mb">
        <label class="label">Price</label>
        <input type="number" name="price" class="form-control"  value="{{$class->price}}"  required>
    </div> 
    

    
    
        <button type="submit">Update</button>
         
</form>
</div> -->

@endsection