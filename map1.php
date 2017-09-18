<?php
include './cms/plugin.php';
$cms = new plugin();
?>

<!DOCTYPE html>
<!--<html>
    <head>
        <meta charset="UTF-8" />
        <title>Ticketchai|direction</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            var directionDisplay, map;
            var directionsService = new google.maps.DirectionsService();
            var geocoder = new google.maps.Geocoder();

            function initialize() {
                // set the default center of the map
                var latlng = new google.maps.LatLng(23.685, 90.3563);
                // set route options (draggable means you can alter/drag the route in the map)
                var rendererOptions = {draggable: true};
                directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
                // set the display options for the map
                var myOptions = {
                    zoom: 11,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true
                };
                // add the map to the map placeholder
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                // bind the map to the directions
                directionsDisplay.setMap(map);
                // point the directions to the container for the direction details
                directionsDisplay.setPanel(document.getElementById("directionsPanel"));
                // start the geolocation API
                if (navigator.geolocation) {
                    // when geolocation is available on your device, run this function
                    navigator.geolocation.getCurrentPosition(foundYou, notFound);
                } else {
                    // when no geolocation is available, alert this message
                    alert('Geolocation not supported or not enabled.');
                }
            }


            function foundYou(position) {
                // convert the position returned by the geolocation API to a google coordinate object
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                // then try to reverse geocode the location to return a human-readable address
                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        // if the geolocation was recognized and an address was found
                        if (results[0]) {
                            // add a marker to the map on the geolocated point
                            marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            // compose a string with the address parts
                            var address = results[0].address_components[1].long_name + ' ' + results[0].address_components[0].long_name + ', ' + results[0].address_components[3].long_name
                            // set the located address to the link, show the link and add a click event handler
                            $('.autoLink span').html(address).parent().show().click(function () {
                                // onclick, set the geocoded address to the start-point formfield
                                $('#routeStart').val(address);
                                // call the calcRoute function to start calculating the route
                                calcRoute();
                            });
                        }
                    } else {
                        // if the address couldn't be determined, alert and error with the status message
                        alert("Geocoder failed due to: " + status);
                    }
                });
            }


            function calcRoute() {
                // get the travelmode, startpoint and via point from the form  
                var travelMode = $('input[name="travelMode"]:checked').val();
                var start = $("#routeStart").val();
                var end = $("#routeEnd").val();
                // compose a array with options for the directions/route request
                var request = {
                    origin: start,
                    destination: end,
                    unitSystem: google.maps.UnitSystem.IMPERIAL,
                    travelMode: google.maps.DirectionsTravelMode[travelMode]
                };
                // call the directions API
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        // directions returned by the API, clear the directions panel before adding new directions
                        $('#directionsPanel').empty();
                        // display the direction details in the container
                        directionsDisplay.setDirections(response);
                    } else {
                        // alert an error message when the route could nog be calculated.
                        if (status == 'ZERO_RESULTS') {
                            alert('No route could be found between the origin and destination.');
                        } else if (status == 'UNKNOWN_ERROR') {
                            alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
                        } else if (status == 'REQUEST_DENIED') {
                            alert('This webpage is not allowed to use the directions service.');
                        } else if (status == 'OVER_QUERY_LIMIT') {
                            alert('The webpage has gone over the requests limit in too short a period of time.');
                        } else if (status == 'NOT_FOUND') {
                            alert('At least one of the origin, destination, or waypoints could not be geocoded.');
                        } else if (status == 'INVALID_REQUEST') {
                            alert('The DirectionsRequest provided was invalid.');
                        } else {
                            alert("There was an unknown error in your request. Requeststatus: nn" + status);
                        }
                    }
                });
            }




        </script>

    </head>

    <body style="background: #FFFFFF url(tc-merchant-template/assets/img/patterns/gplay.png) repeat !important;" onLoad="initialize()">
        page loader
        <div class="se-pre-con"></div>
        page loader
        <div class="container" >

            <h1 class="text-center">GET EVENT LOCATION</h1>
            <form action="#" onSubmit="calcRoute();
                    return false;" id="routeForm">
                <div class="form-group label-floating success">
                    <label for="from" class="control-label">From:</label>
                    <input type="text" id="routeStart" value="" class="form-control" required="required" >
                    <a id="from-link" href="#" style="display: none">Get my position</a>
                </div>
                <div class="form-group label-floating success">
                    <label for="to" class="control-label">To:</label>
                    <input  <input type="text" id="routeEnd" value="<?php //echo $vanue = $_GET['venue'] . ' ,bangladesh';  ?>"  class="form-control" >
                    <a id="to-link" href="#" style="display: none">Get my position</a>     
                </div>
                <label><input type="radio" name="travelMode" value="DRIVING" checked /> Driving</label>
                <label><input type="radio" name="travelMode" value="BICYCLING" /> Bicylcing</label>
                <label><input type="radio" name="travelMode" value="TRANSIT" /> Public transport</label>
                <label><input type="radio" name="travelMode" value="WALKING" /> Walking</label>

                <input type="submit" value="GET Direction" class="btn btn-raised btn-success btn-block btn-login waves-effect"><br />
            </form>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="map_canvas" style="width:100%; height:350px"></div>

            <div id="directionsPanel" class="container" >
            </div><br>
        </div>

    </body>
