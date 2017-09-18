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

        <?php echo $cms->pageTitle("Unsubscribe_newsletter | Ticket Chai"); ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php echo $cms->headCss(array('unsubscribe_newsletter')); ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="unsubscribe_newsletterController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>
 <div growl></div>
                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent;">
                        <!-- Customers LogIn section starts here -->
                        <div class="section-simple2">
                            <div class="container">
                                <div class="row padd_btm_30">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <h3 style="margin-top:90px">
                                   {{title}}<br/>
                                    <small>{{p1}}</small>
                                </h3>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
                                        <form>
                                            <div class="form-group label-floating danger">
                                                <label class="control-label">{{label}}</label>
                                                <input type="email" class="form-control" ng-model="email" >
                                            </div>
                                            <div class="form-group text-center">
                                                <a type="button" class="btn btn-raised btn-danger btn-block btn-login waves-effect" href="javascript:void(0)" ng-click="unsubscribe_newsletter(email)">{{button}}</a>
                                                <br/> {{p2}}
                                                <a href="subscribe_newsletter.php" class="text-capitalize signup-link">{{p3}}</a>
                                            </div>
                                        </form>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!-- Customers LogIn section ends here -->
                        <!-- ticketchai simple section starts here -->
                        <div class="section section-simple-close">
                            <div class="container">
                                <div class="row section_padd30">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ticketchai simple section ends here -->
                    </div>
                    <!-- main content part ends here -->

                    <?php include 'include/footer.php';?>

                </div>

                <!-- Sart Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="material-icons">clear</i>
                                </button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-simple">Nice Button</button>
                                <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                    <?php echo $cms->angularJs(array('unsubscribeNewsletter_angular')); ?>
                    <?php echo $cms->fotterJs(array('unsubscribeNewsletter')); ?>

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