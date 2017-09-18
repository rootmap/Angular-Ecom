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
<div class="col-lg-12 col-md-6 col-sm-3 well">

    <div id="container" class="pull-left" style=" width: 520px; height: 400px; margin: 0 auto">
        {{ salesReports}}
    </div>
    

 
      <div id="large" class="pull-right" style="width: 500px; height:400px;   margin: 0 auto"></div>



</div>
<div class="cleafix"></div>
<!--!1st & 2nd PART CHART END HERE-->










<!--!3rd & 6th DONUT PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well" style="height: 430px;">
<!-- <div  id="plain" class="pull-left" style="width: 410px; height: 400px;  margin: 0 auto"></div>-->
<div id="performance" class="pull-left" style="width: 550px; height: 400px; margin: 0 auto"></div>
   
 <div id="donutchart" class="pull-right" style="width: 470px; height:400px;  margin: 0 auto"></div>
</div>

<!--!3rd & 6th DONUT PART CHART END HERE-->




<!--!4th & 5th PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well" style="height: 350px;">
   


    <div id="samidonutChart" class="pull-right" style="width: 470px; height: 310px;  margin: 0 auto"></div>
    <div id="eventwise" class="pull-left" style="width: 550px; height: 310px;  margin: 0 auto"></div>

</div>

<!--!4th & 5th PART CHART END HERE-->




