<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/fav1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Ticket Chai | Buy Online Ticket...</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet" />

    <link href="assets/css/user_profile.css" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="../plugins/fontello-2910d963/css/fontello.css" rel="stylesheet">

    <!--Import Multi Step Indicator css-->
    <link href="../plugins/stepformwizard/assets/css/gsi-step-indicator.min.css" rel="stylesheet" />

    <!--Import  Step Form Wizard css-->
    <link href="../plugins/stepformwizard/assets/css/tsf-step-form-wizard.min.css" rel="stylesheet" />

    <!--For Dropzone Image Upload-->
    <link href="../plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">
            <!--
                            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
                            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
                -->
            <div class="logo text-center">
                <a href="index.html" class="db-logo text-center">
                    <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" />
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#!" class="simple-text">
                    <img src="assets/img/fav1.png" alt="Ticketchai Logo" />
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="assets/img/default-avatar.png" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                Shanto Kumar Sarker
                                <b class="caret"></b>
                            </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li><a href="user.html">My Profile</a></li>
                                <li><a href="user.html">Edit Profile</a></li>
                                <li><a href="user.html">Change Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li>
                        <a data-toggle="collapse" href="#Analytics">
                            <i class="pe-7s-display1 bold"></i>
                            <p>Analytics
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Analytics">
                            <ul class="nav">
                                <li><a href="#">All Events</a></li>
                                <li><a href="#">Test Event - 01</a></li>
                                <li><a href="#">Test Event - 02</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#Events">
                            <i class="pe-7s-display2 bold"></i>
                            <p>Events
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Events">
                            <ul class="nav">
                                <li><a href="#">Create Event</a></li>
                                <li><a href="#">Current Events</a></li>
                                <li><a href="#">Past Events</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="overview.html">
                            <i class="ti-panel"></i> Dashboard
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">

                        <form class="navbar-form navbar-left navbar-search-form" role="search">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" value="" class="form-control" placeholder="Search...">
                            </div>
                        </form>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#stats" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
                                    <i class="ti-pencil-alt"></i>
                                    <p>Create Event</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#notifications" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
                                    <i class="ti-image"></i>
                                    <!--<span class="notification">5</span>-->
                                    <p>
                                        Analytics
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">All Events</a></li>
                                    <li><a href="#">Test Event - 01</a></li>
                                    <li><a href="#">Test Event - 02</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="login.html" class="btn-magnify">
                                    <i class="ti-power-off"></i>
                                    <p>
                                        Sign Out
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- Wizard Sarts Here -->
                            <div class="card padding_top15">
                                <form method="#" action="#">
                                    <div class="header">
                                        <h4 class="title">
                                                 Ticket Chai User Profile
                                                <hr/>
                                            </h4>
                                    </div>
                                    <div class="content">

                                        <div class="row" style="background-color: #f1f8e9; border: 1px solid #8bc34a; border-radius: 4px;">
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 text-center">
                                                <div class="row image">
                                                    <div class=" col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4">
                                                        <img class="img-circle img-responsive proImage " src="assets/img/faces/face-4.jpg">
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 uicon1">
                                                        <a href=""><i class="fa fa-facebook"></i></a>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 uicon2">
                                                        <a href="">
                                                            <i class="fa fa-twitter"></i></a>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 uicon3">
                                                        <a href=""><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 uicon3">
                                                        <a href=""><i class="fa fa-google-plus"></i></a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>


                                                </div>
                                                <div class="row">
                                                    <a href="">
                                                        <p class="text-center edit">Edit Profile</p>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                <div class="tab-content nav_body">
                                                    <div id="profile" class="tab-pane fade in active p-l-3">
                                                        <div style="" class="nav_body_element">
                                                            <h4>Personal Information</h4>
                                                            <p>Username: <span>username</span></p>
                                                            <p>First Name: <span>TicketChai</span></p>
                                                            <p>Last Name: <span>User</span></p>
                                                            <p>Address: <span>Something</span></p>
                                                            <p>City: <span>Dhaka</span></p>
                                                            <p>Country: <span>Bangladesh</span></p>
                                                            <p>Postal Code: <span>1207</span></p>
                                                            <p>Company: <span>example</span></p>
                                                        </div>
                                                        <div style="" class="nav_body_element">
                                                            <h4>Contact Information</h4>
                                                            <p>Email addess: <span>email@example.com</span></p>
                                                        </div>
                                                    </div>

                                                    <!--                                                    background-color: #f1f8e9; border: 1px solid #8bc34a; border-radius: 4px;-->
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                                <div class="clearfix" style="padding: 30px;"></div>
                            </div>
                            <!--./ Wizard Ends Here -->
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid text-center">
                    <div class="copyright">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Ticketchai.com | All Rights Reserved.
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

<!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Forms Validations Plugin -->
<script src="assets/js/jquery.validate.min.js"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="assets/js/moment.min.js"></script>

<!--  Date Time Picker Plugin is included in this js file -->
<script src="assets/js/bootstrap-datetimepicker.js"></script>

<!--  Select Picker Plugin -->
<script src="assets/js/bootstrap-selectpicker.js"></script>

<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>

<!-- Circle Percentage-chart -->
<script src="assets/js/jquery.easypiechart.min.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Sweet Alert 2 plugin -->
<script src="assets/js/sweetalert2.js"></script>

<!-- Vector Map plugin -->
<script src="assets/js/jquery-jvectormap.js"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Wizard Plugin    -->
<script src="assets/js/jquery.bootstrap.wizard.min.js"></script>

<!--  Bootstrap Table Plugin    -->
<script src="assets/js/bootstrap-table.js"></script>

<!--  Full Calendar Plugin    -->
<script src="assets/js/fullcalendar.min.js"></script>

<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!--   Sharrre Library    -->
<script src="assets/js/jquery.sharrre.js"></script>

<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
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
<script src="../plugins/dropzone-master/dist/min/dropzone.min.js"></script>
<script type="text/javascript">
    // jQuery
    $("form#event-cover-photo").dropzone({
        url: "/file/post"
    });
    // Dropzone class:
    //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
</script>

<script src="../plugins/stepformwizard/assets/js/tsf-wizard-plugin.js"></script>

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