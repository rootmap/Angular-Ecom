<?php
session_start();
include '../cms/merchantPlugin.php';
$cms = new plugin();

if (isset($_GET['ref'])) {
    $ref = urldecode($_GET['ref']);
    session_regenerate_id();
    $_SESSION['REF'] = $ref;
    session_write_close();
}
?>




<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Login | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->


        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("login")); ?>
        <!--./CSS Part end here-->
        <style type="text/css">
            .footer .copyright {
                margin: 5px 3px !important;
                padding: 5px 15px !important;
            }
            .btn-log-in {
                border-color: #1F3A93 !important;
                background-color: #1F3A93 !important;
                color: #FFFFFF !important;
                padding-left: 50px !important;
                padding-right: 50px !important;
            }

            .btn-log-in:hover,
            .btn-log-in:focus,
            .btn-log-in:active{
                border-color: #1F3A93 !important;
                background-color: #ffffff !important;
                color: #1F3A93 !important;
            }
        </style>
    </head>

    <body ng-app="merchantaj" ng-controller="loginController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <!--sdk for facebook and google login--> 
        <script type="text/javascript">
                    window.fbAsyncInit = function () {
                        FB.init({
                            appId: '200818277047626',
                            xfbml: true,
                            version: 'v2.6'
                        });
                    };

                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement(s);
                        js.id = id;
//                      js.src = "//connect.facebook.net/en_US/sdk.js";
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>
        <!--sdk for facebook and google login-->


        <div growl></div>
        <?php include ('includes/login-navigation.php'); ?> 

        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" data-color="green" data-image="assets/img/background/background-4.jpg">   
                <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
                <div class="content">
                    <div class="container">
                        <div class="row">                   
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <h3 id="msg" style=" background-color: #4caf50; border-radius: 3px;color: white;font-size: 16px;line-height: 40px;position: relative; padding-left:8px;font-weight: 500;"></h3>
                                <?php include ('includes/box_login.php'); ?> 

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
    echo $cms->footerJs(array("login"));
    ?>
    <!--./Footer Js End Here-->

    <!--SOCIAL LOGIN SCRIPT include start-->  
    <?php
    include 'ajax/facebookLogin.php';
    include 'ajax/googleLogin.php';
    ?>
    <!--SOCIAL LOGIN SCRIPT in clude end>--> 

    <script type="text/javascript">
        $().ready(function () {
            demo.checkFullPageBackgroundImage();

            setTimeout(function () {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>


    <!-- Mirrored from demos.creative-tim.com/paper-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Aug 2016 07:34:30 GMT -->
</html>
