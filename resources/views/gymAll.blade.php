@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
NOTE: show ratings here too? allow people to filter according to ratings?
<form action="{{route('sortMembershipPrice')}}" method="get">
    <select name="sort">
    <option value="" disabled selected>Sort By Membership Price</option>
        <option value="monthly-low">Monthly (Low to High)</option>
        <option value="monthly-high">Monthly (High to Low)</option>
        <option value="annual-low">Annual (Low to High)</option>
        <option value="annual-high">Annual (High to Low)</option>
        <option value="daily-low">Daily (Low to High)</option>
        <option value="daily-high">Daily (High to Low)</option>
        <option value="weekly-low">Weekly (Low to High)</option>
        <option value="weekly-high">Weekly (High to Low)</option>
    </select>
    <button type="submit">Sort</button>
</form>   

<form action="{{route('filterLocation')}}" method="get">

        <select name="filter_location" >
            <option value="" disabled selected>Filter By Location</option>
            <option value ="north">North</option>
            <option value ="east">East</option>
            <option value ="south">South</option>
            <option value ="west">West</option>
            <option value ="central">Central</option>
        </select>
    </select>
    <button type="submit">Apply Filter</button>
</form>   



@foreach($gyms as $gym)
<ul> 

   <li> <h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
   <!--<li> <h1><a href="/gymIndividual/{{$gym->slug}}">{{ $gym->name }}</a></h1> </li> -->
  <!-- <li> <h1><a href="{{ route('gymIndividual', $gym) }}">{{ $gym->name }}</a></h1> </li>-->
   Location: {{$gym->general_location}}
   
</ul> 
    @endforeach
   
{{$gyms->links()}}

@endsection