@extends('layouts.app')

@section('content')

<!--code for star are from: https://codepen.io/hesguru/pen/BaybqXv -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!--for the bookmark icon. from: https://www.w3schools.com/icons/tryit.asp?filename=trybs_ref_glyph_bookmark -->

<div class="banner">
    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->banner) }}" alt="banner" style="width:100%; height:600px">
</div>
<div class="gym_logo">
    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->logo) }}" alt="Logo"  >

</div>
   
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

<div class="gym_info">
<h1 class="gym_name">{{$gym->name}}</h1>

<form method= "post" action="{{route('storeFavGym')}}" >
@csrf
<input type="hidden"  name="gym_id" value="{{$gym->Gym_id}}">
<button type="submit" class="btn btn-default btn-sm" id="bookmark">
        <span class="glyphicon glyphicon-bookmark"></span> Bookmark
</button>

</form>
<br>
<!--I used this for help with the stars rating: https://www.youtube.com/watch?v=2JUoZGoJwCg&t=749s&ab_channel=StackDevelopers -->

<div class="avg_rating">
    <?php $num=1;
        while($num<=$ratingsAverage){
            ?> <span>&#9733;</span>
            <?php $num++;} ?> 
 <a href=#reviews id="hyperlink">Reviews </a> 
</div> 


<div class="description">
 <!--<h4 class="sub-heading">Description</h4>-->
 <p>{{$gym->description}}</p>
</div>


<div class="location_img">
    <div class="location_hours">
        <h4 class="sub-heading">Location</h4>
    <ul class="location">    
      <li>  {{$gym->location}} </li>
      <li>  {{$gym->general_location}} </li>
    </ul>

    <h4 class="sub-heading">Opening Hours</h4>
    <div class= "hours">
        <!--explode function splits opening_hours into array based on '.'
        each item between '.' is placed in its own array index. then foreach loop 
        goes through array and displays each index in a sepate <p> tag. -->
        @foreach(explode('.', $gym->opening_hours) as $hour)
            <p> {{trim($hour)}}</p>
        @endforeach
    </div>
    <!--<p class="hours"> {{$gym-> opening_hours}} </p>-->
</div>

<div class="extra_img">
    <img src="{{ asset('public/images/uploaded/gym_' . $gym->user_id.$gym->name . '/' . $gym->extra_image) }}" alt="extra image" >
</div>
</div>




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
    <p>MOVE THIS TO THE OTHER SIDE OF THE PAGE. HAVE A SPLIT SCREEN. ELSE IF IT'S BELOW, IT WILL SCROLL UP WHEN USER RATES</p>
    <h3>Write a Review</h3>
<form action="{{route('storeRating')}}" method="POST" id="ratingForm">
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
    <button type="submit" >Post Review</button>
</form>
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

@if(count($ratings)>0)
<div class="reviews" id="reviews">
<h4>Reviews</h4>

    @foreach($ratings as $rating)
<div>
<!--9733 is the ascii code for star. set num=1, as long as num is less than the rating, add an extra star-->

<?php $num=1;
    while($num<=$rating->rating){
        ?> <span>&#9733;</span>
        <?php $num++;} ?>
    

    <p>{{$rating->review}}</p>
    <p>By: {{$rating->user->name}}</p>
    @endforeach
</div>
@endif
</div>

<form action="{{route('subscribe',['Gym_id' => $gym->Gym_id])}}" method="get">
    @csrf
<p>Join our mailing list and be the first to hear about our exciting offers</p>
<input type="email" name="email" class="form-control" required placeholder="email@example.com">

<button type="submit">Subscribe</button>
</form>
</div>
    
   

@endsection