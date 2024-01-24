@extends('layouts.adminPage')

@section('content')
<h2>Memberships</h2>
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

  <a href="{{route('AdminAddMembership', ['Gym_id' => $Gym_id])}}"><button id="add" class="btn btn-success">Add New Membership</button></a>
 
<!--search-->

<div class="input-box">
<form method="GET" action="{{route ('searchMembership', ['Gym_id' => $Gym_id])}}" id="search" >
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
      <th scope="col">Type</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>
  </thead>

  <tbody>
  @foreach($memberships as $membership)
    <tr>
      
      <td>{{$membership->name}}</td>
      <td>{{$membership->description}}</td>
      <td>{{$membership->price}}</td>
      <td>{{$membership->membership_type}}</td>
      
      <td><a href="{{route('EditMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit" class="btn btn-info">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit" class="btn btn-danger">Delete</button></a></td>
    
    </tr>
 @endforeach
 </tbody>
 </table>
      
      
    



@endsection