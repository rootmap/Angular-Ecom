<?php
include './config/config.php';
include './lib/mpdf/mpdf.php';
if (isset($_GET['id'])) {
    $orderID = $_GET['id'];
}
$userID = 0;
$user_email = '';


if (!checkUserLogin()) {
    $link = baseUrl('index.php');
    redirect($link);
} else {
    $userID = getSession('user_id');
    $user_email = getSession('user_email');
    $sessionID = session_id();
    $sqlcheck = mysqli_query($con, "SELECT * FROM orders WHERE order_session_id='" . $sessionID . "'");
    $chksqlcount = mysqli_num_rows($sqlcheck);
    if ($chksqlcount == 1) {
        session_regenerate_id();
        $sessionID = session_id();
    } else {
        $sessionID = session_id();
    }
}

$orderDetails = array();
$orderDetails2 = array();
$orderDetails3 = array();
$strSeatIds = "";

$sqlOrderDetails = "SELECT order_events.OE_id,order_events.OE_order_id,order_events.OE_event_id,"
        . "order_events.OE_session_id,order_events.OE_user_id,order_items.OI_id,order_items.OI_unique_id,"
        . "order_items.OI_OE_id,order_items.OI_order_id,order_items.OI_session_id,"
        . "order_items.OI_item_type,order_items.OI_venue_id,order_items.OI_item_id,order_items.OI_quantity,"
        . "order_items.OI_unit_price as OI_unit_price,order_items.OI_unit_discount,events.event_id,events.event_category_id,"
        . "events.event_title,events.event_web_logo,events.event_description,events.event_terms_conditions,"
        . "categories.category_id,categories.category_title,event_venues.venue_start_time,"
        . "event_venues.venue_end_time,event_venues.venue_address,"
        . "event_venues.venue_id,event_venues.venue_title,event_venues.venue_event_id,"
        . "event_venues.venue_start_date,"
        . "orders.order_total_item,orders.order_id,orders.order_total_amount,orders.order_vat_amount,"
        . "orders.order_discount_amount,orders.order_shipment_charge,orders.order_number,"
        . "CONCAT(users.user_first_name, ' ',users.user_last_name) as defname,"
        . "user_addresses.UA_phone as defphone,"
        . "user_addresses.UA_address as defaddress,"
        . "orders.order_status,orders.order_payment_type,orders.order_billing_first_name,orders.order_billing_last_name,"
        . "orders.order_billing_phone,orders.order_billing_address,"
        . "users.user_email,users.user_first_name,users.user_last_name,"
        . " CASE OI_item_type WHEN 'ticket' THEN ' Ticket'"
        . " ELSE CASE OI_item_type WHEN 'include' THEN 'Include' "
        . " ELSE CASE OI_item_type WHEN 'seat' THEN 'Seat' "
        . " ELSE 'Others' END END END AS item_type "
        . " FROM order_items "
        . " LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id "
        . " LEFT JOIN events ON events.event_id = order_events.OE_event_id "
        . " LEFT JOIN categories ON categories.category_id = events.event_category_id "
        . " LEFT JOIN orders ON orders.order_id = order_items.OI_order_id "
        . " LEFT JOIN event_venues ON events.event_id = event_venues.venue_event_id "
        . " LEFT JOIN users ON order_events.OE_user_id = users.user_id "
        . " LEFT JOIN user_addresses on user_addresses.UA_user_id=users.user_id"
        . " WHERE order_events.OE_order_id ='$orderID' GROUP BY order_events.OE_order_id";

$sqlOrderDetails2 = "SELECT alldata.* FROM (SELECT order_events.OE_order_id, order_items.OI_item_type,order_items.OI_quantity,
        order_items.OI_unit_price,order_items.OI_unit_discount,events.event_id,events.event_category_id,
        events.event_title,event_includes.EI_name 
         FROM order_items 
         LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id 
         LEFT JOIN events ON events.event_id = order_events.OE_event_id 
         LEFT JOIN categories ON categories.category_id = events.event_category_id 
         LEFT JOIN orders ON orders.order_id = order_items.OI_order_id 
         LEFT JOIN event_includes ON event_includes.EI_id=order_items.OI_item_id              
         WHERE order_events.OE_order_id ='$orderID') as alldata WHERE alldata.OI_item_type='include'";

$sqlOrderDetails3 = "SELECT alldata.* FROM (SELECT order_events.OE_order_id, order_items.OI_item_type,order_items.OI_quantity,
        order_items.OI_unit_price,order_items.OI_unit_discount,events.event_id,events.event_category_id,
        events.event_title,event_ticket_types.TT_type_title,order_items.OI_item_id 
         FROM order_items 
         LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id 
         LEFT JOIN events ON events.event_id = order_events.OE_event_id 
         LEFT JOIN categories ON categories.category_id = events.event_category_id 
         LEFT JOIN orders ON orders.order_id = order_items.OI_order_id 
         LEFT JOIN event_ticket_types ON event_ticket_types.TT_id=order_items.OI_item_id              
         WHERE order_events.OE_order_id ='$orderID') as alldata WHERE alldata.OI_item_type='ticket'";


// " LEFT JOIN event_form_values ON event_form_values.EFV_session_id = order_events.OE_session_id "

$resultOrderDetails = mysqli_query($con, $sqlOrderDetails);
if ($resultOrderDetails) {
    while ($resultOrderDetailsObj = mysqli_fetch_object($resultOrderDetails)) {
        $orderDetails[] = $resultOrderDetailsObj;
        if ($resultOrderDetailsObj->item_type == "Seat") {
            $strSeatIds .= $resultOrderDetailsObj->OI_id . ",";
        }
    }
} else {
    if (DEBUG) {
        $err = "resultOrderDetails error: " . mysqli_error($con);
    } else {
        $err = "resultOrderDetails query failed";
    }
}

