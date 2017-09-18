<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i>  Change Event Status</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div> 
        <div class="content table-responsive table-full-width">
            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <div class="col-md-12">


                    <!-- BEGIN STEP CONTENT-->
                    <form class="tsf-step-content" <?php if (isset($_GET['eid'])) { ?> ng-init="LoadAutoEID('<?php echo $_GET['eid']; ?>')" <?php } ?>>
                        <div class="row">
                            <div class="col-md-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label for="1"> Select Event</label>
                                    <select  ng-model="eventStatus.event" name="event" class="form-control"  data-title="Single Select">
                                        <option value=""></option>
                                        <option ng-repeat="evt in eventStatusList" ng-selected="{{ evt.event_id}}=={{ eventStatuslist.event}}" value="{{ evt.event_id}}">{{ evt.event_title}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="1"> Select Event status</label>
                                    <select  ng-model="eventStatus.Status" name="eventStatus" class="form-control"  data-title="Single Select">
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
                                        <option value="upcoming">upcoming</option>
                                        <option value="archived">archived</option>
                                        <option value="request">request</option>
                                        <option value="info">info</option>
                                        <option value="delete">delete</option>
                                        <option value="pending">pending</option>
                                        <option value="upcoming">upcoming</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="row-fluid" style="margin-top: 20px;">
                            <div class="col-md-4 col-md-offset-4">

                                <a type="submit"  value="save"  ng-click="DataSave(eventStatus);" class="btn btn-fill btn-info btn-block" href="#">Save Change</a>
                                <!--                  
                                
                                                            </div>
                                                        </div>
                                
                                                    </form>
                                
                                <!-- END STEP CONTENT-->


                            </div>

                            <!-- END STEP CONTENT-->
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

