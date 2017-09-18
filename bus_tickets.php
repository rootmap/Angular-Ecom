<?php
include './cms/plugin.php';
$cms = new plugin();
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php $cms->baseUrl(" assets/img/fav1.png "); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!-- <title>Ticket Chai | Buy Online Ticket...</title>-->
        <?php
        echo $cms->pageTitle("Bus Tickets | Ticketchai.com...");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("bus"));
        ?>


    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="busController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>
            <script src="http://maps.googleapis.com/maps/api/js"></script>
            <!--map-->
            <script>
                function initialize() {
                    var mapProp = {
                        center: new google.maps.LatLng(51.508742, -0.120850),
                        zoom: 5,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            <!--./map-->

            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:50px ">


                        <div class="clearfix"></div>
                        <div class="section section-simple2">
                            <div class="container">
                                <div class="row section_padd30">
                                    <!--tab bar start here -->
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 raised">
                                        <!--  side content right here start -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading cont_detilsh">
                                                <h4 class="text-left bold" style="color: #ffffff !important;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                                           {{panelHeading}}</h4>
                                            </div>
                                            <div class="panel-body">

                                                <form class="share_detalis">
                                                    <div class="form-group">

                                                        <label for="exampleInputEmail1" class="pull-left text-black bold">From</label>

                                                        <select class="form-control">
                                                            <option>Enter city</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>




                                                        <label for="exampleInputEmail1" class="pull-left text-black bold">To</label>

                                                        <select class="form-control">
                                                            <option>Enter city</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-4 col-xs-12 dtt" style="padding-left: 0px;">

                                                            <input class="datepicker form-control" type="text" value="03/12/2016" />
                                                            <i class="fa fa-calendar cal_start"></i>
                                                        </div>
                                                        <div class="col-md-6 col-sm-4 col-xs-12 dtt" style="padding-right: 0px;">
                                                            <input class="datepicker form-control" type="text" value="03/12/2016" />
                                                            <i class="fa fa-calendar cal_end "></i>

                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <button class="btn btn-block btn-success-outline waves-effect btn-raised bold" type="submit"><i class=" fa fa-search fa-lg"></i> &nbsp;{{btn_search}}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>


                                    </div>



                                    <!-- ./Checkout Panel section ends here -->


                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 raised">
                                        <!--  side content right here start -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading img_show">
                                                <h4 class="text-left bold" style="color: #ffffff !important;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
                                            {{panelHeading}}</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-12">
                                                    <div class="col-sm-6 col-xs-12 active">
                                                        <img src="<?php echo $cms->baseUrl(" assets/img/events/bus_PNG8615.png "); ?>" class="img-fluid img-responsive img-bus">

                                                    </div>
                                                    <div class="col-sm-6 col-xs-12 active">
                                                        <img src="<?php echo $cms->baseUrl(" assets/img/events/hqdefault.jpg "); ?>" class="img-fluid img-responsive img-bus">

                                                    </div>
                                                    <div class="col-sm-6 col-xs-12 active">
                                                        <img src="<?php echo $cms->baseUrl(" assets/img/events/bus_PNG8615.png "); ?>" class="img-fluid img-responsive img-bus">

                                                    </div>
                                                    <div class="col-sm-6 col-xs-12 active">
                                                        <img src="<?php echo $cms->baseUrl(" assets/img/events/bus_PNG8615.png "); ?>" class="img-fluid img-responsive img-bus">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- side content right here end-->

                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <div class="panel panel-active">
                                            <div class="panel-heading show_inf">
                                                <h3 class="text-center bold" style="color: #ffffff !important;">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            {{search}}</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">


                                                    <table class="table text-center">



                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">{{t_no}}</th>
                                                                <th class="text-center">{{t_busName}}</th>
                                                                <th class="text-center">{{t_sit}}</th>
                                                                <th class="text-center">{{t_time}}</th>
                                                                <th class="text-center">{{t_price}}</th>
                                                                <th class="text-center">{{t_buy}}</th>
                                                            </tr>
                                                        </thead>



                                                        <!-- On cells (`td` or `th`) -->
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Shamoli</td>
                                                                <td>A2</td>
                                                                <td>11.15</td>
                                                                <td>300TK</td>
                                                                <td class="td-actions">

                                                                    <button class="btn btn-raised  btn-success text-center bold"> <i class="fa fa-ticket" aria-hidden="true"></i> Buy Now</button>
                                                                </td>



                                                            </tr>

                                                            <tr>
                                                                <td>2</td>
                                                                <td>SR</td>
                                                                <td>D2</td>
                                                                <td>12:15</td>
                                                                <td>450TK</td>
                                                                <td class="td-actions ">
                                                                    <button class="btn btn-raised  btn-success text-center bold"> <i class="fa fa-ticket" aria-hidden="true"></i> Buy Now</button>

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>3</td>
                                                                <td>Dipjol</td>
                                                                <td>D2</td>
                                                                <td>08:02</td>
                                                                <td>650TK</td>
                                                                <td class="td-actions">
                                                                    <button class="btn btn-raised  btn-success text-center bold"> <i class="fa fa-ticket" aria-hidden="true"></i> Buy Now</button>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Green line</td>
                                                                <td>

                                                                    <button type="button" id="site_viwe"> D2</button>
                                                                    <!-- <img id="view_sitid" src="<?php //echo $cms->baseUrl("assets/img/events/bus_PNG8615.png");?>"/>&nbsp;&nbsp; -->
                                                                </td>



                                                                <td>09:00</td>
                                                                <td>1200TK</td>
                                                                <td class="td-actions">
                                                                    <button class="btn btn-raised  btn-success text-center bold"> <i class="fa fa-ticket" aria-hidden="true"></i> Buy Now</button>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- On rows -->




                                                    <script>
                                                        $(document).ready(function () {
                                                            $("#view_sitid").hide();
                                                            $("#site_viwe").click(function () {
                                                                $("#view_sitid").toggle('slow');
                                                                $("#site_viwe").toggle('hide');

                                                            });
                                                        });
                                                    </script>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--./row section_padd30-->
                            </div>
                            <!--container end here-->
                        </div>
                    </div>
                    <!-- main content part ends here -->

                    <?php include 'include/footer.php';?>

                </div>
                <!--  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> -->
                <?php echo $cms->fotterJs(array('bus_tickets'));?>
                    <?php echo $cms->angularJs(array('bus_angular'));?>


                        <script type="text/javascript">
                            $(document).ready(function () {
                                // the body of this function is in assets/material-kit.js
                                //materialKit.initSliders();
                                $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

                                window_width = $(window).width();

                                if (window_width >= 768) {
                                    big_image = $('.wrapper > .header');

                                    $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                                }

                            });
                        </script>
                        <script type="text/javascript">
            $(document).ready(function () {
                $('#subscription').hide();
                setTimeout(function (a) {
                    $('#subscription').slideDown(1000);
                }, 15000);
                setTimeout(function (b) {
                    $('#subscription').slideUp(3000);
                }, 30000);
                $('#btn-sclose').click(function () {
                    $('#subscription').slideUp(1000);
                });

                $('#nav-search-btn').click(function () {
                    $('#nav-search-field').show();
                    $('#nav-search-btn').hide();
                });
                $('#nav-search-close').click(function () {
                    $('#nav-search-field').hide();
                    $('#rslt-div').hide();
                    $('#nav-search-btn').show();
                    $('#searchInput').val('');
                });
            });

            setTimeout(function () {
                $('#odometer1').html('50');
                $('#odometer2').html('100');
                $('#odometer3').html('200');
                $('#odometer4').html('10000');
            }, 1000);

        </script>
        <!--  Select Picker Plugin -->
        <!--searchbar script-->
    <script>
            $(document).ready(function () {
    
            $('.control').keyup(function () {

    // If value is not empty
    if ($(this).val().length == 0) {
    // Hide the element
    $('.show_hide').hide();
    } else {
    // Otherwise show it
    $('.show_hide').show();
    }
    }).keyup();
    });</script>
    <!--searchbar script-->
                        <!-- <script src="app2.js" type="text/javascript"></script>
    <script src="busController.js" type="text/javascript"></script> -->



    </body>


    </html>