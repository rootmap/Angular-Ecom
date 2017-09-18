<?php
require_once '../DBconnection/database_connections.php';

$o_id = trim($_GET['orderId']);
//session_start();
$unique_id = session_id();
$sqlgetnumber = mysqli_query($con, "SELECT order_number,order_session_id, order_status, order_total_item FROM `orders` WHERE order_id='$o_id'");
$fetnumber = mysqli_fetch_array($sqlgetnumber);
$order_number = $fetnumber['order_number'];
$order_item = $fetnumber['order_total_item'];
$order_sessoin = $fetnumber['order_session_id'];
$order_status = $fetnumber['order_status'];

?>
 

<!--this ng repeat is work for count total order iteam-->
<!--ng-repeat="xx in orderItem"-->


    <div class="card padding_top15" >

        <span ng-repeat="x in orderData">

        <div class="header">
            <p class="title">
                Order No: <code>{{x.order_number}}</code>
            </p>
        </div>
        <!--download-ticket.php-->

        <!--        Ticket format 1-->
        <div ng-if="x.order_status == 'booking' || x.order_status == 'approved' || x.order_status == 'delivered' || x.order_status == 'paid' || x.order_status == 'free & paid' || x.order_status == 'pending' || x.order_status == 'cancel'" class="" style="padding-left:17px;padding-right:17px;padding-top:0px">
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENUE WILL NOT BE ALLOWED</h5>
            </div>

            <span ng-if="x.order_status == 'paid' || x.order_status == 'free'">  
                <h5 style="margin: 0 auto;">PLEASE PRINT AND BRING THIS TICKET WITH YOU AT THE EVENT</h5> 
                <a href="download-ticket.php?order_session=<?php echo $order_sessoin; ?>&oid=<?php echo $o_id; ?>" target="_new" class="btn btn-success" style="border-radius: 0px; margin-top:10px; margin-bottom: 10px;">Download E-ticket</a>
          
            </span>
        <table border="1" border-collapse: collapse cellspacing="0" width="100%" style="margin:0px auto;border:1px solid #81C91B;">
            <tbody>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">EVENT TITLE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;">{{x.event_title}}</td>
                    <td rowspan="2" style="text-align: center;padding:1%;border:1px solid #81C91B;">
                        <img style="height:90px;max-width:100px"  check-image ng-src="../upload/event_web_logo/{{x.event_web_logo}}"/>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">VENUE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;">{{x.venue_title}}</td>

                </tr>
                <!-- end one -->
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;padding:10px;">DATE</td>
                    <td colspan="1" style="padding-left:1%;border:1px solid #81C91B;">{{x.start_date}}</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">TIME</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">Start Time : {{x.start_time}} &nbsp; End Time: {{x.end_time}} </td>
                </tr>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">PAYMENT METHOD:</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">{{x.payment_method}}</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">CATEGORY</td>
                    <td style="padding-left:1%;border:1px solid #81C91B;">{{x.category_title}}</td>
                </tr>
                <!-- end two -->
                <tr>
                    <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;border:1px solid #81C91B;">
                        <h5 style="text-align: center;">CUSTOMER INFO</h5>
                        <!--;margin-top:  !important;-->
                        <div style="width:30%;float:left;height:35px;">
                            <p>Name:</p>
                        </div>
                        <div style="width:70%;float:right;height:35px;">
                            <p>{{x.userName}}</p>
                        </div>
                        <div style="width:30%;float:left;height:35px;">
                            <p>Address:</p>
                        </div>
                        <div style="width:70%;float:right;height:35px;">
                            <p>{{x.UA_address}}</p>
                        </div>
                        <div style="width:30%;float:left;height:35px; margin-top:25px;">
                            <p>Email:</p>
                        </div>
                        <div style="width:70%;float:right;height:35px; margin-top:25px;">
                            <p>{{x.user_email}}</p>
                        </div>
                        <div style="width:30%;float:left;height:35px;">
                            <p>Phone:</p>
                        </div>
                        <div style="width:70%;float:right;height:35px;">
                            <p>{{x.user_phone}}</p>
                        </div>

                    </td>
                    <td colspan="2" style="padding-left:1%;line-height: 5px;max-width:100%;border:1px solid #81C91B;">
                        <h5 style="text-align: center;">TICKET DETAILS (BDT)</h5>
                        <div style="width:70%;float:left;height:35px;">
                            <p>Ticket Qty:</p>
                        </div>
                        <div style="width:30%;float:right;height:35px;">
