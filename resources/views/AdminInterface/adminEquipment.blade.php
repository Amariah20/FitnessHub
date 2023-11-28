@extends('layouts.adminPage')

@section('content')



<h2>Offerings</h2>
@if (session('Success'))
    <h6 class="alert alert-success">{{ session('Success') }}</h6>
@endif

<a href="{{route('AdminAddEquipment', ['Gym_id' => $Gym_id])}}"><button>Add New Equipment</button></a>




<table class="table table-striped">
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
     
      
      <td><a href="{{route('EditEquipment', ['Equipment_id' => $equipment->equipment_id] )}}"><button type= "submit">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteEquipment',['Equipment_id' => $equipment->equipment_id])}}"><button type= "submit">Delete</button></a></td>
    </tr>
 @endforeach
 </tbody>
 </table>
@endsection