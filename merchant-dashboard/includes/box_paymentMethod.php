<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Payment Method</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form class="tsf-step-content" ng-model="payMethod">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="row-fluid">
                                <label>Events </label>
                                <select  ng-model="event_id" class="form-control"  data-title="Single Select">
                                    <option ng-selected="{{ event_id }}" value="">Please Select Event</option>
                                    <option ng-repeat="eventMtd in Evntpaymtd" ng-selected="{{ eventMtd.event_id }}=={{ event_id }}" value="{{ eventMtd.event_id }}">{{ eventMtd.event_title}}</option>
                                </select>
                            </div>


                            <hr>

                            <label class="row-fluid">Please Select Your Payment Methods</label>
                            <div class="row-fluid"  ng-repeat="paymentStyle in rows">

                                <div class="checkboxall">
                                    <label><input type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="paymentStyle.check_namest"> {{ paymentStyle.check_name}}
                                    </label>
                                </div>
                            </div>

                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">
<!--                                     href="paymentMethodList.php"-->
                                    <button type="submit" class="btn btn-fill btn-info btn-block"  ng-click="AddPaymentMethod()">SAVE</button>
                                </div>
                            </div>


                        </div>    

                    </div>    
                </form>
                <!-- END STEP CONTENT-->
            </div>
        </div>
    </div>
</div>

 