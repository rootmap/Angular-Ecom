<?php
include './DBconnection/auth.php';
include './DBconnection/database_connections.php';
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
        <?php echo $cms->pageTitle("Reports 1 | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->


        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("reports")); ?>
        <!--./CSS Part end here-->


        <!--model start here--> 
        <!--modal From Date Wise Order Report Start-->


    <div class="modal fade"  id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Step 2 -->
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><legend><span class="ti-timer"></span>Choose Your Date Period</legend></h4>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <div class="clearfix"></div>
                                        <input id="start-date" name="custom_start" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET['rpt'])) {
                                    ?>
                                    <input type="hidden" name="rpt" value="<?php echo $_GET['rpt']; ?>" />
                                <?php } ?>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input id="end-date"  name="custom_end" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="row-fluid" style="margin-top: 20px;">
                                    <div class="col-md-4"><br>

                                        <button type="submit" name="srt" class="btn btn-fill btn-info btn-block">Generate Report</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- ./Step 2 -->
                </div>
            </div>
        </div>
    </div>
    <!--modal From Date Wise Order Report  End-->
    <!--model end here-->

</head>
<?php
$datestring = '';
$custom_date = '';
if (isset($_GET['date'])) {
    $datestring = $_GET['date'];
}

$paramevt = '';
if (isset($_GET['rpt'])) {
    $paramevt = $_GET['rpt'];
}
$custom_start = '';
if (isset($_GET['srt'])) {
    if (!empty($_GET['custom_start']) && !empty($_GET['custom_end'])) {
        $custom_start = $_GET['custom_start'];
        $custom_end = $_GET['custom_end'];
    } elseif (!empty($_GET['custom_start']) && empty($_GET['custom_end'])) {
        $datestring = $_GET['custom_start'];
    } elseif (!empty($_GET['custom_end']) && empty($_GET['custom_start'])) {
        $datestring = $_GET['custom_end'];
    }
}
?>

<?php
//initiate
if (!empty($paramevt) && empty($custom_start) && empty($datestring)) {
    $ccsty = "loadoEventWiseList('" . $paramevt . "')";
}
elseif (!empty($paramevt) && empty($custom_start) && !empty($datestring)) {
    $ccsty = "loadoEventWiseList('" . $paramevt . "', '" . $datestring . "')";
} elseif (!empty($custom_start) && !empty($paramevt)) {
    $ccsty = "loadoEventWiseDateList('" . $paramevt . "', '" . $custom_start . "', '" . $custom_end . "')";
}
else {
    $ccsty = "loadoEventAllList('" . $datestring . "')";
}
?>

