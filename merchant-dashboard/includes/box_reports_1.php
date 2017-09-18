<style type="text/css">
    /*** Table Styles **/
    .table-fill {
        background: white;
        border-radius:3px;
        border-collapse: collapse;
        margin: auto;
        max-width: 90%;
        padding:5px;
        width: 100%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        animation: float 5s infinite;
    }

    th {
        color:#fff;
        background: #87CB16 !important; /* Old browsers */
        background: -moz-linear-gradient(top,  #87CB16 0%, #87CB16 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #87CB16 0%,#87CB16 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #87CB16 0%,#87CB16 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87CB16', endColorstr='#87CB16',GradientType=0 ); /* IE6-9 */

        border-bottom:4px solid #9ea7af;
        border-right: 1px solid #ffffff;
        font-size:23px;
        font-weight: 100;
        padding:8px;
        text-align:left;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        vertical-align:middle;
    }

    th:first-child {
        border-top-left-radius:3px;
    }

    th:last-child {
        border-top-right-radius:3px;
        border-right:none;
    }

    tr {
        border-top: 1px solid #C1C3D1;
        border-bottom-: 1px solid #C1C3D1;
        color:#666B85;
        font-size:16px;
        font-weight:normal;
        text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
    }

    tr:hover td {
        background:#4E5066;
        color:#FFFFFF;
        border-top: 1px solid #22262e;
        border-bottom: 1px solid #22262e;
    }

    tr:first-child {
        border-top:none;
    }

    tr:last-child {
        border-bottom:none;
    }

    tr:nth-child(odd) td {
        background:#EBEBEB;
    }

    tr:nth-child(odd):hover td {
        background:#4E5066;
    }

    tr:last-child td:first-child {
        border-bottom-left-radius:3px;
    }

    tr:last-child td:last-child {
        border-bottom-right-radius:3px;
    }

    td {
        background:#FFFFFF;
        padding:5px;
        text-align:left;
        vertical-align:middle;
        font-weight:300;
        font-size:18px;
        text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #C1C3D1;
    }

    td:last-child {
        border-right: 0px;
    }

    th.text-left {
        text-align: left;
    }

    th.text-center {
        text-align: center;
    }

    th.text-right {
        text-align: right;
    }

    td.text-left {
        text-align: left;
    }

    td.text-center {
        text-align: center;
    }

    td.text-right {
        text-align: right;
    }

</style>    

<div class="clearfix"></div>

<table class="table-fill">
    <thead>
        <tr>
            <th style="text-align: left !important;">SL</th>
            <th class="text-left">Event Name</th>
            <th class="text-left">Quantity</th>

        </tr>
    </thead>
    <tbody ng-repeat="reportslist in alleventdata">

        <tr ng-init="strtable = false" ng-click="strtable = strtable ? false : true" style="border-bottom: 1px #000 solid; cursor: pointer;">
            <td  class="text-left">{{ $index + 1}}  <i ng-show="strtable == false" class="fa fa-plus"></i>
                <i ng-show="strtable == true" class="fa fa-minus"></i></td>
            <td ng-show="strtable == false" class="text-left">{{ reportslist.event_title}}</td>
            <td ng-show="strtable == true" class="text-left" colspan="2">{{ reportslist.event_title}}</td>
            <td ng-show="strtable == false">Sold Quantity = {{ reportslist.ticket_sold }}</td>
        </tr>
        <tr ng-show="strtable == true" style="border-bottom: 1px #000 solid; ">
            <td class="text-right" colspan="2">Ticket Quantity</td>
            <td class="text-left">{{ reportslist.ticket_quantity }}</td>
        </tr>
        <tr ng-show="strtable == true" style="border-bottom: 1px #000 solid; ">
            <td class="text-right" colspan="2">Ticket Sold</td>
            <td class="text-left">{{ reportslist.ticket_sold }}</td>
        </tr>
        <tr ng-show="strtable == true" style="border-bottom: 1px #000 solid; ">
            <td class="text-right" colspan="2">Ticket Left</td>
            <td class="text-left">{{ reportslist.ticket_left }}</td>
        </tr>
    </tbody>
</table>
<div class="clearfix" style="margin-bottom: 20px;"></div>
<div style="float: left; width: 400px"></div>


<!--!1st & 2nd PART CHART START HERE-->
<div class="col-lg-12 col-md-6 col-sm-3 well">

    <div id="container" class="pull-left" style=" width: 520px; height: 400px; margin: 0 auto" ng-data=" {{ salesReports}}">
        
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




