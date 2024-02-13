@extends('layouts.app')

@section('content')
<!--@vite(['resources/sass/app.scss', 'resources/js/maps.js'])-->
<!--reference: https://developers.google.com/maps/documentation/javascript/overview#bootstrap_loader
https://www.youtube.com/watch?v=CaadLzrhDhQ&list=PLzz9vf6075V2MQCIkO8NybfQK5hx67cxG&index=2&ab_channel=WebDevMatics
https://developers.google.com/maps/documentation/javascript/places-->
<!--<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQdqqTKe1wfqWcre5mWru75IVS7KAGFE8"> </script>-->

<script type="text/javascript" src="{{asset('/maps.js') }}"></script>



<div class="container">
    <div id="map" style= " height: 500px; width: 600px;">
        
    </div>
</div>




@endsection