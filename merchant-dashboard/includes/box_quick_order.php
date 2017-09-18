<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Quick Order Venue</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form action="" method="post" class="tsf-step-content" ng-model="quickOrderall">
                    <div class="row-fluid">
                        <div class="col-lg-12">
                            <div class="row-fluid">
                                <div class="col-md-3">
                                    <label>Events Title </label>
                                    <select  ng-model="quickOrderall.eventTitle" ng-change="loadQuickVenueList(quickOrderall.eventTitle)" class="form-control"  data-title="Single Select">
                                        <option value="">Please Select Event</option>
                                        <option ng-repeat="QuickOrder in EvntQkOrderData" ng-selected="{{ QuickOrder.event_id}}=={{ quickOrderall.eventTitle}}" value="{{ QuickOrder.event_id}}">{{ QuickOrder.event_title}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Venue Title </label>
                                    <select  ng-model="quickOrderall.vanueTitle"  ng-change="loadoofflineChkVTList(quickOrderall.eventTitle)"  class="form-control"  data-title="Single Select">
                                        <option value="">Please Select venue</option>
                                        <option ng-repeat="vanueQuickTitles in VenueQuickData" ng-selected="{{vanueQuickTitles.venue_id}}=={{quickOrderall.vanueTitle}}" value="{{ vanueQuickTitles.venue_id}}">{{ vanueQuickTitles.venue_title}}</option>
                                    </select>
                                
                                </div>
                                <div class="col-md-3">
                                    <label>Ticket Type </label>
                                    <select  ng-model="quickOrderall.TCT" class="form-control"  data-title="Single Select">
                                        <option value="">Please Select Ticket Type</option>
                                        <option ng-repeat="ticketstyleQuick in ticketQuickData" ng-selected="{{ ticketstyleQuick.TT_id}}=={{ quickOrderall.TCT}}" value="{{ ticketstyleQuick.TT_id}}">{{ ticketstyleQuick.TT_type_title}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Ticket Quantity </label>
                                    <div class="col-md-12">
                                        <input id="userPhone" class="form-control" value="" name="userPhone" type="text" ng-model="quickOrderall.ticketQuantity">
                                    </div>
                                </div>
                                <div class="clearfix"></div><br>




                                <div class="row">
                                    

                                    <br>


                                    <div class="col-md-6 text-right">

                                        <div class="clearfix"></div>
                                        <br>
                                        <hr>



                                        <div class="row-fluid" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <button type="button" ng-click="DatainsertQuick(quickOrderall)" name="dd" class="btn btn-fill btn-info btn-block">Generate</button>
                                            </div>
                                        </div>


                                    </div>    

                                </div>    

                                <!-- END STEP CONTENT-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

