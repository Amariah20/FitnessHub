@extends('layouts.app')

@section('content')
<!--code for star are from: https://codepen.io/hesguru/pen/BaybqXv -->

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

@if($ratings)
<h4>Reviews</h4>
<ul>
    @foreach($ratings as $rating)

    <li>{{$rating->review}}</li>
    <li>{{$rating->rating}}</li>
    @endforeach
</ul>
@endif
<h3>Write a Review</h3>
<form action="{{route('storeRating')}}" method="POST">
@csrf
<div class="rate" name="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
<div class="mb">
        
<input class="form-control" name="review"  rows="3" required placeholder="Leave us a review!"></input>
    </div>
<input type="hidden" name="gym_id" value="{{$gym->Gym_id}}">
    <button type="submit">Post Review</button>
</form>

<form action="{{route('subscribe',['Gym_id' => $gym->Gym_id])}}" method="get">
    @csrf
<p>Join our mailing list and be the first to hear about our exciting offers</p>
<input type="email" name="email" class="form-control" required placeholder="email@example.com">

<button type="submit">Subscribe</button>
</form>
    
    
   

@endsection