<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Manual New Pickup point</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->
                <!--manual new  pick point start here-->
                <form class="tsf-step-content" ng-model="pickpoint" ng-submit="AddPaymentMethod(pickpoint)">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="row-fluid">
                                <label>Events </label>
                                <select  ng-model="pickpoint.eventValue" class="form-control"  data-title="Single Select">
                                    <option value="">Please Select Event</option>
                                    <option ng-repeat="eventMtd in Evntpaymtd" ng-selected="{{ eventMtd.event_id}}=={{ pickpoint.eventValue}}" value="{{ eventMtd.event_id}}">{{ eventMtd.event_title}}</option>
                                </select>
                            </div>


                            <hr>
                            <div class="form-group">
                                <label for="1">Pick Point Name </label>
                                <input type="text" class="form-control" id="1" name="PickPointName" value="PickPointName" required  ng-model="pickpoint.PickPointName">
                            </div>

                            <div class="form-group">
                                <label for="1">Point Address</label>
                                <input type="text" class="form-control" id="1" name="PointAddress" value="PointAddress" required  ng-model="pickpoint.pointAddress">
                            </div>
                            <div class="form-group">
                                <label for="1">point Contact details Address</label>
                                <input type="text" class="form-control" id="1" name="pointContactdetailsAddress" value="pointContactdetailsAddress" required  ng-model="pickpoint.pointContactdetailsAddress">
                            </div>
                           

                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-fill btn-info btn-block">SAVE</button>
                                </div>
                            </div>


                        </div>    

                    </div>    
                </form>
                <!--manual new  pick point end here-->      
                <!-- END STEP CONTENT-->
            </div>
        </div>
    </div>
</div>

