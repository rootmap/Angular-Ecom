






<?php 
session_start();
require_once '../DBconnection/database_connections.php';
$data = json_decode(file_get_contents("php://input"));

@$o_session_id  = $data->osessionId;


$orderSql = "SELECT `order_number`, `order_id` FROM `orders` WHERE `order_session_id` = '$o_session_id' ORDER BY order_id DESC LIMIT 1";
$order_number = mysqli_query($con, $orderSql);
$fetNum=  mysqli_fetch_array($order_number);

$orderNumber = array();
 $o_id = $fetNum['order_id'];



$sql = " 
select 
o.order_id,
o.order_number, 
o.order_status, 
oe.OE_event_id,
e.event_title,
e.event_description,
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
WHERE oi.OI_order_id=$o_id
GROUP BY oi.OI_item_type) AS oit ON oit.OI_order_id=o.order_id AND oit.OI_item_type='ticket'
LEFT JOIN (SELECT oi.OI_order_id,SUM(oi.OI_quantity) AS quantity,SUM(oi.OI_quantity*oi.OI_unit_price) AS total_price,oi.OI_item_type FROM order_items as oi 
WHERE oi.OI_order_id=$o_id
GROUP BY oi.OI_item_type) AS oii ON oii.OI_order_id=o.order_id AND oii.OI_item_type='include'
where o.order_id =$o_id
       ";

$result = mysqli_query($con, $sql);

$object = array();

$row = mysqli_fetch_array($result);

    @$OI_id=$row['order_id'];
    @$OI_number=$row['order_number'];
    @$o_title=$row['event_title'];
    @$venue_title=$row['venue_title'];
    @$event_web_logo=$row['event_web_logo'];
    @$start_date=$row['start_date'];
    @$start_time=$row['start_time'];
    @$end_time=$row['end_time'];
    @$payment_method=$row['payment_method'];
    @$category_title=$row['category_title'];
    @$status=$row['order_status'];
    @$userName=$row['userName'];
    @$UA_address=$row['UA_address'];
    @$user_email=$row['user_email'];
    @$user_phone=$row['user_phone'];
    @$ticket_quantity=$row['ticket_quantity'];
    @$include_quantity=$row['include_quantity'];
    @$totalTI = $row['ticket_quantity'] + $row['include_quantity'] ;
    @$ticket_total_price=$row['ticket_total_price'];
    @$include_total_price=$row['include_total_price'];
    @$totalPrice=$row['ticket_total_price'] + $row['include_total_price'];
    @$event_description=$row['event_description'];

?>

<html>
    
    
    <body>
        
        
        <table border="1" border-collapse: collapse cellspacing="0"  style="margin:0px auto;border:1px solid #81C91B;width:960px; margin: 0 auto;">
            <tbody>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">EVENT TITLE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;"><?php echo $o_title;?></td>
                    <td rowspan="2" style="text-align: center;padding:1%;border:1px solid #81C91B;"><img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/<?php echo $event_web_logo; ?>" alt="event_logo"></td>
                </tr>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">VENUE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;"><?php echo $venue_title;?></td>

                </tr>
                <!-- end one -->
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;padding:10px;">DATE</td>
                    <td colspan="1" style="padding-left:1%;border:1px solid #81C91B;"><?php echo $start_date;?></td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">TIME</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">Start Time : <?php echo $start_time;?> &nbsp; End Time: <?php echo $end_time;?> </td>
                </tr>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">DELIVERY METHOD:</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;"><?php echo $payment_method;?></td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">CATAGORY</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;"><?php echo $category_title;?></td>
                    
                </tr>
                   <td style="padding-left:1%;border:1px solid #81C91B;">ORDER STATUS</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;"><?php echo $status;?></td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">ORDER NUMBER</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;"><?php echo $OI_number;?></td>
                <tr>
                    
                </tr>
                <!-- end two -->
                <tr>
                    <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;border:1px solid #81C91B;">
                        <h5 style="text-align: center;">CUSTOMER INFO</h5>
                        <!--;margin-top:  !important;-->
                        <div style="width:30%;float:left;height:35px;"><p>Name:</p></div>
                        <div style="width:70%;float:right;height:35px;"><p><?php echo $userName;?></p></div>
                        <div style="width:30%;float:left;height:35px;"><p>Address:</p></div>
                        <div style="width:70%;float:right;height:35px;"><p><?php echo $UA_address;?></p></div>
                        <div style="width:30%;float:left;height:35px;"><p>Email:</p></div>
                        <div style="width:70%;float:right;height:35px;"><p><?php echo $user_email;?></p></div>
                        <div style="width:30%;float:left;height:35px;"><p>Phone Number:</p></div>
                        <div style="width:70%;float:right;height:35px;"><p><?php echo $user_phone;?></p></div>

                    </td>
                    <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;border:1px solid #81C91B;">
                        <h5 style="text-align: center;">TICKET DETAILS (BDT)</h5>
                        <div style="width:70%;float:left;height:35px;"><p>Ticket Qty:</p></div>
                        <div style="width:30%;float:right;height:35px;"><p><?php echo $ticket_quantity;?></p></div>
                        <div style="width:70%;float:left;height:35px;"><p>Include Qty:</p></div>
                        <div style="width:30%;float:right;height:35px;"><p><?php echo $include_quantity;?></p></div>
                        <div style="width:70%;float:left;height:35px;"><p>Ticket Price:</p></div>
                        <div style="width:30%;float:right;height:35px;"><p><?php echo $ticket_total_price;?></p></div>
                        <div style="width:70%;float:left;height:35px;"><p>Include Price:</p></div>
                        <div style="width:30%;float:right;height:35px;"><p><?php echo $include_total_price;?></p></div>
                        <div style="width:70%;float:left;height:35px;"><p>Total Price:</p></div>
                        <div style="width:30%;float:right;height:35px;"><p><?php echo $totalPrice;?></p></div>
                    </td>
                </tr>

                <!-- end three -->
                <tr>
                    <td  style="padding:1.5%;border:1px solid #81C91B;">EVENT DETAILS</td>
                    <td colspan="3" style="padding:1.5%;border:1px solid #81C91B;"><p><?php echo $event_description;?></p>
                    </td>
                </tr>
         
                

                <tr>
                    <td colspan="4"  style="text-align: center;border:1px solid #81C91B;">
                        <p>TERMS & CONDITIONS</p>
                        <p style="padding-left:">Bring your National ID card / passport / driving license photocopy to enter the venue.</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="4"  style="text-align: center;border:1px solid #81C91B;">
                        <p>TICKETING PARTNER</p>
                        <p style="padding-left:">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                        <p><img src="../tc-merchant-template/assets/img/white-shadow-logo.png" alt="Ticketchai Logo"  style="max-height:100%;max-width:100%"></p>
                    </td>
                </tr>

            </tbody>
        </table>
    </body>
    
    
</html>
