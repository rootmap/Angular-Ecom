<div class="col-md-12">
    <div class="card">
        <div class="header">
           
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Payment Method Offline</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                
                <!-- BEGIN STEP CONTENT-->
                <!--<form class="tsf-step-content" ng-model="payMethod" ng-submit="AddPaymentMethod()">-->
                <form class="tsf-step-content">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <!--[Events field start]-->
                                <div class="row-fluid">
                                    <label>Events </label>
                                    <select  ng-model="event_id" class="form-control"  data-title="Single Select">
                                        <option value="">Please Select Event</option>
                                        <option ng-repeat="eventMtd in Evntpaymtd" ng-selected="{{ eventMtd.event_id }}=={{ event_id }}" value="{{ eventMtd.event_id }}">{{ eventMtd.event_title}}</option>
                                    </select>
                                </div>
                            <!--[Events field start]-->
                            <hr>
                            
                            <!--[Option part start]-->
                            <label class="row-fluid">Please Select Your Payment Methods Offline</label>
                            <div class="col-md-12 h"  ng-repeat="pm in off_pmrows">
                                <div class="form-group">
                                    <div class="checkboxall">
                                        <label>
                                            <input  id="offlinePayment{{$index}}" ng-click="pickuppoint(pm.off_check_name)" 
                                                    type="checkbox" ng-true-value="'1'" ng-false-value="'0'" 
                                                    ng-model="pm.off_check_namest" > {{ pm.off_check_name}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--[option part end]-->
                            
                            <!--[hidden part for pickup point start]-->
                                <div class="col-md-12" id="pickupPoint" style="display: none;"> 
                                    <div class="col-md-11" ng-repeat="pp in ppl">

                                          <div class="col-md-6">
                                              <label for="3">Pick PointName</label>
                                              <input ng-model="pp.point_name" type="text" class="form-control" id="3" placeholder="Point Name">
                                          </div>

                                          <div class="col-md-6">
                                              <label for="3">Point Address</label>
                                              <input ng-model="pp.point_address" type="text" class="form-control" id="3" placeholder="Point Address">
                                          </div>

                                          <div class="col-md-12" style="margin-top:15px;">
                                              <label for="3">point Contact Detail</label>
                                              <input ng-model="pp.point_contact_detail" type="text" class="form-control  input-lg" id="3" placeholder="point Contact Detail" ><br>
                                          </div>   
                                    </div>

                                    <div class="col-md-1">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button  type="button" class="btn btn-icon btn-simple" ng-click="removepickPoint(index)"><strong><span class="ti-close text-inverse"></span></strong></button>
                                            </div>
                                    </div> 

                                    <div class="clearfix"></div>
                                    <div class="col-md-11" style="margin-top: 20px;">
                                        <button type="button"  ng-init="pplloop()" ng-click="pplloop()" class="btn btn-success btn-fill pull-right"><span class="ti-plus"></span> Add More Pick Point </button>
                                    </div>

                                </div>
                            <!--[hidden part for pickup point end]-->
                            
                            <!--[save button]-->
                                <div class="row-fluid" style="margin-top: 20px;">
                                        <div class="col-md-4">
                                            <a ng-click="submitData(event_id)" type="submit" class="btn btn-fill btn-info btn-block" >SAVE</a>
                                        </div>
                                </div>
                            <!--[save button]-->


                        </div>    

                    </div>    
                </form>
                <!-- END STEP CONTENT-->
            </div>
        </div>
    </div>
</div>

 