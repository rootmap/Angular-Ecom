<?php
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
        <?php echo $cms->pageTitle("Merchant Register | Ticketchai "); ?>
        <!--./Title Part end Here-->

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("register")); ?>
        <!--./CSS Part end here-->

        <style type="text/css">
            .card .header {
                padding: 0px 0px 0 !important;
            }
            .card .content {
                padding: 0px 15px 10px !important;
            }
            .login-page .card .footer, .lock-page .card .footer {
                padding-top: 0px !important;
            }
            .card-wizard .footer {
                padding-bottom: 0px !important;
                padding-top: 0px !important;
            }
        </style>
    </head>

    <body ng-app="merchantaj" ng-controller="registerController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php include ('includes/login-navigation.php'); ?> 

        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" data-color="green" data-image="assets/img/background/background-1.jpg">   
                <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
                <div class="content">
                    <div class="container">
                        <div class="row">                 
                            <?php include ('includes/box_register.php'); ?>                     
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
    echo $cms->footerJs(array("register"));
    ?>
    <!--./Footer Js End Here-->

    <script type="text/javascript">
        $().ready(function () {

            var $validator = $("#wizardForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        minlength: 5
                    },
                    first_name: {
                        required: false,
                        minlength: 3
                    },
//                                            last_name: {
//                                                required: false,
//                                                minlength: 5
//                                            },
                    website: {
                        required: true,
                        minlength: 5,
                        url: true
                    },
                    framework: {
                        required: false,
                        minlength: 4
                    },
                    cities: {
                        required: true
                    },
                    price: {
                        number: true
                    }
                }
            });

            // you can also use the nav-pills-[blue | azure | green | orange | red] for a different color of wizard
            $('#wizardCard').bootstrapWizard({
                tabClass: 'nav nav-pills',
                nextSelector: '.btn-next',
                previousSelector: '.btn-back',
                onNext: function (tab, navigation, index) {
                    var $valid = $('#wizardForm').valid();

                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    }
                },
                onInit: function (tab, navigation, index) {

                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    $width = 100 / $total;

                    $display_width = $(document).width();

                    if ($display_width < 600 && $total > 3) {
                        $width = 50;
                    }

                    navigation.find('li').css('width', $width + '%');
                },
                onTabClick: function (tab, navigation, index) {
                    // Disable the posibility to click on tabs
                    return false;
                },
                onTabShow: function (tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index + 1;

                    var wizard = navigation.closest('.card-wizard');

                    // If it's the last tab then hide the last button and show the finish instead
                    if ($current >= $total) {
                        $(wizard).find('.btn-next').hide();
                        $(wizard).find('.btn-finish').show();
                    } else if ($current == 1) {
                        $(wizard).find('.btn-back').hide();
                    } else {
                        $(wizard).find('.btn-back').show();
                        $(wizard).find('.btn-next').show();
                        $(wizard).find('.btn-finish').hide();
                    }
                }
            });
        });

        function onFinishWizard() {
            //here you can do something, sent the form to server via ajax and show a success message with swal

            swal("Good Job!", "Your Registration is Successful!", "success");
        }
    </script>

    <script type="text/javascript">
        $().ready(function () {
            demo.checkFullPageBackgroundImage();

            setTimeout(function () {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
</html>
