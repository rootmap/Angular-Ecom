<?php
include './cms/plugin.php';
$cms = new plugin();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Ticketchai|direction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
      function calculateRoute(from, to) {
        // Center initialized to Naples, Italy
        var myOptions = {
          zoom: 10,
          center: new google.maps.LatLng(40.84, 14.25),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: from,
          destination: to,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: mapObject,
                directions: response
              });
            }
            else
              $("#error").append("Unable to retrieve your route<br />");
          }
        );
      }

      $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
          $("#error").text("Your browser doesn't support the Geolocation API");
          return;
        }

        $("#from-link, #to-link").click(function(event) {
          event.preventDefault();
          var addressId = this.id.substring(0, this.id.indexOf("-"));

          navigator.geolocation.getCurrentPosition(function(position) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#" + addressId).val(results[0].formatted_address);
              else
                $("#error").append("Unable to retrieve your address<br />");
            });
          },
          function(positionError){
            $("#error").append("Error: " + positionError.message + "<br />");
          },
          {
            enableHighAccuracy: true,
            timeout: 10 * 1000 // 10 seconds
          });
        });

        $("#calculate-route").submit(function(event) {
          event.preventDefault();
          calculateRoute($("#from").val(), $("#to").val());
        });
      });
    </script>
    <style type="text/css">

      #map {
        max-width:100%;
        height: 400px;
        margin-top: 10px;
      }
    </style>
  </head>
  <body style="background: #FFFFFF url(tc-merchant-template/assets/img/patterns/gplay.png) repeat !important;">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>
  <div class="container" >

        <h1 class="text-center">GET EVENT LOCATION</h1>
        <form id="calculate-route" name="calculate-route" action="#" method="get">
          <div class="form-group label-floating success">
            <label for="from" class="control-label">From:</label>
            <input type="text" id="from" name="from"  class="form-control" >
            <a id="from-link" href="#" style="display: none">Get my position</a>
            <br />
          </div>
          <div class="form-group label-floating success">
              <label for="to" class="control-label">To:</label>
              <input type="text" id="to" name="to" required="required" class="form-control" >
              <a id="to-link" href="#" style="display: none">Get my position</a>
              <br />
           </div>
            
                <input type="submit" value="GET Direction" class="btn btn-raised btn-success btn-block btn-login waves-effect">
               
        </form>
<div>
    <div id="map"></div>
    <p id="error"></p>
</div>
</div>

  </body>
</html>