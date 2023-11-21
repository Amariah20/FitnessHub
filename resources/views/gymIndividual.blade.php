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
    <li>Memberships: 
        @foreach($memberships as $membership)
            <p>{{$membership->name}}</p>
            <p>{{$membership->price}}</p>
            <p>{{$membership->description}}</p>
            <hr>
        @endforeach
    </li>
    
    <li>
    @if($count>=1)
        @if($count>1)
            <p>We have a variety of classes and services available</p>
        @elseif($numOfclasses==1)
            <p>View our Class</p>
        @elseif($numOfofferings==1)
            <p>View our Services</p>
        @endif
        <button type="submit"> <a href="{{ route('classesOfferings', ['Gym_id'=>$gym->Gym_id]) }}">Learn More</a></button>
    @endif
        
    </li>

    @if(($gym->logo || $gym->banner || $gym->extra_image >= 1)) 
    <li>Images:</li>
        <ul>
          
                <li>
                    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->logo) }}" alt="Logo">
                    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->banner) }}" alt="banner">
                    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->extra_image) }}" alt="extra image">
                </li>     
               
        </ul>
@endif
   
</ul>
    
    
    
    
   

@endsection