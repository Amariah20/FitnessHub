@extends('layouts.adminPage')

@section('content')


<h2>Classes</h2>




@if (session('Success'))
                <h6 class="alert alert-success">{{ session('Success') }}</h6>
            @endif

<a href="{{route('AdminAddClass', ['Gym_id' => $Gym_id])}}"><button>Add New Class</button></a>
<!--search bar-->
<form method="GET" action="{{route ('searchClass', ['Gym_id' => $Gym_id])}}" >
                <input type="text" placeholder="Find something" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>  
</form>

<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Class Name</th>
      <th scope="col">Decription</th>
      <th scope="col">Location</th>
      <th scope="col">Schedule</th>
      <th scope="col">Duration</th>
      <th scope="col">Capacity</th>
      <th scope="col">Price</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>
  </thead>

  <tbody>
  @foreach($classes as $class)
    <tr>
      
      <td>{{$class->name}}</td>
      <td> {{$class->description}}</td>
      <td>{{$class->location}}</td>
      <td>{{$class->schedule}}</td>
      <td> {{$class->duration}}</td>
      <td>{{$class->capacity}}</td>
      <td> {{$class->price}}</td>
      <td><a href="{{route('EditClass', ['Class_id' => $class->Class_id] )}}"><button type= "submit">Edit</button></a></td>
   <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteClass', ['Class_id' => $class->Class_id] )}}"><button type="submit">Delete</button></a></td>
    </tr>
 @endforeach
 </tbody>
 </table>
@endsection
