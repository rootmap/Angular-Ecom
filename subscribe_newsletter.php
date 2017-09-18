<?php
include './cms/plugin.php';
$cms = new plugin();
?>
    <!doctype html>
    <html lang="en" ng-app="frontEnd">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Subscribe Newsletter | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php echo $cms->headCss(array('subscribe_newsletter')); ?>
    </head>

    <body class="index-page signin"  ng-controller="subscribe_newsletterController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>

                <div class="cleafix"></div>
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
                                            <div class="form-group label-floating warning">
                                                <label class="control-label">{{label}}</label>
                                                <input type="email" ng-model="email" class="form-control">
                                            </div>
                                            <div class="form-group text-center">
                                                <a class="btn btn-raised btn-warning btn-block btn-login waves-effect" href="javascript:void(0)" ng-click="subscribe_newsletter(email)" >{{button}}</a>
                                                <br/> {{p2}}
                                                <a href="unsubscribe_newsletter.php" class="text-capitalize signup-link"> {{p3}}</a>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--           <button type="button" class="btn btn-primary btn-large" ng-show="!logged"  ng-click="IntentLogin()">Login with Facebook</button>
          <button type="button" class="btn btn-danger btn-large" ng-show="logged" ng-click="logout()">Logout</button>-->
          
<!--          <div>
            <debug val="user"></debug>
          </div>-->
                        
                    </div>
                    <!-- main content part ends here -->

                    <?php include 'include/footer.php';?>

                </div>

         

                <?php echo $cms->fotterJs(array('subscribeNewsletter'));?>
                    <?php echo $cms->angularJs(array('subscribeNewsletter_angular'));?>
                    <script  src="f.js"></script>
                        

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
<!--  <div ng-include="'index.html'"></div> -->
    </html>