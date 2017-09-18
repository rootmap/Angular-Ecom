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


    <from class="modal fade" id="myModal" tabindex="-1" ng-model="modelData" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Step 2 -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><legend><span class="ti-timer"></span>Choose Your Date Period</legend></h4>
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
    <!--model end here-->

</head>

<body ng-app="merchantaj" ng-controller="reportsController">
    <div class="wrapper">
        <?php include ('includes/sidebar.php'); ?>

        <div class="main-panel">
            <?php include ('includes/top_navigation.php'); ?> 

            <!--navbar Start here-->
            <nav class="navbar navbar-default bg-primary">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="nav navbar-nav">
                            <li class="dropdown" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All EVENTS<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li ng-repeat="allEvent in alleventdata"><a href="#">{{allEvent.event_title}}</a></li>
                                   

                                </ul>

                             
                            </li>
                        </ul>

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="rht-nav">
                        <style type="text/css">
                            div#rht-nav ul li.active a{
                                color: #fff;
                                font-weight: bolder;
                            }
                            
                        </style>    
                        <ul ng-init="rht='showTotalrht'" class="nav navbar-nav navbar-right">
                            <li class="" ng-class="{'active':rht=='showTotalrht', inactive:rht!='showTotalrht'}"><a ng-click="rht='showTotalrht'" href="#">TOTAL</a></li>
                            <li ng-class="{'active':rht=='showTodayrht', inactive:rht!='showTodayrht'}" class=""><a ng-click="rht='showTodayrht'" href="#">TODAY</a></li>
                            <li  ng-class="{'active':rht=='showYesterdayrht', inactive:rht!='showYesterdayrht'}"><a ng-click="rht='showYesterdayrht'" href="#">YESTERDAY</a></li>
                            <li  ng-class="{'active':rht=='showThisWeekrht', inactive:rht!='showThisWeekrht'}"><a ng-click="rht='showThisWeekrht'" href="#">THIS WEEK</a></li>
                            <li ng-class="{'active':rht=='showThisMonthrht', inactive:rht!='showThisMonthrht'}"><a ng-click="rht='showThisMonthrht'" href="#">THIS MONTH</a></li>
                            <li ng-class="{'active':rht=='showCustomerrht', inactive:rht!='showCustomerrht'}">
                                <a ng-click="rht='showCustomerrht'" href="#" data-toggle="modal" data-target="#myModal">CUSTOMER</a>
                            </li>

                            <li><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>

                        </ul>

                    </div><!-- /.navbar-collapse -->


                </div><!-- /.container-fluid -->
            </nav>
            <!--navbar end here-->

