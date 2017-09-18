<?php
require_once '../../DBconnection/database_connections.php';
$orderID = $_GET['order_id'];
@$orderStatus=$_GET['order_status'];
//$sqlgetactualdata = "SELECT a.*,
//b.name,
//c.*,
//a.order_id as mov_order_id,
//eml.event_id
//FROM order_movie_event as a 
//LEFT JOIN event_movie_theatre as b on b.theatre_id=a.theatre_id 
//LEFT JOIN orders as c on c.order_id=a.verified_order_id 
//LEFT JOIN event_movie_list as eml on eml.movie_id=a.movie_id WHERE a.verified_order_id='" . $orderID . "'";

//$sqlgetactualdata="SELECT a.*,
//a.order_id as mov_order_id,
//mt.name as theatre_name
//FROM order_movie_event as a 
//LEFT JOIN event_movie_theatre AS mt ON a.theatre_id=mt.theatre_id
// WHERE a.order_id='$orderID'";

$sqlgetactualdata="SELECT 
emgl.image AS movieLogo,
pm.name AS paymentMethod,
a.*,
a.order_id as mov_order_id,
mt.name as theatre_name

FROM order_movie_event as a 
LEFT JOIN event_movie_theatre AS mt ON a.theatre_id=mt.theatre_id
LEFT JOIN event_movie_gallery_list AS emgl ON a.movie_id = emgl.movie_id
LEFT JOIN payment_method AS pm ON a.payment_method = pm.id
WHERE a.order_id='$orderID'";



$queryactualuser = mysqli_query($con, $sqlgetactualdata);
$chkactualuser = mysqli_num_rows($queryactualuser);

$alldataact = array();
if ($chkactualuser != 0) {
    while ($rowactu = mysqli_fetch_object($queryactualuser)):
        $alldataact[] = $rowactu;
    endwhile;
    ?>

    <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                           text-align: center;width: 92%;">Please print and bring this ticket with you</h5>
    </div>      

    <!--border-collapse:"collapse"-->
    <table border="1"  cellspacing="0" width="100%" style="margin:0px auto;border-collapse: collapse;border-spacing: 0px;">
                
                <tbody>
                
                        <tr border="1">
                            <td style="padding-left:1%;">Movie Name</td>
                            <td colspan="2" style="padding-left:1%;">
                               <?php echo $alldataact[0]->movie_name; ?>
                            </td>
                            <td rowspan="5" style="text-align: center;padding:1%;">
                                <!--<img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/' . "$event_logo" . '">-->
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Theater Name</td>
                           <td colspan="2" style="padding-left:1%;">
                               <?php echo $alldataact[0]->theatre_name; ?> 
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Payment Method:</td>
                           <td colspan="2" style="padding-left:1%;">
                                
                            </td>
                        </tr>
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Category:</td>
                           <td colspan="2" style="padding-left:1%;">
                               Movie
                            </td>
                        </tr> 
                        
                        <tr border="1">
                           <td style="padding-left:1%;">Order Id:</td>
                           <td colspan="2" style="padding-left:1%;">
                               <?php echo $orderID; ?> 
                            </td>
                        </tr>
                        
                        
                        
                        <tr border="1">
                            <td colspan="2" style="text-align: center;padding-left:1%;line-height: 25px;max-width:100%;">
                                    <div class="barcodecell" style="margin:0 auto;text-align:center;">
                                        <!--<barcode code=" ' . "$base_code" . '" type="c93" text="1" />-->
                                    </div>
                            </td>
                            <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                 <h5 style="text-align: center;">Schedule</h5>
<!--                                 <p>'.$event_start_date.','.$event_start_time.'-'.$event_end_time.'</p>
                                 <p>'.$event_end_date.','.$event_start_time.'-'.$event_end_time.'</p>-->
                            </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p><?php echo $alldataact[0]->fullname; ?></p>
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
<!--                                        ' . "$UA_address" . '-->
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Email:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        <?php echo $alldataact[0]->email; ?>
                                    </p>
                                </div>
                                <div style="width:30%;float:left;height:35px;">
                                    <p>Phone/Mobile:</p>
                                </div>
                                <div style="width:70%;float:right;height:35px;">
                                    <p>
                                        <?php echo $alldataact[0]->mobile; ?>
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
                                        <?php echo $alldataact[0]->seat; ?>
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Seat Number:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        <?php echo $alldataact[0]->seat_number; ?>
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Unit Price:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        <?php echo $config['CURRENCY_SIGN']; ?><?php echo $alldataact[0]->seat_unit_price; ?>
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Ticket Total Amount:</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        + <?php
                                            $total_ticket_amount = $alldataact[0]->seat * $alldataact[0]->seat_unit_price;
                                            echo number_format($total_ticket_amount, 2);
                                            ?>
                                    </p>
                                </div>
                                <div style="width:70%;float:left;height:35px;">
                                    <p>Total Order Amount :</p>
                                </div>
                                <div style="width:30%;float:right;height:35px;">
                                    <p>
                                        <?php echo $config['CURRENCY_SIGN']; ?><?php
                                        echo number_format($total_order_amount_found, 2);
                                        ?>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr border="1">
                               
                               <td colspan="4" style="padding-left:1%;line-height: 5px;max-width:100%;">
                                  <h5 style="">TERMS & CONDITIONS</h5>
                                  <!--<p>'.$event_terms_conditions.'</p>-->
                               </td>
                        </tr>
                        
                        <tr border="1">
                               <td colspan="4" style="text-align: center;">
                                 <p>PARTNERS</p>
                                 <img/>
                               </td>
                        </tr>
                    

                </tbody>
            </table>

<!--    <tr>
        <td valign="top">
            <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello <?php //echo $alldataact[0]->fullname; ?>,</h1>
            <p style="font-size:15px;line-height:16px;">
                

            </p>
        </td>
    </tr>-->
    <!--            <table class="table" width="100%" cellspacing="1">-->
    
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