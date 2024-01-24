@extends('layouts.adminPage')

@section('content')
<div class="container">
<div class="card-header">Edit Offering</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('UpdateEquipment',  ['Equipment_id' => $equipment->equipment_id])}}">
@csrf
@method("patch")

    <div class="mb">
        <label class="label">Name</label>
        <input type="text" name="name" class="form-control" value="{{$equipment->name}}" required>
    </div>
  
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <input class="form-control" name="description"   value="{{$equipment->description}}" required></input>
    </div>


</div>

 
        <button type="submit">Update </button>

</form>
<div>
@endsection