<body ng-app="merchantaj" ng-controller="reportsController" ng-init="<?php echo $ccsty; ?>">
    <div class="wrapper">
        <?php include ('includes/sidebar.php'); ?>

        <div class="main-panel">
            <?php include ('includes/top_navigation.php'); ?> 
            <style type="text/css">
                .navbar-ct-info
                {
                    /*                    background: #263238;
                                        background: -moz-linear-gradient(top, #263238 0%, rgba(64, 145, 255, 0.7) 100%);
                                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #263238), color-stop(100%, rgba(64, 145, 255, 0.7)));
                                        background: -webkit-linear-gradient(top, #263238 0%, rgba(64, 145, 255, 0.7) 100%);
                                        background: -o-linear-gradient(top, #263238 0%, rgba(64, 145, 255, 0.7) 100%);
                                        background: -ms-linear-gradient(top, #263238 0%, rgba(64, 145, 255, 0.7) 100%);
                                        background: linear-gradient(to bottom, #263238 0%, rgba(64, 145, 255, 0.7) 100%);
                                        background-size: 150% 150%;*/

                    background: #87CB16;/*#8fc800;  Old browsers */
                    background: -moz-linear-gradient(top,  #87CB16 0%, #87CB16 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(top,  #87CB16 0%,#87CB16 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to bottom,  #87CB16 0%,#87CB16 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87CB16', endColorstr='#87CB16',GradientType=0 ); /* IE6-9 */



                }
            </style>
            <!--navbar Start here-->
            <nav class="navbar navbar-ct-info">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="nav navbar-nav">
                            <?php
                            if (!empty($paramevt)) {
                                ?>
                                <li>
                                    <a href="#"  role="button" aria-haspopup="false" aria-expanded="false" id="custom_evt">{{custom_evt}} - Reports</a>
                                </li><?php
                            } else {
                                ?>
                                <li class="dropdown" >
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All EVENTS<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li ng-repeat="allEvent in alleventdata"><a href="#">{{allEvent.event_title}}</a></li>


                                    </ul>


                                </li>
                            <?php } ?>
                        </ul>

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="rht-nav">
                        <style type="text/css">
                            div#rht-nav ul li.active a{
                                color: #fff;
                                font-weight: bolder;
                                border: 1px #dcdcdc solid;
                                /* background: #87CB16;*/
                            }

                        </style>    

                        <?php
                        $link_prefix = '';
                        if (isset($_GET['rpt'])) {
                            $link_prefix .="?rpt=" . $_GET['rpt'];
                        }

                        $today_param = FALSE;
                        $today = "?date=" . date('Y-m-d');
                        $yesterday_param = FALSE;
                        $yesterday = "?date=" . date("Y-m-d", strtotime("-1 day"));
                        $week = "?date=week";
                        $week_param = FALSE;

                        $month_param = FALSE;
                        $month = "?date=month";

                        if (!empty($link_prefix)) {
                            $today = "&date=" . date('Y-m-d');
                            $yesterday = "&date=" . date("Y-m-d", strtotime("-1 day"));
                            $week = "&date=week";
                            $month = "&date=month";
                        }

                        if ($datestring == date('Y-m-d')) {
                            if (!empty($link_prefix)) {

                                $today_param = TRUE;
                                $today_param_date = date('Y-m-d');
                            }
                        } elseif ($datestring == date("Y-m-d", strtotime("-1 day"))) {
                            if (!empty($link_prefix)) {

                                $yesterday_param = TRUE;
                                $yesterday_param_date = date("Y-m-d", strtotime("-1 day"));
                            }
                        } elseif ($datestring == "week") {
                            if (!empty($link_prefix)) {
                                // $week="&start_date=".date("Y-m-d")."&end_date=".date("Y-m-d",strtotime("-7 day"));


                                $week_param = TRUE;
                                $week_param_end_date = date("Y-m-d");
                                $week_param_start_date = date("Y-m-d", strtotime("-7 day"));
                            }
                        } elseif ($datestring == "month") {
                            if (!empty($link_prefix)) {

                                $month_param = TRUE;
                                $month_param_end_date = date("Y-m-d");
                                $month_param_start_date = date("Y-m-d", strtotime("-1 month"));
                            }
                        }
                        ?>


                        <ul ng-init="rht = 'showTotalrht'" class="nav navbar-nav navbar-right">
                            <li class="" ng-class="{'active':rht == 'showTotalrht', inactive:rht != 'showTotalrht'}"><a ng-click="rht = 'showTotalrht'" href="<?php echo basename(__FILE__) . $link_prefix; ?>">TOTAL</a></li>
                            <li ng-class="{'active':rht == 'showTodayrht', inactive:rht != 'showTodayrht'}" class=""><a ng-click="rht = 'showTodayrht'" href="<?php echo basename(__FILE__) . $link_prefix . $today; ?>">TODAY</a></li>
                            <li  ng-class="{'active':rht == 'showYesterdayrht', inactive:rht != 'showYesterdayrht'}"><a ng-click="rht = 'showYesterdayrht'" href="<?php echo basename(__FILE__) . $link_prefix . $yesterday; ?>">YESTERDAY</a></li>
                            <li  ng-class="{'active':rht == 'showThisWeekrht', inactive:rht != 'showThisWeekrht'}"><a ng-click="rht = 'showThisWeekrht'" href="<?php echo basename(__FILE__) . $link_prefix . $week; ?>">THIS WEEK</a></li>
                            <li ng-class="{'active':rht == 'showThisMonthrht', inactive:rht != 'showThisMonthrht'}"><a ng-click="rht = 'showThisMonthrht'" href="<?php echo basename(__FILE__) . $link_prefix . $month; ?>">THIS MONTH</a></li>
                            <li ng-class="{'active':rht == 'showCustomerrht', inactive:rht != 'showCustomerrht'}">
                                <a ng-click="rht = 'showCustomerrht'" href="#" data-toggle="modal" data-target="#myModal">CUSTOM</a>
                            </li>

                            <li><a href="reports_1.php"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>

                        </ul>

                    </div><!-- /.navbar-collapse -->


                </div><!-- /.container-fluid -->
            </nav>
            <!--navbar end here-->
            <style type="text/css">
                @media (min-width:767px){
                    .col-lg-2{width: 20%;}
                    .col-md-2{width: 20%;}
                }
            </style>
            <div class="content" style="min-height: 180px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big text-center">
                                                <i class="ti-shopping-cart text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8" style="overflow: hidden;">
                                            <div class="numbers" style="font-size:20px; ">
                                                <p>Amount</p>
                                                {{totalSales}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats" style="font-size:12px; font-weight: bold;">
                                        <i class="ti-reload"></i> Total Sales Amount
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-wallet"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8" style="overflow: hidden;">
                                            <div class="numbers" style="font-size:20px; ">
                                                <p>Amount</p>
                                                {{NetEarnings}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats" style="font-size:12px; font-weight: bold;">
                                        <i class="ti-calendar"></i> Net Earnings Amount
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big text-center text-warning">
                                                <i class="ti-share-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8" style="overflow: hidden;">
                                            <div class="numbers" style="font-size:20px; ">
                                                <p>Amount</p>
                                                {{Refunds_remain}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats" style="font-size:12px; font-weight: bold;">
                                        <i class="ti-timer"></i> Remaining To Transfer
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big text-center text-danger">
                                                <i class="ti-shield"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8" style="overflow: hidden;">
                                            <div  class="numbers" style="font-size:20px; ">
                                                <p>Amount</p>
                                                {{Refunds}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats" style="font-size:12px; font-weight: bold;">
                                        <i class="ti-reload"></i> Total Refunds Amount
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big text-center text-success">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8" style="overflow: hidden;">
                                            <div class="numbers" style="font-size:20px; ">
                                                <p>Quantity</p>
                                                {{Registration}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats" style="font-size:12px; font-weight: bold;">
                                        <i class="ti-reload"></i> Total Registration
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--            navbar 2 start here -->

            <!--navbar 2 end here -->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php include ('includes/box_reports_1.php'); ?> 
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
echo $cms->footerJs(array("reports"));
?>
<!--Footer Js End Here-->
<script type="text/javascript">
            $(document).ready(function () {
    demo.initOverviewDashboard();
            demo.initCirclePercentage();
    });</script>
<!-- Mirrored from demos.creative-tim.com/paper-dashboard-pro/examples/dashboard/overview.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Aug 2016 07:33:01 GMT -->



<!-- 1st PIA CHART START HERE-->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

            $(function () {

            $(document).ready(function () {

            // Build the chart
            Highcharts.chart('container', {
            chart: {
            plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
            },
                    title: {
                    text: 'Sales in numbers'
                    },
                    tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                    pie: {
                    allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                            enabled: false
                            },
                            showInLegend: true
                    }
                    },
                    series: [{
                    name: 'Brands',
                            colorByPoint: true,
                            data: [
<?php
//sales in number
if ($today_param == true) {
    $param_salesinnumber = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_salesinnumber = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_salesinnumber = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_salesinnumber = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $month_param_end_date . "')";
}
else
{
     $param_salesinnumber = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}

if (!empty($paramevt)) {
    $paramevtt = " AND e.event_id='$paramevt' ";
}

$query = "Select 
        e.`event_id`,
        e.`event_title`,

        IFNULL(count(oe.OE_event_id),0) as `ordersAmount`

        FROM `events` as e
        LEFT JOIN `order_events` as oe ON oe.OE_event_id=e.event_id
        LEFT JOIN `orders` as o ON o.order_id=oe.OE_order_id " . $param_salesinnumber . "

        WHERE e.`event_created_by`='$login_user_id' $paramevtt GROUP BY e.event_id";
$xsql = mysqli_query($con, $query);
$chk = mysqli_num_rows($xsql);

//print_r($xsql);
//echo "QUERY=".$chk;
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($xsql)) {
        ?>


                                    //                                    name: 'Microsoft Internet Explorer',
                                    {name:'<?php echo $row['event_title']; ?>', y:<?php echo $row['ordersAmount']; ?>}
                                    //                                    y: 56.33
        <?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',y:100}";
}
?>
                            //                                , {
                            //                                    name: 'Chrome',
                            //                                    y: 24.03,
                            //                                    sliced: true,
                            //                                    selected: true
                            //                                }, {
                            //                                    name: 'Firefox',
                            //                                    y: 10.38
                            //                                }, {
                            //                                    name: 'Safari',
                            //                                    y: 4.77
                            //                                }, {
                            //                                    name: 'Opera',
                            //                                    y: 0.91
                            //                                }, {
                            //                                    name: 'Proprietary or Undetectable',
                            //                                    y: 0.2
                            //                                }
                            ]
                    }]
            });
            });
            });</script>


<!-- 1st PIA CHART END HERE-->


<!--BAR CHART START 2 HERE-->

<script type="text/javascript">
            $(function () {
            var chart = Highcharts.chart('large', {
            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Sales breakup by events'
                    },
                    subtitle: {
                    text: 'E'
                    },
                    legend: {
                    align: 'right',
                            verticalAlign: 'middle',
                            layout: 'vertical'
                    },
                    xAxis: {
                    categories: ['<?php echo $row['event_title']; ?>'],
                            labels: {
                            x: - 10
                            }
                    },
                    yAxis: {
                    allowDecimals: false,
                            title: {
                            text: 'Amount'
                            }
                    },
                    series: [<?php
//sales breakup by events
if ($today_param == true) {
    $param_salesbe = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_salesbe = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_salesbe = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_salesbe = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $month_param_end_date . "')";
}
else
{
     $param_salesbe = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}
if (!empty($paramevt)) {
    $paramevtt = " AND e.event_id='$paramevt' ";
}

$query = "Select 
        e.`event_id`,
        e.`event_title`,

        IFNULL(SUM(o.`order_total_amount`),0) as `ordersAmount`

        FROM `events` as e
        LEFT JOIN `order_events` as oe ON oe.OE_event_id=e.event_id
        LEFT JOIN `orders` as o ON o.order_id=oe.OE_order_id " . $param_salesbe . "

        WHERE e.`event_created_by`='$login_user_id' $paramevtt  GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                            { name:'<?php echo $row['event_title']; ?>', data:[<?php echo intval($row['ordersAmount']); ?>]}<?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',data:100}";
}
?>
                    //                        {
                    //                        name: 'Christmas Eve',
                    //                                data: [1, 4, 3]
                    //                        }, {
                    //                        name: 'Christmas Day before dinner',
                    //                                data: [6, 4, 2]
                    //                        }, {
                    //                        name: 'Christmas Day after dinner',
                    //                                data: [8, 4, 3]
                    //                        }

                    ],
                    responsive: {
                    rules: [{
                    condition: {
                    maxWidth: 500
                    },
                            chartOptions: {
                            legend: {
                            align: 'center',
                                    verticalAlign: 'bottom',
                                    layout: 'horizontal'
                            },
                                    yAxis: {
                                    labels: {
                                    align: 'left',
                                            x: 0,
                                            y: - 5
                                    },
                                            title: {
                                            text: null
                                            }
                                    },
                                    subtitle: {
                                    text: null
                                    },
                                    credits: {
                                    enabled: false
                                    }
                            }
                    }]
                    }
            });
                    $('#small').click(function () {
            chart.setSize(400, 300);
            });
                    $('#large').click(function () {
            chart.setSize(600, 300);
            });
            });</script>
