@extends('layouts.app')

@section('content')
<!--reference: https://www.youtube.com/watch?v=FkibP9Wnreo&ab_channel=AndrewSchmelyun-->

<script>


import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key:'AIzaSyDQdqqTKe1wfqWcre5mWru75IVS7KAGFE8'
    }
});

const app = new Vue({
    el: '#app',
});
</script>
<!--@vite(['resources/sass/app.scss', 'resources/js/maps.js'])-->
<div class="map" id="app">
    <gmap-map
        :center= "{lat:10, lng:10}"
        :zoom= "8"
        style= "width: 500px; height:320px;"
    ></gmap-map>


</div>
@endsection