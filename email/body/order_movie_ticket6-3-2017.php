<?php
require_once '../../DBconnection/database_connections.php';
$orderID = $_GET['order_id'];
$orderStatus=$_GET['order_status'];
//$sqlgetactualdata = "SELECT a.*,
//b.name,
//c.*,
//a.order_id as mov_order_id,
//eml.event_id
//FROM order_movie_event as a 
//LEFT JOIN event_movie_theatre as b on b.theatre_id=a.theatre_id 
//LEFT JOIN orders as c on c.order_id=a.verified_order_id 
//LEFT JOIN event_movie_list as eml on eml.movie_id=a.movie_id WHERE a.verified_order_id='" . $orderID . "'";

$sqlgetactualdata="SELECT a.*,
a.order_id as mov_order_id,
mt.name as theatre_name
FROM order_movie_event as a 
LEFT JOIN event_movie_theatre AS mt ON a.theatre_id=mt.theatre_id
 WHERE a.order_id='$orderID'";

$queryactualuser = mysqli_query($con, $sqlgetactualdata);
$chkactualuser = mysqli_num_rows($queryactualuser);

$alldataact = array();
if ($chkactualuser != 0) {
    while ($rowactu = mysqli_fetch_object($queryactualuser)):
        $alldataact[] = $rowactu;
    endwhile;
    ?>

    <tr>
        <td valign="top">
            <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello <?php echo $alldataact[0]->fullname; ?>,</h1>
            <p style="font-size:15px;line-height:16px;">
                

            </p>
        </td>
    </tr>
    <tr>
        <td valign="top">

<!--            <table class="table" width="100%" cellspacing="1">-->
             <table width="100%" cellspacing="0" cellpadding="0" border="1">
                <thead>
                    <tr>
                        <td colspan="4"><h3><strong><u>Order Detail : </u></strong></h3></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Request Date</strong></td>
                        <td><?php echo $alldataact[0]->request_date; ?></td>
                        <td><strong>Order Time</strong></td>
                        <td><?php echo $alldataact[0]->datetime; ?></td>
                    </tr>    
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Order ID</strong></td>
                        <td><?php echo $orderID; ?></td>
                        <td><strong>Full Name</strong></td>
                        <td><?php echo $alldataact[0]->fullname; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Ticket Number</strong></td>
                        <td><?php echo $orderNumber; ?></td>

                        <td><strong>Phone/Mobile</strong></td>
                        <td><?php echo $alldataact[0]->mobile; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Movie Name</strong></td>
                        <td><?php echo $alldataact[0]->movie_name; ?></td>
                        <td><strong>Email</strong></td>
                        <td><?php echo $alldataact[0]->email; ?></td>

                    </tr>

                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Theatre Name</strong></td>
                        <td><?php echo $alldataact[0]->theatre_name; ?></td>
                        <td><strong>Ticket Type</strong></td>
                        <td><?php echo $alldataact[0]->seat_type; ?></td>

                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Ticket Quantity</strong></td>
                        <td><?php echo $alldataact[0]->seat; ?></td>
                        <td><strong>Unit Price</strong></td>
                        <td><?php echo $config['CURRENCY_SIGN']; ?><?php echo $alldataact[0]->seat_unit_price; ?></td>

                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Seat Number</strong></td>
                        <td colspan="3"><?php echo $alldataact[0]->seat_number; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Ticket Total Amount</strong></td>
                        <td colspan="3">+ <?php
                            $total_ticket_amount = $alldataact[0]->seat * $alldataact[0]->seat_unit_price;
                            echo number_format($total_ticket_amount, 2);
                            ?></td>
                    </tr>
                    <?php
                    $extra_cost_total = 0;
                    $deliveryCost = 0;
                    $onlineGatewayCost = 0;
                    $costarray = array();
                    $extracoststring = "SELECT a.*,e.deduction_type FROM order_extra_cost_history as a 
                    LEFT JOIN event_ticket_extra_cost as e ON e.id=a.cost_id WHERE a.order_id='" . $alldataact[0]->order_id . "'";
                    $extracost = mysqli_query($con, $extracoststring);
                    @$chkextrs = mysqli_num_rows($extracost);
                    while ($rowcost = mysqli_fetch_object($extracost)):
                        $costarray[] = $rowcost;
                    endwhile;
                    if ($chkextrs != 0):
                        foreach ($costarray as $cost):
                            $extra_cost_total+=$cost->cost_amount;
                            if ($cost->deduction_type == 2) {
                                $am=($ticket_amount*$cost->cost_amount)/100;
                                ?>
                                <tr>
                                    <td style="border: none;"><strong><?php echo $cost->cost_title; ?></strong></td>
                                    <td style=" border: none; border-bottom:1px #ccc solid;">+ <?php echo number_format($am); ?>(<?php echo number_format($cost->cost_amount, 2); ?>%)</td>
                                </tr>
                                <?php
                            } else {
                                $am=$cost->cost_amount;
                                ?>
                                <tr>
                                    <td style="border: none;"><strong><?php echo $cost->cost_title; ?></strong></td>
                                    <td style=" border: none; border-bottom:1px #ccc solid;">+ <?php echo number_format($cost->cost_amount, 2); ?></td>
                                </tr>
                                <?php
                            }
                            
                            $extra_cost_total+=$am;
                        endforeach;
                    endif;





                    $pmt = $alldataact[0]->payment_method;
                    if (true) {
                        $online_charge_rate = "3.50";
                        $order_events_idso = $alldataact[0]->event_id;
                        if ($order_events_idso == 0) {
                            $online_charge_rate = "3.50";
                        } else {
                            $ratearray = array();
                            $sqlrateget = "SELECT * FROM event_online_charge WHERE event_id='" .$order_events_idso. "'";
                            $queryrate = mysqli_query($con, $sqlrateget);
                            $chekqu = mysqli_num_rows($queryrate);
                            if ($chekqu != 0) {
                                while ($rg = mysqli_fetch_object($queryrate)):
                                    $ratearray[] = $rg;
                                endwhile;

                                $online_charge_rate = $ratearray[0]->cost;
                                
                            }
                            else {
                                $online_charge_rate = "3.50";
                                
                            }
                        }
                        
                        $onlineGatewayCost =(($total_ticket_amount + $extra_cost_total)*$online_charge_rate)/100;
                        
                        ?>
                        <tr>
                            <td style="height: 20px; line-height: 20px;"><strong>Online Charge : </strong></td>
                            <td colspan="3">+ <?php 
                                echo number_format($onlineGatewayCost,2);
                            ?> (<?php echo $online_charge_rate; ?>%)</td>
                        </tr>

                        <?php
                        $total_order_amount_found = $total_ticket_amount + $extra_cost_total +$onlineGatewayCost;
                        
                    } elseif ($pmt == 3) {

                        $rrdelivery = array();
                        $sqlgetdelivery_detail = "SELECT * FROM order_delivery_cost WHERE order_id='" . $alldataact[0]->mov_order_id . "'";
                        $querydelivery = mysqli_query($con, $sqlgetdelivery_detail);
                        @$chkdeliveryst = mysqli_num_rows($querydelivery);
                        if ($chkdeliveryst != 0) {
                            while ($rowdeli = mysqli_fetch_object($querydelivery)):
                                $rrdelivery[] = $rowdeli;
                            endwhile;
                        }
                        ?>
                        <tr>
                            <td style="height: 20px; line-height: 20px;"><strong>Delivery Cost : </strong></td>
                            <td colspan="3">+ <?php 
                                echo number_format($rrdelivery[0]->cost,2);
                            ?></td>
                        </tr>

                        <?php
                        $deliveryCost = $rrdelivery[0]->cost;
                        $total_order_amount_found = $total_ticket_amount + $extra_cost_total + $deliveryCost;
                    }
                    else {
                        $total_order_amount_found = $total_ticket_amount + $extra_cost_total;
                    }
                    ?>
                    <tr>
                            <td style="height: 20px; line-height: 20px;"><strong>Total Order Amount : </strong></td>
                            <td colspan="3"><strong><?php echo $config['CURRENCY_SIGN']; ?><?php
                                
                                echo number_format($total_order_amount_found, 2);
                                ?></strong></td>
                        </tr>
                   <?php     
                   if ($pmt == 2) {  ?>  
                        <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                   <tr>
                        <td colspan="4"><h3><strong><u>Shipping Detail : </u></strong></h3></td>
                    </tr>    
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Contact Person Name : </strong></td>
                        <td colspan="3"><?php echo $alldataact[0]->order_shipping_first_name;  ?></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Contact No. :</strong></td>
                        <td colspan="3"><?php echo $alldataact[0]->order_shipping_phone;  ?></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>City :</strong></td>
                        <td colspan="3"><?php echo $alldataact[0]->order_shipping_city;  ?></td>
                    </tr>
                    <tr>
                        <td style="height: 20px; line-height: 20px;"><strong>Address :</strong></td>
                        <td colspan="3"><?php echo $alldataact[0]->order_shipping_address;  ?></td>
                    </tr>
                   <?php } ?>
                </thead>

            </table>

        </td>
    </tr>
    <tr>
        <td valign="top">
            <p style="font-size:15px;line-height:16px;">
                Note : Ticket Purchase Amount is not re-fundable.
            </p>
        </td>
    </tr>
    <?php
} else {
    ?>
    <tr>
        <td valign="top">
            <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello <?php echo $orderUserName; ?>,</h1>        
            <p style="font-size:15px;line-height:16px;">
                Thank you for using ticketchai.com, Your ticket has been canceled due to payment.please try again before end-up your movie schedule.
            </p>
        </td>
    </tr>
    <?php
}
?>