<!--BAR CHART 2 END HERE-->




<!--BAR CHART START 3 HERE-->

<script type="text/javascript">
            $(function () {
            var chart = Highcharts.chart('performance', {

            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Sales Earnings By Events'
                    },
                    subtitle: {
                    text: 'Showing Earnings Reports'
                    },
                    legend: {
                    align: 'right',
                            verticalAlign: 'middle',
                            layout: 'vertical'
                    },
                    xAxis: {
                    categories: ['All Earnings Reports'],
                            labels: {
                            x: - 10
                            }
                    },
                    yAxis: {
                    allowDecimals: false,
                            title: {
                            text: 'Amount'
                            }
                    },
                    series: [
<?php
$makestring = '';
//$today = strtotime(date('Y-m-d'));
////Total previous Date show Start here
//for ($i = 10; $i >= 0; $i--) {
//
//    $month = date("M", strtotime("-" . $i . " month ", $today));
//    $year = date("Y", strtotime("-" . $i . " month ", $today));
//
//    $formatmonth = date("Y-m-d", strtotime("-" . $i . " month ", $today));
//
//    $d = new DateTime($formatmonth);
//    $month_last_date = $d->format('Y-m-t');
//    $month_first_date = $d->format('Y-m-01');
//echo $month . "-" . $year . "-:-" . $month_first_date . ":-:" . $month_last_date . "<br>";
//sales earning query by month
if ($today_param == true) {
    $param_salesem = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_salesem = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_salesem = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_salesem = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $month_param_end_date . "')";
}
else
{
     $param_salesem = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}
if (!empty($paramevt)) {
    $paramevtt = " AND A.event_id='$paramevt' ";
}


//(DATE_FORMAT(o.order_created,'%Y-%m-%d')>='$month_first_date' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='$month_last_date') AND
$sqlssr = mysqli_query($con, "SELECT A.event_id,A.event_title,B.netearning as total_sales FROM 
                                (SELECT 
                                 e.event_id,
                                 e.event_title 
                                 FROM `events` as e
                                 WHERE e.event_created_by='$login_user_id') AS A,
                                (SELECT 
                                oe.OE_event_id,
                                IFNULL(SUM(o.`order_total_amount`-(o.`order_vat_amount`+o.`order_discount_amount`+o.`order_shipment_charge`)),0) as netearning
                                FROM order_events as oe 
                                LEFT JOIN orders as o ON oe.OE_order_id=o.order_id  " . $param_salesem . "
                                LEFT JOIN `events` as e on oe.OE_event_id=e.event_id 
                                WHERE e.event_created_by='$login_user_id' 
                                GROUP BY oe.OE_event_id) AS B 
                                WHERE A.event_id=B.OE_event_id $paramevtt");
$sqlssrow = mysqli_num_rows($sqlssr);
$k = 1;
if ($sqlssrow == 0) {
    ?>
                        {
                        name: 'No Events Found',
                                data: [0]
                        },
    <?php
} else {
    //$j = 1;
    while ($rorr = mysqli_fetch_array($sqlssr)) {
        $makestring .="{ name: '" . $rorr['event_title'] . "',data: [" . intval($rorr['total_sales']) . "] },";

        //$j++;
    }
}
//}

if (!empty($makestring)) {
    $purnishmakestring = rtrim($makestring, ",");
}



echo $purnishmakestring;
?>
                    //{ name: 'Default',data: [0] }
                    //                            {
                    //                                name: 'Christmas Day before dinner',
                    //                                data: [6, 4, 2]
                    //                            }, {
                    //                                name: 'Christmas Day after dinner',
                    //                                data: [8, 4, 3]
                    //                            }
                    ],
                    responsive: {
                    rules: [{
                    condition: {
                    maxWidth: 500
                    },
                            chartOptions: {
                            legend: {
                            align: 'center',
                                    verticalAlign: 'bottom',
                                    layout: 'horizontal'
                            },
                                    yAxis: {
                                    labels: {
                                    align: 'left',
                                            x: 0,
                                            y: - 5
                                    },
                                            title: {
                                            text: null
                                            }
                                    },
                                    subtitle: {
                                    text: null
                                    },
                                    credits: {
                                    enabled: false
                                    }
                            }
                    }]
                    }
            });
                    $('#large').click(function () {
            chart.setSize(600, 300);
            });
            });</script>