<!--                            <p>{{+x.ticket_quantity + +x.include_quantity - 0}}</p>-->
                                <p>{{x.oiteam}}</p>
                        </div>
                        <div style="width:70%;float:left;height:35px;">
                            <p>Ticket Price:</p>
                        </div>
                        <div style="width:30%;float:right;height:35px;">
                            <p>{{x.ticket_total_price}}</p>
                        </div>
                        <div style="width:70%;float:left;height:35px;">
                            <p>Include Price:</p>
                        </div>
                        <div style="width:30%;float:right;height:35px;">
                            <p>{{x.include_total_price}}</p>
                        </div>
                        <div style="width:70%;float:left;height:35px;">
                            <p>Shipment/Delivery Cost:</p>
                        </div>
                        <div style="width:30%;float:right;height:35px;">
                            <p>{{x.order_shipment_charge}}</p>
                        </div>
                        <div style="width:70%;float:left;height:35px;">
                            <p>Total Price:</p>
                        </div>
                        <div style="width:30%;float:right;height:35px;">
                            <!--<p>{{+x.ticket_total_price + +x.include_total_price + +x.order_shipment_charge}}</p>-->
                            <p>{{x.newtotal_price}}</p>
                        </div>
                    </td>
                </tr>

                <!-- end three -->
                <tr>
                    <td style="padding:1.5%;border:1px solid #81C91B;">ORGANIZER</td>
                    <td colspan="3" style="padding:1.5%;border:1px solid #81C91B;">
                        <p>{{x.organized_by}}</p>
                    </td>
                </tr>
                
                <tr>
                    <td style="padding:1.5%;border:1px solid #81C91B;">EVENT DETAILS</td>
                    <td colspan="3" style="padding:1.5%;border:1px solid #81C91B;">
                        <!--<p>{{x.event_description}}</p>-->
                          <div ng-bind-html="content_test"></div>
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="text-align: center;border:1px solid #81C91B;">
                        <p>TERMS and CONDITIONS</p>
                        <p style="padding-left:">{{x.event_terms_conditions}}</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="text-align: center;border:1px solid #81C91B;">
                        <p>TICKETING PARTNER</p>
                        <p style="padding-left:">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                        <p><img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" style="max-height:100%;max-width:100%"></p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <!--        Ticket format 1 end-->


    <!--        Ticket format 2 start-->
    <div class="" style="padding-left:17px;padding-right:17px;padding-top:0px" ng-if="x.order_status == 'free'">

        <div>
            <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENU WILL NOT BE ALLOWED</h5>
        </div>


        <span ng-if="x.order_status == 'paid' || x.order_status == 'free'">  
                <h5 style="margin: 0 auto;">PLEASE PRINT AND BRING THIS TICKET WITH YOU AT THE EVENT</h5> 
                <a href="download-ticket.php?order_session=<?php echo $order_sessoin; ?>&oid=<?php echo $o_id; ?>" target="_new" class="btn btn-success" style="border-radius: 0px; margin-top:10px; margin-bottom: 10px;">Download E-ticket</a>
            </span>



        <table border="1" border-collapse: collapse cellspacing="0" width="100%" style="margin:0px auto; border:1px solid #81C91B;border-collapse: separate;empty-cells: hide;">
            <tbody>
                <tr>
                    <td colspan="2" rowspan="3" style="text-align: center;padding:1%;border:1px solid #81C91B;">
                        <img style="height:90px;max-width:100px" check-image ng-src="../upload/event_web_logo/{{x.event_web_logo}}" alt="Event Logo Not Found"/>
                    </td>

