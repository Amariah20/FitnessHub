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
@if(session('success_class'))
    <div class="alert alert-success">
        {{ session('success_class') }}
    </div>
@endif


<div id="add-admin" class="container">
<div class="card-header">Add New Class</div>
<form method="POST" action="{{ route('AdminClassStore', ['Gym_id' => $Gym_id]) }}">
@csrf

<div class="form-group">
    <label>Class Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="form-group">
    <label>Class Location</label>
    <input type="text" name="location" class="form-control" required>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="description" required rows="3"></textarea>
</div>

<div class="form-group">
    <label>Schedule</label>
    <textarea class="form-control" name="schedule" required rows="3"></textarea>
</div>

<div class="form-group">
    <label>Capacity</label>
    <input type="number" name="capacity" class="form-control" required>
</div>

<div class="form-group">
    <label>Duration (in minutes)</label>
    <input type="number" name="duration" class="form-control" required>
</div>

<div class="form-group">
    <label>Price</label>
    <input type="number" name="price" class="form-control" required>
</div>

<button id="add-info-button" class="btn btn-success" type="submit">Add</button>
         <br>
</form>
</div>

<!--
    <div class="mb">
        <label class="label">Class Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Class Location</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Description</label>
        <textarea class="form-control" name="description" required rows="3"></textarea>
    </div>
    <div class="mb">
        <label class="label">Schedule</label>
        <textarea class="form-control" name="schedule" required rows="3"></textarea>
    </div>
    <div class="mb">
        <label class="label">Capacity</label>
        <input type="number" name="capacity" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Duration (in minutes)</label>
        <input type="number" name="duration" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Price</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    
        <button type="submit">Add</button>
         
</form>
</div>-->

@endSection