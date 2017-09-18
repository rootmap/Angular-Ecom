<?php
session_start();
//require_once './DBconnection/database_connections.php';
require_once './DBconnection/database_connections.php';

//require_once '../DBconnection/auth.php';

// $o_id = $_GET['o_id'];
 $o_id = $_GET['o_id'];
 
 
$order_session=$_GET['order_session'];
        

$sql = "SELECT

pi.image,

e.`event_id`,
e.`event_title`,
e.`event_web_logo`,
e.`event_terms_conditions`,
e.`event_description`,
e.`organized_by`,

ev.`venue_id`,
ev.`venue_title`,
ev.`city`,

o.`order_id`,
o.`order_number`, 
o.`order_status`, 
o.`order_total_item`,
o.`order_shipment_charge`,

CASE o.`order_payment_type`
WHEN 'CARD' THEN 'Online Payment'
WHEN 'COD'  THEN 'Cash On Delivery'
WHEN 'eticket' THEN 'Online Free E-Ticket'
WHEN 'movie-eticket-online' THEN 'Online Movie E-Ticket'
WHEN 'movie-eticket-cod' THEN 'Cash On Delivery'
ELSE 'Pick From Office'
END payment_method,

((o.`order_total_amount` + o.`order_vat_amount`)-o.`order_discount_amount`) AS newtotal_price,
oe.`OE_event_id`,

IFNULL(oit.quantity,0) AS ticket_quantity ,
IFNULL(oit.total_price,0) AS ticket_total_price,
IFNULL(oii.quantity,0) AS include_quantity,
IFNULL(oii.total_price,0) AS include_total_price,

c.`category_title`,
u.`user_name` as userName,
IFNULL(u.`user_phone`,'Not Mentioned') AS user_phone ,
u.`user_email`,
IFNULL(ua.`UA_address`,'Not Mentioned') AS UA_address ,

DATE_FORMAT(ev.venue_start_date, '%a %D %b %Y') as start_date,
DATE_FORMAT(ev.venue_end_date, '%a %D %b %Y') as end_date,
TIME_FORMAT(ev.venue_start_time, '%h:%i%p') as start_time,
TIME_FORMAT(ev.venue_end_time, '%h:%i%p') as end_time

from `orders`AS o
LEFT JOIN `order_events` AS oe ON o.order_id = oe.OE_order_id
LEFT JOIN `events`       AS e ON oe.OE_event_id = e.event_id
LEFT JOIN `partner_image` AS pi ON pi.e_id = e.event_id
LEFT JOIN `event_venues` AS ev ON e.event_id = ev.venue_event_id
LEFT JOIN `categories`   AS c  ON e.event_category_id = c.category_id
LEFT JOIN `temp_billing` AS u  ON o.order_session_id = u.order_id 
LEFT JOIN `user_addresses` AS ua ON u.user_id = ua.UA_user_id 
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$o_id'
GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id='$o_id'
GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
where o.order_id ='$o_id' AND o.`order_session_id`='$order_session'
       ";

//DATE_FORMAT(ev.venue_start_date, '%M %d, %Y') as start_date2,
//DATE_FORMAT(ev.venue_end_date, '%M %d, %Y') as end_date2

$result = mysqli_query($con, $sql);

$object = array();

while ($row = mysqli_fetch_array($result)) {

    $object[] = $row;

    $event_id = $row['event_id'];
    $event_title = $row['event_title'];
    $event_logo = $row['event_web_logo'];
    $event_terms_conditions = $row['event_terms_conditions'];
    $event_description = $row['event_description'];
    $event_start_date = $row['start_date'];
    $event_end_date = $row['end_date'];
    $event_start_time = $row['start_time'];
    $event_end_time = $row['end_time'];
    $organized_by = $row['organized_by'];

    $venue_id = $row['venue_id'];
    $venue_title = $row['venue_title'];
    $city = $row['city'];

    $order_id = $row['order_id'];
    $order_number = $row['order_number'];
    $order_status = $row['order_status'];
    $order_total_item = $row['order_total_item'];
    $order_payment_method = $row['payment_method'];
    $order_newtotal_price = $row['newtotal_price'];

    $ticket_quantity = $row['ticket_quantity'];
    $include_quantity = $row['include_quantity'];
    $totalTI = $row['ticket_quantity'] + $row['include_quantity'];
    $ticket_total_price = $row['ticket_total_price'];
    $include_total_price = $row['include_total_price'];
    $totalPrice = $row['ticket_total_price'] + $row['include_total_price'] + $row['order_shipment_charge'];
    $order_shipment_charge = $row['order_shipment_charge'];

    $category_title = $row['category_title'];

    $userName = $row['userName'];
    $UA_address = $row['UA_address'];
    $user_email = $row['user_email'];
    $user_phone = $row['user_phone'];

    $p_img = $row['image'];
}

