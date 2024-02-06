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
<div class="new-ratings-message">
@if($newRatings>0)
<div class="alert alert-danger">
        <p>New Reviews Awaiting Approval!</p>
    </div>
@endif
</div>

<div class="global_admin_gyms">
    <h1>Gym Reviews</h1>
<div class="row row-cols-1 row-cols-md-3 g-4">
@foreach($gyms as $gym) 

<div class="col">
    <div class="card border-secondary mb-3" style="width: 75%;">
            <div class="card-header">
            {{ $gym->name }}
            </div>
            <div class="card-body">
                
                <p class="card-text">New ratings: {{$gym->ratings->count()}}</p>
                <button class="btn btn-primary"> <a href="{{ route('reviewStatus', ['Gym_id' => $gym->Gym_id]) }}" class="card-link">View Review</a></button>
             </div>
    </div>
    </div>

   <!--
    <ul>
        <li> <h1><a href="{{ route('reviewStatus', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
        <p>New ratings: {{$gym->ratings->count()}}</p>
    </ul>-->
    
    
@endforeach
   
</div>

@endsection