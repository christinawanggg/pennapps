<!DOCTYPE html>
<html>
  <head>
    <title>Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      #map {
         width: 1100px;
        height: 800px;
      }
      #legend {
        position: fixed;
        bottom: 0px;
        left: 70px;
        z-index: 1;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #form_container {
        position: absolute;
        z-index: 10;
        display: none;
        width: 300px;
      }
      #custom {
        position: absolute;
        right: 200px;
        width: 200px;
        top: 300px;
      }
    </style>
  </head>
  <body>
    <img id="legend" src="Legend.png" alt="air quality legend" style="width: 260px; height: 306px;">><
    <div id="container">
      <div id="map"></div>
    </div>
    <script>
      "use strict";
      var googleMap = document.getElementById('map');
      var form = document.getElementById('form_container');
      var map;
      var mapsEvent;
      function initMap() {
        const myLatLng = {lat: 37.773972, lng: -122.431297}
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 8
        });
      }
      function drawCircle (lat, long, aqi) {
        const contentString =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "Heritage Site.</p>" +
          '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
          "https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
          "</div>" +
          "</div>";
          const infoWindow = new google.maps.InfoWindow({
          content: contentString
        });

        var color;
        //console.log(lat)
        if (aqi < 50) {
          color = "#3E815C"
        } else if (aqi < 100 && aqi > 51){
          color = "#EADD6E"
        } else if (aqi < 150 && aqi > 101){
          color = "#F8B385"
        } else if (aqi < 200 && aqi > 151){
          color = "#F43F35"
        } else if (aqi < 300 && aqi > 251){
          color = "#DABFDE"
        } else {
          color = "#632E34"
        }
        // add the circle for this city to the map
        const circle = new google.maps.Circle ({
          clickable: true,
          fillColor: color,
          fillOpacity: 1.0,
          radius : Math.sqrt(10000) * 100,
          strokeColor: color,
          strokeOpacity: 1.0,
          strokeWeight: 2,
          map,
          center: {lat: lat, lng:long}
        });
        google.maps.event.addListener(circle, 'click', function(ev){
          console.log("hi");
          infoWindow.setPosition(circle.getCenter());
          infoWindow.open(map);
        });
      }

      // Make request to fetch data.
      var http = new XMLHttpRequest();
      var url = 'https://api.waqi.info/map/bounds/';
      var api_key = 'b49a33f9e559aa5260b4423411c1b2b31e2eef56'
      var latlngbox = "28,-129,49,-70";
      http.open('POST', url + "?latlng=" + latlngbox + "&token=" + api_key, true);
      http.onreadystatechange = function() {//Call a function when the state changes.
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.response).data;
          data.forEach(datapoint => {
            drawCircle(datapoint.lat, datapoint.lon, datapoint.aqi)
            console.log(datapoint.aqi)
          });
        }
      }
      http.send();
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgxPi-s0nirteUxHlZB8rS1bHTKt89F0I&callback=initMap"async defer></script>
  </body>
</html>