</html>-->

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
        <title>Ticketchai|direction</title>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;


            }
            #floating-panel {
                position: absolute;
                top: 10px;
                left: 25%;
                z-index: 5;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
                text-align: center;
                font-family: 'Roboto','sans-serif';
                line-height: 30px;
                padding-left: 10px;
            }
            #right-panel {
                font-family: 'Roboto','sans-serif';
                line-height: 30px;
                padding-left: 10px;
            }

            #right-panel select, #right-panel input {
                font-size: 15px;
            }

            #right-panel select {
                width: 100%;
            }

            #right-panel i {
                font-size: 12px;
            }
            #right-panel {
                height: 100%;
                float: right;
                width: 390px;
                overflow: auto;
            }
            #map {
                margin-right: 400px;
            }
            #floating-panel {
                background: #fff;
                padding: 5px;
                font-size: 14px;
                font-family: Arial;
                border: 1px solid #ccc;
                box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
                display: none;
            }

        </style>
    </head>
    <body class="container-fluid col-md-12 col-sm-12 col-sx-12">

        <div id="floating-panel">
          <!--<strong>Start:</strong>-->
            <div class="form-group">

                <input type="text" value="" class="form-control" id="start" placeholder="Start address" >
            </div>
            <div class="form-group">

                <input type="text"  value="<?php echo $vanue = $_GET['venue']; ?>" class="form-control" id="end" placeholder="end point" >
                <?php
                $_GET['venue'];
                $str = $_GET['venue'];
                $parts = explode(",", $str);
                $one = $parts[0];
                $two = $parts[1];
                ?>
                <input type="text"  value="<?php echo $one; ?>" class="form-control" id="cen1" style="display:none" >
                <input type="text"  value="<?php echo $two; ?>" class="form-control" id="cen2" style="display:none">
            </div>

<!--      <select id="star">
  <option value="chicago, il">Chicago</option>
  <option value="st louis, mo">St Louis</option>
  <option value="joplin, mo">Joplin, MO</option>
  <option value="oklahoma city, ok">Oklahoma City</option>
  <option value="amarillo, tx">Amarillo</option>
  <option value="gallup, nm">Gallup, NM</option>
  <option value="flagstaff, az">Flagstaff, AZ</option>
  <option value="winona, az">Winona</option>
  <option value="kingman, az">Kingman</option>
  <option value="barstow, ca">Barstow</option>
  <option value="san bernardino, ca">San Bernardino</option>
  <option value="los angeles, ca">Los Angeles</option>
</select>-->
            <!--<br>-->
            <!--<strong>End:</strong>-->

<!--      <select id="en">
  <option value="chicago, il">Chicago</option>
  <option value="st louis, mo">St Louis</option>
  <option value="joplin, mo">Joplin, MO</option>
  <option value="oklahoma city, ok">Oklahoma City</option>
  <option value="amarillo, tx">Amarillo</option>
  <option value="gallup, nm">Gallup, NM</option>
  <option value="flagstaff, az">Flagstaff, AZ</option>
  <option value="winona, az">Winona</option>
  <option value="kingman, az">Kingman</option>
  <option value="barstow, ca">Barstow</option>
  <option value="san bernardino, ca">San Bernardino</option>
  <option value="los angeles, ca">Los Angeles</option>
</select><br>-->
            <button type="button" class="btn btn-success" onclick="click()">GET DIRECTION</button>
        </div>
        <div id="right-panel"></div>
        <div id="map"></div>
        <script>
            var center1 = parseFloat($("#cen1").val());
            var center2 = parseFloat($("#cen2").val());
            function initMap() {
                var directionsDisplay = new google.maps.DirectionsRenderer;
                var directionsService = new google.maps.DirectionsService;

                var myLatLng = {lat: center1, lng: center2};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });



//                var map = new google.maps.Map(document.getElementById('map'), {
//                    zoom: 11,
//                    //center: {lat:center1, lng:center2}
//                    
//                });
//
//                var cen= map.setCenter(new google.maps.LatLng(center1, center2));
                
                directionsDisplay.setMap(map);
                directionsDisplay.setPanel(document.getElementById('right-panel'));
                 

                var control = document.getElementById('floating-panel');
                control.style.display = 'block';
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

                var onChangeHandler = function () {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                };
                document.getElementById('start').addEventListener('change', onChangeHandler);
                document.getElementById('end').addEventListener('change', onChangeHandler);
            }
            var start;
            var end
            function click() {
                start = $("#start").val();
                end = $("#end").val();

            }

            function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                // var start = document.getElementById('start').value;
                // var end = document.getElementById('end').value;
                start = $("#start").val();
                end = $("#end").val();
                directionsService.route({
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING'
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCONGB2LuIR6U3cT63dnC5IOzRWKWAGWAI&callback=initMap">
        </script>
    </body>
</html>
