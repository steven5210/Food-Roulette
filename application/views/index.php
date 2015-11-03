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
      $('.modal-trigger').leanModal();
  });
   </script>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #restaurant_name {
    text-align: center;
    color: teal;
   }
   .title {
    color: #9ad3de;
   }
   #modal_no {
    color: red;
   }
   .food_but {
    color: red;
   }
   .rating, .location {
    text-align: center;
   }
   #res_rating, #res_location {
    text-align: center;
    color: red;
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
                document.getElementById('restaurant_name').innerHTML= results[i].name;
                document.getElementById('res_rating').innerHTML = results[i].rating;
                document.getElementById('res_location').innerHTML = results[i].vicinity;
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
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxYMkW1x8Amd9tdxmHaPmF82h-LeGQ_iE&signed_in=true&libraries=places&callback=initMap" async defer></script>
    <h1 class='title'>Feeling Hungry and Indecisive?</h1>
  <div class="input-field col s6">
        <input id="location" type="text">
        <label for="location">Location</label>
  </div>
  <!-- Modal Trigger -->
  <button data-target="modal1" class="btn modal-trigger"><a class='food_but' href="">Find me Food!</a></button>

  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 id='restaurant_name'>Your Random Restaurant</h4>
      <h5 class='rating'>Rating:</h5>
      <p id='res_rating'><p>
      <h5 class ='location'>Located At:</h5>
      <p id='res_location'></p>
      <!-- INSERT IMAGE -->
      <img src="">
    </div>
    <div class="modal-footer">
      <a href="/main" class="modal-action modal-close waves-effect waves-green btn-flat ">I'd Totally Eat There!</a>
       <a href="/main" class="modal-action modal-close waves-effect waves-green btn-flat ">Nope!</a>
    </div>
  </div>
  </body>
</html>