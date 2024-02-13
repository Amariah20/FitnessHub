
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

        var aston = new google.maps.LatLng( 52.4862,-1.8881 ); //aston uni gps

        

            const map =  new google.maps.Map(document.getElementById('map'),{
                center: aston,  
                zoom: 12
                
            });

      

            locations.forEach (function(location){
                var lat = location.latitude;
                var lng = location.longitude;
                var title = location.name;
                var latlng = new google.maps.LatLng (lat, lng );
               // console.log (lat, lng, name);
                var icon = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; //idc about this. can have a random icon for every business. 
                createMarker (latlng, icon, title);
            });

            function createMarker(latlng, icon, title){
                var marker = new google.maps.Marker({
                position: latlng, 
                map: map,
                icon:icon,
                title: title // this title must be the gym name from database
                });

            }

           
            
     }

     