<!--BAR  CHART END 3 HERE-->

<!--//44-->
<script type="text/javascript">
            $(function () {
            var chart = Highcharts.chart('samidonutChart', {

            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Page Views'
                    },
                    subtitle: {
                    text: 'Viewers Number'
                    },
                    legend: {
                    align: 'right',
                            verticalAlign: 'middle',
                            layout: 'vertical'
                    },
                    xAxis: {
                    categories: ['All Viewers Reports'],
                            labels: {
                            x: - 10
                            }
                    },
                    yAxis: {
                    allowDecimals: false,
                            title: {
                            text: 'Number'
                            }
                    },
                    series: [
<?php
//page views

if ($today_param == true) {
    $param_pv = " AND DATE_FORMAT(evp.date,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_pv = " AND DATE_FORMAT(evp.date,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_pv = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(evp.date,'%Y-%m-%d')<='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_pv = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(evp.date,'%Y-%m-%d')<='" . $month_param_end_date . "')";
}
else
{
     $param_pv = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}
if (!empty($paramevt)) {
    $paramevtt = " AND e.event_id='$paramevt' ";
}

$query = "SELECT 
                                    e.event_id,
                                    e.event_title,
                                    count(evp.event_id) as `pageviewes`,
                                    e.event_created_by
                                    FROM `events` as e 
                                    LEFT JOIN `event_visit_page` as evp ON e.event_id=evp.event_id " . $param_pv . "
                                    WHERE e.event_created_by='$login_user_id' $paramevtt
                                    GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                            {name:'<?php echo $row['event_title']; ?>', data:[ <?php echo $row['pageviewes']; ?>]},
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',data:[100]}";
}
?>
                    //{ name: 'Default',data: [0] }
                    //                            {
                    //                                name: 'Christmas Day before dinner',
                    //                                data: [6, 4, 2]
                    //                            }, {
                    //                                name: 'Christmas Day after dinner',
                    //                                data: [8, 4, 3]
                    //                            }
                    ],
                    responsive: {
                    rules: [{
                    condition: {
                    maxWidth: 500
                    },
                            chartOptions: {
                            legend: {
                            align: 'center',
                                    verticalAlign: 'bottom',
                                    layout: 'horizontal'
                            },
                                    yAxis: {
                                    labels: {
                                    align: 'left',
                                            x: 0,
                                            y: - 5
                                    },
                                            title: {
                                            text: null
                                            }
                                    },
                                    subtitle: {
                                    text: null
                                    },
                                    credits: {
                                    enabled: false
                                    }
                            }
                    }]
                    }
            });
                    $('#large').click(function () {
            chart.setSize(600, 300);
            });
            });</script>
