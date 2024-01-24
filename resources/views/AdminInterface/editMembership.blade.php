@extends('layouts.adminPage')

@section('content')
<div class="container">
<div class="card-header">Edit Membership</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('UpdateMembership',  ['Membership_id' => $membership->membership_id])}}">
@csrf
@method("patch")

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" value="{{$membership->name}}" required>
    </div>
    <div class="mb">
        <label class="label">Price of Membership</label>
        <input type="number" name="price" class="form-control" value="{{$membership->price}}"  required>
    </div>
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <input class="form-control" name="description"  value="{{$membership->description}}" required></input>
    </div>
    <br>
    <div class="mb">
        <label class="label">Membership type</label>
        <select name="membership_type" >
            <option value="{{$membership->membership_type}}">{{$membership->membership_type}}</option>
            <option value ="annual">Annual</option>
            <option value ="monthly">Monthly</option>
            <option value ="weekly">Weekly</option>
            <option value ="daily">Daily</option>
        </select>
    </div>
    <br>

</div>

 
        <button type="submit">Update </button>

         
</form>
</div>
@endsection