$resultOrderDetails2 = mysqli_query($con, $sqlOrderDetails2);
$orderDetailscount2 = mysqli_num_rows($resultOrderDetails2);
if ($orderDetailscount2 != 0) {
    while ($resultOrderDetailsObj2 = mysqli_fetch_object($resultOrderDetails2)) {
        $orderDetails2[] = $resultOrderDetailsObj2;
    }
}

$resultOrderDetails3 = mysqli_query($con, $sqlOrderDetails3);
$orderDetailscount3 = mysqli_num_rows($resultOrderDetails3);
if ($orderDetailscount3 != 0) {
    while ($resultOrderDetailsObj3 = mysqli_fetch_object($resultOrderDetails3)) {
        $orderDetails3[] = $resultOrderDetailsObj3;
    }
}

$arrSeats = array();
$strSeatIds = rtrim($strSeatIds, ",");
if (!empty($strSeatIds)) {
    $strSeatIds = rtrim($strSeatIds, ",");
    $sqlSelectSeats = "SELECT order_items.*,events.event_title,events.event_web_logo,events.event_description,"
            . "events.event_terms_conditions,order_seats.*,event_venues.venue_start_time,"
            . "event_venues.venue_end_time,event_venues.venue_address,"
            . "event_venues.venue_id,event_venues.venue_title,event_venues.venue_event_id,"
            . "event_venues.venue_start_date,orders.order_status,orders.order_payment_type,"
            . "orders.order_billing_first_name,orders.order_billing_last_name,"
            . "orders.order_billing_phone,orders.order_billing_address,categories.category_title,"
            . "seat_place_coordinate.SPC_id,seat_place_coordinate.SPC_SP_id,"
            . "seat_place_coordinate.SPC_title,seat_place_coordinate.SPC_shape_type,"
            . "users.user_first_name,users.user_last_name,users.user_email, "
            . "FROM order_items "
            . "LEFT JOIN order_seats ON order_seats.OS_OI_id = order_items.OI_id "
            . "LEFT JOIN seat_place_coordinate ON order_seats.OS_coordinate_id = seat_place_coordinate.SPC_id "
            . "LEFT JOIN events ON events.event_id = order_seats.OS_event_id "
            . "LEFT JOIN categories ON categories.category_id = events.event_category_id "
            . "LEFT JOIN orders ON orders.order_id = order_seats.OS_order_id "
            . "LEFT JOIN event_venues ON events.event_id = event_venues.venue_event_id "
            . "LEFT JOIN users ON orders.order_user_id = users.user_id "
            . "WHERE order_items.OI_id in ($strSeatIds)";


    $resultSelectSeats = mysqli_query($con, $sqlSelectSeats);
    if ($resultSelectSeats) {
        while ($resultSelectSeatsObj = mysqli_fetch_object($resultSelectSeats)) {
            $arrSeats[] = $resultSelectSeatsObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultSelectSeats error: " . mysqli_error($con);
        } else {
            $err = "resultSelectSeats query failed";
        }
    }
}





if (isset($_POST['btnDownload'])) {
    extract($_POST);

    $dateTimeNow = date("d-m-y H:i:s");
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 15, 16, 13);
    $mpdf->SetDisplayMode('fullpage');
    $stylesheet = file_get_contents(baseUrl() . "pdfticket/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->list_indent_first_level = 0;
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        $quantity = 1;
    }
    $url = baseUrl() . "pdfticket/e-ticket-mini.php?id=" . $OI_id . "&type=" . $OI_item_type . "&OS_id=" . $OS_id . "&quantity=" . $quantity;
    $html = file_get_contents($url);
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('e-ticket-' . $dateTimeNow . '.pdf', 'D');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include basePath('header_script.php'); ?>
        <!-- From customer order list page -->
        <link rel="stylesheet" type="text/css" href="<?php echo baseUrl('css/footable-0.1.css'); ?>">
        <link  rel="stylesheet" type="text/css" href="<?php echo baseUrl('css/footable.sortable-0.1.css'); ?>">
        <style type="text/css">
            table.main{
                border-collapse: collapse; 
                padding-left:5px;
                padding-right: 5px;
                width: 100%;
                border: 2px solid darkgray;
                font-family: sans-serif;
            }
            table.main td {
                padding-left: 8px;
                border: 2px solid darkgray;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-right: 5px;
                border-collapse: collapse;
            }

            .barcode {
                margin: 0;
                vertical-align: top;
                color: #000044;
            }

            .barcodecell {
                text-align: center;
                vertical-align: middle;
            }

            .event_logo{
                width: 100px;
                height: 80px;
            }

            .top_text{
                text-align: center;
                height: 30px;
                width: 50%;
                background-color: darkgray;
                border-radius: 5px;
                color: black;
                margin-left: auto;
                margin-right: auto;
                padding-top: 5px;
                font-family: sans-serif;
                font-weight: bold;
                border: 1px solid darkgray;
            }

            .no_border{
                border-style: none;
            }

        </style>
    </head>
    <body>
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>
        <div id="wrapper">
            <header>
                <div class="header-wrapper">
                    <?php include basePath('menu_top.php'); ?>
                    <?php include basePath('navigation.php'); ?>
                </div>
            </header>
            <div class="main-container">
                <div class="container">
                    <ul class="nav nav-pills nav-justified  nav-tab-bar">
                        <li><a href="<?php echo baseUrl(); ?>account"><i class="fa fa-dashboard"></i> User Settings</a> </li>
                        <li><a href="<?php echo baseUrl(); ?>address"><i class="fa fa-map-marker"></i> Default Address</a> </li>
                        <li ><a href="<?php echo baseUrl(); ?>mywishlist"><i class="fa fa-heart"></i> My Wishlist</a> </li>
                        <li class="active"><a href="<?php echo baseUrl(); ?>myorderlist"><i class="icon-doc-text"></i>Order History</a> </li>
                    </ul>
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-doc-text"></i> Order Details </h2>
                        <div class="table-order">
                            <div class="col-xs-12 col-sm-12">
                                <div class="table-inner-o">
                                    <table class="footable">
                                        <thead>
                                            <tr>
                                                <th>Event Logo</th>
                                                <th data-class="expand" data-sort-initial="true"> <span title="table sorted by this column on load">Event Title</span> </th>
                                                <th data-hide="phone" data-sort-ignore="true">Category Title</th>
                                                <th data-hide="phone" data-sort-ignore="true">Unit Price</th>
                                                <th data-hide="phone,tablet"><strong>Total Quantity</strong></th>
                                                <th data-hide="phone,tablet"><strong>Item Type</strong></th>
                                                <th> Action </th>
                                                <th data-hide="default" data-type="numeric"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($orderDetails) >= 1) : ?>
                                                <?php foreach ($orderDetails AS $Details) : ?>
                                                    <?php if ($Details->item_type != "Seat"): ?>
                                                        <tr>
                                                            <td><img style="width: 50px;" src="<?php echo $config['IMAGE_UPLOAD_URL'] . '/event_web_logo/' . $Details->event_web_logo; ?>" alt="img"></td>
                                                            <?php
                                                            if ($Details->order_payment_type == 'movie-eticket-online' || $Details->order_payment_type == 'movie-eticket-cod' || $Details->order_payment_type == 'movie-eticket-bkash') {
                                                                $sqlgetactualdata = "SELECT 
                                                                a.*,
                                                                b.name,
                                                                c.order_number,c.order_total_amount,
                                                                e.event_web_logo,
                                                                FROM
                                                                order_movie_event as a 
                                                                LEFT JOIN event_movie_theatre as b on b.theatre_id=a.theatre_id 
                                                                LEFT JOIN (SELECT movie_id,event_id FROM event_movie_list) as d on d.movie_id=a.movie_id 
                                                                LEFT JOIN (SELECT event_id,event_web_logo FROM events) as e on e.event_id=d.event_id 
                                                                LEFT JOIN (SELECT order_id,order_number,order_total_amount FROM orders) as c on c.order_id=a.verified_order_id WHERE a.verified_order_id='" . $orderID . "'";
                                                                $queryactualuser = mysqli_query($con, $sqlgetactualdata);
                                                                @$chkactualuser = mysqli_num_rows($queryactualuser);
                                                                $alldataact = array();
                                                                if ($chkactualuser != 0) {
                                                                    while ($rowactu = mysqli_fetch_object($queryactualuser)):
                                                                        $alldataact[] = $rowactu;
                                                                    endwhile;
                                                                }
                                                                // 
                                                                ?>
                                                                <td><?php
                                                                    echo $Details->event_title;
                                                                    ?></td>
                                                                <td>Movie</td>

                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                <td>
                                                                    <?php
                                                                    echo $Details->event_title;
                                                                    ?></td>
                                                                <td><?php
                                                                    echo $Details->category_title;
                                                                    ?></td>
                                                                <?php
                                                            }
                                                            ?></td>

                                                            <td><?php
                                                                $total_order_full_price = ($Details->order_total_amount + $Details->order_vat_amount);
                                                                if ($total_order_full_price == 0) {
                                                                    echo "Free";
                                                                } else {
                                                                    echo number_format($total_order_full_price, 2);
                                                                }
                                                                ?></td>
                                                            <td><?php echo $Details->OI_quantity; ?></td>
                                                            <td><?php echo $Details->item_type; ?></td>
                                                            <td style="color: navy;">View Ticket</td>
                                                            <!-- Event Ticket -->
                                                            <!-- ticket devide in two part-->
                                                            <?php
                                                            $method_of_delivery = '';
                                                            if ($total_order_full_price == 0 && $Details->order_payment_type == 'eticket') {
                                                                include('./free_eticket_design.php');
                                                                $method_of_delivery = 'Online';
                                                            } elseif ($Details->order_payment_type == 'movie-eticket-online' || $Details->order_payment_type == 'movie-eticket-cod' || $Details->order_payment_type == 'movie-eticket-bkash') {
                                                                if ($Details->order_payment_type == 'movie-eticket-online') {
                                                                    $method_of_delivery = 'Online';
                                                                } elseif ($Details->order_payment_type == 'movie-eticket-cod') {
                                                                    $method_of_delivery = 'Cash on Delivery';
                                                                } elseif ($Details->order_payment_type == 'movie-eticket-bkash') {
                                                                    $method_of_delivery = 'Bkash Payment';
                                                                }

                                                                include('./movie_eticket_design.php');
                                                            } else {
                                                                ?>
                                                                <!--ticket divide into two part-->
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <h4 class="text-center">
                                                                            <?php if ($Details->order_status == 'paid'): ?>
                                                                                <strong>PLEASE PRINT AND BRING THIS TICKET WITH YOU AT THE EVENT</strong>
                                                                            <?php else: ?>
                                                                                <strong>PLEASE COMPLETE PAYMENT PROCESS IN ORDER TO DOWNLOAD E-TICKET</strong>
                                                                            <?php endif; ?>
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <form method="post">
                                                                                <input type="hidden" name="OI_id" value="<?php echo $Details->OI_id; ?>" />
                                                                                <input type="hidden" name="OI_item_type" value="<?php echo $Details->OI_item_type; ?>" />
                                                                                <input type="hidden" name="OS_id" value="0" />
                                                                                <input type="hidden" name="quantity" value="<?php echo $Details->OI_quantity; ?>" />
                                                                                <?php if ($Details->order_status == 'paid'): ?>
                                                                                    <button type="submit" name="btnDownload" class="btn btn-success btn-lg">Download e-Ticket</button>
                                                                                <?php endif; ?>
                                                                            </form>
                                                                        </h4>
                                                                    </div>
                                                                    <br />
                                                                    <table class="main">
                                                                        <tr>
                                                                            <td width="139" style="height:50px;" bgcolor="#FFFFFF"><h4>EVENT TITLE</h4></td>
                                                                            <td colspan="5" bgcolor="#FFFFFF"><h4><strong><?php echo $Details->event_title; ?></strong></h4></td>
                                                                            <td colspan="4" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
                                                                                <img src="<?php echo $config['IMAGE_UPLOAD_URL'] . '/event_web_logo/' . $Details->event_web_logo; ?>" class="event_logo" alt=""/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="height:50px;" bgcolor="#FFFFFF"><h4>VENUE</h4></td>
                                                                            <td colspan="5" bgcolor="#FFFFFF">
                                                                                <h4>
                                                                                    <?php echo $Details->venue_title; ?>
                                                                                </h4>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#FFFFFF"><h4>DATE</h4></td>
                                                                            <td colspan="4" bgcolor="#FFFFFF"><?php echo date("l, d F, Y", strtotime($Details->venue_start_date)); ?></td>
                                                                            <td  bgcolor="#FFFFFF"><h4>TIME</h4></td>
                                                                            <td colspan="4" bgcolor="#FFFFFF">
                                                                                <h4> Start Time : <?php echo date("h:i A", strtotime($Details->venue_start_time)); ?> &nbsp;&nbsp;
                                                                                    <?php if ($Details->venue_end_time): ?>
                                                                                        End Time: <?php echo date("h:i A", strtotime($Details->venue_end_time)); ?>
                                                                                    <?php endif; ?>
                                                                                </h4>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#FFFFFF"><h4>DELIVERY METHOD:</h4></td>
                                                                            <td colspan="4" bgcolor="#FFFFFF">
                                                                                <?php if ($Details->order_payment_type == "COD"): ?>
                                                                                    <h4>Cash On Delivery</h4>
                                                                                <?php elseif ($Details->order_payment_type == "Card"): ?>
                                                                                    <h4>Online Payment</h4>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                            <td bgcolor="#FFFFFF"><h4>CATAGORY</h4></td>
                                                                            <td colspan="4" bgcolor="#FFFFFF"><h4><?php echo $Details->category_title; ?></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="6" valign="top" bgcolor="#FFFFFF" style="font-size: 12px;">
                                                                                <p style="text-align: center; font-size: 16px; font-weight: bold; margin-top: 4px;">CUSTOMER INFO</p>
                                                                                <?php
                                                                                $free = false;
                                                                                if ($total_order_full_price == 0 && $Details->order_payment_type == 'eticket') {
                                                                                    $sqlq = mysqli_query($con, "SELECT * FROM users_info_free_event WHERE session_id='" . $Details->OI_session_id . "'");
                                                                                    $chkord = mysqli_num_rows($sqlq);
                                                                                    if ($chkord != 0) {
                                                                                        $rowd = mysqli_fetch_array($sqlq);
                                                                                        //OI_session_id
                                                                                        ?>
                                                                                        <p> <strong>Name:</strong> &nbsp;&nbsp;<?php echo $rowd['full_name']; ?></p>
                                                                                        <p> <strong>Address:</strong> &nbsp;&nbsp;<?php echo $rowd['address']; ?></p>
                                                                                        <p> <strong>Email:</strong> &nbsp;&nbsp;<?php echo $rowd['email']; ?></p>
                                                                                        <p> <strong>Phone Number:</strong> &nbsp;&nbsp;<?php echo $rowd['phone_mobile']; ?></p>
                                                                                        <?php
                                                                                        $free = true;
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <p> <strong>Name:</strong> &nbsp;&nbsp;<?php echo $Details->defname; ?></p>
                                                                                    <p> <strong>Address:</strong> &nbsp;&nbsp;<?php echo $Details->defaddress; ?></p>
                                                                                    <p> <strong>Email:</strong> &nbsp;&nbsp;<?php echo $Details->user_email; ?></p>
                                                                                    <p> <strong>Phone Number:</strong> &nbsp;&nbsp;<?php echo $Details->defphone; ?></p>
                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                            </td>
                                                                            <td colspan="5" bgcolor="#FFFFFF" valign="top">
                                                                                <?php
                                                                                if ($free == true) {
                                                                                    ?>
                                                                                    <table style="width: 100%; margin-left: -8px; font-size: 12px;">
                                                                                        <tr>
                                                                                            <td colspan="2" style="text-align: center; font-size: 16px; font-weight: bold; border-style: none;">TICKET DETAILS (BDT)</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-style: none;">Ticket Qty:</td>
                                                                                            <td style="border-style: none; text-align: right"><?php echo $Details->OI_quantity; ?></td>
                                                                                        </tr>

                                                                                        <tr style="border-bottom: 1px #cccbd0 dotted; border-top: 1px #cccbd0 dotted;">
                                                                                            <td style="border-style: none;">Total Price:</td>
                                                                                            <td style="border-style: none; text-align: right">Free</td>
                                                                                        </tr>

                                                                                    </table>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <table style="width: 100%; margin-left: -8px; font-size: 12px;">
                                                                                        <tr>
                                                                                            <td colspan="2" style="text-align: center; font-size: 16px; font-weight: bold; border-style: none;">TICKET DETAILS (BDT)</td>
                                                                                        </tr>

                                                                                        <?php
                                                                                        $ticket_quantity = 0;
                                                                                        $ticket_row_total = 0;
                                                                                        if ($orderDetailscount3 != 0) {
                                                                                            foreach ($orderDetails3 as $dcc):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td style="border-style: none;">(+)<?php echo $dcc->TT_type_title; ?>(<?php echo $dcc->OI_quantity; ?>):</td>
                                                                                                    <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?><?php echo $dcc->OI_unit_price; ?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                $ticket_quantity+=$dcc->OI_quantity;
                                                                                                $ticket_row_total+=$dcc->OI_unit_price;
                                                                                            endforeach;
                                                                                        }
                                                                                        ?>
                                                                                        <tr style="border-top: 1px #cccbd0 dotted;">
                                                                                            <td style="border-style: none;">Ticket Total Qty: <?php echo $ticket_quantity; ?></td>
                                                                                            <td style="border-style: none; text-align: right;"><span class="pull-Left" style="margin-right: 20px;">Ticket Total Price:</span> <span  class="pull-right"><?php echo $config['CURRENCY_SIGN']; ?> <?php echo number_format($ticket_row_total, 2); ?></span></td>
                                                                                        </tr>        
                                                                                        <?php
                                                                                        if ($orderDetailscount2 != 0) {
                                                                                            foreach ($orderDetails2 as $dc):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td style="border-style: none;">(+)<?php echo $dc->EI_name; ?>(<?php echo $dc->OI_quantity; ?>):</td>
                                                                                                    <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?> <?php echo $dc->OI_unit_price; ?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                            endforeach;
                                                                                        }
                                                                                        ?>

                                                                                        <?php
                                                                                        if ($Details->order_shipment_charge != "0.00") {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td style="border-style: none;">(+) Shipment/Delivery Cost:</td>
                                                                                                <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?> <?php 
                                                                                                echo $Details->order_shipment_charge; 
                                                                                                $ticket_row_total+=$Details->order_shipment_charge;
                                                                                                ?></td>
                                                                                            </tr>

                                                                                            <?php
                                                                                        }
                                                                                        ?>   

                                                                                        <?php
                                                                                        if ($Details->order_discount_amount != "0.00") {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td style="border-style: none;">(-) Discount Amount:</td>
                                                                                                <td style="border-style: none; text-align: right"><?php echo $Details->order_discount_amount; ?></td>
                                                                                            </tr>

                                                                                            <?php
                                                                                        }
                                                                                        $order_id = $Details->OE_session_id;
                                                                                        ?>

                                                                                        <?php
                                                                                        $chkextracost_order_query = mysqli_query($con, "SELECT * FROM order_extra_cost_history WHERE order_id='" . $order_id . "'");
                                                                                        $chkextracost_order = mysqli_num_rows($chkextracost_order_query);
                                                                                        if ($chkextracost_order != 0) {
                                                                                            //mysqli_query($con, "INSERT INTO order_extra_cost_history SET order_id='" . $order_id . "',cost_id='" . $cost->id . "',cost_title='" . $cost->cost_title . "',cost_amount='" . $cost->cost_amount . "',date='" . date('Y-m-d') . "',status='" . $cost->deduction_type . "'");
                                                                                            $extracostd = array();
                                                                                            while ($excoro = mysqli_fetch_object($chkextracost_order_query)):
                                                                                                $extracostd[] = $excoro;
                                                                                            endwhile;

                                                                                            foreach ($extracostd as $cost):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td style="border-style: none;">(+) <?php echo $cost->cost_title; ?>:</td>
                                                                                                    <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?> <?php echo $cost->cost_amount; ?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                $ticket_row_total+=$cost->cost_amount;
                                                                                            endforeach;
                                                                                        }
                                                                                        ?>

                                                                                        <?php
                                                                                        $chkdiscount_order_query = mysqli_query($con, "SELECT * FROM order_discount WHERE order_id='" . $order_id . "'");
                                                                                        $chkdiscount_order = mysqli_num_rows($chkdiscount_order_query);
//                                                                                        if ($chkdiscount_order == 0) {
//                                                                                            mysqli_query($con, "INSERT INTO order_discount SET order_id='" . $order_id . "',discount_id='" . $ds->id . "',discount_amount='" . $ds->discount_amount . "',discount_type='" . $ds->discount_type . "',date='" . date('Y-m-d') . "',status='active'");
//                                                                                        }
                                                                                        if ($chkdiscount_order != 0) {
                                                                                            $discostd = array();
                                                                                            while ($excoro = mysqli_fetch_object($chkdiscount_order_query)):
                                                                                                $discostd[] = $excoro;
                                                                                            endwhile;

                                                                                            foreach ($discostd as $cost):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td style="border-style: none;">(-) Discount:</td>
                                                                                                    <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?> <?php echo $cost->discount_amount; ?></td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                $ticket_row_total-=$cost->discount_amount;
                                                                                            endforeach;
                                                                                        }
                                                                                        ?>        

                                                                                        <tr style="border-bottom: 1px #cccbd0 dotted; border-top: 1px #cccbd0 dotted;">
                                                                                            <td style="border-style: none;">Total Price:</td>
                                                                                            <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?> <?php
                                                                    //echo number_format($total_order_full_price, 2); 
                                                                                            echo number_format($ticket_row_total,2);
                                                                                        ?></td>
                                                                                        </tr>

                                                                                    </table>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $chkextrafields = mysqli_query($con, "SELECT * FROM `event_form_values` WHERE `EFV_session_id`='" . $Details->OI_session_id . "'");
                                                                        $chkcountrows = mysqli_num_rows($chkextrafields);

                                                                        if ($chkcountrows != 0) {
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="11" valign="top" bgcolor="#FFFFFF" style="font-size: 12px;">
                                                                                    <table style="width:100%; " align="center">
                                                                                        <tr>
                                                                                            <td colspan="8" style="text-align: center; font-size: 16px; font-weight: bold; border-style: none;">Custom Booking/Order information</td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        $a = 1;
                                                                                        $s = 1;
                                                                                        $fetquery = mysqli_query($con, "SELECT a.*, b.form_field_title as dd FROM `event_form_values` as a 
left join event_dynamic_forms as b on b.form_id=a.EFV_field_id 
 WHERE `EFV_session_id`='" . $Details->OI_session_id . "'");
                                                                                        while ($fetcus = mysqli_fetch_array($fetquery)) {

                                                                                            if ($fetcus['dd'] != "") {
                                                                                                if ($s == 1) {
                                                                                                    echo "<tr>";
                                                                                                }
                                                                                                ?>

                                                                                                <td>  <?php
                                                                    echo $a . ". <strong>";
                                                                    echo $fetcus['dd'];
                                                                                                ?>:</strong></td>
                                                                                                <td><?php echo $fetcus['EFV_field_value']; ?></td>

                                                                                                <?php
                                                                                                if ($s == 4) {
                                                                                                    echo "</tr>";
                                                                                                    $s = 0;
                                                                                                }

                                                                                                if ($s == 0 && $a == $chkcountrows) {

                                                                                                    $s = 0;
                                                                                                } else {
                                                                                                    if ($s == 1 && $a == $chkcountrows) {
                                                                                                        echo "<td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                                                                                    } elseif ($s == 2 && $a == $chkcountrows) {
                                                                                                        echo "<td></td><td></td><td></td><td></td></tr>";
                                                                                                    } elseif ($s == 3 && $a == $chkcountrows) {
                                                                                                        echo "<td></td><td></td></tr>";
                                                                                                    }
                                                                                                }

                                                                                                $s++;
                                                                                                $a++;
                                                                                            } else {
                                                                                                if ($fetcus['EFV_field_id'] == 0 && $fetcus['EFV_field_value'] != "") {
                                                                                                    if ($s == 1) {
                                                                                                        echo "<tr>";
                                                                                                    }
                                                                                                    ?>

                                                                                                    <td>  <?php
                                                                    echo $a . ". <strong>";
                                                                                                    ?>Your Photo :</strong></td>
                                                                                                    <td><img class="img-responsive" width="100" src="<?php echo baseUrl() . 'upload/dynamic_form_upload/' . $fetcus['EFV_field_value']; ?>" alt="<?php echo $fetcus['EFV_field_value']; ?>" /></td>

                                                                                                    <?php
                                                                                                    if ($s == 4) {
                                                                                                        echo "</tr>";
                                                                                                        $s = 0;
                                                                                                    }

                                                                                                    if ($s == 0 && $a == $chkcountrows) {

                                                                                                        $s = 0;
                                                                                                    } else {
                                                                                                        if ($s == 1 && $a == $chkcountrows) {
                                                                                                            echo "<td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                                                                                        } elseif ($s == 2 && $a == $chkcountrows) {
                                                                                                            echo "<td></td><td></td><td></td><td></td></tr>";
                                                                                                        } elseif ($s == 3 && $a == $chkcountrows) {
                                                                                                            echo "<td></td><td></td></tr>";
                                                                                                        }
                                                                                                    }

                                                                                                    $s++;
                                                                                                    $a++;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        <?php if ($Details->event_description != ""): ?>
                                                                            <tr>
                                                                                <td height="74" bgcolor="#FFFFFF">EVENT DETAILS</td>
                                                                                <td colspan="9" align="left" bgcolor="#FFFFFF" style="text-align: justify;">
                                                                                    <?php echo html_entity_decode(html_entity_decode($Details->event_description)); ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                        <?php if ($Details->OI_item_type == "ticket"): ?>
                                                                            <tr>
                                                                                <td colspan="10" align="center" bgcolor="#FFFFFF" style="padding-top: 15px;" >
                                                                                    <script type="text/javascript">
                                                                                        $(document).ready(function () {
                                                                                            $("#ticketBarcode_<?php echo $Details->OI_id; ?>").barcode(
                                                                                                    "<?php echo $Details->OI_unique_id; ?>", // Value barcode (dependent on the type of barcode)
                                                                                                    "code39" // type (string)
                                                                                                    );
                                                                                        });

                                                                                    </script>
                                                                                    <div id="ticketBarcode_<?php echo $Details->OI_id; ?>"></div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>


                                                                        <?php if ($Details->event_terms_conditions != ""): ?>
                                                                            <tr>
                                                                                <td colspan="10" align="center" bgcolor="#FFFFFF" style="border-bottom-color: white;">TERMS &amp; CONDITIONS</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="10" bgcolor="#FFFFFF" style=" text-align: justify;">
                                                                                    <?php echo html_entity_decode(html_entity_decode($Details->event_terms_conditions)); ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                        <tr>
                                                                            <td colspan="10" align="center" bgcolor="#FFFFFF" style="border-bottom-style: none;">TICKETING PARTNER</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="border-top-style: none;" colspan="10" bgcolor="#FFFFFF">
                                                                                <table style="width: 100%; margin-left: -8px;">
                                                                                    <tr>
                                                                                        <td style="border-style: none; width: 46%"> <h5>Hot Line Number:  <?php echo getConfig("HEADER_PHONE_NUMBER"); ?> </h5></td>
                                                                                        <td style="border-style: none;"><img src="<?php echo baseUrl(); ?>images/ticketchai_logo.png" width="100" height="50" alt=""/></td>
                                                                                        <td style="border-style: none; text-align: right"></td>
                                                                                    </tr>              
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <div class="clearfix"></div>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>

                                                            <!-- Event Ticket -->
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                            <!-- Event Seat Ticket Start -->

                                            <?php if (count($arrSeats) >= 1) : ?>

                                                <?php foreach ($arrSeats AS $Seat) : ?>
                                                    <tr>
                                                        <td><img style="width: 50px;" src="<?php echo $config['IMAGE_UPLOAD_URL'] . '/event_web_logo/' . $Seat->event_web_logo; ?>" alt="img"></td>
                                                        <td><?php echo $Seat->event_title; ?></td>
                                                        <td><?php echo $Seat->category_title; ?></td>
                                                        <td><?php echo $Seat->OI_unit_price; ?></td>
                                                        <td>1</td>
                                                        <td><?php echo ucfirst($Seat->OI_item_type); ?></td>
                                                        <td style="color: navy;">View Ticket</td>
                                                        <!-- Event Ticket -->
                                                        <td>
                                                            <div class="col-md-12">
                                                                <h4 class="text-center">
                                                                    <?php if ($Seat->order_status == 'paid'): ?>
                                                                        <strong>PLEASE PRINT AND BRING THIS TICKET WITH YOU AT THE EVENT</strong>
                                                                        <<?php else: ?>
                                                                        <strong>PLEASE COMPLETE PAYMENT PROCESS IN ORDER TO DOWNLOAD E-TICKET</strong>
                                                                    <?php endif; ?>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <form method="post">
                                                                        <input type="hidden" name="OI_id" value="<?php echo $Seat->OI_id; ?>" />
                                                                        <input type="hidden" name="OI_item_type" value="<?php echo $Seat->OI_item_type; ?>" />
                                                                        <input type="hidden" name="OS_id" value="<?php echo $Seat->OS_id; ?>" />
                                                                        <?php if ($Seat->order_status == 'paid'): ?>
                                                                            <button type="submit" name="btnDownload" class="btn btn-success btn-lg">Download e-Ticket</button>
                                                                        <?php endif; ?>
                                                                    </form>
                                                                </h4>
                                                            </div>
                                                            <br />
                                                            <table class="main">
                                                                <tr>
                                                                    <td width="139" style="height:50px;" bgcolor="#FFFFFF"><h4>EVENT TITLE</h4></td>
                                                                    <td colspan="5" bgcolor="#FFFFFF"><h4><strong><?php echo $Seat->event_title; ?></strong></h4></td>
                                                                    <td colspan="4" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
                                                                        <img src="<?php echo $config['IMAGE_UPLOAD_URL'] . '/event_web_logo/' . $Seat->event_web_logo; ?>" class="event_logo" alt=""/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height:50px;" bgcolor="#FFFFFF"><h4>VENUE</h4></td>
                                                                    <td colspan="5" bgcolor="#FFFFFF">
                                                                        <h4>
                                                                            <?php echo $Seat->venue_title; ?>
                                                                        </h4>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF"><h4>DATE</h4></td>
                                                                    <td colspan="4" bgcolor="#FFFFFF"><?php echo date("l, d F, Y", strtotime($Seat->venue_start_date)); ?></td>
                                                                    <td  bgcolor="#FFFFFF"><h4>TIME</h4></td>
                                                                    <td colspan="4" bgcolor="#FFFFFF">
                                                                        <h4> Start Time : <?php echo date("h:i A", strtotime($Seat->venue_start_time)); ?> &nbsp;&nbsp;
                                                                            <?php if ($Seat->venue_end_time): ?>
                                                                                End Time: <?php echo date("h:i A", strtotime($Seat->venue_end_time)); ?>
                                                                            <?php endif; ?>
                                                                        </h4>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF"><h4>DELIVERY METHOD:</h4></td>
                                                                    <td colspan="4" bgcolor="#FFFFFF">
                                                                        <?php if ($Seat->order_payment_type == "COD"): ?>
                                                                            <h4>Cash On Delivery</h4>
                                                                        <?php elseif ($Seat->order_payment_type == "Card"): ?>
                                                                            <h4>Online Payment</h4>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td bgcolor="#FFFFFF"><h4>CATAGORY</h4></td>
                                                                    <td colspan="4" bgcolor="#FFFFFF"><h4><?php echo $Seat->category_title; ?></h4></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" valign="top" bgcolor="#FFFFFF" style="font-size: 12px;">
                                                                        <p style="text-align: center; font-size: 16px; font-weight: bold; margin-top: 4px;">CUSTOMER INFO</p>
                                                                        <p> <strong>Name:</strong> &nbsp;&nbsp;<?php echo $Seat->user_first_name; ?>&nbsp; <?php echo $Seat->user_last_name; ?></p>
                                                                        <p> <strong>Address:</strong> &nbsp;&nbsp;<?php echo $Seat->order_billing_address; ?></p>
                                                                        <p> <strong>Email:</strong> &nbsp;&nbsp;<?php echo $Seat->user_email; ?></p>
                                                                        <p> <strong>Phone Number:</strong> &nbsp;&nbsp;<?php echo $Seat->order_billing_phone; ?></p>
                                                                    </td>
                                                                    <td colspan="5" bgcolor="#FFFFFF" valign="top">
                                                                        <table style="width: 100%; margin-left: -8px; font-size: 12px;">
                                                                            <tr>
                                                                                <td colspan="2" style="text-align: center; font-size: 16px; font-weight: bold; border-style: none;">TICKET DETAILS (BDT)</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border-style: none;">Ticket Qty:</td>
                                                                                <td style="border-style: none; text-align: right">1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border-style: none;">Ticket Price:</td>
                                                                                <td style="border-style: none; text-align: right"><?php echo $config['CURRENCY_SIGN']; ?><?php echo $Seat->OI_unit_price; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border-style: none;">Seat Number:</td>
                                                                                <td style="border-style: none; text-align: right"><?php echo $Seat->OS_seat_number; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border-style: none;">Seat Type:</td>
                                                                                <td style="border-style: none; text-align: right"><?php echo $Seat->SPC_title; ?></td>
                                                                            </tr>

                                                                        </table>
                                                                    </td>

                                                                </tr>
                                                                <?php if ($Details->event_description != ""): ?>
                                                                    <tr>
                                                                        <td height="74" bgcolor="#FFFFFF">EVENT DETAILS</td>
                                                                        <td colspan="9" align="left" bgcolor="#FFFFFF" style="text-align: justify;">
                                                                            <?php echo html_entity_decode(html_entity_decode($Seat->event_description)); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                                <tr>
                                                                    <td colspan="10" align="center" bgcolor="#FFFFFF" style="padding-top: 15px;" >
                                                                        <script type="text/javascript">
                                                                            $(document).ready(function () {
                                                                                $("#ticketBarcode_<?php echo $Seat->OS_id; ?>").barcode(
                                                                                        "<?php echo $Seat->OS_unique_id; ?>", // Value barcode (dependent on the type of barcode)
                                                                                        "code39" // type (string)
                                                                                        );
                                                                            });

                                                                        </script>
                                                                        <div id="ticketBarcode_<?php echo $Seat->OS_id; ?>"></div>
                                                                    </td>
                                                                </tr>

                                                                <?php if ($Seat->event_terms_conditions != ""): ?>
                                                                    <tr>
                                                                        <td colspan="10" align="center" bgcolor="#FFFFFF" style="border-bottom-color: white;">TERMS &amp; CONDITIONS</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="10" bgcolor="#FFFFFF" style=" text-align: justify;">
                                                                            <?php echo html_entity_decode(html_entity_decode($Seat->event_terms_conditions)); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                                <tr>
                                                                    <td colspan="10" align="center" bgcolor="#FFFFFF" style="border-bottom-style: none;">TICKETING PARTNER</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-top-style: none;" colspan="10" bgcolor="#FFFFFF">
                                                                        <table style="width: 100%; margin-left: -8px;">
                                                                            <tr>
                                                                                <td style="border-style: none; width: 46%"> <h5>Hot Line Number:  <?php echo getConfig("HEADER_PHONE_NUMBER"); ?> </h5></td>
                                                                                <td style="border-style: none;"><img src="<?php echo baseUrl(); ?>images/ticketchai_logo.png" width="100" height="50" alt=""/></td>
                                                                                <td style="border-style: none; text-align: right"></td>
                                                                            </tr>              
                                                                        </table>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                            <div class="clearfix"></div>
                                                        </td>
                                                        <!-- Event Ticket -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <!-- Event Seat Ticket End -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
            <?php include basePath('social_link.php'); ?>
            <?php include basePath('footer.php'); ?>
        </div>
        <?php include basePath('footer_script.php'); ?>
        <!-- From Customer Dashboard -->
        <script src="<?php echo baseUrl('js/jquery.matchHeight-min.js'); ?>"></script>
        <script src="<?php echo baseUrl('js/hideMaxListItem.js'); ?>"></script>

        <script src="<?php echo baseUrl('js/footable.js?v=2-0-1'); ?>" type="text/javascript"></script> 
        <script src="<?php echo baseUrl('js/footable.filter.js?v=2-0-1'); ?>" type="text/javascript"></script>
        <script type="text/javascript">
                                                                            $(function () {
                                                                                $('#addManageTable').footable().bind('footable_filtering', function (e) {
                                                                                    var selected = $('.filter-status').find(':selected').text();
                                                                                    if (selected && selected.length > 0) {
                                                                                        e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                                                                                        e.clear = !e.filter;
                                                                                    }
                                                                                });

                                                                                $('.clear-filter').click(function (e) {
                                                                                    e.preventDefault();
                                                                                    $('.filter-status').val('');
                                                                                    $('table.demo').trigger('footable_clear_filter');
                                                                                });

                                                                            });
        </script> 
        <script>
            function checkAll(bx) {
                var chkinput = document.getElementsByTagName('input');
                for (var i = 0; i < chkinput.length; i++) {
                    if (chkinput[i].type == 'checkbox') {
                        chkinput[i].checked = bx.checked;
                    }
                }
            }
        </script> 
        <script src="<?php echo baseUrl('js/plugins/jquery.fs.scroller/jquery.fs.scroller.js'); ?>"></script>
        <script src="<?php echo baseUrl('js/plugins/jquery.fs.selecter/jquery.fs.selecter.js'); ?>"></script>

        <!-- From customer order list page -->

        <script type="text/javascript" src="<?php echo baseUrl('js/footable.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo baseUrl('js/footable.sortable.js'); ?>"></script>
        <script type="text/javascript">
            $(function () {
                $('.footable').footable();
            });
        </script> 

        <!-- For Barcode Generate -->
        <script type="text/javascript" src="<?php echo baseUrl('js/barcode/jquery-barcode.js'); ?>"></script>
        <!-- For Barcode Generate -->
    </body>
</html>