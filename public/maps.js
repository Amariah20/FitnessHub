//Used google maps documentation for all things maps related: https://developers.google.com/maps/documentation/javascript/controls#maps_control_disableUI-javascript 
//ajax request to get locations from server (from gps controller)
fetch('/locations')
.then(response=>response.json())
.then(locations=>{
    console.log(locations);
    initMap(locations);
})

    //var locations = {!!json_encode($locations)!!};  //passes $locations (data from php backend) to js code so i can use it.
    //console.log (locations);

     //function initMap() {
    function initMap(locations) {

       //var aston = new google.maps.LatLng( 52.4862,-1.8881 ); //aston uni gps. Change this to Victoria seychelles
        var victoria = new google.maps.LatLng(-4.623540, 55.452492);
        

            const map =  new google.maps.Map(document.getElementById('map'),{
                center: victoria,  
                zoom: 14,
                mapTypeControl: true,
                mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER,
                },
                zoomControl: true,
                zoomControlOptions: {
                  position: google.maps.ControlPosition.LEFT_TOP,
                },
                scaleControl: true,
                streetViewControl: true,
                streetViewControlOptions: {
                  position: google.maps.ControlPosition.RIGHT_TOP,
                },

                
            });

      

            locations.forEach (function(location){
                var lat = location.latitude;
                var lng = location.longitude;
                var title = location.name;
                var latlng = new google.maps.LatLng (lat, lng );
               // console.log (lat, lng, name);
                var icon = { 
                    url:'https://maps.google.com/mapfiles/ms/icons/red-dot.png', //https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png
                    scaledSize: new google.maps.Size(60,60)
                };
                
                createMarker (latlng, icon, title);
            });

            function createMarker(latlng, icon, title){
              //var marker = new google.maps.Marker({
                var marker = new google.maps.marker({
                position: latlng, 
                map: map,
                icon:icon,
                //label: ,

                title: title // this title must be the gym name from database. //change this to url that is within your page. 
                });

            

                  marker.addListener('click', function() { // used stackoverflow for help with this function: https://stackoverflow.com/questions/8769966/google-maps-api-open-url-by-clicking-on-marker 
                //window.location.href = 'https://www.google.com/maps/search/?api=1&query='+lat+','+lng;
                var googleMaps= 'https://www.google.com/maps/search/?api=1&query='+latlng.lat()+','+latlng.lng();
                window.open(googleMaps, '_blank');
            });

            }

          

           
            
     }

     