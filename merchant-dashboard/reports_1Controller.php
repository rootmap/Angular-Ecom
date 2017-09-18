<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id = $data->reports
        ;
/*sales in number start here*/
if($id == 1){
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
}
/*sales in number end here*/

/*sales breakup by event start here*/
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
/*sales breakup by event end here*/

/*Sales Earnings By Events Month Start here*/

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
/*Sales Earnings By Events Month end here*/

/*Page Views By Event User start here*/
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
/*Page Views By Event User end here*/

/*Page Views By Event User Start here */
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
/*Page Views By Event User end here*/

/*Earning in Number start here*/
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
/*Earning in Number End here*/