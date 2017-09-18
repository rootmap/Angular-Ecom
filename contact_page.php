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
        echo $cms->pageTitle("Contact Page | Ticketchai.com...");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
            <?php 
        echo $cms->headCss(array('contactPage'));
        ?>

    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="contact_pageController">
        <div growl></div>
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <div id="fb-root"></div>
        <?php echo $cms->FbSocialScript();?>

            <?php include 'include/navbar.php';?>


                <!--Google map starts here-->
                <div class="section frame">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                            <iframe class="col-lg-12 col-md-12 col-sm-12 col-xs- map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d912.9906364251227!2d90.40331199999999!3d23.748714999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ0JzU1LjQiTiA5MMKwMjQnMTEuOSJF!5e0!3m2!1sbn!2sbd!4v1413197027945" id="" width="800" height="600" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>

                </div>
                <!--Google map ends here-->

                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent;">
                        <!-- Customers LogIn section starts here -->
                        <div class="section-simple2">
                            <div class="container">
                                <div class="row padd_btm_30">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <h3>
                                    <span class="contact_tag">{{contact_title}}</span><br/>
                                    <small>{{title_span}}</small>
                                    <hr class="hr"/>
                                </h3>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.02s">
                                        <!--left part starts here-->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control" ng-model="info.name" name="senderName" id="senderNameId">
                                            </div>
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Email</label>
                                                <input type="email" class="form-control" ng-model="info.email" name="senderEmail" id="senderEmaild">
                                            </div>
                                            <div class="form-group label-floating success">
                                                <label class="control-label">Subject</label>
                                                <input type="text" class="form-control" ng-model="info.sub" name="senderSub" id="senderSubId">
                                            </div>
                                            <div class="form-group label-floating success sendermessage">
                                                <label class="control-label">Message</label>
<!--                                                <input type="textarea" class="form-control" ng-model="info.msg" />-->
                                                <textarea style="height: 150px" class="form-control" ng-model="info.msg" name="senderMessage" id="senderMessageId"></textarea>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="button" ng-click="contact(info)" class="btn btn-raised btn-success btn-block btn-login waves-effect">{{btn_send}}</button>
<!--                                                <br/> {{question}}
                                                <a href="signup.html" class="text-capitalize signup-link"> {{share}}</a>-->
                                            </div>
                                        </div>
                                        <!--left part ends here-->
                                        <!--Right part starts here-->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 " style="text-align: center !important;">
                                            <div class="clearfix" style="">
                                            </div>
                                            <br/>
                                            <h2 id="rightPartText">{{c_info}}</h2>
                                            <p id="rightPartText">{{c_infoText1}}</p>
                                            <i class="fa fa-map-marker iconColor"></i>
                                            <p id="rightPartText">{{c_infoText2}} </p>

                                            <i class="fa fa-phone iconColor"></i>
                                            <p id="rightPartText">{{c_infoText3}}</p>
                                            <br/>
                                            <p>{{c_infoText4}}</p>
                                            <i class="fa fa-envelope iconColor"></i>
                                            <p id="rightPartText">{{c_infoText5}}</p>
                                            <hr class="hr" id="rightPartText" />
                                        </div>
                                        <!--Right part ends here-->
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


                <?php echo $cms->fotterJs(array('contact_page'));?>
                    <?php echo $cms->angularJs(array('contact_angular'));?>

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