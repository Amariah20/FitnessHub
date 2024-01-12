@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif


<h1>Gym: {{$gym->name}}</h1>

<ul>
    <li>Description: {{$gym->description}} </li>
    <li>General Location: {{$gym->general_location}}</li>
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
            <p>View our Service</p>
        @endif
        <button type="submit"> <a href="{{ route('classesOfferings', ['Gym_id'=>$gym->Gym_id]) }}">Learn More</a></button>
    @endif
        
    </li>

    @if($numequipment>=1)
    <h5>View Our Equipments</h5>
    <button type="submit"> <a href="{{ route('showEquipments', ['Gym_id'=>$gym->Gym_id]) }}">Learn More</a></button>
    @endif

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

<h3>Contact us</h3>
<form method="GET" action="{{ route('clientSendMail',['Gym_id' => $gym->Gym_id]) }}">
@csrf

<div class="mb">
        <label class="label">Name</label>
        <input type="text" name="name" class="form-control" required placeholder="Please enter your name">
    </div>

    <div class="mb">
        <label class="label">Email Address</label>
        <input type="email" name="email" class="form-control" required placeholder="Please enter your email address">
    </div>

    <div class="mb">
        <label class="label">Phone Number</label>
        <input type="text" name="number" class="form-control" placeholder="Please enter your phone number">
    </div>

    <div class="mb">
        <label class="label">Subject of Email</label>
        <input type="text" name="subject" class="form-control" required placeholder="Briefly state the purpose of your email">
    </div>
 
       <div class="mb">
        <label class="label">Email Message</label>
        <textarea class="form-control" name="message"  rows="3" required placeholder="Please write your message"></textarea>
    </div>
    <br>
    <button type="submit">Send Email</button>
</form>

<form action="{{route('subscribe',['Gym_id' => $gym->Gym_id])}}" method="get">
    @csrf
<p>Join our mailing list and be the first to hear about our exciting offers</p>
<input type="email" name="email" class="form-control" required placeholder="email@example.com">

<button type="submit">Subscribe</button>
</form>
    
    
   

@endsection