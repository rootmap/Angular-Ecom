<?php
//include  '../DBconnection/database_connections.php';

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

        <!--Ticket format 1-->
        <div ng-if="x.order_status == 'booking' || x.order_status == 'approved' || x.order_status == 'delivered' || x.order_status == 'paid' || x.order_status == 'free & paid' || x.order_status == 'pending' || x.order_status == 'cancel'" class="" style="padding-left:17px;padding-right:17px;padding-top:0px">
            <div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENUE WILL NOT BE ALLOWED</h5>
            </div>
<!--href=".././user_dashboard/download-ticket.php?oid=<?php echo $orderId; ?>"-->
            <span ng-if="x.order_status == 'paid' || x.order_status == 'free'">
                <a  href=".././user_dashboard/download-ticket.php?order_session=<?php echo $order_sessoin; ?>&oid=<?php echo $orderId; ?>" target="_new" class="btn btn-success" style="border-radius: 0px; margin-top:10px; margin-bottom: 10px;">Download E-ticket</a>
            </span>
            
            
            <!--[status change option starts]-->
                <span ng-if="x.order_status == 'booking' || x.order_status == 'approved' || x.order_status == 'delivered' || x.order_status == 'pending'  ">
                    <div class="form-group">
                         
                        <div class="col-xs-12 col-lg-8" style="padding-left:0px; padding-bottom:15px">
                            <style type="text/css">
                             select option:empty{display:none }
                          </style>
                            <label for="1"> Change order status</label>
                            <select ng-model="orderStatus.Status" name="orderStatus" ng-init="orderStatus.Status=1" class="form-control">
                                <option value="1" ng-selected="true">CHANGE ORDER STATUS</option>
                                <option value="booking">Booking</option>
                                <option value="approved">Approved</option>
                                <option value="delivered">Delivered</option>
                                <option value="paid">Paid</option>
                                <option value="free">Free</option>
                                <option value="free & paid">Free & Paid</option>
                                <option value="closed">Closed</option>
                                <option value="pending">Pending</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-lg-4" style="padding-left:0px;padding-right:0px;padding-top:5px;">
                            <label for="1"> </label>
                            <a type="submit"  value="save"  ng-click="DataSave(orderStatus,x.order_number);" class="btn btn-fill btn-info btn-block" href="#">Save Change</a>
                        </div>
                    </div>
                </span>
            <!--[status change option ends]-->
            
            
        <table border="1" border-collapse: collapse cellspacing="0" width="100%" style="margin:0px auto;border:1px solid #81C91B;">
            <tbody>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">EVENT TITLE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;">{{x.event_title}}</td>
                    <td rowspan="2" style="text-align: center;padding:1%;border:1px solid #81C91B;"><img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/{{x.event_web_logo}}"></td>
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
                    <td style="padding-left:1%;border:1px solid #81C91B;font-size:10px;">CATEGORY</td>
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
                                <p>{{x.order_total_item}}</p>
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
                        <p ta-bind="text" ng-model="x.event_description" ta-readonly='disabled'>{{x.event_description}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:1.5%;border:1px solid #81C91B;">Order Status</td>
                    <td colspan="3" style="padding:1.5%;border:1px solid #81C91B;">
                        <p ta-bind="text" ng-model="x.order_status" ta-readonly='disabled'>{{x.order_status}}</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;border:1px solid #81C91B;">

                        <div style="text-align: center; margin:0 auto;" id="ticketBarcode<?php echo base64_encode($order_number); ?>"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#ticketBarcode<?php echo base64_encode($order_number); ?>").barcode(
                                    "<?php echo base64_encode($order_number); ?>", // Value barcode (dependent on the type of barcode)
                                    "code93" // type (string)
                                );
                            });
                        </script>

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
    <!--Ticket format 1 end-->


    <!--Ticket format 2 start-->
    <div class="" style="padding-left:17px;padding-right:17px;padding-top:0px" ng-if="x.order_status == 'free'">

        <div>
            <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                    text-align: center;width: 92%;">WITHOUT A READABLE BARCODE, ENTRY INTO THE VENU WILL NOT BE ALLOWED</h5>
        </div>


        <span ng-if="x.order_status == 'paid' || x.order_status == 'free'">  
                <h5 style="margin: 0 auto;">PLEASE PRINT AND BRING THIS TICKET WITH YOU AT THE EVENT</h5> 
                <a href=".././user_dashboard/download-ticket.php?oid=<?php echo $orderId; ?>" target="_new" class="btn btn-success" style="border-radius: 0px; margin-top:10px; margin-bottom: 10px;">Download E-ticket</a>
            </span>



        <table border="1" border-collapse: collapse cellspacing="0" width="100%" style="margin:0px auto;border:1px solid #81C91B;">
            <tbody>
                <tr>
                    <td style="padding-left:1%;border:1px solid #81C91B;">EVENT TITLE</td>
                    <td colspan="2" style="padding-left:1%;border:1px solid #81C91B;">{{x.event_title}}</td>
                    <td rowspan="2" style="text-align: center;padding:1%;border:1px solid #81C91B;"><img style="max-height:80px;max-width:100px" src="../upload/event_web_logo/{{x.event_web_logo}}"></td>
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
                    <td style="padding-left:1%;border:1px solid #81C91B;font-size:10px;">CATEGORY</td>
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
                        <h5 style="text-align: center;">FREE PASS</h5>
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
                        <p ta-bind="text" ng-model="x.event_description" ta-readonly='disabled'>{{x.event_description}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:1.5%;border:1px solid #81C91B;">Order Status</td>
                    <td colspan="3" style="padding:1.5%;border:1px solid #81C91B;">
                        <p ta-bind="text" ng-model="x.order_status" ta-readonly='disabled'>{{x.order_status}}</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="text-align:center; padding: 1% 1% 1% 1%;max-width: 100%;border:1px solid #81C91B;">

                        <div style="text-align: center; margin:0 auto;" id="ticketBarcode<?php echo base64_encode($order_number); ?>"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#ticketBarcode<?php echo base64_encode($order_number); ?>").barcode(
                                    "<?php echo base64_encode($order_number); ?>", // Value barcode (dependent on the type of barcode)
                                    "code93" // type (string)
                                );
                            });
                        </script>

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
    <!--        Ticket format 2 end-->

    <div class="clearfix" style="padding: 30px;"></div>

    </span>

    </div>
    <!--./ Wizard Ends Here -->