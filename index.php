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
        bottom: 10px;
        left: 10px;
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

    <img id="legend" src="Legend.png" alt="air quality legend"><

    <div id="container">
      <div id="map"></div>
    </div>
     

    <script>
      var googleMap = document.getElementById('map');
      var form = document.getElementById('form_container');
      var map;
      var mapsEvent;
      var lat;
      var long;
      function initMap() {
        var myLatLng = {lat: 37.773972, lng: -122.431297}
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng, 
          zoom: 8
        });

        const contentString =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "</div>" +
          '<h1 id="firstHeading" class="firstHeading">Uluru</h1>' +
          '<div id="bodyContent">' +
          "<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large " +
          "sandstone rock formation in the southern part of the " +
          "Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) " +
          "south west of the nearest large town, Alice Springs; 450&#160;km " +
          "(280&#160;mi) by road. Kata Tjuta and Uluru are the two major " +
          "features of the Uluru - Kata Tjuta National Park. Uluru is " +
          "sacred to the Pitjantjatjara and Yankunytjatjara, the " +
          "Aboriginal people of the area. It has many springs, waterholes, " +
          "rock caves and ancient paintings. Uluru is listed as a World " +
          "Heritage Site.</p>" +
          '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
          "https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
          "(last visited June 22, 2009).</p>" +
          "</div>" +
          "</div>";

          const infowindow = new google.maps.InfoWindow({
          content: contentString

        });
        
             var circle = new google.maps.Circle({
              map,
              fillColor: "#82DEAC",
              fillOpacity: 1.0,
              radius : Math.sqrt(10000) * 100,
              strokeColor: "#82DEAC",
              strokeOpacity: 1.0,
              strokeWeight: 2,
              center: {
                lat: 38.5816,
                lng: -121.4944
              },
            });

             circle.addListener("click", () => {
              console.log("hi");
              // figure out why the info window is not opening
              infowindow.open(map, circle);
              console.log("helloooo");
             });

            // console.log(circle);
    
      }
  

    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgxPi-s0nirteUxHlZB8rS1bHTKt89F0I&callback=initMap"async defer></script>

  </body>
</html>

