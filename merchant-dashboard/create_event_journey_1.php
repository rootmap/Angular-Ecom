<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
$eid = "";
if (isset($_GET['eid'])) {
    $eid = $_GET['eid'];
}
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Create Event | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("createEvent")); ?>
        <!--./CSS Part end here-->
        <style type="text/css">
            .btn i.fa {    			
                opacity: 0;				
            }
            .btn.active i.fa {				
                opacity: 1;
            }
            .btn.active i {				
                opacity: 1;
                margin-left: 10px;
            }
            .btn-group .btn.active{border: 1px solid #82BD55 !important;}
            .btn-group .btn:hover{border: 1px solid #82BD55 !important;}
        </style>
    </head>

    <body id="evt" ng-app="merchantaj" ng-controller="createEventController" ng-model="evt">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 
                <?php
                if (!empty($eid)) {
                    ?>
                    <span ng-click="eventEditFunction('<?php echo $eid; ?>')" id="createEditEvent"></span>
                    <?php
                }
                ?>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                <?php include ('includes/box_createEvent_journey_1.php'); ?> 
                                <!--./ Wizard Ends Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php include ('includes/footer.php'); ?> 
            </div>
        </div>
        <?php
        echo $cms->footerJs(array("createEvent"));
        ?>

        
    </body>

    <!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->

    <!-- Footer Js start here--->





    <!--Footer Js End Here-->



    <script type="text/javascript">
        $(document).ready(function () {
            $('#venue_detail').hide();
            $('#vbtn').click(function () {
                $('#venue_detail').slideToggle();
                //venue-row
            });
        });
        $(document).ready(function () {

<?php
if (!empty($eid)) {
    ?>
                $("#createEditEvent").click();
    <?php
}
?>

            // Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            //demo.initFormExtendedDatetimepickers();
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

            $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
                format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }

            });
        });</script>


    <script type="text/javascript">
        $(document).ready(function () {
            demo.initOverviewDashboard();
            demo.initCirclePercentage();
        });</script>

    <script type="text/javascript">
        // jQuery
        $("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        var myDropzone = new Dropzone("form#event-cover-photo", {url: "/file/post"});</script>



    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.tsf-content").attr("style", "#");
            }, 2000);
        });
        $(function () {
            pageLoadScript();
        });
        $("#card-photo").click(function () {
            $("#uploads_thumbke").click();
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
