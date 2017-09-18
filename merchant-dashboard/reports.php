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
        <?php echo $cms->pageTitle("Reports | Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->


        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("reports")); ?>
        <!--./CSS Part end here-->



    </head>

    <body ng-app="merchantaj" ng-controller="reportsController">
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
                            <?php include ('includes/box_reports.php'); ?> 
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
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

if ($chk == 0) {
    ?>
                ['No Event Found', 'ordersAmount']
    <?php
} else {
    $i = 1;
    //print_r($xsql);
    ?>
                ['Events', 'Total Order'],
    <?php
    while ($row = mysqli_fetch_array($xsql)) {
        ?>
                    ['<?php echo $row['event_title']; ?>',<?php echo $row['ordersAmount']; ?>]
        <?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
}
?>
            ]);
                    var options = {
                        title: 'Event Overall Sales Percentage (%)',
                        is3D: true,
                    };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


    <!-- 1st PIA CHART END HERE-->


    <!--BAR 2 CHART START HERE-->
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
<?php
$query = "SELECT 

                                                                                e.`event_id`,
                                                                                e.`event_title`,
                                                                                sum(`order_total_amount`) as `total_sales`

                                                                                FROM  `events` as e 
                                                                                INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='83'
                                                                                GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$result = mysqli_num_rows($msql);
if ($result == 0) {
    ?>
                ['No Event Found', 'total_sales']
    <?php
} else {
    ?>
                ['Element', 'Density', {role: 'style'}],
    <?php
    $i = 1;
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                    ['<?php echo $row['event_title']; ?>',<?php echo $row['total_sales']; ?>, "#b87333"]
        <?php
        if ($i != $result) {
            echo ",";
        }
        ?>


        <?php
        $i++;
    }
}
?>
            ]);
                    var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);
            var options = {
                title: "Event Wise Selse Amount",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
        }
    </script>
    <!--BAR 2 CHART END HERE-->




    <!--BAR 3 CHART START HERE-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>    
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Year', 'Order Quantity'],
<?php
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
    if ($sqlssrow == 0) {
        ?>
                        ['<?php echo $month; ?>', <?php echo $year; ?>, 0],
        <?php
    } else {
        while($rorr=mysqli_fetch_array($sqlssr)){
        ?>
            ['<?php echo $month."-".$year; ?>', <?php echo $year; ?>, <?php echo $rorr['total_sales']; ?>],         
        <?php
        }
    }
}
?>

//                ['Dec', 2013, 10],
//                ['Jan', 2013, 6],
//                ['Mar', 2012, 22],
//                ['Jun', 2011, 44]




            ]);
            var options = {
                title: 'Overall Event Performance',
                vAxis: {title: 'Year', titleTextStyle: {color: 'red'}}};
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
    <!--BAR 3 CHART END HERE-->


    <!--BAR 4 CHART START HERE-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([

<?php
$query = "SELECT 

                                                            e.`event_id`,
                                                            e.`event_title`,
                                                            sum(`order_total_amount`)-(sum(`order_vat_amount`+`order_discount_amount`+`order_promotion_discount_amount`+`order_shipment_charge`)) as `earnings`

                                                            FROM  `events` as e 
                                                            INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='$login_user_id'
                                                            GROUP BY e.event_id";
$msql = mysqli_query($con, $query);
$result = mysqli_num_rows($msql);
if ($result == 0) {
    ?>
                ['No Event Found', 'earnings']
    <?php
} else {
    ?>

                ["Element", "Density", {role: "style"}],
    <?php
    $i = 1;
    while ($row = mysqli_fetch_array($msql)) {
        ?>
                    ['<?php echo $row['event_title']; ?>',<?php echo $row['earnings']; ?>, "#b87333"]
        <?php
        if ($i != $result) {
            echo ",";
        }
        ?>


        <?php
        $i++;
    }
}
?>
            ]);
                    var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);
            var options = {
                title: "EventWise Earnings",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>
    <!--BAR 4 CHART END HERE-->


    <!--DONUT  5 CHART START HERE-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([

<?php
$query = "SELECT 

                                                e.`event_id`,
                                                e.`event_title`,
                                                count(`order_total_amount`) as `earning in number`

                                                FROM  `events` as e 
                                                INNER JOIN `orders` as o ON o.order_id=e.event_id WHERE e.`event_created_by`='$login_user_id'
                                                GROUP BY e.event_id";
$xsql = mysqli_query($con, $query);
$chk = mysqli_num_rows($xsql);

if ($chk == 0) {
    ?>
                ['No Event Found', 'earning in number']
    <?php
} else {
    $i = 1;
    //print_r($xsql);
    ?>
                ['Task', 'Hours per Day'],
    <?php
    while ($row = mysqli_fetch_array($xsql)) {
        ?>
                    ['<?php echo $row['event_title']; ?>',<?php echo $row['earning in number']; ?>]
        <?php
        if ($i != $chk) {
            echo ",";
        }
        ?>
        <?php
        $i++;
    }
}
?>


            ]);
                    var options = {
                        title: 'Earning in Number',
                        pieHole: 0.4,
                    };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>



    <!--DONUT  5  CHART END HERE-->




</html>
