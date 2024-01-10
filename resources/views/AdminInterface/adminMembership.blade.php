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

  <a href="{{route('AdminAddMembership', ['Gym_id' => $Gym_id])}}"><button>Add New Membership</button></a>
 
<!--search-->

<form method="GET" action="{{route ('searchMembership', ['Gym_id' => $Gym_id])}}" >
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
  @foreach($memberships as $membership)
    <tr>
      
      <td>{{$membership->name}}</td>
      <td>{{$membership->description}}</td>
      <td>{{$membership->price}}</td>
      
      <td><a href="{{route('EditMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit">Edit</button></a></td>
      <td><a onclick="return confirm('Are you sure you want to delete?')" href="{{route('DeleteMembership', ['Membership_id' => $membership->membership_id] )}}"><button type= "submit">Delete</button></a></td>
    <
    </tr>
 @endforeach
 </tbody>
 </table>
      
      
    



@endsection