<!--BAR  CHART END 44 HERE-->





<!--BAR  CHART STAR 5 HERE-->

<script type="text/javascript">
            $(function () {
            var chart = Highcharts.chart('eventwise', {

            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Page Views by source'
                    },
                    subtitle: {
                    text: 'Resize the frame or click buttons to change appearance'
                    },
                    legend: {
                    align: 'right',
                            verticalAlign: 'middle',
                            layout: 'vertical'
                    },
                    xAxis: {
                    categories: ['<?php echo $row['event_title']; ?>'],
                            labels: {
                            x: - 10
                            }
                    },
                    yAxis: {
                    allowDecimals: false,
                            title: {
                            text: 'Amount'
                            }
                    },
                    series: [
<?php
if ($today_param == true) {
    $param_pvs = " AND DATE_FORMAT(evp.date,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_pvs = " AND DATE_FORMAT(evp.date,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_pvs = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(evp.date,'%Y-%m-%d')<='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_pvs = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(evp.date,'%Y-%m-%d')<='" . $month_param_end_date . "')";
}
else
{
     $param_pvs = " AND (DATE_FORMAT(evp.date,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(evp.date,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}

if (!empty($paramevt)) {
    $paramevtt = " AND e.event_id='$paramevt' ";
}

$query = "SELECT IFNULL(count(evp.`event_id`),0) as total FROM `event_visit_page` as evp
LEFT JOIN `events` as e ON evp.event_id=e.event_id 
WHERE e.event_created_by='$login_user_id' $paramevtt " . $param_pvs;
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                            { name:'Viewed By All Source', data:[<?php echo $row['total']; ?>]}<?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',data:[100]}";
}
?>


                    //            name: 'Christmas Eve',
                    //            data: [1, 4, 3]
                    //        }, {
                    //            name: 'Christmas Day before dinner',
                    //            data: [6, 4, 2]
                    //        }, {
                    //            name: 'Christmas Day after dinner',
                    //            data: [8, 4, 3]
                    //        }
                    ],
                    responsive: {
                    rules: [{
                    condition: {
                    maxWidth: 500
                    },
                            chartOptions: {
                            legend: {
                            align: 'center',
                                    verticalAlign: 'bottom',
                                    layout: 'horizontal'
                            },
                                    yAxis: {
                                    labels: {
                                    align: 'left',
                                            x: 0,
                                            y: - 5
                                    },
                                            title: {
                                            text: null
                                            }
                                    },
                                    subtitle: {
                                    text: null
                                    },
                                    credits: {
                                    enabled: false
                                    }
                            }
                    }]
                    }
            });
                    $('#small').click(function () {
            chart.setSize(400, 300);
            });
                    $('#large').click(function () {
            chart.setSize(600, 300);
            });
            });</script>
