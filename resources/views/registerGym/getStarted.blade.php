@extends('layouts.app')

@section('content')


<!--I used this for help with splitting the screen in two: https://www.w3schools.com/howto/howto_css_split_screen.asp -->
<link rel="stylesheet" type="text/css" href="/getStarted.css"> 
<div class= "bannerlogo_instructions">
<div class="bannerlogo">
<div class="split left">
    
    <img class="logo" src="{{ asset('images/SmallLogo.png') }}">
    <p class="banner">It's easy to get started on</p>
    <p class= "banner"> Fitness Hub</p>
</div>
</div>
<div class="instructions">
<div class="split right">
    
    <div class= "container"> 
        
        <!-- <img class="gympic" src="{{ asset('images/gym.png') }}">-->
        <h1 class="heading">1. Introduce Your Centre</h1>
        <p>Share essential details like name, location, opening hours, a captivating description and your images</p>
        
        
        <!--<img class="gympic" src="{{ asset('images/gym 1.png') }}">-->
        <h1 class="heading">2. Highlight Your Offerings</h1>
        <p>Showcase the diverse range of memberships, classes, services and equipments your fitness centre offers</p>
       
        
       
    </div>
</div>
</div>
   
    

  
    <form action="{{ route('gyms.create') }}" method="GET">
    <button type="submit">Get Started</button>

    
</form>




@endsection
