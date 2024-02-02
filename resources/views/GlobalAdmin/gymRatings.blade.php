@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method= "POST" action= "{{route('approveStatus' )}}">
@csrf
<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Review</th>
      <th scope="col">Rating</th>
      <th scope="col">Approved</th>
      <th scope="col">Change Review Status</th>
     
     
      
    </tr>
  </thead>

  <tbody>
  @foreach($ratings as $rating)
    <tr>
      
      <td>{{$rating->review}}</td>
      <td>{{$rating->rating}}</td>
      <td>

      
        <select name="approved" >
            <option value="{{$rating->approved}}" disabled selected>{{$rating->approved}}</option>
            <option value ="approved">Approved</option>
            <option value ="declined">Declined</option>
        </select>
    </div>
      </td>
     
      <td><button type= "submit" name="rating_id" value="{{$rating->rating_id}}">Update</button></a></td>
      
    </tr>
 @endforeach
 </tbody>
 </table>
</form>
      
      
@endsection