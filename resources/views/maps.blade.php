@extends('layouts.app')

@section('content')
<!--@vite(['resources/sass/app.scss', 'resources/js/maps.js'])-->
<!--reference: https://developers.google.com/maps/documentation/javascript/overview#bootstrap_loader
https://www.youtube.com/watch?v=CaadLzrhDhQ&list=PLzz9vf6075V2MQCIkO8NybfQK5hx67cxG&index=2&ab_channel=WebDevMatics
https://developers.google.com/maps/documentation/javascript/places-->
<!--<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQdqqTKe1wfqWcre5mWru75IVS7KAGFE8"> </script>-->



<script>
     function initMap() {

        var aston = new google.maps.LatLng( 52.4862,-1.8881 );

            const map =  new google.maps.Map(document.getElementById('map'),{
                center: aston,  //aston uni
                zoom: 12
                //the stuff below are not working. deal with later
                //fullscreenControl:true,
                //zoomControl:true,
               // zoomControlOptions: {
                //    position: google.maps.ControlPosition.RIGHT_BOTTOM
               // }
            });



            //to see locations with icons: https://www.youtube.com/watch?v=uZH2rHJNv1s&list=PLzz9vf6075V2MQCIkO8NybfQK5hx67cxG&index=4&ab_channel=WebDevMatics 
            function createMarker(latlng, icn){
                var marker = new google.maps.Marker({
                position: latlng, 
                map: map,
                icon:icn,
                title: 'Hello' // this title must be the gym name from database
                });

            }
           

            var request = {
                location: aston, //aston uni
                radius: '1500',
                type: ['school']
            };

            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);

            function callback(results, status) {
               // console.log(results);
                
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        var place= results[i];
                        latlng = place.geometry.location; //will be replaced by values customers enter
                        icn = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; //idc about this. can have a random icon for every business. 
                        //icn= "{{asset('images/redicon.jpg')}}"
                        createMarker(latlng, icn);
                    }
                }
            }



            /*
            const locations = [
                {lat: 52.4785, lng: -1.8986}, //bcu
                {lat: 52.4777, lng:-1.9028}, //canalside

            ];

            locations.forEach(location=>{
                new google.maps.Marker({
                    position: location,
                    map: map
                });
            });*/

            
}

</script>

<div class="container">
    <div id="map" style= " height: 500px; width: 600px;">
        
    </div>
</div>




@endsection