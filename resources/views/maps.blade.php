@extends('layouts.app')

@section('content')
@vite(['resources/sass/app.scss', 'resources/js/maps.js'])
<!--reference: https://developers.google.com/maps/documentation/javascript/overview#bootstrap_loader
https://www.youtube.com/watch?v=CaadLzrhDhQ&list=PLzz9vf6075V2MQCIkO8NybfQK5hx67cxG&index=2&ab_channel=WebDevMatics-->
<!--<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQdqqTKe1wfqWcre5mWru75IVS7KAGFE8"> </script>-->

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQdqqTKe1wfqWcre5mWru75IVS7KAGFE8&callback=initMap">
</script>

<script>
     function initMap() {
  const map =  new google.maps.Map(document.getElementById('map'),{
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

</script>



<div class="container">
    <div id="map" style= " height: 500px; width: 600px;">
        
    </div>
</div>

@endsection