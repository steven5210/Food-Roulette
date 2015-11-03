<!DOCTYPE html>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!--Import jQuery before materialize.js-->

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <script type="text/javascript">
   $(document).ready(function() {
      $('select').material_select();
    })
  </script>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        width: 500px;
        height: 400px;
      }
      .title {
        color: teal;
      }
    </style>
    <script>
var map;
var service;
var marker;
var pos;
var infowindow;

function initMap() {

    var mapOptions = {
        zoom: 15
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    console.log(map);

    // Try HTML5 geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            pos = new google.maps.LatLng(position.coords.latitude,
                                         position.coords.longitude);

            infowindow = new google.maps.InfoWindow({
                map: map,
                position: pos,
                content: 'Located'
            });

            map.setCenter(pos);

            var request = {
                location:pos,
                radius:500,
                types: ['restaurant']
            };

            infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request,callback);
        }), 
        function createMarker(place) {
      var placeLoc = place.geometry.location;
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
      });
    }
    function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {

                var picker = Math.random();
                if (picker < .2){
                  var lat = results[i].geometry.location.G;
                  var lng = results[i].geometry.location.K;
                  var center = new google.maps.LatLng(lat, lng);
                  map.panTo(center);
                  map.setZoom(15);
                  var marker = new google.maps.Marker({
                  position: center,
                  map: map,
                  title: 'Hello World!'
                });
                break;
                }

            }
        }
    }
}

}

    </script>
  </head>
  <body class='container'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxYMkW1x8Amd9tdxmHaPmF82h-LeGQ_iE&signed_in=true&libraries=places&callback=initMap" async defer></script>
    <h4 class='title'>Follow the map and directions to what you crave!</h4>
  <div id="map"></div>
  <a href="/index">Go Back</a>

  <div id="map" style="float:left;width:70%; height:100%"></div>
<div id="directionsPanel" style="float:right;width:30%;height 100%"></div>
  </body>
</html>