<!--                    <td colspan="2" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;border:1px solid #81C91B;">
                        <div style="text-align: center; margin:0 auto;" id="ticketBarcode<?php //echo base64_encode($order_number); ?>"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#ticketBarcode<?php// echo base64_encode($order_number); ?>").barcode(
                                    "<?php //echo base64_encode($order_number); ?>", // Value barcode (dependent on the type of barcode)
                                    "code93" // type (string)
                                );
                            });
                        </script>
                    </td>-->
                    
                    <td colspan="2" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;border:1px solid #81C91B;">
                        <h4 style="text-align:center; margin:5px">{{x.event_title}}</h4>
                    </td>

                </tr>
                <!-- one -->
                <tr>
                    <td colspan="2" style="border:1px solid #81C91B;">
                        <h4 style="text-align:center; margin:5px">{{x.userName}}</h4>
                    </td>
                </tr>
                <!-- two -->
                <tr>
                    <td style="border:1px solid #81C91B;">
                        <h4 style="text-align:center; margin:5px; font-size:20px">GATE - 14</h4>
                    </td>
                    <td style="border:1px solid #81C91B;">
                        <h4 style="text-align:center; margin:5px; font-size:20px">{{x.order_number}}</h4>
                    </td>
                </tr>
                <!-- three -->
                <tr>
                    <td style="border:1px solid #81C91B;">
                        <p style="margin:5px; font-size:16px; font-weight:normal">
                            {{x.start_date2}} - {{x.end_date2}}
                            <br/>Gates will open at {{x.start_time}}
                        </p>
                    </td>
                    <td style="border:1px solid #81C91B;">
                        <p style="text-align:center; margin:5px; font-size:16px; font-weight:normal">{{x.venue_title}}</p>
                    </td>
                    <td colspan="2" style="border:1px solid #81C91B;">
                        <h4 style="text-align:center; margin:5px; font-size:20px">FREE PASS</h4>
                    </td>

                </tr>
                <!-- four -->

                <tr>
                    <td colspan="4" style="border:1px solid #81C91B;">
                        <p style="text-align:center; margin:5px; font-size:16px; font-weight:normal">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                    </td>
                </tr>
                <!-- five -->

                <tr style="text-align:left;padding:8px;">
                    <td colspan="4" style="border:1px solid #81C91B;">
                        <h5 style="margin-top:15px; text-align:center">Schedule</h5>
                        <p style="margin-left:5px; fon-size:14px;">{{x.event_description}}</p>
                    </td>

                </tr>
                <!-- six -->

                <tr style="text-align:left;padding:8px;">
                    <td colspan="4" style="border:1px solid #81C91B;">
                        <h5 style="margin-top:15px; text-align:center">Terms and conditions</h5>
                        <p style="margin-left:5px;">{{x.event_terms_conditions}}</p>
                    </td>

                </tr>
                <!-- eight -->

<!--                <tr>
                    <td colspan="4" style="border:1px solid #81C91B;">
                        <img src="android.PNG" alt="sponsore images" width="120px" height="100px">
                        <img src="android.PNG" alt="sponsore images" width="120px" height="100px">
                        <img src="android.PNG" alt="sponsore images" width="120px" height="100px">
                        <img src="android.PNG" alt="sponsore images" width="120px" height="100px">
                    </td>

                </tr>-->
                <!-- nine -->
                
                <tr>
                    <td colspan="4" style="text-align: center;border:1px solid #81C91B;">
                        <p>TICKETING PARTNER</p>
                        <p style="padding-left:">Hot Line Number: +88 01971-Ticket (842538), +8801942 999666</p>
                        <p><img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo" style="max-height:100%;max-width:100%"></p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <!--        Ticket format 2 end-->

    <div class="clearfix" style="padding: 30px;"></div>

    </span>

    </div>
    <!--./ Wizard Ends Here -->