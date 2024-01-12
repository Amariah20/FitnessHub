@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
NOTE: Figure out which piece of info to display here in addition to gym name. what's most important for customers?
<form action="{{route('sortMembershipPrice')}}" method="get">
<label class="label">Sort By Membership Price</label>
    <select name="sort">
        <option value="monthly-low">Monthly (Low to High)</option>
        <option value="monthly-high">Monthly (High to Low)</option>
        <option value="annual-low">Annual (Low to High)</option>
        <option value="annual-high">Annual (High to Low)</option>
        <option value="daily-low">Daily (Low to High)</option>
        <option value="daily-high">Daily (High to Low)</option>
        <option value="weekly-low">Weekly (Low to High)</option>
        <option value="weekly-high">Weekly (High to Low)</option>
    </select>
    <button type="submit">Apply Filter</button>
</form>   
@foreach($gyms as $gym)
<ul> 

   <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
   <!--<li> <h1><a href="/gymIndividual/{{$gym->slug}}">{{ $gym->name }}</a></h1> </li> -->
  <!-- <li> <h1><a href="{{ route('gymIndividual', $gym) }}">{{ $gym->name }}</a></h1> </li>-->
   Location: {{$gym->location}}
   
</ul> 
    @endforeach
   


@endsection()