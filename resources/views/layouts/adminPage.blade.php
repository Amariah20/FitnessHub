<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=2.0"> <!--for responsive design-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!--I used this for help with designing admin interface: https://www.youtube.com/watch?v=CqzHZP252FM -->

    <link rel="stylesheet" type="text/css" href="admin.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <header class="header">
        <a href="">LOGO</a>

        <div class="logout" >
            <a href="" class="btn btn-primary">Log out</a>
        </div>
    </header>
    
    <aside>

    <ul>
        <li>
            <a href="{{ route('AdminClass', ['Gym_id' => $Gym_id]) }}">Classes</a>
        </li>
        <li>
            <a href="{{ route('AdminOffering', ['Gym_id' => $Gym_id]) }}">Offerings</a>
        </li>
        <li>
            <a href="{{ route('AdminMembership', ['Gym_id' => $Gym_id]) }}">Memberships</a>
        </li>
        <li>
            <a href="{{ route('AdminEquipment', ['Gym_id' => $Gym_id]) }}">Equipments</a>
        </li>
     
        <li>
            <a href="registerGym/getStarted">Add New Gym</a>
        </li>
    </ul>
    </aside>
    
    <div class="content">
    @yield('content') 
    </div>
</body>
<html>