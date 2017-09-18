<?php
session_start();
//require_once './DBconnection/database_connections.php';
require_once './DBconnection/database_connections.php';

//require_once '../DBconnection/auth.php';

$o_id = $_GET['o_id'];


$sql = " 
select 
o.order_id,
o.order_number, 
o.order_status, 
o.order_total_item,
o.order_shipment_charge,
((o.`order_total_amount` + o.`order_vat_amount`)-o.`order_discount_amount`) AS newtotal_price,
oe.OE_event_id,
e.event_title,
e.event_description,
e.organized_by,
e.event_terms_conditions,
e.event_web_logo,
ev.venue_title,
ev.venue_id,
c.category_title,
CONCAT(u.user_first_name,' ',u.user_last_name) as userName,
u.user_phone,
u.user_email,
ua.UA_address,


DATE_FORMAT(ev.venue_start_date, '%W, %M %e, %Y') as start_date,
DATE_FORMAT(ev.venue_end_date, '%W, %M %e, %Y') as end_date,
TIME_FORMAT(ev.venue_start_time, '%h:%i%p') as start_time,
TIME_FORMAT(ev.venue_end_time, '%h:%i%p') as end_time,

DATE_FORMAT(ev.venue_start_date, '%M %d, %Y') as start_date2,
DATE_FORMAT(ev.venue_end_date, '%M %d, %Y') as end_date2,

CASE o.order_payment_type
WHEN 'CARD' THEN 'Online Payment'
WHEN 'COD'  THEN 'Cash On Delivery'
WHEN 'eticket' THEN 'Online Free E-Ticket'
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
ELSE 'Pick From Office'
END payment_method,

IFNULL(oit.quantity,0) AS ticket_quantity ,
IFNULL(oit.total_price,0) AS ticket_total_price,
IFNULL(oii.quantity,0) AS include_quantity,
IFNULL(oii.total_price,0) AS include_total_price


from `orders`AS o
LEFT JOIN `order_events` AS oe ON o.order_id = oe.OE_order_id
LEFT JOIN `events`       AS e ON oe.OE_event_id = e.event_id
LEFT JOIN `event_venues` AS ev ON e.event_id = ev.venue_event_id
LEFT JOIN `categories`   AS c  ON e.event_category_id = c.category_id
LEFT JOIN `users`        AS u  ON o.order_user_id = u.user_id
LEFT JOIN `user_addresses` AS ua ON u.user_id = ua.UA_user_id 
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$o_id'
GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$o_id'
GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
where o.order_id ='$o_id'
       ";

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {

    $object[] = $row;
    @$OI_id = $row['order_id'];
    @$order_item = $row['order_total_item'];
    @$order_status = $row['order_status'];
    @$OI_number = $row['order_number'];
    @$o_title = $row['event_title'];
    @$venue_title = $row['venue_title'];
    @$event_web_logo = $row['event_web_logo'];
    @$event_description = $row['event_description'];
    @$event_organizer = $row['organized_by'];
    @$event_terms_conditions = $row['event_terms_conditions'];
    @$start_date = $row['start_date'];
    @$start_date2 = $row['start_date2'];
    @$end_date2 = $row['end_date2'];
    @$start_time = $row['start_time'];
    @$end_time = $row['end_time'];
    @$payment_method = $row['payment_method'];
    @$category_title = $row['category_title'];
    @$userName = $row['userName'];
    @$UA_address = $row['UA_address'];
    @$user_email = $row['user_email'];
    @$user_phone = $row['user_phone'];
    @$ticket_quantity = $row['ticket_quantity'];
    @$include_quantity = $row['include_quantity'];
    @$totalTI = $row['ticket_quantity'] + $row['include_quantity'];
    @$ticket_total_price = $row['ticket_total_price'];
    @$include_total_price = $row['include_total_price'];
    @$totalPrice = $row['ticket_total_price'] + $row['include_total_price'] + $row['order_shipment_charge'];
    @$order_shipment_charge = $row['order_shipment_charge'];
    @$event_description = $row['event_description'];
}
?>


