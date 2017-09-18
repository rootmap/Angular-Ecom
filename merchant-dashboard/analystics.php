<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms =new plugin();
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        
        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Analystics | Buy Online Ticket... ");?>
        <!--./Title Part end Here-->


        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        
       <!--CSS Part start here-->
       <?php echo $cms->headCss(array("analystics"));?>
       <!--./CSS Part end here-->
    </head>

    <body ng-app="merchantaj" ng-controller="analysticsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div class="wrapper">
             <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                 <?php include ('includes/top_navigation.php'); ?> 

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                           <?php include ('includes/box_analystics.php'); ?> 
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
    echo $cms->footerJs(array("analystics"));
    ?>
    <!--Footer Js End Here-->
    <script type="text/javascript">
        $(document).ready(function () {
            demo.initOverviewDashboard();
            demo.initCirclePercentage();
        });
    </script>
    <!-- Mirrored from demos.creative-tim.com/paper-dashboard-pro/examples/dashboard/overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Aug 2016 07:33:01 GMT -->
</html>
