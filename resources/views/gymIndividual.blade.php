@extends('layouts.app')

@section('content')
<h1>Gym: {{$gym->name}}</h1>

<ul>
    <li>Description: {{$gym->description}} </li>
    <li>Location: {{$gym->location}}</li>
    <li>Opening Hours: {{$gym-> opening_hours}}</li>
    <li>Phone Number: {{$gym->phone_number}}</li>
    <li>Email: {{$gym->email}}</li>
    <li>Instagram: {{$gym->instagram}}</li>
    <li>Facebook: {{$gym->facebook}}</li>
   
</ul>
    
    note:need to find a way to add and display pics
    
    
   

@endsection