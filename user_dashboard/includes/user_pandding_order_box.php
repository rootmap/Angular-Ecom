<!-- Wizard Sarts Here -->
<div class="card padding_top15">

    <div class="header">
        <h4 class="title">
            <!--<i class="fa fa-server"></i>{{test}}-->
            <i class="fa fa-server"></i> Pending order list
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
         

          
                <tr ng-repeat="x in panddingOrderData">
                    <td id="package1">
                        {{x.onum}}
                    </td>
                    <td>{{x.oiteam}}</td>
                    <td>{{x.total_price}}</td>
                    <td>{{x.payment_method}}</td>
                    <td><span class="label label-success btn-xs">{{x.os}}</span></td>
                    <td>
                        <a href="./order_ticket.php?orderId= {{x.oid}}" class="btn btn-success btn-raised btn-round">
                            <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i>VIEW DETAILS </a>
                    </td>
                </tr>
           
            
        </table>
    </div>

    <div class="clearfix" style="padding: 30px;"></div>
</div>
<!--./ Wizard Ends Here -->


