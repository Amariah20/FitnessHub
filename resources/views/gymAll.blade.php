@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif

<div class="split left">
<div class= "gym_maps">
    <div class="gymss">
    <div class="gymAll">
    <!--<button class="btn btn-dark"><a href="{{ route('maps') }}">Map</a></button>-->
    <!--<a href=#maps id="hyperlink">Maps </a> -->

    <div class="form-sort">
    <form action="{{route('sortMembershipPrice')}}" method="get" class="sort_filter">
    <select  name="sort">
    <option value="" disabled selected>Sort By:</option>
        <option value="rating">Avg. Customer Rating</option>
        <option value="monthly-low">Monthly Membership Price: Low to High</option>
        <option value="monthly-high">Monthly Membership Price: High to Low</option>
        <option value="annual-low">Annual Membership Price: Low to High</option>
        <option value="annual-high">Annual Membership Price: High to Low</option>
        <option value="daily-low">Daily Membership Price: Low to High</option>
        <option value="daily-high">Daily Membership Price: High to Low</option>
        <option value="weekly-low">Weekly Membership Price: Low to High</option>
        <option value="weekly-high">Weekly Membership Price: High to Low</option>
       
       
    </select>
    <button type="submit" class="btn btn-dark">Sort</button>
    </form>   

    <form action="{{route('filterLocation')}}" method="get" class="sort_filter">

        <select name="filter_location" >
            <option value="" disabled selected>Filter By Location</option>
            <option value ="north">North</option>
            <option value ="east">East</option>
            <option value ="south">South</option>
            <option value ="west">West</option>
            <option value ="central">Central</option>
        </select>
        </select>
    <button type="submit" class="btn btn-dark">Filter</button>
</form>   <br>
<!--
<form action="{{'sortRating'}}" method="get" class="sort_filter">
    <select name="sort_rating">
    <option value="" disabled selected>Sort By Customer Reviews</option>
        <option value="rating-low">Low to High</option>
        <option value="rating-high">High to Low</option>
    </select>
    <button type="submit" class="btn btn-dark">Sort</button>

</form>-->


</div>



@foreach($gyms as $gym)
<div class="gym_cards">

 <div class="gym_box_info">
   <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->logo) }}" alt="Logo" style="width:120px; height:120px"  >

    <div class="gym_info_left">
        
   <!--<h1><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> -->
   <h1>{{ $gym->name }}</h1>
   <h2>Location: {{$gym->general_location}}</h2>
    </div>
    <div class="gym_info_right">
   <button class="btn btn-dark"><a href="{{ route('gymIndividual', ['Gym_id' => $gym->Gym_id]) }}">More Info</a></button>
    </div>
</div>


</div>
    

    @endforeach
</div>
   
{{$gyms->links()}}
</div>
</div>


<div class="split right">
    <div class="maps" id="maps" >
        <script type="text/javascript" src="{{asset('/maps.js') }}"></script>



        <div class="container">
            <div id="map" style= "height:1530px; width: 1000px; padding-left:0px;">
            </div>
    </div>
</div>
</div>
@endsection