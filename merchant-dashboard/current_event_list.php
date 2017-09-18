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
        <?php echo $cms->pageTitle("Current Event List| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("currentList")); ?>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="currentEventListController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <!--modal From Date Wise Order Report Start-->


    <from class="modal fade" id="myModal" tabindex="-1" ng-model="modelData" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Step 2 -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><legend><span class="ti-timer"></span> Event Date</legend></h4>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <div class="clearfix"></div>
                                    <input id="start-date" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input id="end-date" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4"><br>

                                    <button type="button" ng-click="ModelDataReportDateWise(modelData)" value="save" class="btn btn-fill btn-info btn-block">Generate Report</button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- ./Step 2 -->
                </div>

                
            </div>
        </div>
    </from>
    <!--modal From Date Wise Order Report  End-->

        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 
                <?php if (!isset($_GET['eid'])) { ?>
                    <span ng-click="loadEventList()" id="LoadAllEvents"></span>
                <?php } ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                <?php include ('includes/box_currentEventList.php'); ?> 
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
    echo $cms->footerJs(array("currentList"));
    ?>

    <!--Footer Js End Here-->



    <script type="text/javascript">
        $(document).ready(function () {

<?php if (!isset($_GET['eid'])) { ?>
                $("#LoadAllEvents").click();
<?php } ?>

            // Init Sliders
            //demo.initFormExtendedSliders();
            // Init DatetimePicker
            //demo.initFormExtendedDatetimepickers();

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

    <script>
        // Init DatetimePicker
        demo.initFormExtendedDatetimepickers();
    </script>
    <!--Footer Js End Here-->
    <script type="text/javascript">
//        $(document).ready(function () {
//            demo.initOverviewDashboard();
//            demo.initCirclePercentage();
//
//        });
    </script>

    <script type="text/javascript">
        // jQuery
        //$("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
    </script>



    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.tsf-content").attr("style", "#");
            }, 2000);

        });

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

    <!--  Angular LIBRARY Js
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
        <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
        ./Angular LIBRARY Js
    
        Bootstrap Js start
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        Bootstrap Js End
    
    
         custom anular script
        <script src="../angularJs/app.js"></script>
        <script src="../angularJs/scripts/createEventController.js"></script>
        CUSTOM ANGULAR SCRIPT-->
</html>