<!--BAR 5 CHART END HERE-->





<!--DONUT   CHART START 6 HERE-->

<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script type="text/javascript">
            $(function () {
            Highcharts.chart('donutchart', {
            chart: {
            type: 'pie',
                    options3d: {
                    enabled: true,
                            alpha: 45
                    }
            },
                    title: {
                    text: 'Earning in Number'
                    },
                    subtitle: {
                    //                                text: 'Earning in Number Chart'
                    },
                    plotOptions: {
                    pie: {
                    innerSize: 100,
                            depth: 45
                    }
                    },
                    series: [


                    {
                    name: 'Earning Number',
                            data: [<?php
//earning in number 
if ($today_param == true) {
    $param_ein = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $today_param_date . "'";
} elseif ($yesterday_param == true) {
    $param_ein = " AND DATE_FORMAT(o.order_created,'%Y-%m-%d')='" . $yesterday_param_date . "'";
} elseif ($week_param == true) {
    $param_ein = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $week_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $week_param_end_date . "')";
} elseif ($month_param == true) {
    $param_ein = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . $month_param_start_date . "' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='" . $month_param_end_date . "')";
}
else
{
     $param_ein = " AND (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='2015-01-01' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')>='" . date('Y-m-d') . "')";
}
if (!empty($paramevt)) {
    $paramevtt = " AND A.event_id='$paramevt' ";
}


$query = "SELECT A.event_id,A.event_title,B.netearning as total_sales FROM 
                                (SELECT 
                                 e.event_id,
                                 e.event_title 
                                 FROM `events` as e
                                 WHERE e.event_created_by='$login_user_id') AS A,
                                (SELECT 
                                oe.OE_event_id,
                                IFNULL(COUNT(o.`order_total_amount`),0) as netearning
                                FROM order_events as oe 
                                LEFT JOIN orders as o ON oe.OE_order_id=o.order_id  " . $param_ein . "
                                LEFT JOIN `events` as e on oe.OE_event_id=e.event_id 
                                WHERE e.event_created_by='$login_user_id' 
                                GROUP BY oe.OE_event_id) AS B 
                                WHERE A.event_id=B.OE_event_id $paramevtt";
$xsql = mysqli_query($con, $query);
$chk = mysqli_num_rows($xsql);
$i = 1;
if ($chk !== 0) {
    ?>

    <?php
    while ($row = mysqli_fetch_array($xsql)) {
        ?>
                                    ['<?php echo $row['event_title']; ?>', <?php echo $row['total_sales']; ?>]<?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',data:100}";
}
?>


                            //                                                ['Bananas', 8],
                            //                                                ['Kiwi', 3],
                            //                                                ['Mixed nuts', 1],
                            //                                                ['Oranges', 6],
                            //                                                ['Apples', 8],
                            //                                                ['Pears', 4],
                            //                                                ['Clementines', 4],
                            //                                                ['Reddish (bag)', 1],
                            //                                                ['Grapes (bunch)', 1]
                            ]
                    }
                    ]
            });
            });</script>



<!--DONUT  CHART 6 END HERE-->

<script>
            // Init DatetimePicker

            demo.initFormExtendedDatetimepickers();
</script>


</html>