//$sql2 = "
//        SELECT 
//        *
//        FROM  partner_image WHERE e_id = '$event_id'"
//        ;
//
//   $result2 = mysqli_query($con, $sql2);
//   
//   
//   
//   $count = mysqli_num_rows($result2);
//$count = mysqli_num_rows($result2);
//   $object = array();
//   
//   if($count == 1):
//       while ($row2 = mysqli_fetch_array($result2)) :
//         $object[]=$row2;
//         
//         $img = $row2['image'];
//         
//          $pImg = '';
////   <img style="max-height:50px;width:100%;padding:5px;" src="../upload/ticket_partner/'.$img.'"/>
//      if(!empty($img)):
//         $pImg = '<tr border="1">
//                               <td colspan="4" style="text-align:center;">
//                                 <img style="padding:5px;" src="../upload/ticket_partner/'.$img.'"/>
//                               </td>
//                        </tr>';
//     else:
//         $pImg = '';
//      
//     endif;
//         
//      endwhile;
//   endif;


$pIMG = '';

if (!empty($p_img)) {
    $pIMG = '<tr border="1">
                               <td colspan="4" style="text-align:center;">
                                 <img style="padding:5px;" src="../upload/ticket_partner/' . $p_img . '"/>
                              </td>
                        </tr>';
}else{
    $pIMG = '';
}
?>


<html>

    <head>

        <script type='text/javascript' src='assets/js/jquery.min.js'></script>
        <script type='text/javascript' src='assets/js/barcode/jquery-barcode.js'></script>


    </head>

    <body>


<?php
$i = 0;


