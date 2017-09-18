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
        echo $cms->pageTitle("signup | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />


        <?php
        echo $cms->headCss(array("signup"));
        ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="signupController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <?php echo $cms->FbSocialScript(); ?>
        
        <!--sdk for facebook and google login-->
        <script type="text/javascript">
                    window.fbAsyncInit = function () {
                        FB.init({
                            appId: '1866086476938296',
                            xfbml: true,
                            version: 'v2.8'
                        });
                    };

                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>
        <!--sdk for facebook and google login-->
        
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; top:40px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <br>
                                <h3>
                                    {{title}}<br/>
                                    <small>{{des}}</small>
                                </h3>
                            </div>



                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                    <form name="myForm">
                                        <h3 id="msg" style=" background-color: #4caf50; border-radius: 3px;color: white;font-size: 16px;line-height: 40px;position: relative;"></h3>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Name *</label>
                                            <input type="text" class="form-control" ng-model="info.name" name="name" >
<!--                                                <span style="color:red" ng-show="myForm.name.$dirty && myForm.name.$invalid">
                                                <span ng-show="myForm.name.$error.required"></span>-->
                                        </div>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Email*</label>
                                            <input type="email" class="form-control" ng-model="info.email" name="email"  >
<!--                                            <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">-->
<!--                                                <span ng-show="myForm.email.$error.required"></span>
                                                <span ng-show="myForm.email.$error.email">Invalid email address.</span>-->
                                        </div>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Password*</label>
                                            <input type="password" class="form-control" ng-model="info.pass" name="pass"  >
<!--                                                <span style="color:red" ng-show="myForm.pass.$dirty && myForm.pass.$invalid">
                                                <span ng-show="myForm.pass.$error.required"></span>-->
                                        </div>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Phone No.*</label>
                                            <input type="text" class="form-control" ng-model="info.phone" name="phone"  >
<!--                                                <span style="color:red" ng-show="myForm.phone.$dirty && myForm.phone.$invalid">
                                                <span ng-show="myForm.phone.$error.required"></span>-->
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" ng-model="info.checked" name="optionsCheckboxes"> {{p1}} <a href="#!" class="signup-link">{{p2}}</a>
                                            </label>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="button" ng-click="registerUser(info)"  class="btn btn-raised btn-success btn-block btn-login waves-effect" style="border:2px solid#4CAF50;color:#000"><strong>{{p3}}</strong></button>
                                            <br/> {{p4}}
                                            <a href="signin.php" class="text-capitalize signup-link"> {{p5}}</a>
<!--                                            ng-disabled="!info.checked"   -->
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <h3 class="text-center">{{p6}}</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" style="text-align: center !important;">
                                        <div class="clearfix" style="height: 5px;"></div>
                                        <br/>
                                        <a href="javascript:void(0);" onclick="facebookLogin()" class="btn btn-block btn-social btn-facebook btn-raised" >
                                            SIGN iN WITH FACEBOOK<span class="fa fa-facebook"></span> 
                                        </a>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <br/>
                                        <a href="javascript:void(0);" onclick="googleLogin()" class="btn btn-block btn-social btn-google btn-raised">
                                            SIGN IN WITH GOOGLE<span class="fa fa-google-plus"></span> 
                                        </a>
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

            <?php include 'include/footer.php'; ?>

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

        <!--   Core JS Files   -->
       
        <?php
        echo $cms->angularJs(array('signup_angular'));
        ?>
        
         <?php
        echo $cms->fotterJs(array('signup'));
        ?>
        
        
<!--SOCIAL LOGIN SCRIPT include start-->  
<?php
include 'ajax/facebookLogin.php';
include 'ajax/googleLogin.php';
?>
<!--SOCIAL LOGIN SCRIPT in clude end>--> 
        
        
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