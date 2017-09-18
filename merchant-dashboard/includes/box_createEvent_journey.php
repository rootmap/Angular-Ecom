<!-- Start Create Event Journey Here -->

<div class="card padding_top15">

    <div class="header">
        <h4 class="title"><span class="ti-pencil-alt"></span> Add Event Details</h4>
        <hr>
    </div>
    <div class="content"> 
        <div class="row">
            <!-- Left Part Starts Here -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- Step 1 -->
                <div class="row">
                    <div class="col-lg-12" >
                        <legend><span class="ti-menu-alt"></span> Basic Event Details</legend>
                        <br>
                        <div class="form-group col-md-12">
                            <label for="event-name">Event Name</label>
                            <input type="text" ng-keyup="createNewEvtLink(evt)" class="form-control" id="eventNameEdit" placeholder="eg: Ticketchai Hackathon 2016" required ng-model="evt.EventName">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="basic-url">Event URL</label>
                            <div class="input-group">
                                <style type="text/css">
                                    #basic-addon3{ padding-right: 0px; border-right: 0px; } 
                                </style>    
                                <span class="input-group-addon" id="basic-addon3">ticketchai.com/event/</span>
                                <input type="text" ng-keyup="createNewEvtLinkCus(evt)" class="form-control"  id="basic-url" aria-describedby="basic-addon3" ng-model="evt.EventURL">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="basic-url">&nbsp;</label>
                            <div class="input-group">
                                <button ngshow="EventURLStatus_success==true" type="button" class="btn btn-success btn-fill pull-right"><span class="ti-check-box" style="color:{{EventURLStatusColor}}"> {{EventURLStatus2}} </span> </button>
                                <!--<button ng-show="EventURLStatus_processing == true" type="button" class="btn btn-info btn-fill pull-right"><span class="ti-plug"> Processing... </span> </button>-->

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="event-name">Event Category</label>
                            <select class="form-control" data-title="Select Category" id="EventCategoryEdit" ng-model="evt.EventCategory">
                                <option ng-selected="{{evt.EventCategory}}==" value="">Select Category</option>
                                <option ng-repeat="cat in eventcategorydata" ng-selected="{{cat.id}}=={{evt.EventCategory}}" value="{{cat.id}}">{{cat.name}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="event-name">Event Sub-Category</label>
                            <!--<input ng-show="newsubcat" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Enter New Sub-Category Name" ng-model="evt.newsubcat">-->
                            <select ng-hide="newsubcat" class="form-control" ng-change="checkNewSub(evt.EventSubCategory)" data-title="Select Sub Category" id="sub-cat" ng-model="evt.EventSubCategory">
                                <option ng-selected="{{evt.EventSubCategory}}==" value="">Select Sub Category</option>
                                <!--<option ng-selected="{{evt.EventSubCategory}}== 0" value="0">Create New Sub Category</option>-->
                                <option ng-repeat="scat in eventsubcategorydata" ng-selected="{{scat.id}}=={{evt.EventSubCategory}}" value="{{scat.id}}">{{scat.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="exampleInputPassword1">Event Type</label>
                                <select class="form-control" ng-change="EventTypeAllocate(evt)" data-title="Select Sub Category" id="sub-cat"  ng-model="evt.EventType">
                                    <option ng-selected="{{evt.EventType}}==" value="">Select Event Type</option>
                                    <option ng-repeat="etd in eventtypedata" ng-selected="{{etd.id}}=={{evt.EventType}}" value="{{etd.id}}">{{etd.name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-name">Organized By</label>
                                <input ng-model="evt.OrganizedBy"  type="text" class="form-control" placeholder="Please Type Organizer Name"/>
                                <br>
                                <label for="event-name">Organizer Details</label><span>&emsp;<input type="checkbox" name="checkfield" id="g" onclick="showHideDiv(this)"/></span>
                                <textarea style="display:none;" ng-model="evt.org_details" id="org_details" placeholder="Type Organizer Details Here" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Step 1 -->
                <div class="clearfix"></div>
                <!-- Step 2 -->
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <legend><span class="ti-timer"></span> Event Date And Time</legend>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <div class="clearfix"></div>
                                <input ng-model="evt.evt_start_date"  id="evt_start_date" ng-init="InitDate('evt_start_date')" type="text" class="form-control datepicker1"  datepicker-options="options" placeholder="Date Picker Here"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Start Time</label>
                                <input name="evt_start_time"  ng-init="InitTime()" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input ng-model="evt.evt_end_date"  id="evt_end_date" ng-init="InitDate('evt_end_date')" type="text" class="form-control datepicker1" placeholder="Date Picker Here"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">End Time</label>
                                <input name="evt_end_time"  ng-init="InitTime()" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Step 2 -->
                <div class="clearfix"></div>
                <!-- Step 3 -->
                <div class="row" id="venue-row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <legend><span class="ti-location-pin"></span> Event Location / Venue</legend>
                    </div>
                    <div class="col-md-11 col-xs-10">
                        <div class="form-group">
                            <label for="1">Name of Venue </label>
                            <input ng-model="evt.ven_name" type="text"  class="form-control"  id="pac-input"  placeholder="Name of Venue"  ng-required="true">
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
                            <div class="form-group">
                                <label for="1">Event Venue</label>
                            </div>
                            <div class="form-group">
                                <label for="2">Address Line</label>
                                <input ng-model="evt.ven_address" type="text" value="{{ evt.ven_address}}" class="form-control" id="street_number" placeholder="Street Line 1">
                            </div>
                            <div class="form-group">
                                <label for="3">Address Line 2</label>
                                <input ng-model="evt.ven_addresss" type="text" value="{{ evt.ven_addresss}}"  class="form-control" id="route"  placeholder="Street Line 2">
                            </div>
                            <div class="form-group">
                                <label for="4">City</label>
                                <input ng-model="evt.ven_city" type="text" value="{{ evt.ven_city}}"  class="form-control" id="locality"   placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="5">Country</label>
                                <input ng-model="evt.ven_country" type="text" value="{{ evt.ven_country}}"  class="form-control" id="country"   placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="1">ZIP/Postal Code</label>
                                <input ng-model="evt.ven_zip" type="text" value="{{ evt.ven_zip}}"  class="form-control" id="postal_code"     placeholder="Name of Venue" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="1">Location Map</label>
                            </div>
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </fieldset>
                </div>
                <!-- ./Step 3 -->
                <div class="clearfix"></div>
                <!-- Step 4 -->
                <div class="row"  id="ticket-row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <legend><span class="ti-ticket"></span> Event Ticket</legend>
                    </div>
                    <div  class="row" ng-repeat="ckt in tck">
                        <div class="col-md-12">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Ticket Name</label>
                                    <input ng-model="ckt.tick_name" value="{{ ckt.id}}" type="text" placeholder="Ticket Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select ng-model="ckt.tick_type" class="form-control">
                                        <option  ng-repeat="mtb in mtt" value="{{ mtb.id}}">{{ mtb.name}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input ng-model="ckt.tick_quantity" type="text" placeholder="ex:1" class="form-control" id="tck">
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <label for="ticketPrice" class="control-label">Price</label>
                                    <input ng-model="ckt.tick_price"   type="text" ng-readonly="ckt.tick_type == 2"  placeholder="Ex: 1000" class="form-control" name="ticketPrice" id="ticketPrice{{$index}}" required="required">
                                </div>
                            </div>
                            <div class="col-sm-1 col-xs-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <label style="margin-top: 10px;"><strong><span  class="ti-settings text-inverse"></span></strong> <input style="opacity:0;" type="checkbox" value="1" ng-model="ckt.rein" /></label>
                                </div>
                            </div>
                            <div class="col-sm-1 col-xs-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button  type="button" class="btn btn-icon btn-simple" ng-click="removeTicket(index)"><strong><span class="ti-close text-inverse"></span></strong></button>
                                </div>
                            </div>
                        </div>
                        <fieldset ng-show="ckt.rein == 1" style="z-index: 1;min-width:50%" class="ng-hide" id="expand">
                            <div class="col-md-12">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ticketPrice" class="control-label">Currency</label>
                                        <select ng-readonly="ckt.tick_type == 2"  ng-model="ckt.tick_currency" class="form-control">
                                            <option value="" ng-selected="{{ckt.tick_currency}}==">Select Currency Type</option>
                                            <option ng-repeat="ect in LoadCurrency"  value="{{ect.id}}">{{ect.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-6">
                                    <div class="form-group">
                                        <label>Min Qty.</label>
                                        <input ng-model="ckt.tick_min_quan" type="text" placeholder="Min Qty." class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <div class="form-group">
                                        <label>Max Qty.</label>
                                        <input ng-model="ckt.tick_max_quan" type="text" placeholder="Max Qty." class="form-control">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <!--                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Availability</label><br/>
                                                                    <div ng-model="evt.tick_availability" class="btn-group" role="group" aria-label="...">
                                                                        <button type="button" class="btn btn-success">Available</button>
                                                                        <button type="button" class="btn btn-success">Halt</button>
                                                                        <button type="button" class="btn btn-success">Hidden</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Who will pay Ticketchai fee</label><br/>
                                                                    <div ng-model="evt.tick_fee_from" class="btn-group" role="group" aria-label="...">
                                                                        <button type="button" class="btn btn-success">Me</button>
                                                                        <button type="button" class="btn btn-success">Customer</button>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Availability</label><br/>
                                        <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
                                            <label class="btn btn-success" ng-click="ckt.tick_availability = 1">
                                                <input type="radio" name="options" id="option1" value="available" checked="checked"/>
                                                Available<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success" ng-click="ckt.tick_availability = 2">
                                                <input type="radio" name="options" id="option2" value="halt">
                                                Halt<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success" ng-click="ckt.tick_availability = 3">
                                                <input type="radio" name="options" id="option3" value="hidden">
                                                Hidden<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" ng-hide="ckt.tick_type == 2">
                                    <div class="form-group">
                                        <label>Who will pay Ticketchai fee</label><br/>
                                        <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
                                            <label class="btn btn-success" ng-click="ckt.tick_fee_from = 1">
                                                <input type="radio" name="options2" id="options1" value="me" checked="checked"/>
                                                Me<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success" ng-click="ckt.tick_fee_from = 2">
                                                <input type="radio" name="options2" id="options2" value="customer">
                                                Customer<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sales start date</label>
                                        <input  name="tick_start_date"  id="{{$index}}" ng-init="InitDateTicket()"  type="text" class="form-control datepickerT"  placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sales start Time</label>
                                        <input   name="tick_start_time"  id="{{$index}}" ng-init="InitTimeTicket()"  type="text" class="form-control timepickerT"  placeholder="Time Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sales end Date</label>
                                        <input  name="tick_end_date"  id="{{$index}}" ng-init="InitDateTicket()" type="text" class="form-control datepickerT"  placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sales end Time</label>
                                        <input  name="tick_end_time"  id="{{$index}}" ng-init="InitTimeTicket()" type="text" class="form-control timepickerT" ng-model="evt.start_time"  placeholder="Time Picker Here"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="1">Ticket Description</label>
                                        <textarea  rows="3" id="tick_desc" placeholder="ex:This Ticket Includes Lunnch" class="form-control"></textarea>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="1">Message To Attendee</label>
                                        <textarea  id="tick_mess_atten" rows="3" placeholder="ex:Please Reach The Venue 15 Minutes Before The Show Start Time" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </fieldset>
                    </div>
                    <div class="clearfix" style="height: 30px;"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" ng-click="tckaddRow()" class="btn btn-success btn-fill pull-right"><span class="ti-plus"></span> Add More Ticket </button>
                        </div>
                    </div>
                </div>
                <!-- ./Step 4 -->
                <div class="clearfix"></div>
                <!-- Step 5 -->
                <div class="row">


                    <div class="col-md-12" style="margin-top: 30px;">
                        <legend><span class="ti-receipt"></span> Event Description</legend>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="1">Event Description</label>
                            <textarea ng-model="evt.evt_desc" id="evt_desc" placeholder="Type Your Event Description Here" class="form-control"></textarea>
<!--<textarea ng-model="evt.evt_desc" rows="3" placeholder="Type Your Event Description Here" class="form-control"></textarea>-->
                        </div>
                    </div>

                    <!--Terms and Conditions [starts]-->


                    <div class="col-md-12" style="margin-top: 30px;">

                        <legend>
                            <span class="ti-receipt"></span>
                            <label for="event-name">Event Terms and Conditions</label>
                            <span>&emsp;<input type="checkbox" name="checkfield" id="terms" onclick="ShowHideDiv(this)" /></span>
                        </legend>
                    </div>
                    
                    <div class="col-lg-12" id="e_terms" style="display:none;">
                        <div class="form-group" >
                            <!--<textarea  ng-model="evt.evt_terms" id="evt_terms" placeholder="Type Your Event Terms and Conditions Here" class="form-control"></textarea>-->
                            <!--<textarea ng-model="evt.evt_terms" id="terms" class="form-control"></textarea>-->
                            <textarea ng-model="evt.evt_terms" id="evt_terms" placeholder="Type Your Event Description Here" class="form-control"></textarea>

                        </div>
                    </div>
                    <!--Terms and Conditions [ends]-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="1">Event Tags</label>
                        <!--                        <div class="form-group">
                                                    
                                                    <div class="tagsinput  tag-success" ng-model="tag" ng-keypress="($event.which === 13) ? eventtag(tag) : 0" id="tags1470823879022_tagsinput" style="height: 100%;">
                                                        <div id="tags1470823879022_addTag" class="tagsinput-add-container">
                                                            <div class="tagsinput-add"></div>
                                                            <input data-default="" value="" id="tags1470823879022_tag" style="color: rgb(102, 102, 102); width: 50%;">
                                                        </div>
                                                    </div>
                                                </div>-->
                        <div style=" background-color: #f1f8e9;border: 1px solid #82bd55;  border-radius: 4px;padding: 5px 5px">
                            <p class="label label-success " style="margin:5px 5px;border-radius: 4px;padding: 5px;" ng-repeat="(key, value) in list">&nbsp;
                                <span ng-click="remove($index)">&nbsp;{{value}}<a href="javascript:void(0)" class="ti-close" style="color:#fff;"></a></span>
                            </p>
                            <a href="javascript:void(0)"  ng-click="addToList(todo)" class="ti-plus" ></a> <input type="text" id="todo" ng-model="todo" ng-keyup="$event.which === 13 || $event.keyCode == 32 ? addToList(todo) : null" style=" background-color: #f1f8e9;border: 1px solid #82bd55;  width:20%;padding: 5px 5px"> 
                        </div>
                    </div>

                    <div class="col-md-12 h" style="margin-top: 30px;">
                        <legend><span class="ti-receipt"></span> Payment Setting </legend>
                    </div>

                    <div class="col-md-6 h"  ng-repeat="pm in pmrows| limitTo:2">
                        <div class="form-group">
                            <div class="checkboxall">
                                <label><input type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="pm.check_namest" id="cod{{$index}}"> {{ pm.check_name}} 
                                    <!--<span ng-hide="{{pm.check_t_c.length}}==''">({{pm.check_t_c}})</span>-->
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group h">
                            <div class="checkboxall">
                                <label><input type="checkbox" id="cash">
                                    Cash On Delivery 
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <div class="col-md-12"  style="margin-top: 10px;">
                        <legend>&nbsp;</legend>
                    </div>

                    <div id="offline" style="display:none;">
                        <div class="col-md-12 h" style="">
                            <legend>
                                <span class="ti-receipt"></span>Offline Payment Setting <br>
                                <code>Offline Payment Method will after You Pay it's Charge : 500 Taka, Please Pay After Creating this event.</code>    
                            </legend>
                        </div>
                        <div class="col-md-6 h"  ng-repeat="pm in off_pmrows">
                            <div class="form-group">
                                <div class="checkboxall">
                                    <label>
                                        <input  id="offlinePayment{{$index}}" ng-click="pickuppoint(pm.off_check_name)" type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="pm.off_check_namest" > {{ pm.off_check_name}}
                                        <!--<span ng-hide="{{pm.check_t_c.length}}==''">({{pm.check_t_c}})</span>-->
                                        <!--ng-true-value="'1'" ng-false-value="'0'" -->
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 pickupPoint" style="display: none;">

                        <div class="col-md-12 block" ng-repeat="pplr in ppl">

                            <div class="col-md-5">
                                <label for="3">Pick PointName</label>
                                <input ng-model="pplr.point_name" type="text" class="form-control" id="3" placeholder="Point Name">
                            </div>
                            <div class="col-md-6">
                                <label for="3">Point Address</label>
                                <input ng-model="pplr.point_address" type="text" class="form-control" id="3" placeholder="Point Address">
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button  type="button" class="btn btn-icon btn-simple" ng-click="removepickPoint(index)"><strong><span class="ti-close text-inverse"></span></strong></button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="3">point Contact Detail</label>
                                <input ng-model="pplr.point_contact_detail" type="text" class="form-control  input-lg" id="3" placeholder="point Contact Detail" ><br>
                            </div>
                            <legend>&nbsp;</legend>
                            <div class="clearfix"></div>

                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-11" style="margin-top: 20px;">
                            <button type="button"  ng-init="pplloop()" ng-click="pplloop()" class="btn btn-success btn-fill pull-right"><span class="ti-plus"></span> Add More Pick Point </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 h" style="margin-top: 10px;">
                        <legend>&nbsp;</legend>
                    </div>

                    <div class="col-md-6 h">
                        <div class="form-group">
                            <label for="1">Payment Gateway & Service Charge</label>
                            <select ng-model="evt.pm_gt_fee" class="form-control " data-title="Single Select" data-style="btn-success btn-block">>
                                <option  value="" ng-selected="{{evt.pm_gt_fee}}==">Select Charges Policy</option>
                                <option ng-repeat="pg in LoadPaymentGateway"  value="{{pg.id}}">{{pg.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="1">Change the Label</label>
                            <select ng-model="evt.evt_btn_lbl" class="form-control " data-title="Single Select" data-style="btn-success btn-block">
                                <option  value="" ng-selected="{{evt.evt_btn_lbl}}==">Select Ticket Button Label</option>
                                <option ng-repeat="eb in LoadEventButton"  value="{{eb.id}}">{{eb.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Step 5 -->

                <!-- Step 6 -->
                <legend><span class="ti-gallery" style="margin-top: 30px;"></span> Design Your Event</legend>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div ng-show="previewOneDefault" class="col-sm-12">
                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageCover}}" />
                                <a href="javascript:void(0);" ng-click="clearCoverDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                            </div>
                            <div  ng-show="previewOne" class="col-sm-12">

                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step}}" />
                                <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                            </div>

                            <div ng-hide="previewOne" class="col-sm-12 previewOne" >
                                <form method="post" enctype="multipart/form-data" id="event-cover-photo">

                                    <div  style="height: 180px; width: 100%;" data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="340" data-width="1350" class="dropzone event-photo event-photo-cover text-center" id="cover-photo">

                                        <label  class="btn btn-success">
                                            <span class="ti-plus"  data-toggle="modal" data-target="#cover_imagem"></span>
                                        </label>					

                                        <p>
                                            <span class="text-uppercase">{{ UploadCoverImage}}</span>
                                            <i class="mdi mdi-help-circle"></i> 
                                        </p>
                                        <p class="text-primary">1350px X 340px</p>
                                        <div class="row" style="margin:1%;"> 
                                        </div> 
                                    </div>
                                </form>


                            </div>

                        </div>

                    </div>

                    <div class="clearfix visible-xs" style="height:15px;"></div>

                    <div class="col-sm-6">

                        <div ng-show="previewTwoDefault" style="display: block;" class="col-sm-12">
                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageThamb}}" />
                            <a href="javascript:void(0);" ng-click="clearThumbleDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>
                        <div  ng-show="previewTwo" style="display: block;" class="col-sm-12">
                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step_thumble}}" />
                            <a href="javascript:void(0);" ng-click="clearThumble()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>

                        <div ng-hide="previewTwo" class="col-sm-12 previewTwo">
                            <form method="post" enctype="multipart/form-data" id="event-card-photo">
                                <div data-image-type="card" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="200" data-width="420" class="dropzone event-photo event-photo-card text-center" id="card-photo" style="height: 185px; width: 100%;">
                                    <label class="btn btn-success" data-toggle="modal" data-target="#thumb_image">
                                        <span class="ti-plus"></span>
                                    </label>					

                                    <p>
                                        <span class="text-uppercase">{{ UploadCardImage}}</span>
                                    </p>
                                    <p class="text-primary">420px X 200px</p>
                                    <div class="row" style="margin:1%;"> 
                                    </div> 

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--                <div class="row">
                                    <div class="card">
                                        <div class="header">
                                            <p><span class="ti-check"></span> Pick an image from library</p>
                                        </div>
                                        <div class="content">
                                            <div class="col-sm-3">
                                                <a href="javascript:void(0);" class="img-thumbnail">
                                                    <img src="assets/img/background/background-2.jpg" alt="img" class="img-responsive" data-toggle="modal" data-target="#cover_image" >
                
                                                </a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a href="javascript:void(0);" class="img-thumbnail">
                                                    <img src="assets/img/background/background-5.png" alt="img" class="img-responsive" data-toggle="modal" data-target="#thumb_image" >
                                                </a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>-->
                <!-- Step 6 -->
                <div class="clearfix" style="padding: 30px;"></div>
            </div>
            <!-- ./Left Part Ends Here -->
        </div>

        <div class="col-md-12" style="margin-top: 30px;">
            <button type="button" ng-click="createEventJourney(evt, 'pending', 'btn_normal'); myFunction()" class="btn btn-success btn-fill"><span class="ti-save"></span> SAVE & EXIT </button>
            <button type="button" ng-click="createEventJourney(evt, 'pending', 'btn_preview')" data-toggle="modal" data-target="preview" class="btn btn-success btn-fill"><span class="ti-eye"></span> PREVIEW </button>
            <button type="button" ng-click="createEventJourney(evt, 'active', 'btn_normal')" class="btn btn-success btn-fill"><span class="ti-new-window"></span> GO LIVE </button>
        </div>
        <!-- ./ End Create Event Journey Here -->
        <div class="clearfix"></div>
    </div>
</div>
</form>
<!-- Modal -->



<div class="modal fade" id="thumb_image" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Default Thumbnail Image</h4>
            </div>
            <div class="modal-body">
                <div class="imageT col-md-" style="margin-right:15px;overflow: hidden">
                    <label for="upload">

                        <span href="javascript:void(0)" class="btn btn-success">Upload From Computer</span>
                    </label>					
                    <input id="upload" style="display:none;" type='file' file-input="files" onchange="angular.element(this).scope().imageUpload_thumbleJourney(event)" /> 
                </div>

                <div class="default_images">
                    <img ng-repeat="d_image in LoadEventDefaultImage" src=".././upload/event_default_images/{{d_image.banner_image}}" ng-click="defaultImageThumb(d_image.banner_image)" alt="Default image" class="img-responsive img-thumbnail" class="close" data-dismiss="modal" style="max-width:120px; max-height:140px">
                </div>
            </div>

        </div>
    </div>
</div> 




<div class="modal fade" id="cover_imagem" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Default Cover Image</h4>
            </div>
            <div class="modal-body">
                <div class="imageC col-md-" style="margin-right:15px;overflow: hidden">
                    <label for="uploadT">

                        <span href="javascript:void(0)" class="btn btn-success">Upload From Computer</span>
                    </label>					
                    <input id="uploadT" style="display:none;" type='file' file-input="files" onchange="angular.element(this).scope().imageUploadJourney(event)" /> 
                </div>

                <div class="default_images">
                    <img ng-repeat="d_image in LoadEventDefaultImage" src=".././upload/event_default_images/{{d_image.banner_image}}" ng-click="defaultImageCover(d_image.banner_image)" alt="Default image" class="img-responsive img-thumbnail" class="close" data-dismiss="modal" style="max-width:120px; max-height:140px">
                </div>
            </div>

        </div>
    </div>
</div> 

<!--- preview button modal  -->

<div class="modal fade modal-md" id="preview" role="dialog">

    <div class="modal-dialog" style="width:800px ">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your inputed data</h4>
            </div>
            <div class="modal-body">

                <div class="panel-default col-md-6 panel-custom panel-c" style="">
                    <div class="panel-heading">
                        <span class="ti-menu-alt"></span> Basic Event Details
                    </div>
                    <div class="panel-body">
                        <p>Event Name: {{evt.EventName}}</p>
                        <p>Organized By: {{evt.OrganizedBy}}</p>
                        <p>Event Start Date: {{evt.evt_start_date}}</p>
                        <p>Event End Date: {{evt.evt_end_date}}</p>
                        <p>Event Description: {{evt.evt_desc}}</p>

                        <p ng-if="evt.EventCategory == 1">Event Category: Events</p>
                        <p ng-if="evt.EventCategory == 2">Event Category: Music</p>
                        <p ng-if="evt.EventCategory == 3">Event Category: Movies</p>
                        <p ng-if="evt.EventCategory == 4">Event Category: Theater</p>
                        <p ng-if="evt.EventCategory == 5">Event Category: Sports</p>

                        <p ng-if="evt.EventType == 1">Event Type: Normal</p>
                        <p ng-if="evt.EventType == 3">Event Type: Donation</p>
                        <p ng-if="evt.EventType == 5">Event Type: Free</p>
                        <p ng-if="evt.EventType == 7">Event Type: Private</p>

<!--<p>Event Tags: {{tag}}</p>-->

                    </div>
                </div>

                <div class="panel-default col-md-6 panel-custom panel-c" style="">
                    <div class="panel-heading">
                        <span class="ti-gallery"></span>Design Your Event
                    </div>
                    <div class="panel-body">
                        <div ng-show="previewOneDefault" style="display: block;" class="col-sm-10 col-sm-offset-1 ">
                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageCover}}" />
                            <a href="javascript:void(0);" ng-click="clearCoverDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>
                        <div  ng-show="previewOne" style="display: block;" class="col-sm-10 col-sm-offset-1">

                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step}}" />
                            <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>

                        <div ng-show="previewTwoDefault" style="display: block;" class="col-sm-10 col-sm-offset-1 ">
                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageThamb}}" />
                            <a href="javascript:void(0);" ng-click="clearThumbleDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>
                        <div  ng-show="previewTwo" style="display: block;" class="col-sm-10 col-sm-offset-1">
                            <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step_thumble}}" />
                            <a href="javascript:void(0);" ng-click="clearThumble()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-location-pin"></span> Event Location / Venue
                    </div>
                    <div class="panel-body">
                        <p>Name of Venue: {{evt.ven_name}}</p>
                        <p>Address Line: {{evt.ven_address}}</p>
                        <p>Address Line2: {{evt.ven_addresss}}</p>
                        <p>City: {{evt.ven_city}}</p>
                        <p>Country: {{evt.ven_country}}</p>
                        <p>ZIP/Postal Code: {{evt.ven_zip}}</p>
                    </div>
                </div>


                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-ticket"></span> Event Ticket Details
                    </div>
                    <div class="panel-body">

                        <p>Ticket Name: {{tck[0].tick_name}}</p>                     

                        <p>Quantity: {{tck[0].tick_quantity}}</p>
                        <p>Price: {{tck[0].tick_price}}</p>
                        <p class="ng-not-empty" ng-if="tck[0].tick_currency == 1">Currency: USD</p>
                        <p class="ng-not-empty" ng-if="tck[0].tick_currency == 2">Currency: POUND</p>
                        <p class="ng-not-empty" ng-if="tck[0].tick_currency == 3">Currency: TAKA</p>

                        <p>Min Qty.: {{tck[0].tick_min_quan}}</p>
                        <p>Max Qty.: {{tck[0].tick_max_quan}}</p>
                        <p>Start Date: {{tck[0].tick_start_date}}</p>
                        <p>End Date: {{tck[0].tick_end_date}}</p>
                        <p>Ticket Description: {{evt.tick_desc}}</p>
                        <p>Message To Attendee: {{evt.tick_mess_atten}}</p>


                    </div>
                </div>
                <div class="clearfix"></div> 

                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-receipt"></span> Payment Setting 
                    </div>
                    <div class="panel-body">
                        <p class="ng-not-empty" ng-if="pm.check_namest = 1">1: Online Payment</p> 
                        <p class="ng-not-empty" ng-if="pm.check_namest = 1">2: Bkash Payment</p>
                        <p class="ng-not-empty" ng-if="pm.check_namest = 1">3: Pay Online &amp; Get E-Ticket on Your E-Mail</p>


                    </div>
                </div>
                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-ticket"></span><span class="ti-receipt"></span> Offline Payment Setting<br>
                        <code>Offline Payment Method will after You Pay it's Charge : 500 Taka, Please Pay After Creating this event.</code>
                    </div>
                    <div class="panel-body">
                        <p class="ng-not-empty" ng-if="pm.off_check_namest = 1">1: Home Delivery</p>  
                        <p class="ng-not-empty" ng-if="pm.off_check_namest = 1">2: Pick UP Point</p>
                    </div>
                </div>

                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-ticket"></span> Payment Gateway & Service Charge
                    </div>
                    <div class="panel-body">
                        <p ng-if="evt.pm_gt_fee == 1">Charges Policy: Organiser Pay Both The Fees (3.99%+S.tax)</p> 
                        <p ng-if="evt.pm_gt_fee == 2">Charges Policy: Pass Payment Gateway fee to Customer (1.99%+S.tax)</p>
                        <p ng-if="evt.pm_gt_fee == 3">Charges Policy: Pass Service Charge to Customer (2%+S.tax)</p>
                        <p ng-if="evt.pm_gt_fee == 4">Charges Policy: Customer Pay Both The Fees (3.99%+S.tax)</p>

                    </div>
                </div>
                <div class="panel-default col-md-6 panel-custom panel-c">
                    <div class="panel-heading">
                        <span class="ti-ticket"></span> Change the Label
                    </div>
                    <div class="panel-body">
                        <p ng-if="evt.evt_btn_lbl == 1">Ticket Button Label: Buy Ticket</p>  
                        <p ng-if="evt.evt_btn_lbl == 2">Ticket Button Label: Register Now</p>
                        <p ng-if="evt.evt_btn_lbl == 3">Ticket Button Label: Book Now</p>
                        <p ng-if="evt.evt_btn_lbl == 4">Ticket Button Label: Donate</p>

                    </div>
                </div>



                <button type="button" ng-click="createEventJourney(evt, 'pending')" class="btn btn-success btn-fill"><span class="ti-new-window"></span> CONTINUE</


            </div>

        </div>
    </div>

</div> 




