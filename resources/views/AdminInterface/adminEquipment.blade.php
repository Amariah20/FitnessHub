@extends('layouts.adminPage')

@section('content')



<h2>Equipments</h2>
@if (session('Success'))
    <h6 class="alert alert-success">{{ session('Success') }}</h6>
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

<a href="{{route('AdminAddEquipment', ['Gym_id' => $Gym_id])}}"><button id="add" class="btn btn-success">Add New Equipment</button></a>
<!--search-->
<div class="input-box">
<form method="GET" action="{{route ('searchEquipment', ['Gym_id' => $Gym_id])}}" id="search" >
<input type="text" placeholder="Find something" name="search" id="search-box" class="form-control">
   <button type="submit"><i class="fa fa-search"></i></button>  
  </div>
</form>




<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Decription</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>
  </thead>

  <tbody>
  @foreach($equipments as $equipment) 
  
    <tr>
      
      <td>{{$equipment->name}}</td>
      <td>{{$equipment->description}}</td>
     
      
      <td><a href="{{route('EditEquipment', ['Equipment_id' => $equipment->equipment_id] )}}"><button type= "submit" class="btn btn-info">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteEquipment',['Equipment_id' => $equipment->equipment_id])}}"><button type= "submit" class="btn btn-danger">Delete</button></a></td>
    </tr>
 @endforeach
 </tbody>
 </table>
@endsection