@extends('layouts.app')

@section('content')

<!--code for star are from: https://codepen.io/hesguru/pen/BaybqXv -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--> <!--for the bookmark icon. from: https://www.w3schools.com/icons/tryit.asp?filename=trybs_ref_glyph_bookmark -->
    
  
 

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

@if(count($ratings)>0)
<div class="avg_rating">
    <?php $num=1;
        while($num<=$ratingsAverage){
            ?> <span>&#9733;</span>
            <?php $num++;} ?> 
 <a href=#reviews id="hyperlink">Reviews </a> 
</div> 
@endif

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

<div class="memberships">
<h4 class="sub-heading">Memberships</h4>

@foreach($memberships as $membership)
            <p class="membership_name">{{$membership->name}}</p>
            <p class="price">{{$membership->price}}</p> <!--change line color to gym's color*/-->
            <p class="item_description">{{$membership->description}}</p>
            <hr class="membership_line"> <!--change line color to gym's color*/-->
        @endforeach

</div>
 

<div class="classes_equipments">
    <div class="classes">
        @if($count>=1)
            @if($numOfclasses>=1 && $numOfofferings==0 )
            <h5 class ="view">View Our Classes </h5>
            <div class="learn_more_button">
                <button type="button" class="btn btn-danger" > <a href="{{ route('classesOfferings', ['Gym_id'=>$gym->Gym_id]) }}" class="learn_more">Learn More</a></button>
            </div>
            @elseif($numOfofferings>=1 && $numOfclasses==0)
            <h5 class ="view">View Our Services</h5>
            <div class="learn_more_button">
                <button type="button" class="btn btn-danger" > <a href="{{ route('classesOfferings', ['Gym_id'=>$gym->Gym_id]) }}" class="learn_more">Learn More</a></button>
            </div>
            @elseif($count>1)
            <h5 class ="view">View Our Classes & Services</h5>
            <div class="learn_more_button_both">
                <button type="button" class="btn btn-danger" > <a href="{{ route('classesOfferings', ['Gym_id'=>$gym->Gym_id]) }}" class="learn_more">Learn More</a></button>
            </div>
            @endif
           
            @endif
    </div>

    <div class="equipments">
        @if($numequipment>=1)
        <h5 class ="view">View Our Equipments</h5>
        <div class="learn_more_button_2">
            <button type="button" class="btn btn-danger"> <a href="{{ route('showEquipments', ['Gym_id'=>$gym->Gym_id]) }}" class="learn_more">Learn More</a></button>
       </div>
        @endif
    </div>
        
</div>



<h4 class="sub-heading" id="contact">Contact us</h4>
<div class="contact_split">
<div class="contact_form">

<form method="GET" action="{{ route('clientSendMail',['Gym_id' => $gym->Gym_id]) }}">
@csrf

                  
    <div class="mb">
        <input type="text" name="name" class="form-control" required placeholder="Name">
    </div>

    <div class="mb">
       <input type="email" name="email" class="form-control" required placeholder="Email Address">
    </div>

    <div class="mb">
        <input type="text" name="number" class="form-control" placeholder="Phone Number">
    </div>

    <div class="mb">
        <input type="text" name="subject" class="form-control" required placeholder="Subject of Email">
    </div>
 
    <div class="mb">
        <textarea class="form-control" name="message"  rows="3" required placeholder="Your Enquiry"></textarea>
    </div>
    <br>
    <button type="submit"  class="btn btn-success">Send Email</button>
</form>
    </div>

    <div class="contact_info">
        <div class="class_info_1">


    <li><svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
    </svg> {{$gym->phone_number}}</li>
    <li><svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
    </svg> {{$gym->email}}</li> 
    <li><svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
    </svg> {{$gym->instagram}}</li>
    <li><svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
    </svg> {{$gym->facebook}}</li>
        </div>
</div> 
</div>

<!--<p>MOVE THIS TO THE OTHER SIDE OF THE PAGE. HAVE A SPLIT SCREEN. ELSE IF IT'S BELOW, IT WILL SCROLL UP WHEN USER RATES</p>-->
 

<div class="subscribe">
    <form action="{{route('subscribe',['Gym_id' => $gym->Gym_id])}}" method="get">
        @csrf
        <h5 class="join">Join our mailing list and be the first to hear about our exciting offers!</h5>
        <input type="email" name="email" class="form-control" required placeholder="email@example.com">
        <br>
        <button type="submit" class="btn btn-dark">Subscribe</button>
    </form>
</div>


<hr class="review_line">
<div class="write_view_review">
    <div class="review_write_1">
        <h4 class="review_write">Write a Review</h4>
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
   
            <input class="form-control" name="review"  rows="3" required placeholder="Leave us a review!" style="height:100px; width:500px;"></input>
            </div><br>
            <input type="hidden" name="gym_id" value="{{$gym->Gym_id}}">
            <button type="submit"  class="btn btn-success">Post Review</button>
        </form>
    </div>





@if(count($ratings)>0)
<div class="reviews" id="reviews">
<h4 class="review_write">What Our Customers Say</h4>

    @foreach($ratings as $rating)

<!--9733 is the ascii code for star. set num=1, as long as num is less than the rating, add an extra star-->

<div class="ratings_by_customers">
<?php $num=1;
    while($num<=$rating->rating){
        ?> <span>&#9733;</span>
        <?php $num++;} ?>
    
</div>
    <li class="review_comment">{{$rating->review}}</li>
    <li>By: {{$rating->user->name}}</li>
    <hr class="rating_divide">
    @endforeach
</div>
@endif
</div>
</div>
</div>


</div>

    
   
<!--
<script>
    document.querySelectorAll('.rate input').forEach(function(star){
        star.addEventListener('click', function(event){
            event.preventDefault();
         
        });
    });
</script>-->
@endsection