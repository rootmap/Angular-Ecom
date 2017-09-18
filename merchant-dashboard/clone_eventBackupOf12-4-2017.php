<?php
include './DBconnection/database_connections.php';
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
$eid = "";
if (isset($_GET['eid'])) {
    $eid = $_GET['eid'];
}
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Clone Event | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("createEvent")); ?>
        <!--./CSS Part end here-->

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <!--<script src="assets/js/tinymce.min.js"></script>-->
        <script>
            /*** cnvyr.min.js.gz ***/
            tinymce.init({
                mode: "specific_textareas",
                editor_selector: "mceEditor",
                selector: "textarea#evt_desc",
                width: "100%",
                plugins: ["advlist autolink lists link charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime paste"],
                toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                relative_urls: false
            });

            $("#tncForm").validate({
                submitHandler: function (a) {
                    a.submit()
                }
            });
            
                if (tinymce.get("evt_desc").getContent()) {
                    $("#messageError").text("")
                } else {
                    $("#messageError").text("Please enter message")
                }

                
        </script>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="createEventController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <div class="wrapper">
<?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
<?php include ('includes/top_navigation.php'); ?> 
                <?php
                if (!empty($eid)) {
                    ?>
                    <span ng-init="eventEditFunction('<?php echo $eid; ?>')" id="createEditEvent"></span>
                    <?php
                }
                ?>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
<?php include ('includes/box_cloneEvent.php'); ?> 
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
echo $cms->footerJs(array("cloneEvent"));
?>

    <!--Footer Js End Here-->
    <script>
        $(document).ready(function () {
            $("#pac-input").on({
                keypress: function () {
                    $("#venue_detail").show();
                },
                keyup: function () {
                    if ($(this).val() == "") {
                        $("#venue_detail").hide();
                    }
                }

                //another event to know if input is empty while on focus, then removeClass('active');
            });


            $("#tck").on({
                keypress: function () {
                    $('#expand').removeClass("ng-hide");
                },
                keyup: function () {
                    if ($(this).val() == "") {
                        $('#expand').addClass("ng-hide");
                    }
                }

                //another event to know if input is empty while on focus, then removeClass('active');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $(function () {
                $("#g").click(function () {
                    if ($(this).is(":checked")) {
                        $("#org_details").show(1000);
                    } else {
                        $("#org_details").hide(1000);
                    }
                });
            });

            $(function () {
                $("#terms").click(function () {
                    if ($(this).is(":checked")) {
                        $("#evt_terms").show();
                    } else {
                        $("#evt_terms").hide(1000);
                    }
                });
            });
        });
    </script>   
    <script>
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
//var placeSearch, autocomplete;
//      var componentForm = {
//        street_number: 'short_name',
//        route: 'long_name',
//        locality: 'long_name',
//        administrative_area_level_1: 'short_name',
//        country: 'long_name',
//        postal_code: 'short_name'
//      };
//
//      function initAutocomplete() {
//        // Create the autocomplete object, restricting the search to geographical
//        // location types.
//        autocomplete = new google.maps.places.Autocomplete(
//            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
//            {types: ['geocode']});
//
//        // When the user selects an address from the dropdown, populate the address
//        // fields in the form.
//        autocomplete.addListener('place_changed', fillInAddress);
//      }
//
//      function fillInAddress() {
//        // Get the place details from the autocomplete object.
//        var place = autocomplete.getPlace();
//
//        for (var component in componentForm) {
//          document.getElementById(component).value = '';
//          document.getElementById(component).disabled = false;
//        }
//
//        // Get each component of the address from the place details
//        // and fill the corresponding field on the form.
//        for (var i = 0; i < place.address_components.length; i++) {
//          var addressType = place.address_components[i].types[0];
//          if (componentForm[addressType]) {
//            var val = place.address_components[i][componentForm[addressType]];
//            document.getElementById(addressType).value = val;
//          }
//        }
//      }
//
//      // Bias the autocomplete object to the user's geographical location,
//      // as supplied by the browser's 'navigator.geolocation' object.
//      function geolocate() {
//        if (navigator.geolocation) {
//          navigator.geolocation.getCurrentPosition(function(position) {
//            var geolocation = {
//              lat: position.coords.latitude,
//              lng: position.coords.longitude
//            };
//            var circle = new google.maps.Circle({
//              center: geolocation,
//              radius: position.coords.accuracy
//            });
//            autocomplete.setBounds(circle.getBounds());
//          });
//        }
//      }


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
                    }

                    // Get each component of the address from the place details
                    // and fill the corresponding field on the form.
                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        console.log(addressType);
                        if (componentForm[addressType]) {
                            var val = place.address_components[i][componentForm[addressType]];
                            document.getElementById(addressType).value = val;
                            route

                            if (addressType == "locality")
                            {

                                angular.element(document.getElementById('locality')).scope().AutoVarVal("ven_city", val);
                            }
                            if (addressType == "administrative_area_level_2")
                            {

                                angular.element(document.getElementById('route')).scope().AutoVarVal("ven_address", val);
                            }

                            if (addressType == "country")
                            {

                                angular.element(document.getElementById('country')).scope().AutoVarVal("ven_country", val);
                            }
                            if (addressType == "postal_code")
                            {

                                angular.element(document.getElementById('postal_code')).scope().AutoVarVal("ven_zip", val);
                            }
                        }
                    }
                    angular.element(document.getElementById('pac-input')).scope().AutoVarVal("ven_name", place.name);




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
            //tinyMCE.activeEditor.setContent({{evt.evt_desc}});
            $('#g').click(function () {
                $('#org_details').toggle('slow');
            })
        });
    </script>   




    <script type="text/javascript">
        $(document).ready(function () {


            $('#venue_detail').hide();
            $('#vbtn').click(function () {
                $('#venue_detail').slideToggle();
                //venue-row
            });


        });
        $(document).ready(function () {

<?php
if (!empty($eid)) {
    ?>
                $("#createEditEvent").click();
    <?php
}
?>

            // Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

            $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
                format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }

            });
        });</script>

    <script type="text/javascript">

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            demo.initOverviewDashboard();
            demo.initCirclePercentage();
        });</script>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.tsf-content").attr("style", "#");
            }, 2000);
        });
        $(function () {
            pageLoadScript();
        });
        $("#card-photo").click(function () {
            $("#uploads_thumbke").click();
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
