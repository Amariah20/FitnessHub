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
<div class="card-header">Add New Membership</div>
<form method="POST"  action="{{ route('AdminMembershipStore', ['Gym_id' => $Gym_id]) }}">
@csrf

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb">
        <label class="label">Price of Membership</label>
        <input type="number" name="price" class="form-control"  required>
    </div>
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <textarea class="form-control" name="description"  rows="3" required></textarea>
    </div>

        <button type="submit">Add </button>

         
</form>
</div>

@endSection