<!--            navbar 2 start here -->
            <nav class="navbar navbar-default bg-info">
                <div class="container text-center">

                    <div class="col-md-2">
                        <h5 class="text-uppercase font-size-12 letter-spacing-1-2">Total Sales</h5>
                        <i class="fa fa-taka"></i>৳ 

                        <span class="odometer-value">{{totalSales}}</span>
                    </div>   
                    <div class="col-md-2 ">
                        <h5 class="text-uppercase font-size-12 letter-spacing-1-2">Net Earnings</h5>
                        <i class="fa fa-taka"></i>৳
                        <span class="odometer-value">{{NetEarnings}}</span>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-uppercase font-size-12 letter-spacing-1-2">Remaining To Transfer</h5>
                        <i class="fa fa-taka"></i>৳
                        <span class="odometer-value">{{RemainingToTransfer}}</span>
                    </div>
                    <div class="col-md-2">
                        <h5 class="text-uppercase font-size-12 letter-spacing-1-2">Refunds</h5>
                        <i class="fa fa-taka"></i>৳
                        <span class="odometer-value">{{Refunds}}</span>
                    </div>
                    <div class="col-md-2">
                        <h5 class="text-uppercase font-size-12 letter-spacing-1-2">Registration</h5>
                        <i class="fa fa-taka"></i>৳
                        <span class="odometer-value">{{Registration}}</span>
                    </div>

                </div>
            </nav>
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
$query = "Select 
                                        e.`event_id`,
                                        e.`event_title`,

                                        count(o.order_id) as `ordersAmount`

                                        FROM `events` as e
                                        INNER JOIN `order_events` as oe ON oe.OE_event_id=e.event_id
                                        INNER JOIN `orders` as o ON o.order_id=oe.OE_order_id

                                        WHERE e.`event_created_by`='$login_user_id'

                                        GROUP BY e.event_id DESC";
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
<script src="https://code.highcharts.com/highcharts.js"></script>
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
$query = "SELECT 

                             e.`event_id`,
                             e.`event_title`,
                             sum(`order_total_amount`) as `total_sales`

                             FROM  `events` as e 
                             INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='$login_user_id'
                             GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                            { name:'<?php echo $row['event_title']; ?>', data:[<?php echo $row['total_sales']; ?>]}<?php
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
            $(function () {
            var chart = Highcharts.chart('performance', {

            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Sales Earnings By Events Month'
                    },
                    subtitle: {
                    text: 'Showing Last 10 Month Reports'
                    },
                    legend: {
                    align: 'right',
                            verticalAlign: 'middle',
                            layout: 'vertical'
                    },
                    xAxis: {
                    categories: ['All Event Reports'],
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
$today = strtotime(date('Y-m-d'));
//Total previous Date show Start here
for ($i = 10; $i >= 0; $i--) {

    $month = date("M", strtotime("-" . $i . " month ", $today));
    $year = date("Y", strtotime("-" . $i . " month ", $today));

    $formatmonth = date("Y-m-d", strtotime("-" . $i . " month ", $today));
//$month_last_date = date("Y-m-t", strtotime($formatmonth));
    $d = new DateTime($formatmonth);
    $month_last_date = $d->format('Y-m-t');
    $month_first_date = $d->format('Y-m-01');
//echo $month . "-" . $year . "-:-" . $month_first_date . ":-:" . $month_last_date . "<br>";
    $sqlssr = mysqli_query($con, "SELECT 
                                                                        e.`event_id`,
                                                                        e.`event_title`,
                                                                        DATE_FORMAT(o.order_created,'%Y-%m-%d') AS order_created,
                                                                        e.event_created_by,
                                                                        IFNULL(sum(`order_total_amount`),0) as `total_sales`
                                                                        FROM  `events` as e 
                                                                        INNER JOIN `orders` as o ON o.order_id=e.event_id
                                                                        WHERE (DATE_FORMAT(o.order_created,'%Y-%m-%d')>='$month_first_date' AND DATE_FORMAT(o.order_created,'%Y-%m-%d')<='$month_last_date') AND e.event_created_by='$login_user_id'");
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
        $j = 1;
        while ($rorr = mysqli_fetch_array($sqlssr)) {
            $makestring .="{ name: '" . $month . " " . $year . "',data: [" . intval($rorr['total_sales']) . "] },";

            $j++;
        }
    }
}

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


<!--SAMI DONUT  CHART 4 START HERE --->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
            $(function () {
            Highcharts.chart('samidonutChart', {
            chart: {
            plotBackgroundColor: null,
                    plotBorderWidth: 0,
                    plotShadow: false
            },
                    title: {
                    text: 'Page Views',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                    },
                    tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                    pie: {
                    dataLabels: {
                    enabled: true,
                            distance: - 50,
                            style: {
                            fontWeight: 'bold',
                                    color: 'white'
                            }
                    },
                            startAngle: - 90,
                            endAngle: 90,
                            center: ['50%', '75%']
                    }
                    },
                    series: [{
                    type: 'pie',
                            name: 'Page Views By Event User',
                            innerSize: '50%',
                            data: [
<?php
$today = strtotime(date('Y-m-d'));
//Total previous Date show Start here
//                                        $query = "SELECT 
//                                        e.event_id,
//                                        e.event_title,
//                                        count(e.event_id) as `pageviewes`
//
//                                        FROM `event_visit_page` as evp
//                                        INNER JOIN `events` as e ON e.event_id=evp.event_id
//
//                                        WHERE e.event_created_by='$login_user_id' AND DATE_FORMAT(date,'%Y-%m-%d')='$today'
//                                        GROUP BY DATE_FORMAT(date,'%Y-%m-%d')";

$query = "SELECT 
                                    e.event_id,
                                    e.event_title,
                                    count(evp.event_id) as `pageviewes`,
                                    e.event_created_by

                                    FROM `event_visit_page` as evp,`events` as e

                                    WHERE e.event_id=evp.event_id AND e.event_created_by='32'

                                    GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                                    ['<?php echo $row['event_title']; ?>', <?php echo $row['pageviewes']; ?>],
        <?php
        $i++;
    }
} else {
    echo "{name:'No Event Found',data:100}";
}
?>
                            {
                            name: 'Proprietary or Undetectable',
                                    y: 0.2,
                                    dataLabels: {
                                    enabled: false
                                    }
                            }
                            ]
                    }]
            });
            });</script>
<!--SAMI DONUT CHART 4 END HERE --->




<!--BAR  CHART STAR 5 HERE-->
<script src="https://code.highcharts.com/highcharts.js"></script>
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
$query = "SELECT 

                         e.`event_id`,
                         e.`event_title`,
                         sum(`order_total_amount`) as `total_sales`

                         FROM  `events` as e 
                         INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='$login_user_id'
                         GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$chk = mysqli_num_rows($msql);
$i = 1;
if ($chk != 0) {
    ?>
    <?php
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                            { name:'<?php echo $row['event_title']; ?>', data:[<?php echo $row['total_sales']; ?>]}<?php
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                    name: 'Delivered amount',
                            data: [<?php
$query = "SELECT 

                                        e.`event_id`,
                                        e.`event_title`,
                                        count(`order_total_amount`) as `earninginnumber`

                                        FROM  `events` as e 
                                        INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='$login_user_id'
                                        GROUP BY e.event_id";
$xsql = mysqli_query($con, $query);
$chk = mysqli_num_rows($xsql);
$i = 1;
if ($chk !== 0) {
    ?>

    <?php
    while ($row = mysqli_fetch_array($xsql)) {
        ?>
                                    ['<?php echo $row['event_title']; ?>', <?php echo $row['earninginnumber']; ?>]<?php
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
