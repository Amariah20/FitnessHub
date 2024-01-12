@extends('layouts.app')

@section('content')
@if (session('no_result'))
    <div class="alert alert-danger">
        {{ session('no_result') }}
    </div>
@endif
@foreach($gyms as $gym){
    <li>
        {{$gym->name}}
    </li>
}