@extends('layouts.adminPage')

@section('content')



<h2>Offerings</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
@if (session('Success'))
    <h6 class="alert alert-success">{{ session('Success') }}</h6>
@endif

<a href="{{route('AdminAddOffering', ['Gym_id' => $Gym_id])}}"><button id="add" class="btn btn-success">Add New Offering</button></a>
<!--search-->
<div class="input-box">
<form method="GET" action="{{route ('searchOffering', ['Gym_id' => $Gym_id])}}" id="search" >
<input type="text" placeholder="Find something" name="search" id="search-box" class="form-control">
   <button type="submit"><i class="fa fa-search"></i></button>  
  </div> 
</form>




<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Decription</th>
      <th scope="col">Price</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>

  <tbody>
  @foreach($offering as $offerin) 
  
    <tr>
      
      <td>{{$offerin->name}}</td>
      <td>{{$offerin->description}}</td>
      <td>{{$offerin->price}}</td>
      
      <td><a href="{{route('EditOffering', ['Offering_id' => $offerin->offerings_id] )}}"><button type= "submit" class="btn btn-info">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteOffering',['Offering_id' => $offerin->offerings_id])}}"><button type= "submit" class="btn btn-danger">Delete</button></a></td>
    </tr>
 @endforeach
 </tbody>
 </table>
      
      
    






@endsection