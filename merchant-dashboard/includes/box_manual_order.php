<div class="col-md-12">
    <div class="card">
        <div class="header">
                 
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i>Manual Order</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form action="" method="post" class="tsf-step-content" ng-model="offLineCheck">
                    <div class="row-fluid">
                        <div class="col-lg-12">
                            <div class="row-fluid">
                                <div class="col-md-3">
                                    <label>Select Events </label>
                                    <select  ng-model="offLineCheck.eventTitle" ng-change="loadoofflineChkVTList(offLineCheck.eventTitle)" class="form-control"  data-title="Single Select">
                                        <option value="">Please Select Event</option>
                                        <option ng-repeat="eventOffCk in EvntOffChk" ng-selected="{{ eventOffCk.event_id}}=={{ offLineCheck.eventTitle}}" value="{{ eventOffCk.event_id}}">{{ eventOffCk.event_title}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Select Venue</label>
                                    <select  ng-model="offLineCheck.vanueTitle"  ng-click="loadoofflineChkTCtypeList(offLineCheck.eventTitle)"  class="form-control"  data-title="Single Select">
                                        <option value="">Please Select venue</option>
                                        <option ng-repeat="vanueTitles in VenueData" ng-selected="{{ vanueTitles.venue_event_id}}=={{ offLineCheck.vanueTitle}}" value="{{vanueTitles.venue_id}}">{{ vanueTitles.venue_title}}</option>
                                    </select>
                                
                                </div>
                                <div class="col-md-3">
                                    <label>Select Ticket</label>
                                    <select  ng-model="offLineCheck.TCT" class="form-control"  data-title="Single Select">
                                        <option value="">Please Select Ticket Type</option>
                                        <option ng-repeat="ticketstyle in ticketData" ng-selected="{{ ticketstyle.TT_id}}=={{ offLineCheck.TCT}}" value="{{ ticketstyle.TT_price}}">{{ ticketstyle.TT_type_title}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Ticket Quantity </label>
                                    <div class="col-md-12">
                                        <input id="userPhone" class="form-control" value="" name="userPhone" type="text" ng-model="offLineCheck.ticketQuantity">
                                    </div>
                                </div>
                                <div class="clearfix"></div><br>




                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label class="col-md-12 control-label">Customer's First Name</label>
                                            <br>
                                            <div class="col-md-12">
                                                <input id="userFName" class="form-control" value="" name="userFName" type="text" ng-model="offLineCheck.customerFirstName">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12 control-label">Customer's Last Name</label>
                                            <br>
                                            <div class="col-md-12">
                                                <input id="userLName" class="form-control" value="" name="userLName" type="text" ng-model="offLineCheck.customerLastName">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12 control-label">Customer's Phone</label>
                                            <br>
                                            <div class="col-md-12">
                                                <input id="userPhone" class="form-control" value="" name="userPhone" type="text" ng-model="offLineCheck.customerPhone">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12 control-label">Customer's Email</label>
                                            <br>
                                            <div class="col-md-12">
                                                <input id="userEmail" class="form-control"  name="userEmail" type="email" ng-model="offLineCheck.customerEmail">
                                            </div>
                                        </div><br><br>
                                    </div> <br><br>
                                    <div class= "clearfix"></div>

<!--                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Is Home Delivery?</label>
                                        <br>
                                        <div class="col-md-12">
                                            <input id="userEmail" class="form-control" name="chkDelivery" id="chkDelivery" type="checkbox" ng-model="offLineCheck.hmDelivery">
                                        </div>
                                    </div>-->

                                    <div class="clearfix"></div>

                                    <br>


                                    <div class="col-md-6 text-right">

                                        <div class="clearfix"></div>
                                        <br>
                                        <hr>



                                        <div class="row-fluid" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <a type="button" ng-click="Datainsert(offLineCheck)" name="dd" class="btn btn-fill btn-info btn-block" >SAVE</a>
                                            </div>
                                        </div>


                                    </div>    

                                </div>    

                                <!-- END STEP CONTENT href="order_list.php"-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

