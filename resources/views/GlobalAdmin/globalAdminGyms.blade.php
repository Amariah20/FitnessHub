@extends('layouts.globalAdmin')

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
@foreach($gyms as $gym)
    <ul>
        <li> <h1><a href="{{ route('reviewStatus', ['Gym_id' => $gym->Gym_id]) }}">{{ $gym->name }}</a></h1> </li>
        <p>New ratings: {{$gym->ratings->count()}}</p>
    </ul>
@endforeach
   


@endsection