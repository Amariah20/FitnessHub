@extends('layouts.adminPage')

@section('content')



<h2>Offerings</h2>
@if (session('Success'))
    <h6 class="alert alert-success">{{ session('Success') }}</h6>
@endif

<a href="{{route('AdminAddOffering', ['Gym_id' => $Gym_id])}}"><button>Add New Offering</button></a>
<!--search-->
<form method="GET" action="{{route ('searchOffering', ['Gym_id' => $Gym_id])}}" >
                <input type="text" placeholder="Find something" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>  
</form>




<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Decription</th>
      <th scope="col">Price</th>
      <th scope="col">Edit</th>
      
    </tr>
  </thead>

  <tbody>
  @foreach($offering as $offerin) 
  
    <tr>
      
      <td>{{$offerin->name}}</td>
      <td>{{$offerin->description}}</td>
      <td>{{$offerin->price}}</td>
      
      <td><a href="{{route('EditOffering', ['Offering_id' => $offerin->offerings_id] )}}"><button type= "submit">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteOffering',['Offering_id' => $offerin->offerings_id])}}"><button type= "submit">Delete</button></a></td>
    </tr>
 @endforeach
 </tbody>
 </table>
      
      
    






@endsection