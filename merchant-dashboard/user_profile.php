<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("User Profile | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->


        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("userProfile")); ?>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="userProfileController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 

                <span id="useredit" ng-click="loaduserprofile(<?php echo $login_user_id; ?>)"></span>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">


                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <?php //include ('includes/box_user_Profile.php'); ?> 
                                <div class="col-lg-12 col-md-10">
                                    <div class="card card-user">

                                        <div class="image">
                                            <img class="img" src="assets/img/background/background-2.jpg" alt="..."/>
                                        </div>

                                        <div class="content">



                                            <div class="author">

                                                <img class="avatar" style="border: 5px solid #87CB16;" src="../upload/merchent_images/<?php echo $defimage; ?>" alt="..."/>
                                <!--                                            <p class="update">Edit</p>   -->
                                <!--                                            <p class="update">Update profile</p>-->

                                            </div>




                                            <ul class="list-unstyled team-members">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center">
                                <!--                            <a href="user_edit_profile.php" class="btn btn-info  btn-fill btn-wd "><i class="fa fa-edit"></i> Edit Profile</a>-->
                                                            <a class="btn btn-info  btn-fill btn-wd" href="dashboard.php" role="button"><i class="fa fa-backward"></i> Back to Dashboard</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">

                                                        <div class="col-xs-1">
                                                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-user"></i></button>
                                                        </div>
                                                        <div class="col-xs-11" ><!--ng-model="usersData" -->


                                                            <small class="bold">Name :</small>
                                                            <strong  class="userInfo" name="username">{{ usersData[0].admin_full_name}}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-envelope"></i></button>
                                                        </div>
                                                        <div class="col-xs-11" ><!-- ng-model="usersData" -->
                                                            <small class="bold">E-mail :</small>


                                                            <strong  class="userInfo">{{ usersData[0].admin_email}}</strong>
                                                        </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-phone"></i></button>
                                                        </div>
                                                        <!--ng-model="usersData"--> 
                                                        <div class="col-xs-11" > 
                                                            <small class="bold">Phone :</small>

                                                            <strong class="userInfo" >{{  usersData[0].admin_phone}}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-1">
                                                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-map-marker"></i></button>
                                                        </div>
                                                        <div class="col-xs-11">
                                                            <small class="bold">Address :</small>

                                                            <strong class="userInfo">{{ usersData[0].admin_address}}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <!--        <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h5><span class="badge badge-black">1 Event</span><br /><small class="bold">Cart</small></h5>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5><span class="badge badge-black">2 Event</span><br /><small class="bold">Wishlist</small></h5>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5><span class="badge badge-black">24,6$</span><br /><small class="bold">Spent</small></h5>
                                                        </div>
                                                    </div>
                                                </div>-->
                                    </div>
                                </div>
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
    echo $cms->footerJs(array("userProfile"));
    ?>
    <!--./Footer Js End Here-->
    <!--     //EDIT FUNCTION WORK START HERE-->
    <script>
        $(document).ready(function () {

            //alert('success');
            $("#useredit").click();

        });

    </script>
    <!-- //EDIT FUNCTION WORK END HERE-->
    <script type="text/javascript">
        $(document).ready(function () {

            // Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();

            $('#start-date-box').click(function () {
                $('#start-date').keyup();
            });
            $('#start-time-box').click(function () {
                $('#start-time').keyup();
            });
            $('#end-date-box').click(function () {
                $('#end-date').keyup();
            });
            $('#end-time-box').click(function () {
                $('#end-time').keyup();
            });


        });


    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            demo.initOverviewDashboard();
            demo.initCirclePercentage();

        });
    </script>
    <!--For Dropzone Image Upload-->

    <script type="text/javascript">
        // jQuery
        $("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
    </script>



    <script>
        $(function () {
            pageLoadScript();
        });


        function pageLoadScript() {

            _stepEffect = $('#stepEffect').val();
            _style = 'style12';
            _stepTransition = $('#stepTransition').is(':checked');
            _showButtons = $('#showButtons').is(':checked');
            _showStepNum = $('#showStepNum').is(':checked');


            $('.tsf-wizard-1').tsfWizard({
                stepEffect: 'basic',
                stepStyle: 'style3',
                navPosition: 'top',
                stepTransition: true,
                showButtons: true,
                showStepNum: true,
                height: 'auto'
            });
        }
    </script>
</html>
