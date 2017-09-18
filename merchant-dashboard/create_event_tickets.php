<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
$tid = "";
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
}
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
<?php echo $cms->pageTitle("Create Event Tickets | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
<?php echo $cms->headCss(array("createEventTickets")); ?>
        <!--./CSS Part end herer-->
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                setup: function (editor) {
                    editor.on('change', function () {

                        editor.save();
                    });
                }
            });
        </script>
    </head>

    <body ng-app="merchantaj" ng-controller="createEventTicketsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <div class="wrapper">
<?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
<?php include ('includes/top_navigation.php'); ?> 
                <?php
                if (!empty($tid)) {
                    ?>
                    <span ng-click="EditDataGetticket(<?php echo $tid; ?>)" id="loadeditdata"></span>
                    <?php
                }
                ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
<?php include ('includes/box_createEventTickets.php'); ?> 
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
echo $cms->footerJs(array("createEventTickets"));
?>
    <!--Footer Js End Here-->
    <script>


    </script>
    <script type="text/javascript">



        $(document).ready(function () {

<?php
if (!empty($tid)) {
    ?>
                $("#loadeditdata").click();
    <?php
}
?>

            // Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            $('.datepicker').datetimepicker({
                format: 'YYYY/MM/DD', //use this format if you want the 12hours timpiecker with AM/PM toggle
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
