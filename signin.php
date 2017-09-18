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
        echo $cms->pageTitle("SignIn| Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("signin"));
        ?>



    </head>



    <body class="index-page signin" ng-app="frontEnd" ng-controller="signinController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>

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

        <?php
        include 'include/navbar.php';
        ?>



        <div class="clearfix"></div>

        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent;margin-top:60px">
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row padd_btm_30">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">  
                                <!--                                <h3>
                                                                    {{signin}}<br/>
                                                                    <small>{{signin_span}}</small>
                                                                </h3>-->

                                <h3>
                                    {{signin}}<br/>
                                    <small>{{signin_span}}</small>
                                </h3>

                            </div>



                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">

                                <form name="frub"  action="javascript:void(0);" class="ng-valid ng-valid-email ng-dirty"> 
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                        <h3 id="msg" style=" background-color: #4caf50; border-radius: 3px;color: white;font-size: 16px;line-height: 40px;position: relative;"></h3>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Email</label>
                                            <!--<input type="email" class="form-control" ng-model="signinData.email" name="email" required>-->
                                            <input type="email" 
                                                   class="form-control" 
                                                   ng-model="loginData.userEmail"
                                                   autocomplete="off"
                                                   name="email" required>
                                            <span ng-show="frub.userEmail.$dirty && frub.userEmail.$error.required"></span><!--   * Required-->
                                            <span ng-show="frub.userEmail.$dirty && frub.userEmail.$error.userEmail"></span><!--  Not an E-mail -->

                                        </div>
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Password</label>
                                            <!--<input type="password" class="form-control" ng-model="signinData.userPass" name="userPass" required>-->
                                            <input type="password" 
                                                   class="form-control" 
                                                   ng-model="loginData.userPassword" 
                                                   name="password" 
                                                   ng-minlength ="3"
                                                   required/>
                                            <span class="floating-f-p">
                                                <a href="forgot-password.php">Forgot Password?</a>
                                            </span>
                                            <span ng-show="frub.password.$dirty && frub.password.$error.required"></span> <!--* Required-->
                                            <span ng-show="frub.password.$dirty && frub.password.$error.minlength"></span><!-- Password is Too Short!!!-->
                                            <span ng-show="frub.password.$dirty && frub.password.$error.maxlenght"></span> <!--Password is To Long!!!-->
<!--                                            <span style="color:red" ng-show="signinForm.userPass.$dirty && signinForm.userPass.$invalid">
                                                <span ng-show="signinForm.userPass.$error.required"></span>-->
                                        </div>

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"> {{remembar_pass}}
                                            </label>
                                        </div>

                                        <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                                        <div class="form-group text-center">
                                            <button type="submit" 
                                                    class="btn btn-raised btn-success btn-block btn-login waves-effect" 
                                                    ng-click="loginInsert(loginData)" 
                                                    style="border:2px solid#4CAF50;color:#000" id="clickSignIn"><strong>{{btn_login}}</strong>
                                            </button>

                                            <br/> {{signup_text}}
                                            <a href="signup.php" class="text-capitalize signup-link"> {{btn_signup}}</a>
                                            <!--<br/>
                                            <a href="merchant-dashboard/login.php" class="text-capitalize signup-link"> Login</a> <b>AS A MERCHANT</b>-->
                                        </div>
                                        <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

                                    </div>    
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <h3 class="text-center">{{singin_or}}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" style="text-align: center !important;">
                                        <div class="clearfix" style="height: 5px;"></div>
                                        <br/>
                                        <a href="javascript:void(0);" onclick="facebookLogin()" class="btn btn-block btn-social btn-facebook btn-raised" >
                                            {{signin_fb}}<span class="fa fa-facebook"></span> 
                                        </a>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <br/>
                                        <a href="javascript:void(0);" onclick="googleLogin()" class="btn btn-block btn-social btn-google btn-raised">
                                            {{singin_g}}<span class="fa fa-google-plus"></span> 
                                        </a>
                                        <br/>
                                        <h3 class="text-center">---------- {{singin_or}} ----------</h3>
                                        <br/>
                                        <a href="merchant-dashboard/index.php" class="btn btn-block btn-social btn-primary btn-raised">
                                            LOGIN AS A MERCHANT / ORGANIZER<span class="fa fa-universal-access"></span> 
                                        </a>
                                    </div>
                                </form> 

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

        <?php echo $cms->angularJs(array('signin_angular')); ?>
        <?php echo $cms->fotterJs(array('signin')); ?>

        <script type="text/javascript" src="tc-merchant-template/assets/js/angular-growl.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-animate.min.js"></script>-->
<!--        <script type="text/javascript" src="tc-merchant-template/assets/js/angularanimate.min.js"></script>-->





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