<!-- Wizard Sarts Here -->
<div class="card padding_top15">

    <div class="header">
        <h4 class="title">
            <i class="fa fa-cart-plus">&nbsp;</i>{{test}}
            <hr/>
        </h4>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="border-collapse:collapse; ">
            
                <tr style="position:fix">
                    <th class="table_heading">
                        <p>{{tableH1}}</p>
                    </th>
                    <th class="table_heading">
                        <p>{{tableH2}}</p>
                    </th>
                    <th class="table_heading">
                        <p>{{tableH3}}</p>
                    </th>
                    <th class="table_heading">
                        <p>{{tableH4}}</p>
                    </th>
                    <th class="table_heading">
                        <p>{{tableH5}}</p>
                    </th>
                    <th class="table_heading">
                        <p>{{tableH6}}</p>
                    </th>
                </tr>
                
                <tr ng-repeat="x in orderData">
                    <td>{{x.onum}}</td>
                    <td>{{x.oiteam}}</td>
                    <td>{{x.total_price}}</td>
                    <td>{{x.payment_method}}</td>
<!--                    <td>{{x.defname}}</td>-->
                    <td>{{x.os}}</td>
                    <td>
                        <a href="./order_ticket.php?orderId= {{x.oid}}" class="btn btn-success btn-raised btn-round">
                            <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>VIEW DETAILS
                        </a>
                    </td>
                </tr>
                
                

<!--            <span ng-repeat="x in orderData">
                <tr data-toggle="collapse" data-target=".demo{{x.oid}}">
                    <td id="package1">
                         {{x.onum}}
                    </td>
                    <td>{{x.oiteam}}</td>
                    <td>{{x.defname}}</td>
                    <td>{{x.payment_method}}</td>
                    <td><span class="label label-success btn-xs">{{x.os}}</span></td>
                    <td>
                        <a href="" class="btn btn-success btn-raised btn-round">
                            <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>VIEW DETAILS </a>
                    </td>
                </tr>
                <tr style="background:#F7F7F7;">
                    <td class="hiddenRow" style="width:18%;background:white;">
                        <div class="">
                            <div class="footable-row-detail-row  col-sm-12 collapse demo{{x.oid}}">
                                <h5 class=" text-left">Billing Details</h5>
                                <p>Name: {{x.billingName}}</p>
                                <p>Address: {{x.oba}}</p>
                                <p>Phone: {{x.obp}}</p>
                            </div>

                        </div>
                    </td>
                    <td style="background:white;"></td>
                    <td class="hiddenRow" style="width:18%;background:white;">
                        <div class="">
                            <div class="footable-row-detail-inner">
                                <div class="footable-row-detail-row  col-sm-12 collapse demo{{x.oid}}">
                                    <h5 class=" text-left">Shipping Details</h5>
                                    <p>Name: {{x.shippingName}}</p>
                                    <p>Address: {{x.osa}}</p>
                                    <p>Phone: {{x.osp}}</p>
                                </div>
                            </div>

                        </div>
                    </td>
                    <td style="background:white;"></td>
                    <td class="hiddenRow" style="width:18%;background:white;">
                        <div class="">
                            <div class="footable-row-detail-inner">
                                <div class="footable-row-detail-row  col-sm-12 collapse demo{{x.oid}}">
                                    <h5 class=" text-left">Order details</h5>
                                    <p>Order Name: {{x.orderName}}</p>
                                    <p>Total price: {{x.total_price}}</p>
                                </div>
                            </div>

                        </div>
                    </td>
                    <td style="background:white;"></td>
                </tr>
            </span>-->
            
        </table>
    </div>

    <div class="clearfix" style="padding: 30px;"></div>
</div>
<!--./ Wizard Ends Here -->
