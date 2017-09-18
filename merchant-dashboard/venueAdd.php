<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Ticket List| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("venueAdd")); ?>
        <!--./CSS Part end here-->

    </head>

    <body id="venueAllData" ng-app="merchantaj" ng-controller="venueAddController" ng-model="venueAllData">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>
            <?php
            if (isset($_GET['vid'])) {
                ?>
                <span id="venulistIDAdd" ng-click="LoadvenueEditList('<?php echo $_GET['vid']; ?>')"></span>
            <?php } ?>
            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                <?php include ('includes/box_venue_add.php'); ?> 
                                <!--./ Wizard Ends Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php include ('includes/footer.php'); ?> 
            </div>
        </div>
    </body>

    <!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->

    <!-- Footer Js start here--->



    <?php
    echo $cms->footerJs(array("venueAdd"));
    ?>
    
   <script>
    $(document).ready(function (){
        <?php if(isset($_GET['vid'])) { ?>
        $("#venulistIDAdd").click();
        <?php } ?>
    });
    </script>
    <!--Footer Js End Here-->
 <script>
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


        function initAutocomplete() {

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13,
                mapTypeId: 'roadmap'
            });


            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var searchBox = new google.maps.places.SearchBox(input);
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            //searchBox.bindTo('bounds', map);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {

                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));


                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);

                    } else {
                        bounds.extend(place.geometry.location);
                        map.setZoom(17);  // Why 17? Because it looks good.

                    }
                    $("#street_number").val(place.formatted_address);
                    //console.log(place);
                    //console.log(place.name);
                    //console.log(place.formatted_address);
                   // console.log(place.address_components);

                    var componentForm = {
                        street_number: 'short_name',
                        route: 'long_name',
                        locality: 'long_name',
                        //administrative_area_level_1: 'short_name',
                        country: 'long_name',
                        postal_code: 'short_name'
                    };

                    for (var component in componentForm) {
                        document.getElementById(component).value = '';
                        document.getElementById(component).disabled = false;
                        //console.log(component);
                    }

                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        if (componentForm[addressType]) {
                            var val = place.address_components[i][componentForm[addressType]];
                            console.log(addressType);
                            document.getElementById(addressType).value = val;
                           if (addressType == "locality")
                            {
                               document.getElementById(addressType).value;
                                angular.element(document.getElementById('venueAllData')).scope().AutoVarVal("ven_city", val);
                            } 
                              if (addressType == "country")
                            {
                               document.getElementById(addressType).value;
                                angular.element(document.getElementById('venueAllData')).scope().AutoVarVal("ven_country", val);
                            } 
                             if (addressType == "postal_code")
                            {
                               document.getElementById(addressType).value;
                                angular.element(document.getElementById('venueAllData')).scope().AutoVarVal("ven_zip", val);
                            } 
                             if (addressType == "route")
                            {
                               document.getElementById(addressType).value;
                                angular.element(document.getElementById('venueAllData')).scope().AutoVarVal("ven_address", val);
                            }
                               // angular.element(document.getElementById('evt')).scope().AutoVarVal("ven_country", val);
                            
                            
                        }
                    }
                    angular.element(document.getElementById('venueAllData')).scope().AutoVarVal("ven_name", place.name);



                    if ($("#street_number").val() == null)
                    {
                        $("#street_number").val(place.formatted_address);
                    }



                });
                map.fitBounds(bounds);
            });
        }

        // google.maps.event.addDomListener(window, 'load', initAutocomplete);


    </script>

<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBByDWX-yegYSxScVHKBldjPkAZFcOPcTc&libraries=places&callback=initAutocomplete"
async defer></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCONGB2LuIR6U3cT63dnC5IOzRWKWAGWAI&v=3.26&libraries=places&callback=initAutocomplete" ></script> 
    
    <script type="text/javascript">
        $(document).ready(function () {
            // Init Sliders
            //demo.initFormExtendedSliders();
            // Init DatetimePicker
            //demo.initFormExtendedDatetimepickers();

            $('#start-date-box').click(function () {
                $('#start-date').keyup();
            });
            $('#start-time-box').click(function () {
                $('#start-time').keyup();
            });
            $('#end-date-box').click(function () {
                $('#end-date').keyup();
            });
            $('#end-time-box').click(function () {
                $('#end-time').keyup();
            });


        });


    </script>


    <script type="text/javascript">
//        $(document).ready(function () {
//            demo.initOverviewDashboard();
//            demo.initCirclePercentage();
//
//        });
    </script>

    <script type="text/javascript">
        // jQuery
        //$("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
    </script>



    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.tsf-content").attr("style", "#");
            }, 2000);

        });

        $(function () {
            pageLoadScript();
        });


        function pageLoadScript() {

            _stepEffect = $('#stepEffect').val();
            _style = 'style12';
            _stepTransition = $('#stepTransition').is(':checked');
            _showButtons = $('#showButtons').is(':checked');
            _showStepNum = $('#showStepNum').is(':checked');


            $('.tsf-wizard-1').tsfWizard({
                stepEffect: 'basic',
                stepStyle: 'style3',
                navPosition: 'top',
                stepTransition: true,
                showButtons: true,
                showStepNum: true,
                height: 'auto'
            });
        }
    </script>

   
</html>