if ($order_total_item > $i) {

//            Free ticketing part start 
    if ($order_status == 'free') {

        //echo 'free';
        //echo $order_total_item;

        for ($i = 1; $i <= $order_total_item; $i++) {
            //echo $i;

            $cleanNum = str_replace("-", "SP", str_replace("[", "TL", str_replace("]", "TR", $order_number))) . "LL" . $i;
            $base_code = $cleanNum;
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE ticket_id='$base_code' AND pattern='$order_number'")) == 0) {
                mysqli_query($con, "INSERT INTO checkininout SET ticket_id='$base_code',pattern='$order_number'");
            }

            echo ' 
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                            text-align: center;width: 92%;">Please print and bring this ticket with you</h5>
            </div>                          

            <table border="1" border-collapse:"collapse" cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                
                <tbody>
                
                        <tr border="1">
                            <td style="padding-left:1%;">EVENT TITLE</td>
                            <td colspan="2" style="padding-left:1%;">
                                ' . "$event_title" . '
                            </td>
                            <td rowspan="5" style="text-align: center;padding:1%;">
                                <img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/' . "$event_logo" . '">
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">VENUE</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$venue_title" . ', '."$city".'  
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">DELIVERY METHOD:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_payment_method" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">CATAGORY:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$category_title" . ' 
                            </td>
                        </tr> 
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Order Number:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_number" . '-' . $i . ' 
                            </td>
                        </tr>
                        
                        
                        
                        <tr border="1">
                            <td colspan="2" style="text-align: center;padding-left:1%;line-height: 25px;max-width:100%;">
                                    <div class="barcodecell" style="margin:0 auto;text-align:center;">
                                        <barcode code=" ' . "$base_code" . '" type="c93" text="1" />
                                    </div>
                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                 <h5 style="text-align: center;">Schedule</h5>
                                 <p>' . $event_start_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                                 <p>' . $event_end_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>' . $userName . '</p>
                               </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                            
                                <h5 style="text-align: center;">CUSTOMER INFO</h5>
                                
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
                            <td colspan="2" style=" text-align:center;">
                               <h4 style="text-align:center; margin:5px; font-size:20px">FREE PASS</h4>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                  <h5 style="">TERMS & CONDITIONS</h5>
                                  <p>' . $event_terms_conditions . '</p>
                               </td>
                        </tr>
                        
                          
                             
                        <tr border="1">
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;text-align:center;">
                                  <h5 style="">TICKETING PARTNER</h5><br/>
                                  <img src="../merchant-dashboard/assets/img/white-shadow-logo.png"/><br/>
                                  <p>Hot Line Number: +88 01971-Ticket(842538), +8801942999666</p>
                               </td>
                        </tr>  
                    

                </tbody>
            </table>
                         ';
            if ($order_total_item != $i) {
                echo '<pagebreak />';
            }
        }
    }//            Free ticketing part end 
    else {
        //echo 'paid order';
        for ($i = 1; $i <= $order_total_item; $i++) {
            //echo $i;

            $cleanNum = str_replace("-", "SP", str_replace("[", "TL", str_replace("]", "TR", $order_number))) . "LL" . $i;
            $base_code = $cleanNum;
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM checkininout WHERE ticket_id='$base_code' AND pattern='$order_number'")) == 0) {
                mysqli_query($con, "INSERT INTO checkininout SET ticket_id='$base_code',pattern='$order_number'");
            }

            echo ' 
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                            text-align: center;width: 92%;">Please print and bring this ticket with you</h5>
            </div>                          

            <table border="1" border-collapse:"collapse" cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                
                <tbody>
                
                        <tr border="1">
                            <td style="padding-left:1%;">EVENT TITLE</td>
                            <td colspan="2" style="padding-left:1%;">
                                ' . "$event_title" . '
                            </td>
                            <td rowspan="5" style="text-align: center;padding:1%;">
                                <img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/' . "$event_logo" . '">
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">VENUE</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$venue_title" . ', '."$city".'  
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">DELIVERY METHOD:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_payment_method" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">CATAGORY:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$category_title" . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Order Number:</td>
                           <td colspan="2" style="padding-left:1%;">
                               ' . "$order_number" . '-' . $i . ' 
                            </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="text-align: center;padding-left:1%;line-height: 25px;max-width:100%;">
                                    <div class="barcodecell" style="margin:0 auto;text-align:center;">
                                        <barcode code=" ' . "$base_code" . '" type="c93" text="1" />
                                    </div>
                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                 <h5 style="text-align: center;">Schedule</h5>
                                 <p>' . $event_start_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                                 <p>' . $event_end_date . ',' . $event_start_time . '-' . $event_end_time . '</p>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>' . $userName . '</p>
                               </td>
                        </tr>
                        
                        <tr border="1">
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                            
                                <h5 style="text-align: center;">CUSTOMER INFO</h5>
                                
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
                                        ' . "$order_total_item" . '
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
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                  <h5 style="">TERMS & CONDITIONS</h5>
                                  <p>' . $event_terms_conditions . '</p>
                               </td>
                        </tr>
                         
                           
                        
                        ' . $pIMG . '  
                             
                        <tr border="1">
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;text-align:center;">
                                  <h5 style="">TICKETING PARTNER</h5><br/>
                                  <img src="../merchant-dashboard/assets/img/white-shadow-logo.png"/><br/>
                                  <p>Hot Line Number: +88 01971-Ticket(842538), +8801942999666</p>
                               </td>
                        </tr>  

                        
                    

                </tbody>
            </table>
                           ';


            if ($order_total_item != $i) {
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

<!--<tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>PARTNERS</p>
                                 <img/>
                                 <h1>'.$img.'</h1>
                               </td>
                        </tr>-->