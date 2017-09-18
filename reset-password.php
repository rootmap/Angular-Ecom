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
         echo $cms->pageTitle("reset-password | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />


        <?php
        echo $cms->headCss(array('reset_pass'));
        ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="reset_passwordController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
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
                                    Reset your password ?
								<br/>
                                    <small>Let's Recover It Quickly And Start Again</small>
                                </h3>
                            </div>



                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4">
                                    <form name="myForm">
                                       
										<div class="form-group label-floating success">
                                            <label class="control-label">Password*</label>
                                            <input type="password" class="form-control" ng-model="info.pass" name="pass"  required> 
											
                                        </div>
					<div class="form-group label-floating success">
                                            <label class="control-label">Confirm-Password*</label>
                                            <input type="password" class="form-control" ng-model="info.c_pass" name="c_pass"  required> 
                                            
                                        </div>
                                   
                                            <input type="text" class="form-control" ng-model="info.u_id" name="u_id" value="<?php echo $_GET['user_id']; ?>">
                                        				
                                        <div class="form-group text-center">
                                            <button type="button" ng-click="resetPass(info,<?php echo $_GET['user_id']; ?>)"  class="btn btn-raised btn-success btn-block btn-login waves-effect" style="border:2px solid#4CAF50;color:#000"><strong>reset</strong></button>
                                            <br/>Return to
                                            <a href="signin.php" class="text-capitalize signup-link">LOGIN</a>
<!--                                            ng-disabled="!info.checked"   -->
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
            <span ng-init="resetPassUserId(<?php echo $_GET['user_id']; ?>)"></span>
            <?php include 'include/footer.php'; ?>

        </div>



        <!--   Core JS Files   -->
       
                <?php 
 echo $cms->fotterJs(array('forgot_password'));
 echo $cms->angularJs(array('resetPass_angular'));
?>
        
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