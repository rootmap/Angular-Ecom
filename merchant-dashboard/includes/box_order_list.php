<div class="col-md-12">
    <div class="card">
        <div class="header">
                        <!--<h2>{{ flyshow}}</h2>-->
            
            <h4 class="title">Order List</h4>
<!--            <p class="category">All Order Data</p>-->

        </div>

        <div class="content table-responsive table-full-width" id="orders">
            <form class="navbar-form navbar-left navbar-search-form" role="search">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input value="" name="valu_sar" class="form-control"  ng-model="search" placeholder="Search..." type="text">
                </div>

            </form>
        </div>

        <div class="cleafix"></div>

        <!--Button Start Here-->
        <!--        <div class="col-md-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Today Report</button>
        
                </div>-->

        <div class="col-md-2">

            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Date Wise Order Report</button>
        </div>
        <div class="cleafix"></div>
        <div class="col-md-4 pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendAttendeesModal" data-whatever="@email">Send Message To All Attendees</button>
        </div>
        <!--Button End Here-->









        <div ng-init="orderlist[]">

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Number</th>
                        <th class="text-center">customer Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Order Amount</th>
<!--                        <th class="text-center">Total Item</th>-->
                        <th class="text-center">Read</th>
                        <!--<th class="text-center">Payment Type</th>-->
                        <th class="text-center">Date</th>
                        <th class="text-center"></th>
<!--                        <th class="text-center">Actions</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="orderlist in orderlistdata| filter:search">

                        <td class="text-center">{{ orderlist.order_id}}</td>
                        <td class="text-center">{{ orderlist.order_number}}</td>
                        <td class="text-center">{{ orderlist.fullname}}</td>
                        <td class="text-center">{{ orderlist.order_status}}</td>
                        <td class="text-center">{{ orderlist.order_total_amount}}</td>
<!--                        <td class="text-center">{{ orderlist.order_total_item}}</td>-->
                        <td class="text-center">{{ orderlist.order_read}}</td>
<!--                        <td class="text-center">{{ orderlist.order_payment_type}}</td>-->
                        <td class="text-center">{{ orderlist.order_date}}</td>

                        <td  class="text-center ">
                            <div ng-if="eventlist.event_status != 'delete'" class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage <span class="fa fa-cogs"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="./view_order.php?oid={{orderlist.order_id}}&order_session={{orderlist.order_session_id}}"><i class="fa fa-tag" aria-hidden="true"></i>  View Order</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="#" data-toggle="modal" ng-click="BindOIDcEm(orderlist.order_id)" data-target="#exampleModal" data-whatever="@email"><i class="fa fa-tag" aria-hidden="true"></i>  Send E-Ticket</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a ng-if="orderlist.order_status != 'cancel'" href=".././user_dashboard/download-ticket.php?oid={{orderlist.order_id}}">
                                            <i class="fa fa-download" aria-hidden="true"></i>  Download
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!--                             <a ng-if="orderlist.order_status != 'cancel'" href="../user_dashboard/download-ticket.php?oid={{orderlist.order_id}}">-->

<!--                                 <button type="button" class=" btn btn-success btn-sm" id="processingModal"><i class="fa fa-tag" aria-hidden="true"></i>  Process</button>-->

                            <!--                            </a>-->
                        </td>

                    </tr>



                </tbody>
            </table>
            <div>{{orderlist| json}}</div>
        </div><!--ng-init end here-->
    </div>
</div>
</div>
<!--<script>
            $('#myModal').modal('toggle'){
    $('#inputModal').modal('show');
            $('#myModal').modal('hide');
    }
//$('#myModal').on('show')', function () {
//  $('#inputModal').focus()
//})
</script>-->