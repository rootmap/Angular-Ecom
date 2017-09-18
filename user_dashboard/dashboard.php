<?php 
include '.././DBconnection/auth.php';
include '../cms/userPlugin.php';
$cms = new plugin();
//echo $login_user_id;
//echo$login_user_name;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/fav1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--Title Part start Here-->
    <?php echo $cms->pageTitle("User_Dashboard | Buy Online Ticket... "); ?>
    <!--Title Part end Here-->

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!--CSS Part start here-->
    <?php echo $cms->headCss(array("dashboard"));?>
    <!--CSS Part end here-->

</head>

<body ng-app="user" ng-controller="dashboardController">
    <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
    <!--<span id="triger" ng-click="loadDashboard('9f9bf237a4432e12e80564ccb54f6acf')"></span>-->
    <div class="wrapper">
        
        <!--include sidebar-->
        <?php include ('includes/sidebar.php');?>
        <!--include sidebar-->

        <div class="main-panel">
            
            <!--top-navbar-->
            <?php include ('includes/top_navigation.php');?>
            <!--top-navbar-->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                            <!--Box part-->
                            <?php include ('includes/user_dashboard_box.php');?>
                            <!--Box part-->
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!--fotter-->
            <?php include ('includes/footer.php');?>
            <!--fotter-->
            
        </div>
    </div>
</body>


<!-- Footer Js start here--->
<?php echo $cms->footerJs(array("dashboard"));?>
<!-- Footer Js end here--->


<!--autoclick-->
<!--<script type="text/javascript">
    $(document).ready(function(){
        $('#triger').click();
    });
</script>-->
<!--autoclick-->

<script type="text/javascript">
    $(document).ready(function () {
        demo.initOverviewDashboard();
        demo.initCirclePercentage();

    });
</script>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-pro/examples/dashboard/overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Aug 2016 07:33:01 GMT -->

</html>