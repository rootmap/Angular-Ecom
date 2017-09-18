<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Event Button Set</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form class="tsf-step-content" ng-model="eventButton">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="row-fluid">
                                <label>Events </label>
                                <select  ng-model="eventButton.event_id" class="form-control"  data-title="Single Select">
                                    <option value="">Please Select Event</option>
                                    <option ng-repeat="eventMtd in Evntpaymtd" ng-selected="{{ eventMtd.event_id}}=={{ eventButton.event_id}}" value="{{ eventMtd.event_id}}">{{ eventMtd.event_title}}</option>
                                </select>
                            </div><br>

                            <div class="clearfix"></div>
                            

                             <div class="row-fluid">
                                <label>Button </label>
                                <select  ng-model="eventButton.evtBtn" class="form-control"  data-title="Single Select">
                                    <option value="">Please Select Button List</option>
                                    <option ng-repeat="btnMtd in Evntbtnmtd" ng-selected="{{ btnMtd.id}}=={{ eventButton.evtBtn}}" value="{{ btnMtd.id}}">{{ btnMtd.name}}</option>
                                </select>
                            </div>

                                <div class="row-fluid" style="margin-top: 20px;">
                                    <div class="col-md-4">
                                        <a type="submit" ng-click="eventbuttonListAll(eventButton)"  class="btn btn-fill btn-info btn-block" href="eventButtonList.php">SAVE</a>
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

