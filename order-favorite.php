<?php
include './cms/plugin.php';
$cms = new plugin();
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Order-Favorite | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array('order'));
        ?>

    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="orderFavoriteController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; margin-top:70px;">
                <div class="clearfix"></div>
                <!-- sitemap section starts here -->
                <div class="section-simple2 ">

                    <div class="container">
                        <div class="row custom_menu">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu">
                                <ul class="nav nav-pills nav-justified  nav-tab-bar">
                                    <li class=""><a href="user_dashboard/dashboard.php"><span class="fa fa-dashboard"></span> {{m_i_1}}</a> </li>
                                    <li class=""><a href="order-add.php"><span class="fa fa-map-marker"></span> {{m_i_2}}</a> </li>
                                    <li class="active"><a href="order-favorite.php"><span class="fa fa-heart"></span> {{m_i_3}}</a> </li>
                                    <li class=""><a href="order.php"><span class="fa fa-heart"></span> {{m_i_4}}</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row " style="">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_content" style="">

                                <div class="table-responsive">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name=" sample" class="selectall">{{selectAll}}        
                                            </label>
                                        </div>

                                    </div>

                                    <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                                        <form class="navbar-form pull-right search" role="search">
                                            <div class="input-group add-on">
<!--                                                <input class="form-control" name="srch-term" id="srch-term" data-toggle="modal" data-target="#myModal" type="text" ng-model="test"  placeholder="Search...">-->
                                                <input class="form-control" name="srch-term" id="srch-term" ng-model="search"  placeholder="Search...">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{p1}} </th>
                                                <th>{{p2}} </th>
                                                <th>{{p3}}</th>
                                                <th>{{p4}} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="x in name | filter:search | orderBy:'event_title'">
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sample[]">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="width:14%" class="add-img-td">
                                                    <a href="ads-details.html"><img class="thumbnail  img-responsive favorite_img" src="upload/event_web_logo/{{x.event_web_logo}}" alt="img"></a>
                                                </td>
                                                <td style="width:58%" class="ads-details-td">
                                                    <div class="eventlist-details">
                                                        <h4 class="add-title text-left"> <a href="event-details.html"> {{x.event_title}} </a> </h4>
                                                        <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> {{x.venue_start_date}}</span><br> 
                                                            <span class="item-location"><i class="fa fa-map-marker"></i>  {{x.venue_title}}</span>
                                                            <br> </span> <a href="event-detsils.html" class="mini-link">{{p9}} <i class="fa fa-caret-right"></i> </a> </div>
                                                </td>
                                                <td> ৳ <b>{{x.MinimumPrice}}</b> - ৳ <b>{{x.MaximumPrice}}</b></td>
                                                <td>
                                                    <div class="f-order">
                                                        <p class="text-center">
                                                            <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round" data-loading-text="Loading...">
                                                                <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>Buy Ticket
                                                            </a>
                                                        </p>
                                                        <p class="text-center">
                                                            <a class="btn btn-danger-outline btn-raised btn-round " ng-click="deleteInfo(x)"> <i class=" fa fa-trash"></i> {{p8}} </a>
                                                        </p>
                                                        
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade " id="myModal" role="dialog" style="margin-top:10%">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Search Result</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" ng-hide="filteredItems.length === 0" >
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{p1}} </th>
                                                <th>{{p2}} </th>
                                                <th>{{p3}}</th>
                                                <th>{{p4}} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="x in filteredItems = (name| filter:test) ">
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sample[]">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td style="width:14%" class="add-img-td">
                                                    <a href="ads-details.html"><img class="thumbnail  img-responsive favorite_img" src="tc-merchant-template/assets/img/movies/small-thumbs/{{x.event_web_logo}}" alt="img"></a>
                                                </td>
                                                <td style="width:58%" class="ads-details-td">
                                                    <div class="eventlist-details">
                                                        <h4 class="add-title text-left"> <a href="event-details.html"> {{x.event_title}} </a> </h4>
                                                        <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> {{x.venue_start_date}}</span><br> 
                                                            <span class="item-location"><i class="fa fa-map-marker"></i>  {{x.venue_title}}</span>
                                                            <br> </span> <a href="event-detsils.html" class="mini-link">{{p9}} <i class="fa fa-caret-right"></i> </a> </div>
                                                </td>
                                                <td> ৳ <b>{{x.MinimumPrice}}</b> - ৳ <b>{{x.MaximumPrice}}</b></td>
                                                <td>
                                                    <div class="f-order">
                                                        <p>
                                                            <a href="" class="btn btn-success btn-raised btn-round" data-loading-text="Loading...">
                                                                <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{p7}}
                                                            </a>
                                                        </p>
                                                        <p class="text-center">
                                                            <a class="btn btn-danger-outline btn-raised btn-round " ng-click="deleteInfo(x)" ng-confirm-click="Would you like to say hi?"> <i class=" fa fa-trash"></i> {{p8}} </a>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>

                                        <h3 ng-if="filteredItems.length === 0" style="width: 50%" class="text-center">No Items Found</h3>

                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- ticketchai simple section starts here -->
                <div class="section section-simple-close">
                    <div class="container">
                        <div class="row section_padd60">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'include/footer.php'; ?>
        </div>



        <?php echo $cms->angularJs(array('oFavorite_angular')); ?>
        <?php echo $cms->fotterJs(array('order_favorite')); ?>

        <script type="text/javascript">
            $(".selectall").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
            });
        </script>


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

    </body>

</html>