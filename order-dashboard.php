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
        echo $cms->pageTitle("Order-dashboard | Ticket Chai");
    ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("order"));
    ?>

    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="order-dashboardController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>

            <?php include 'include/navbar.php';?>

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
                                            <li class="active"><a href="user_dashboard/dashboard.php"><span class="fa fa-dashboard"></span> {{m_i_1}}</a> </li>
                                            <li class=""><a href="order-add.php"><span class="fa fa-map-marker"></span> {{m_i_2}}</a> </li>
                                            <li class=""><a href="order-favorite.php"><span class="fa fa-heart"></span> {{m_i_3}}</a> </li>
                                            <li class=""><a href="order.php"><span class="fa fa-heart"></span> {{m_i_4}}</a> </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_content" id="one" style="">
                                        <div class="row">
                                            <div class="welcome-msg">
                                                <h3 class="page-sub-header2 clearfix">Hello {{name[0].user_first_name}}</h3>
                                                <p class="page-sub-header-sub small">You last logged in at: {{name[0].user_last_login}} [UK time (GMT + 6:00hrs)]</p>
                                        </div>

                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     {{p1}} 
                                    </a>
                                  </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <form class="form-horizontal fist_accordion" role="form">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p2}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="Jhon" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p3}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="Doe" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p4}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="jhon.deo@example.com" type="email" value="{{name[0].user_email}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p5}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder=".." type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Phone" class="col-sm-3 control-label">{{p6}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" id="Phone" placeholder="880 124 9820" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p7}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="1217" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="form-group hide">
                                                            <!-- remove it if dont need this part -->
                                                            <label class="col-sm-3 control-label">Facebook account map</label>
                                                            <div class="col-sm-9">
                                                                <div class="form-control"> <a class="link" href="fb.com">Jhone.doe</a>
                                                                    <a class=""> <i class="fa fa-minus-circle"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-9"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-9" style="">
                                                                <button type="submit" class="btn btn-success-outline">{{p8}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTwo">
                                                    <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{p9}} 
                                    </a>
                                  </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="fist_accordion">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="">{{p10}}
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <form class="form-horizontal fist_accordion" role="form">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p11}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="new password" type="password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">{{p12}}</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" placeholder="confirm password" type="password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-9" style="">
                                                                <button type="submit" class="btn btn-success-outline">{{p13}}</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingThree">
                                                    <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      {{p14}} 
                                    </a>
                                  </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="fist_accordion">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="">{{p15}}
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="">{{p16}}
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
							
							
							
                        </div>
                            <!--
            </div>
        </div>
-->

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
                    </div>

                    <?php include 'include/footer.php';?>
                </div>

                <?php echo $cms->fotterJs(array('order_dashboard'));?>
                    <?php echo $cms->angularJs(array('oDashboard_angular'));?>

                        <!--for collapse active -->
                        <script type="text/javascript">
                            $(document).ready(function () {

                                $('#headingOne').addClass('active-panel');

                                $('.panel').on('show.bs.collapse', function (e) {
                                    var heading = $(this).find('.panel-heading');
                                    heading.addClass("active-panel");
                                });

                                $('.panel').on('hidden.bs.collapse', function (e) {
                                    var heading = $(this).find('.panel-heading');
                                    heading.removeClass("active-panel");
                                });
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