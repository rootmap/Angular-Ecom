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
        echo $cms->pageTitle("WishList | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
            <?php 
        echo $cms->headCss(array('wishList'));
        ?>
       
            
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="navClt">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
    <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper" ng-controller="wishlistController">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:100px;">
                        <!-- Movies Now Showing section starts here -->
                        <div class="section-simple2">
                            <div class="container">
                                <div class="row">



                                    <!-- Left Sidebar Section Starts Here section_padd30-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wishlist_main z-depth-1" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp; border: 1px solid #ccc;">
                                        <div class="section-heading">
                                            <h2 class="h2-responsive bold">{{your}} <span  class="section-topic">{{Wishlist}} </span></h2>
                                        </div>
                                        
                                        
                                        
                                        <div class="table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="text">
                                                    <tr>
                                                        <th class="text-center">{{Item}}</th>
                                                        <th class="text-center">{{Item_name}}</th>
                                                        <th class="text-center">{{Quantity}}</th>
                                                        <th class="text-center">{{Date}}</th>
                                                        <th class="text-center">{{Action}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- single row start-->
                                                    <tr ng-repeat="ww in data">
                                                        <td>
<!--                                             <img src="upload/{{ww.event_web_logo}}"  class="wishlist_img img-responsive">-->
                                                            <img src="upload/{{ww.event_web_logo}}" class="wishlist_img img-responsive"/>
                                                        </td>
                                                        <td>{{ ww.event_title }}</td>
                                                        <td>1</td>
                                                        <td>{{ ww.WL_created }}</td>
                                                        <td>
                                                            <a href="event_tickets.php?id={{ww.event_id}}">
                                                                <button type="button" class="btn success-rounded-outline waves-effect"><i class="fa fa-cart-plus" aria-hidden="true"></i> add to cart</button>
                                                            </a>
                                                            <button ng-click="deleteInfo(ww)" type="button" class="btn danger-rounded-outline waves-effect"><i class="fa fa-remove"></i> remove</button>
                                                        </td>

                                                    </tr>
                                                    <!-- single row end-->
                                                    
                                                </tbody>
                                            </table>
                                        </div>
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
                    <?php include 'include/footer.php';?>
                </div>
                 
                
                 <?php echo $cms->angularJs(array('wishlist_angular'));?>
                 <?php echo $cms->fotterJs(array('wishlist'));?>
                
                
                   
                
                
                
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