<html>

    <head>

        <script type='text/javascript' src='assets/js/jquery.min.js'></script>
        <script type='text/javascript' src='assets/js/barcode/jquery-barcode.js'></script>
        
<!--        <style type="text/css">
            .se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(../favicon/loading.gif) center no-repeat #fff;
}
        </style>-->
        
    </head>

    <body>
        <!--page loader-->
<!--        <div class="se-pre-con"></div>-->
        <!--page loader-->
        <?php
        $cleanNum = str_replace("-", "", str_replace("[", "", str_replace("]", "", $OI_number)));
        $base_code = base64_encode($cleanNum);

        $i = 1;
        

        if ($order_item >= $i) {

            if ($order_status == 'free') {
                for ($i=1; $i <= $order_item; $i++) {
                 
                     echo ' 
                          <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENU WILL NOT BE ALLOWED</h5>
            </div>                          

                <div class="header">
                    <p class="title">
                        Order No: <code>' . "$OI_number" . '</code>
                    </p>
                </div>



            <table border="1"   border-collapse: "collapse" cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                <tbody>
                    <tr border="1">
                        <td colspan="2" rowspan="3" style="text-align: center;padding:1%;">
                            <img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/' . "$event_web_logo" . '">
                        </td>

                        <td colspan="4" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;">

                                    <div class="barcodecell" >
                                        <barcode code=" ' . "$base_code$i" . '" type="c93" text="1" />
                                    </div>
                                    <p>
                                        ' . "$base_code$i" . '
                                    </p>
                        </td>

                    </tr>
                    <!-- one -->
                    <tr border="1">
                        <td colspan="2"  style="text-align:center;">
                            <p style=" margin:5px">
                                '. "$userName" . '
                            </p>
                        </td>
                    </tr>
                    <!-- two -->
                    <tr border="1">
                        <td  style="text-align:center;">
                            <p style="margin:5px">
                                Gate - 14
                            </p>
                        </td>
                        <td  style="text-align:center;">
                            <p style=" margin:5px">
                                '. "$OI_number" . '
                            </p>
                        </td>
                    </tr>
                    <!-- three -->
                    <tr border="1">
                        <td style="padding-left:10px;">
                                <p style="margin:5px;">
                                     '. "$start_date2" . ' - '. "$end_date2" . '
                                    <br/>Gates will open at '. "$start_time" . '
                                </p>
                        </td>
                        <td   style="">
                            <p style="text-align:center; margin:5px;">'."$venue_title".'</p>
                        </td>
                        <td colspan="2" style=" text-align:center;">
                            <h4 style="text-align:center; margin:5px; font-size:20px">FREE PASS</h4>
                        </td>
                    </tr>
                    <!-- four -->

                    <tr border="1">
                        <td colspan="4" style=" text-align:center;padding-left:10px;">
                            <p style="margin:5px;">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                        </td>
                    </tr>
                    <!-- five -->

                    <tr border="1"> 
                     <td colspan="4" style="text-align:center;">
                        <h5 style="margin-top:15px;margin:0 auto;">Schedule</h5>                     
</td>
                     </tr>

                    <tr style="text-align:left;padding:8px;" border="1">
                        <td colspan="4" style=" padding-left:10px;">
                            
                            <p style="">'."$event_description".'</p>
                        </td>

                    </tr>
                    
                    <tr border="1"> 
                       <td colspan="4" style="text-align:center;">
                        <h5 style="margin-top:15px;margin:0 auto;">Terms and conditions</h5>                     
</td>
                     </tr>

                    <tr style="text-align:left;" border="1">
                        <td colspan="4" style="padding:8px;">
                            <p style="margin-left:5px;">'."$event_terms_conditions".'</p>
                        </td>

                    </tr>
                    <!-- eight -->

                    <tr border="1">
                        <td colspan="4" style="">
                            <img src="../upload/event_web_logo/' . "$event_web_logo" . '" width="60px" height="60px">
                        </td>

                    </tr>
                    <!-- nine -->

                </tbody>
            </table>
                         ' ;
                        if($order_item!=$i)
                        {
                            echo '<pagebreak />';
                        }
                        
                }
            } else {
                for ($i; $i <= $order_item; $i++) {
                    echo ' 
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENU WILL NOT BE ALLOWED</h5>
            </div>                          

                <div class="header">
                    <p class="title">
                        Order No: <code>' . "$OI_number" . '</code>
                    </p>
                </div>
                
                <table border="1"  border-collapse: "collapse" cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                    <tbody>
                         <tr border="1">
                            <td style="padding-left:1%;">EVENT TITLE</td>
                            <td colspan="2" style="padding-left:1%;">
                                ' . "$o_title" . '
                            </td>
                            <td rowspan="2" style="text-align: center;padding:1%;"><img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/' . "$event_web_logo" . '"></td>
                        </tr>
                        
                        <tr border="1">
                            <td style="padding-left:1%;">VENUE</td>
                            <td colspan="2" style="padding-left:1%;">
                                ' . "$venue_title" . ' 
                            </td>

                        </tr>
                        
                        <tr border="1">
                            <td style="padding-left:1%;padding:10px;">DATE</td>
                            <td colspan="1" style="padding-left:1%;">
                                ' . " $start_date" . ' 
                            </td>
                            <td style="padding-left:1%;">TIME</td>
                            <td style="padding-left:1%;">Start Time :
                                ' . " $start_time" . '  &nbsp; End Time:
                                    ' . "$end_time" . ' 
                            </td>
                        </tr>
                        <tr border="1">
                            <td style="padding-left:1%;">PAYMENT METHOD:</td>
                            <td style="padding-left:1%;">
                                ' . " $payment_method" . ' 
                            </td>
                            <td style="padding-left:1%;">CATAGORY</td>
                            <td style="padding-left:1%;">
                                ' . " $category_title" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                <h5 style="text-align: center;">CUSTOMER INFO</h5>
                                
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Name:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$userName" . '
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Address:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$UA_address" . '
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Email:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$user_email" . '
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Phone Number:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        ' . "$user_phone" . '
                                    </p>
                                </div>

                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                <h5 style="text-align: center;">TICKET DETAILS (BDT)</h5>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Ticket Qty:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$totalTI" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Ticket Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$ticket_total_price" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Include Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$include_total_price" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Shipment/Delivery Cost:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$order_shipment_charge" . '
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Total Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        ' . "$totalPrice" . '
                                    </p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr border="1">
                                <td style="padding:1.5%;">ORGANIZER</td>
                                <td colspan="3" style="padding:1.5%;">
                                    <p>
                                        ' . " $event_organizer" . ' 
                                    </p>
                                </td>
                        </tr>
                        
                        <tr border="1">
                                <td style="padding:1.5%;">EVENT DETAILS</td>
                                <td colspan="3" style="padding:1.5%;">
                                    <p>
                                        ' . " $event_description" . ' 
                                    </p>
                                </td>
                        </tr>
          
                        <tr border="1">
                                <td colspan="4" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;">

                                    <div class="barcodecell" >
                                        <barcode code=" ' . "$base_code$i" . '" type="c93" text="1" />
                                    </div>
                                    <p>
                                        ' . "$base_code$i" . '
                                    </p>
                                </td>
                        </tr>
                        <tr border="1">
                                <td colspan="4" style="text-align: center;">
                                    <p>TERMS & CONDITIONS</p>
                                    <p style="padding-left:">'."$event_terms_conditions".'</p>
                                </td>
                            </tr>

                            <tr border="1">
                                <td colspan="4" style="text-align: center;">
                                    <p>TICKETING PARTNER</p>
                                    <p style="padding-left:">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                                    <p>
                                        <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" style="max-height:100%;max-width:100%"></p>
                                </td>
                        </tr>                        

                    </tbody>
                </table>   
                
                           ';
                    
                    
                    if($order_item!=$i)
                        {
                            echo '<pagebreak />';
                        }
                }
            }
        } else {
            echo 'No order item<br/>';
        }
        ?>



    </body>

</html>