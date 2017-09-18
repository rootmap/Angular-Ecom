<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow }}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i>  Venue Add</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div> 
        <div class="content table-responsive table-full-width">
            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <div class="col-md-12">


                    <!-- BEGIN STEP CONTENT-->
                    <form class="tsf-step-content">
                        <div class="row">
                            <div class="col-md-8 col-lg-offset-2">
                         
                                <div class="form-group">
                                    <label for="1"> Select Event</label>
                                    <select  ng-model="venueAllData.event" name="event" class="form-control" ng-init="venueAllData=''" data-title="Single Select">
                                        <option value="">Select Event</option>
                                        <option ng-repeat="venueMtd in VenueNewData" ng-selected="{{ venueMtd.event_id}}=={{ venueAllData.event}}" value="{{ venueMtd.event_id}}">{{ venueMtd.event_title }}</option>
                                    </select>
                                </div>
                                
                            <div class="row" id="venue-row">
                
                    <div class="col-md-11 col-xs-10">
                        <div class="form-group">
                            <label for="1">Name of Venue </label>
                            <input ng-model="venueAllData.ven_name" type="text"  class="form-control"  id="pac-input"  placeholder="Name of Venue" ng-required="true">
                        </div>
                    </div>
                    <div class="col-md-1 col-xs-2">
                        <div class="form-group">
                            <label for="1">&nbsp;</label>
                            <button id="vbtn" type="button" class="btn btn-icon btn-simple pull-right"><strong><span class="ti-arrow-circle-down text-inverse"></span></strong></button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <fieldset id="venue_detail">
                        <div class="col-md-5">
                           
                            <div class="form-group" ng-hide="true">
                                <label for="2">Address Line</label>
                                <input ng-model="venueAllData.ven_address" type="text" value="{{ venueAllData.ven_address}}" class="form-control" id="street_number" placeholder="Street Line 1">
                            </div>
                            <div class="form-group">
                                <label for="3">Address Line 2</label>
                                <input ng-model="venueAllData.ven_addresss" type="text" value="{{ venueAllData.ven_addresss}}"  class="form-control" id="route"  placeholder="Street Line 2">
                            </div>
                            <div class="form-group">
                                <label for="4">City</label>
                                <input ng-model="venueAllData.ven_city" type="text" value="{{ venueAllData.ven_city}}"  class="form-control" id="locality"   placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="5">Country</label>
                                <input ng-model="venueAllData.ven_country" type="text" value="{{ venueAllData.ven_country}}"  class="form-control" id="country"   placeholder="Country">
                            </div>
                            <div class="form-group"  ng-hide="true">
                                <label for="1">ZIP/Postal Code</label>
                                <input ng-model="venueAllData.ven_zip" type="text" value="{{ venueAllData.ven_zip}}"  class="form-control" id="postal_code"     placeholder="Name of Venue" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="1">Location Map</label>
                            </div>
                            <div id="map" style="height: 183px;"></div>
                        </div>
                    </fieldset>
                </div>
                        </div>

                        <div class="row-fluid" style="margin-top: 20px;">
                            <div class="col-md-4 col-md-offset-4">

                                <a type="submit"  value="save" ng-show="!update" ng-click="DataSave(venueAllData);" class="btn btn-fill btn-info btn-block" >SAVE</a>
                                <a type="submit" value="save" ng-show="update" ng-click="UpdateDataSave(venueAllData);" class="btn btn-fill btn-info btn-block">Update</a>

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

