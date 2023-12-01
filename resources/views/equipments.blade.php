@extends('layouts.app')

@section('content')
@foreach($equipments as $equipment)
 <li>{{$equipment->name}}</li>
 <li>{{$equipment->description}}</li>
 <hr>

@endforeach

@endsection