<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();

if(isset($_GET['event_id']))
{
    $eventID=$_GET['event_id'];
}
else
{
    header('location: dashboard.php');
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php
        echo $cms->pageTitle("Add More Questions | Buy Online Ticket...");
        ?>
        <!--./Title Part end Here-->

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php
        echo $cms->headCss(array("addMoreQustions"));
        ?>
        <!--./CSS Part end here-->
    </head>

    <body ng-app="merchantaj" ng-controller="addMoreQuestionsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
         <div growl></div>
        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 
                <?php
                if (isset($_GET['qid'])) {
                    $qid=$_GET['qid'];
                    ?>
                    <span id="morequestionedit" ng-click="loadQuestionEditdata('<?php echo $qid; ?>')"></span>
                    <?php
                }
                ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                <?php include ('includes/box_addMoreQuestions.php'); ?>
                                <!--./ Wizard Ends Here -->
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
    echo $cms->footerJs(array("addMoreQustions"));
    ?>
    
    <!--Footer Js End Here-->

    <script type="text/javascript">
        $(document).ready(function () {
            
            //autoclick on edit ng
            <?php 
            if(isset($_GET['qid']))
            {
                ?>
                $("#morequestionedit").click();        
                <?php
            }
            ?>
            
            
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
