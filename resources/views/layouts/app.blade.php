<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=2.0"> <!--for responsive design-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Fitness Hub</title>

    <!--css-->
    <link rel="stylesheet" type="text/css" href="/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
 

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!--for the bookmark icon. from: https://www.w3schools.com/icons/tryit.asp?filename=trybs_ref_glyph_bookmark -->

    <!--<script src="/gymIndividualJS.js"></script>-->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>


    <div id="app">
        

   
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/gymAll') }}">
                   
                    <img class="nav-logo" src="{{ asset('images/FitnessHubLogo.png') }}"  width="220" height="70">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                @if(auth()->user()?->email == 'globaladmin@gmail.com')
                 <p><a href="{{route('AdminAccess')}}">All Users</p> 
                 <p><a href="{{route('globalAdminGyms')}}">Ratings</p>
            @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                <div class="nav_right">
                    <ul class="navbar-nav ms-auto">
                        
                    
               
                             
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" 
                                    style="font-size: 22px; font-family: 'Trebuchet MS', Helvetica, sans-serif; color: black;"
                                    onmouseover="this.style.backgroundColor='#c7c8ca'"
                                    onmouseout="this.style.backgroundColor='transparent'" 
                                     href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" 
                                    style="font-size: 22px; font-family: 'Trebuchet MS', Helvetica, sans-serif; color: black;"
                                    onmouseover="this.style.backgroundColor='#c7c8ca'"
                                    onmouseout="this.style.backgroundColor='transparent'" 
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
               

                <!--search bar-->
            
                <div class="input-box">
                    <form method="GET"  action="{{route('search')}}" >
                    <input type="text" placeholder="Search this page" name="search" id="search-box" class="form-control">
                    <button style="background: none; border:none;"><i class="fa fa-search"></i></button>  
                    
                    </form>
            </div>
             
            
            
             <div class = "user-profile">
         <a href="{{ route('userProfile') }}"  ><svg  xmlns="http://www.w3.org/2000/svg" width="40" height="40" color="black" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg></a>
    </div>

    
        @if(auth()->check())
         @if(auth()->user()->is_admin && Route::currentRouteName() !== 'AdminFirst')
         <div class="admin-panel-button">
             <button class="btn btn-dark"><a href="{{ route('AdminFirst')}}">Admin Panel</a></button>
         </div>
         
         @endif
         @endif
       
       
       
    

                 
         </div>
       </div>
        </nav>
       
        <!--this is to catch exceptions-->
        <main class="py-4">
        
        
            @yield('content')
        </main>
    </div>
</body>
<br><br><br><br><br><br><br><br><br><br>
<!--footer-->
<footer class="footer">
<a href="{{ url('/') }}"><img class="footer-left" src="{{ asset('images/SmallLogo.png') }}"  ></a>

<a class="footer-middle" href="{{ url('/AboutUs') }}">About Us</a> 

<div class="socialmedia">
    <a href="https://www.instagram.com/gymshark/"><img  src="{{asset('images/instagram.jpg')}}"></a>
    <a href="https://www.facebook.com/Gymshark/"><img src="{{asset('images/facebook.jpg')}}"></a>
    <a href="https://www.linkedin.com/company/gymshark/?originalSubdomain=uk"><img src="{{asset('images/linkedin.jpg')}}"></a>

</div>
<p style="font-size: medium; text-align:center;">© 2023 | Fitness Hub | All Rights Reserved</p>




</footer>
</html>
