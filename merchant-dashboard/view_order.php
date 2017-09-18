<?php 
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();

$order_sessoin=$_GET['order_session'];
$orderId = $_GET['oid'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/fav1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <!--Title Part start Here-->
    <?php echo $cms->pageTitle("View_Order | Order_ticket... "); ?>
    <!--Title Part end Here-->
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   
   
    <!--CSS Part start here-->
    <?php echo $cms->headCss(array("dashboard")); ?>
    <!--./CSS Part end here-->
    
    

    
</head>

<body ng-app="merchantaj" ng-controller="vieworderController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
<!-- <span ng-init="oData1('<?php echo $orderId;?>')"></span>-->
    <span ng-init="oData('<?php echo $orderId;?>')"></span>
    <div class="wrapper">
        
        <!--include sidebar-->
        <?php include ('includes/sidebar.php'); ?>
        <!--include sidebar-->

        <div class="main-panel">
            
            <!--top-navbar-->
             <?php include ('includes/top_navigation.php'); ?> 
            <!--top-navbar-->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!--Box part-->
                            <?php include ('includes/viewOrder_box.php');?>
                            <!--Box part-->
                        </div>
                    </div>
                </div>
            </div>
            
            <!--fotter-->
            <?php include ('includes/footer.php'); ?> 
            <!--fotter-->
            
        </div>
    </div>
</body>

<!-- Footer Js start here--->
<?php 
echo $cms->footerJs(array("viewOrder"));
?>
<!-- Footer Js end here--->



<!--autoclick-->
<script type="text/javascript">
$(document).ready(function(){
    $('#trigerl').click();
    $('#triger').click();
});
</script>
<!--autoclick-->

<!--script for collapse table-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.collapse').on('show.bs.collapse', function () {
            $('.collapse.in').collapse('hide');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        demo.initOverviewDashboard();
        demo.initCirclePercentage();

    });
</script>
<script type="text/javascript">
    // jQuery
    $("form#event-cover-photo").dropzone({
        url: "/file/post"
    });
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

            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
            <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.1.2/textAngular.min.js'></script>

</html>