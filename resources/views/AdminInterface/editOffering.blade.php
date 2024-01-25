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
<div class="card-header">Edit Offering</div>

<form method="POST" action="{{route('UpdateOffering',  ['Offering_id' => $offering->offerings_id])}}">
@csrf
@method("patch")
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{$offering->name}}" required>
  </div>

  <div class="form-group">
    <label>Price</label>
    <input type="number" name="price" class="form-control"  value="{{$offering->price}}"  required>
  </div>

  <div class="form-group">
    <label>Description</label>
    <input class="form-control" name="description"   value="{{$offering->description}}" required></input>
  </div>
  <button id="update-button" type= "submit" class="btn btn-info">Update </button> <br>
         
         </form>
        </div>

  <!--
    <div class="mb">
        <label class="label">Name</label>
        <input type="text" name="name" class="form-control" value="{{$offering->name}}" required>
    </div>
    <div class="mb">
        <label class="label">Price</label>
        <input type="number" name="price" class="form-control"  value="{{$offering->price}}"  required>
    </div>
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <input class="form-control" name="description"   value="{{$offering->description}}" required></input>
    </div>


</div>

 
        <button type="submit">Update </button>

</form>
<div> -->
@endsection