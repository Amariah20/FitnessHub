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
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   
                    <img class="nav-logo" src="{{ asset('images/FitnessHubLogo.png') }}"  width="220" height="70">
                

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
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
                </div>
                <!--search bar-->
             <form method="GET" action="{{route('search')}}">
             <input type="text" placeholder="Find something" name="search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
             
             </form>
            </div>
        </nav>
       
        <!--this is to catch exceptions-->
        <main class="py-4">
         @if (isset($error))
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
        @endif
        
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
