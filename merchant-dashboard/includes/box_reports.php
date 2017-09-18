<table class="table table-hover table table-responsive table-bordered">
    <thead >
        <tr class="bg-primary">
            <th  colspan="2" class="text-center">Event Name</th>
            <th class="text-center">Order</th>

        </tr>
    </thead>
    <tbody>
        <tr  ng-repeat="reportslist in reportslistData" >

            <td colspan="2" class="text-left">{{ reportslist.event_title}}</td>
            <td class="text-left" >{{ reportslist.ordersAmount}}</td>
        </tr>

    </tbody>
</table>

<div style="float: left; width: 400px"></div>


<!--!1st & 2nd PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well" style="height: 430px;">

    <div  id="piechart_3d" class="pull-left" style="height: 400px;"></div>

    <div  id="barchart_values" class="pull-right" style="height: 300px;"></div>

</div>
<div class="cleafix"></div>
<!--!1st & 2nd PART CHART END HERE-->




<!--!2nd PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well" style="height: 380px;">
    <div id="chart_div" style="height: 350px;"></div>  

</div>

<!--!2nd PART CHART END HERE-->


<!--!3rd PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well" style="height: 430px;">

    <div id="columnchart_values" class="pull-left" style="height: 400px;"></div>
    <div id="donutchart" class="pull-right" style="height: 400px;"></div>







</div>

<!--!3rd PART CHART END HERE-->





