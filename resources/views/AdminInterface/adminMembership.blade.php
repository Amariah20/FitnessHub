@extends('layouts.adminPage')

@section('content')
<h2>Memberships</h2>
@if (session('Success'))
                <h6 class="alert alert-success">{{ session('Success') }}</h6>
 @endif

  <a href="{{route('AdminAddMembership', ['Gym_id' => $Gym_id])}}"><button>Add New Membership</button></a>


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
  @foreach($memberships as $membership)
    <tr>
      
      <td>{{$membership->name}}</td>
      <td>{{$membership->description}}</td>
      <td>{{$membership->price}}</td>
      
      <td><a href="{{route('EditMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit">Edit</button></a></td>
      <td><a href="{{route('DeleteMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit">Delete</button></a></td>
    <
    </tr>
 @endforeach
 </tbody>
 </table>
      
      
    



@endsection