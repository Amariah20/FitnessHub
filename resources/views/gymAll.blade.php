@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
<div class="gymAll">
NOTE: show ratings here too? allow people to filter according to ratings?
<form action="{{route('sortMembershipPrice')}}" method="get">
    <select class="sort_filter" name="sort">
    <option value="" disabled selected>Sort By Membersh Price</option>
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

        <select class="sort_filter" name="filter_location" >
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
<div class="gym_cards">

 <div class="gym_box_info">
    <div class="gym_info_left">
   <!--<h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> -->
   <h1>{{ $gym->name }}</h1>
   <h2>Location: {{$gym->general_location}}</h2>
    </div>
    <div class="gym_info_right">
   <button class="btn btn-dark"><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">View</a></button>
    </div>
</div>


</div>

    @endforeach
   
{{$gyms->links()}}
</div>

@endsection