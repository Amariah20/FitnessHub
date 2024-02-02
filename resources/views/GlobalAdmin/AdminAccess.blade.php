@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class= "admin-access">
    <h1>User List</h1>

    <!--search-->
<!--<form method="GET" action="{{route ('searchUser')}}" >
                <input type="text" placeholder="Find something" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>  
</form>-->
<div class="input-box">
<form method="GET"  action="{{route ('searchUser')}}"  id="search" >
<input type="text" placeholder="Search this page" name="search" id="search-box" class="form-control">
   <button style="background: none; border:none;"><i class="fa fa-search"></i></button>  
    
 
</form>
</div>

<table class="table table-hover"> 
<thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Change Admin Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($user->is_admin)
                            <form method="POST" action="{{ route('revokeAdminAccess', $user) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('grantAdminAccess', $user) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Grant</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection