<?php
include '../../config/config.php';
if (isset($_POST['btnDownload'])) {
    extract($_POST);
//    echo $OI_item_type;
    
    include '../../lib/mpdf/mpdf.php';
    $dateTimeNow = date("d-m-y H:i:s");
    $mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 15, 16, 13);
    $mpdf->SetDisplayMode('fullpage');
    $stylesheet = file_get_contents(baseUrl() . "pdfticket/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->list_indent_first_level = 0;
    $url = baseUrl() . "pdfticket/e-ticket-mini.php?id=" . $OI_id . "&type=" . $OI_item_type . "&OS_id=" . $OS_id;
    $html = file_get_contents($url);
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output('e-ticket-' . $dateTimeNow . '.pdf', 'D');
    exit();
    
}
include '../../lib/email/mail_helper_functions.php';
$orderID = 0;
$orderCustomID = '';
$orderPlaced = '';
$orderUserFName = '';
$orderUserLName = '';
$order_payment_type = "";
$order_status = "";
$user_first_name = "";
$user_email = "";
$adminID = getSession('admin_id');

//updating order read value
if (isset($_GET['order_id'])) {
    $orderID = validateInput($_GET['order_id']);
    $updateReadStat = "UPDATE orders SET order_read='yes',order_updated_by=$adminID WHERE order_id=$orderID";
    $resultUpdateReadStat = mysqli_query($con, $updateReadStat);
    if (!$resultUpdateReadStat) {
        if (DEBUG) {
            echo "resultUpdateReadStat error: " . mysqli_error($con);
        } else {
            echo "resultUpdateReadStat query failed.";
        }
    }

    $sqlGetInfo = "SELECT users.user_email,users.user_first_name FROM orders "
            . "LEFT JOIN users ON users.user_id = orders.order_user_id "
            . "WHERE  order_id=$orderID";
    $resultGetInfo = mysqli_query($con, $sqlGetInfo);
    if ($resultGetInfo) {
        $resultGetInfoObj = mysqli_fetch_object($resultGetInfo);
        if (isset($resultGetInfoObj->order_id)) {
            $user_email = $resultGetInfoObj->user_email;
            $user_first_name = $resultGetInfoObj->user_first_name;
        }
    } else {
        if (DEBUG) {
            echo "resultGetInfo error: " . mysqli_error($con);
        } else {
            echo "resultGetInfo query failed.";
        }
    }
}

// Order Status Change Code
$orderStatusUpdate = "";
if (isset($_POST['orderStatus'])) {
    extract($_POST);
    $orderStatusUpdate = validateInput($_POST['orderStatus']);
    if ($orderStatusUpdate == '0') {
        $err = "Select one order status";
    } else {
        $checkOrderStatus = "SELECT order_status FROM orders WHERE order_id=$orderID";
        $resultCheckStatus = mysqli_query($con, $checkOrderStatus);
        if ($resultCheckStatus) {
            $resultCheckStatusObj = mysqli_fetch_object($resultCheckStatus);
            $bookingStatus = $resultCheckStatusObj->order_status;
            if ($bookingStatus != 'booking' AND $orderStatusUpdate === 'booking') {
                $err = "You can not change the status as Booking again.";
            } elseif ($orderStatusUpdate === 'approved') {
                if ($bookingStatus != 'approved') {
                    //not approved
                    //updating order status
                    $sqlUpdateOrderStatus = "UPDATE orders SET order_status='$orderStatusUpdate' WHERE order_id=$orderID";
                    $resultUpdateOrderStatus = mysqli_query($con, $sqlUpdateOrderStatus);
                    if ($resultUpdateOrderStatus) {

                        $EmailSubject = "Order Status Change Notification";
                        $EmailBody = file_get_contents(baseUrl('email/body/OS_change.php?order_id=' . $orderID));
                        $sendMailStatus = sendEmailFunction($user_email, $user_first_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);


                        if ($sendMailStatus) {
                            $msg = "Order status changed successfully";
                        } else {
                            $msg = "Order status changed but email sending failed.";
                        }
                    } else {
                        if (DEBUG) {
                            $err = "resultUpdateOrderStatus error: " . mysqli_error($con);
                        } else {
                            $err = "resultUpdateOrderStatus query failed.";
                        }
                    }

                    //change ticket/include quantity
                    $sqlGetItem = "SELECT * FROM order_items WHERE OI_order_id=$orderID";
                    $resultGetItem = mysqli_query($con, $sqlGetItem);
                    if ($resultGetItem) {
                        while ($resultGetItemObj = mysqli_fetch_object($resultGetItem)) {
                            if ($resultGetItemObj->OI_item_type == 'ticket') {
                                $itemID = $resultGetItemObj->OI_item_id;

                                $sqlUpdateTicket = "UPDATE event_ticket_types SET TT_ticket_quantity = TT_ticket_quantity - 1 WHERE TT_id=$itemID";
                                $resultUpdateTicket = mysqli_query($con, $sqlUpdateTicket);

                                if (!$resultUpdateTicket) {
                                    $err .= "Ticket quantity update failed.";
                                }
                            } elseif ($resultGetItemObj->OI_item_type == 'include') {
                                $itemID = $resultGetItemObj->OI_item_id;

                                $sqlUpdateInclude = "UPDATE event_includes SET EI_total_quantity = EI_total_quantity - 1 WHERE EI_id=$itemID";
                                $resultUpdateInclude = mysqli_query($con, $sqlUpdateInclude);

                                if (!$resultUpdateInclude) {
                                    $err .= "Include quantity update failed.";
                                }
                            }
                        }
                    } else {
                        if (DEBUG) {
                            $err = "resultGetItem error: " . mysqli_error($con);
                        } else {
                            $err = "resultGetItem query failed.";
                        }
                    }

                    //not approved    
                } else {
                    //nothing to change, only show error
                    $err = "You can not change the status as Approved again.";
                }
            } else {
                $chkorder_status = mysqli_query($con, "SELECT order_status FROM orders WHERE order_id='$orderID'");
                $chkstorder = mysqli_fetch_array($chkorder_status);
                $chkstorderFet = $chkstorder['order_status'];
                //if()
                if ($orderStatus == 'cancel') {
                    if ($chkstorderFet == 'cancel') {
                        $dd = 1;
                    } else {
                        //cancel
                        $sqlUpdateOrderStatus = "UPDATE orders SET order_status='cancel' WHERE order_id=$orderID";
                        $resultUpdateOrderStatus = mysqli_query($con, $sqlUpdateOrderStatus);
                        if ($resultUpdateOrderStatus) {

                            $EmailSubject = "Order Status Change Notification";
                            $EmailBody = file_get_contents(baseUrl('email/body/OS_change.php?order_id=' . $orderID));
                            $sendMailStatus = sendEmailFunction($user_email, $user_first_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);


                            if ($sendMailStatus) {
                                $msg = "Order status changed successfully";
                            } else {
                                $msg = "Order status changed but email sending failed.";
                            }
                        } else {
                            if (DEBUG) {
                                $err = "resultUpdateOrderStatus error: " . mysqli_error($con);
                            } else {
                                $err = "resultUpdateOrderStatus query failed.";
                            }
                        }

                        //change ticket/include quantity
                        $sqlGetItem = "SELECT * FROM order_items WHERE OI_order_id=$orderID";
                        $resultGetItem = mysqli_query($con, $sqlGetItem);
                        if ($resultGetItem) {
                            while ($resultGetItemObj = mysqli_fetch_object($resultGetItem)) {
                                if ($resultGetItemObj->OI_item_type == 'ticket') {
                                    $itemID = $resultGetItemObj->OI_item_id;

                                    $sqlUpdateTicket = "UPDATE event_ticket_types SET TT_ticket_quantity = TT_ticket_quantity + 1 WHERE TT_id=$itemID";
                                    $resultUpdateTicket = mysqli_query($con, $sqlUpdateTicket);
                                    if (!$resultUpdateTicket) {
                                        $err .= "Ticket quantity update failed.";
                                    }
                                } elseif ($resultGetItemObj->OI_item_type == 'include') {
                                    $itemID = $resultGetItemObj->OI_item_id;

                                    $sqlUpdateInclude = "UPDATE event_includes SET EI_total_quantity = EI_total_quantity + 1 WHERE EI_id=$itemID";
                                    $resultUpdateInclude = mysqli_query($con, $sqlUpdateInclude);

                                    if (!$resultUpdateInclude) {
                                        $err .= "Include quantity update failed.";
                                    }
                                }
                            }
                        } else {
                            if (DEBUG) {
                                $err = "resultGetItem error: " . mysqli_error($con);
                            } else {
                                $err = "resultGetItem query failed.";
                            }
                        }

                        //canceled  
                    }
                } else {
                    $sqlUpdateOrderStatus = "UPDATE orders SET order_status='$orderStatusUpdate' WHERE order_id=$orderID";
                    $resultUpdateOrderStatus = mysqli_query($con, $sqlUpdateOrderStatus);
                    if ($resultUpdateOrderStatus) {

                        $EmailSubject = "Order Status Change Notification";
                        $EmailBody = file_get_contents(baseUrl('email/body/OS_change.php?order_id=' . $orderID));
                        $sendMailStatus = sendEmailFunction($user_email, $user_first_name, 'noreply@ticketchai.com', $EmailSubject, $EmailBody);

                        if ($sendMailStatus) {
                            $msg = "Order status changed successfully";
                        } else {
                            $msg = "Order status changed but email sending failed.";
                        }
                    } else {
                        if (DEBUG) {
                            $err = "resultUpdateOrderStatus error: " . mysqli_error($con);
                        } else {
                            $err = "resultUpdateOrderStatus query failed.";
                        }
                    }
                }
            }
        } else {
            if (DEBUG) {
                $err = "resultCheckStatus error: " . mysqli_error($con);
            } else {
                $err = "resultCheckStatus query failed.";
            }
        }
    }
}


if ($orderID > 0) {
    $sqlGetOrder = "SELECT a.*,b.*,c.OI_session_id,c.OI_item_type FROM orders as a "
            . "LEFT JOIN users as b ON b.user_id=a.order_user_id "
            . "LEFT JOIN order_items as c ON c.OI_order_id=a.order_id "
            . "WHERE order_id=$orderID";
    $resultGetOrder = mysqli_query($con, $sqlGetOrder);
    if ($resultGetOrder) {
        $resultGetOrderObj = mysqli_fetch_object($resultGetOrder);
        if (isset($resultGetOrderObj->order_id)) {
           
            $orderCustomID = $resultGetOrderObj->order_number;
            $orderPlaced = $resultGetOrderObj->order_created;
            $orderSess= $resultGetOrderObj->OI_session_id;
            $orderUserFName = $resultGetOrderObj->user_first_name;
            $order_Item_type = $resultGetOrderObj->OI_item_type;
            $orderUserLName = $resultGetOrderObj->user_last_name;
            $order_payment_type = $resultGetOrderObj->order_payment_type;
            $orderDeliveryCost = $resultGetOrderObj->order_shipment_charge;
            $orderDiscountCost = $resultGetOrderObj->order_discount_amount;
            $orderPromoDiscount = $resultGetOrderObj->order_promotion_discount_amount;
            $orderCouponCode = $resultGetOrderObj->order_promotion_codes;
            $orderSubTotal = $resultGetOrderObj->order_total_amount + $orderDiscountCost;
            $orderTotalCost = ((($orderSubTotal - $orderPromoDiscount) - $orderDiscountCost ) + $orderDeliveryCost);
            $orderStatus = $resultGetOrderObj->order_status;
            $orderMethod = $resultGetOrderObj->order_method;
            $orderUserID = $resultGetOrderObj->order_user_id;
            $user_email = $resultGetOrderObj->user_email;
            $user_first_name = $resultGetOrderObj->user_first_name;
        }
    } else {
        if (DEBUG) {
            echo "resultGetOrder error: " . mysqli_error($con);
        } else {
            echo "resultGetOrder query failed.";
        }
    }

    $ssqqq="SELECT * FROM order_items WHERE OI_order_id='".$orderID."' ORDER BY OI_id ASC LIMIT 1";
    $ss=  mysqli_query($con, $ssqqq);
    if ($ss) {
        while ($sss = mysqli_fetch_object($ss)) {
            $asd[] = $sss;
        }
    } else {
        if (DEBUG) {
            $err = "resultOrderDetails error: " . mysqli_error($con);
        } else {
            $err = "resultOrderDetails query failed";
        }
    }
    
    //echo $orderID;
    

    $orderDetails = array();
    $sqlOrderDetails = "SELECT order_events.*, order_items.*, events .*,"
            . " CASE OI_item_type WHEN 'ticket' THEN ' Ticket'"
            . " ELSE CASE OI_item_type WHEN 'include' THEN 'Include' "
            . " ELSE 'Others' END END AS item_type, "
            . " CASE OI_item_type WHEN 'ticket' THEN (SELECT TT_type_title FROM event_ticket_types WHERE TT_id=OI_item_id) "
            . " ELSE CASE OI_item_type WHEN 'include' THEN (SELECT EI_name FROM event_includes WHERE EI_id=OI_item_id) "
            . " END END AS item_title "
            . " FROM order_items "
            . " LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id "
            . " LEFT JOIN events ON events .event_id = order_events.OE_event_id "
            . " WHERE order_events.OE_order_id =$orderID";
    $resultOrderDetails = mysqli_query($con, $sqlOrderDetails);
    if ($resultOrderDetails) {
        while ($resultOrderDetailsObj = mysqli_fetch_object($resultOrderDetails)) {
            $orderDetails[] = $resultOrderDetailsObj;
        }
    } else {
        if (DEBUG) {
            $err = "resultOrderDetails error: " . mysqli_error($con);
        } else {
            $err = "resultOrderDetails query failed";
        }
    }
    
//    $orderDetails2 = array();
//    $sqlOrderDetails2 = "SELECT order_events.*, order_items.*, events .*,"
//            . " CASE OI_item_type WHEN 'ticket' THEN ' Ticket'"
//            . " ELSE CASE OI_item_type WHEN 'include' THEN 'Include' "
//            . " ELSE 'Others' END END AS item_type, "
//            . " CASE OI_item_type WHEN 'ticket' THEN (SELECT TT_type_title FROM event_ticket_types WHERE TT_id=OI_item_id) "
//            . " ELSE CASE OI_item_type WHEN 'include' THEN (SELECT EI_name FROM event_includes WHERE EI_id=OI_item_id) "
//            . " END END AS item_title "
//            . " FROM order_items "
//            . " LEFT JOIN order_events ON order_events.OE_id = order_items.OI_OE_id "
//            . " LEFT JOIN events ON events .event_id = order_events.OE_event_id "
//            . " WHERE order_events.OE_order_id =$orderID";
//    $resultOrderDetails2 = mysqli_query($con, $sqlOrderDetails2);
//    if ($resultOrderDetails2) {
//        while ($resultOrderDetailsObj2 = mysqli_fetch_object($resultOrderDetails2)) {
//            $orderDetails2[] = $resultOrderDetailsObj2;
//        }
//    } else {
//        if (DEBUG) {
//            $err = "resultOrderDetails error: " . mysqli_error($con);
//        } else {
//            $err = "resultOrderDetails query failed";
//        }
//    }
    
}


//echo $orderDetails2[]->OE_id;

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><!-- <![endif]-->
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <?php include basePath('admin/header_script.php'); ?>
    </head>
    <body class="">

        <?php include basePath('admin/header.php'); ?>

        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="content"><h1 class="hidden-print content-heading bg-white border-bottom">Order Invoice</h1>
            <div class="hidden-print bg-white innerAll border-bottom">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="innerAll spacing-x2">

                <div id="pdfTarget">
                    <div class="innerAll shop-client-products cart invoice">

                        <h3 class="separator bottom">Invoice</h3>

                        <table class="table table-invoice">
                            <tbody>
                                <tr>
                                    <td style="width: 58%;">
                                        <div class="media">
                                            <img class="media-object pull-left thumb" src="<?php echo baseUrl(); ?>images/ticketchai_logo.png" alt="Ticket Chai" width="100px" />

                                        </div>
                                        <br/>
                                        <h5 style="color: darkslategrey;"> Hotline: <?php echo getConfig("HEADER_PHONE_NUMBER"); ?> </h5>
                                    </td>
                                    <td class="right">
                                        <div class="innerL">
                                            <h4 class="separator bottom"># <?php echo $orderCustomID; ?> <br/><br/> <i class="fa fa-calendar"></i> <?php echo date("d M, Y H:i:s A", strtotime($orderPlaced)); ?></h4>
                                            <span class="hidden-print">
                                                <button type="button" data-toggle="print" class="btn btn-default hidden-print"><i class="fa fa-fw fa-print"></i> Print invoice</button>
                                                <div style="height: 10px;"></div>
                                                <form method="POST">
                                                    <div>
                                                        <select class="form-control" style="width: 130px;" name="orderStatus">
                                                            <option value="0">Status</option>
                                                            <option value="booking"  
                                                            <?php
                                                            if ($orderStatus == 'booking') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Booking</option>
                                                            <option value="approved"  
                                                            <?php
                                                            if ($orderStatus == 'approved') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Approved</option>
                                                            <option value="delivered"  
                                                            <?php
                                                            if ($orderStatus == 'delivered') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Delivered</option>
                                                            <option value="paid"  
                                                            <?php
                                                            if ($orderStatus == 'paid') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Paid</option>
                                                            <option value="pending"  
                                                            <?php
                                                            if ($orderStatus == 'pending') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Pending</option>
                                                            <option value="closed"  
                                                            <?php
                                                            if ($orderStatus == 'closed') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Closed</option>
                                                            <option value="cancel"  
                                                            <?php
                                                            if ($orderStatus == 'cancel') {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>Cancel</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-success" style="margin-top: -50px;margin-left: 150px;">Update</button>

                                                    </div>
                                                </form>
                                                
                                                <form method="post" target="_BLANK">
                                                    <input type="hidden" name="OI_id" value="<?php echo $asd[0]->OI_id; ?>" />
                                                    <input type="hidden" name="OI_item_type" value="<?php echo $order_Item_type; ?>" />
                                                    <input type="hidden" name="OS_id" value="0" />
                                                        <button type="submit" name="btnDownload" class="btn btn-success btn-lg">Download e-Ticket</button>
                                                </form>
                                                
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="box-generic">
                            <?php if ($order_payment_type != ""): ?>
                                <?php if ($order_payment_type === 'COD') { ?>
                                    <h3 class="pull-left">Payment Mode:&nbsp;
                                        <?php echo "Cash On Delivery"; ?>
                                        <?php
                                        if ($orderMethod == 'pickup') {
                                            echo "(From Office)";
                                        } else if ($orderMethod == 'deliver') {
                                            echo "(Deliver)";
                                        }
                                        ?>
                                    </h3>  

                                <?php } else if ($order_payment_type === 'Card') { ?>
                                    <h3 class="pull-left">Payment Mode:&nbsp;
                                        <?php echo "Online Payment"; ?>
                                        <?php
                                        if ($orderMethod == 'pickup') {
                                            echo "(From Office)";
                                        } else if ($orderMethod == 'deliver') {
                                            echo "(Deliver)";
                                        }
                                        ?>
                                    </h3>
                                <?php } else { ?>
                                    <h3 class="pull-left">Payment Mode:&nbsp;
                                        <?php echo $order_payment_type; ?>
                                        <?php
                                        if ($orderMethod == 'pickup') {
                                            echo "(From Office)";
                                        } else if ($orderMethod == 'deliver') {
                                            echo "(Deliver)";
                                        }
                                        ?>
                                    </h3>
                                <?php } ?>
                            <?php endif; ?>
                            <h3 class="pull-right hidden-print">Order Status:&nbsp;<span style="color: #843534; font-size: 25px;"><strong><?php echo ucwords($orderStatus); ?></strong></span></h3>
                            <br/><br/>
                            <table class="table table-invoice">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%;">
                                            <p class="lead">Billing information</p>
                                            <h2><?php echo $orderUserFName . " " . $orderUserLName; ?></h2>
                                            <address class="margin-none">
                                                <?php
                                                if ($resultGetOrderObj->order_billing_address == "Razzak Plaza (8th Floor), 1 New Eskaton Road, Moghbazar Circle, Dhaka - 1217") {
                                                    echo "Under Developing Mode For Admin";
                                                    echo $orderUserID;
                                                } else {
                                                    echo $resultGetOrderObj->order_billing_address;
                                                }
                                                ?><br/>
                                                <?php echo $resultGetOrderObj->order_billing_city; ?> - <?php echo $resultGetOrderObj->order_billing_zip; ?><br/>
                                                <?php echo $resultGetOrderObj->order_billing_country; ?><br/>
                                                <abbr title="Work email">e-mail:</abbr> <a class="hidden-print" href="mailto:<?php echo $resultGetOrderObj->user_email; ?>"><?php echo $resultGetOrderObj->user_email; ?></a><br /> 
                                                <abbr title="Work Phone">phone:</abbr><?php echo $resultGetOrderObj->order_billing_phone; ?><br/>
                                            </address>
                                        </td>
                                        <td class="right">
                                            <p class="lead">Delivery information</p>
                                            <h2><?php echo $orderUserFName . " " . $orderUserLName; ?></h2>
                                            <address class="margin-none">
                                                <?php echo $resultGetOrderObj->order_shipping_address; ?><br/>
                                                <?php echo $resultGetOrderObj->order_shipping_city; ?> - <?php echo $resultGetOrderObj->order_shipping_zip; ?><br/>
                                                <?php echo $resultGetOrderObj->order_shipping_country; ?><br/>
                                                <abbr title="Work email">e-mail:</abbr> <a class="hidden-print" href="mailto:<?php echo $resultGetOrderObj->user_email; ?>"><?php echo $resultGetOrderObj->user_email; ?></a><br /> 
                                                <abbr title="Work Phone">phone:</abbr><?php echo $resultGetOrderObj->order_shipping_phone; ?><br/>
                                            </address>
                                        </td>
                                    </tr>
                                        <?php
                                        $chkextrafields = mysqli_query($con, "SELECT * FROM `event_form_values` WHERE `EFV_session_id`='" .$orderSess. "'");
                                        $chkcountrows = mysqli_num_rows($chkextrafields);

                                        if ($chkcountrows != 0) {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <br>
                                                <p class="lead">Custom Booking/Order information</p>
                                                <table style="width:100%; " class="table" align="center">
                                                                                <?php 
                                                                                $a=1;
                                                                                $s=1;
                                                                                $fetquery=  mysqli_query($con,"SELECT a.*, b.form_field_title as dd FROM `event_form_values` as a 
left join event_dynamic_forms as b on b.form_id=a.EFV_field_id WHERE `EFV_session_id`='".$orderSess."'");
                                                                                while($fetcus=  mysqli_fetch_array($fetquery)){
                                                                                if($s==1)
                                                                                {
                                                                                    echo "<tr>";
                                                                                }
                                                                                    ?>
                                                                                
                                                                                <td>  <?php echo $a.". <strong>"; echo $fetcus['dd'];  ?>:</strong></td>
                                                                                    <td><?php echo $fetcus['EFV_field_value'];  ?></td>
                                                                                
                                                                                <?php 
                                                                                if($s==4)
                                                                                {
                                                                                    echo "</tr>";
                                                                                    $s=0;
                                                                                }
                                                                                
                                                                                if($s==0 && $a==$chkcountrows)
                                                                                {
                                                                                    
                                                                                    $s=0;
                                                                                }
                                                                                else
                                                                                {
                                                                                    if($s==1 && $a==$chkcountrows)
                                                                                    {
                                                                                        echo "<td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                                                                    }
                                                                                    elseif($s==2 && $a==$chkcountrows)
                                                                                    {
                                                                                        echo "<td></td><td></td><td></td><td></td></tr>";
                                                                                    }
                                                                                    elseif($s==3 && $a==$chkcountrows)
                                                                                    {
                                                                                        echo "<td></td><td></td></tr>";
                                                                                    }
                                                                                    
                                                                                }
                                                                                
                                                                                $s++;
                                                                                $a++;
                                                                                } ?>
                                                                            </table>
                                            </td>

                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="box-generic padding-none">
                                <table class="table table-vertical-center bg-white margin-none">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="width: 1%;" class="center">No.</th>
                                            <th></th>
                                            <th style="width: 50px;">Qty</th>
                                            <th style="width: 100px;">Discount</th>
                                            <th style="width: 100px;">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Cart item Start-->
                                        <?php $no = 1; ?>
                                        <?php if (count($orderDetails) > 0): ?>
                                            <?php foreach ($orderDetails AS $order): ?>
                                                <tr>
                                                    <td class="center">
                                                        <?php
                                                        echo $no;
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <h5><strong><?php echo $order->event_title; ?></strong></h5>
                                                        Item Title: <span class="label label-default"><?php echo $order->item_title; ?></span>
                                                        Item Type: <span class="label label-default"><?php echo $order->item_type; ?></span>
                                                    </td>
                                                    <td class="center"><?php echo $order->OI_quantity; ?></td>
                                                    <td class="center"><?php echo $config['CURRENCY_SIGN']; ?><?php echo $order->OI_unit_discount; ?></td>
                                                    <td class="center"><?php echo $config['CURRENCY_SIGN']; ?><?php echo number_format($order->OI_unit_price + $order->OI_unit_discount, 2); ?></td>
                                                </tr>
                                                <?php $no++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <!-- // Cart item END -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 hidden-print">
                                    <div class="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-3">
                                    <div class="box-generic padding-none">
                                        <table class="table cart_total margin-none">
                                            <tbody>
                                                <tr>
                                                    <td class="right border-top-none">Subtotal:</td>
                                                    <td class="right border-top-none strong"><?php echo $config['CURRENCY_SIGN']; ?><?php echo number_format($orderSubTotal, 2); ?></td>
                                                </tr>
                                                <?php if ($orderMethod != 'pickup'): ?>
                                                    <tr>
                                                        <td class="right">Delivery Cost:</td>
                                                        <td class="right strong">+ <?php echo $config['CURRENCY_SIGN']; ?><?php echo $orderDeliveryCost; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if ($orderPromoDiscount > 0): ?>
                                                    <tr style="color: tomato;">
                                                        <td class="right">Coupon Discount:
                                                            <br/><strong>(<?php echo $orderCouponCode; ?>)</strong></td>
                                                        <td class="right strong">- <?php echo $config['CURRENCY_SIGN']; ?><?php echo $orderPromoDiscount; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if ($orderDiscountCost > 0): ?>
                                                    <tr style="color: tomato;">
                                                        <td class="right">Discount Price:</td>
                                                        <td class="right strong">- <?php echo $config['CURRENCY_SIGN']; ?><?php echo $orderDiscountCost; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td class="right"><h3 style="font-weight: bold;">Total:</h3></td>
                                                    <td class="right strong"><h3 style="font-weight: bold;"><?php echo $config['CURRENCY_SIGN']; ?><?php echo number_format($orderTotalCost, 2); ?></h3></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php include basePath('admin/footer.php'); ?>
            <div id="print" style="display: none;">
                <div id="invoice">
                    <iframe id="invoiceFrame" src=""></iframe>
                </div>
            </div>

            <script type="text/javascript">
                $(".printCommand").click(function () {
                    var eventId = $(this).attr("data-event");
                    var ticketId = $(this).attr("data-ticket");
                    $("#invoiceFrame").attr("src", "../invoice/index.php?item_id=" + ticketId + "&event_id=" + eventId);
                    var tempFrame = document.getElementById("invoiceFrame");
                    var tempFrameWindow = tempFrame.contentWindow ? tempFrame.contentWindow : tempFrame.contentDocument.defaultView;
                    tempFrameWindow.focus();
                    tempFrameWindow.print();
                });
            </script>
            <script type="text/javascript">
                $("#orderlist").addClass("active");
                $("#orderlist").parent().parent().addClass("active");
                $("#orderlist").parent().addClass("in");
            </script>
            <?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>