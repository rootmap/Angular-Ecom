<!-- Start Create Event Journey Here -->
<div class="card padding_top15">
    <div class="header">
        <h4 class="title"><span class="ti-pencil-alt"></span> Add Event Details</h4>
        <hr>
    </div>
    <div class="content"> 
        <div class="row">
            <!-- Left Part Starts Here -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
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
                        <div class="form-group col-md-3">
                            <label for="basic-url">&nbsp;</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-success btn-fill pull-right"><span class="ti-check-box"></span> {{ EventURLStatus}} </button>
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
                            <input ng-show="newsubcat" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Enter New Sub-Category Name" ng-model="evt.newsubcat">
                            <select ng-hide="newsubcat" class="form-control" ng-change="checkNewSub(evt.EventSubCategory)" data-title="Select Sub Category" id="sub-cat" ng-model="evt.EventSubCategory">
                                <option ng-selected="{{evt.EventSubCategory}}==" value="">Select Sub Category</option>
                                <option ng-selected="{{evt.EventSubCategory}}== 0" value="0">Create New Sub Category</option>
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
                                <input name="evt_end_time" ng-init="InitTime()"  type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
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
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="1">Name of Venue </label>
                            <input ng-model="evt.ven_name" type="text" class="form-control" id="1" placeholder="Name of Venue" required>
                        </div>
                    </div>
                    <div class="col-md-1">
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
                                <input ng-model="evt.ven_address" type="text" class="form-control" id="2" placeholder="Street Line 1">
                            </div>
                            <div class="form-group">
                                <label for="3">Address Line 2</label>
                                <input ng-model="evt.ven_addresss" type="text" class="form-control" id="3" placeholder="Street Line 2">
                            </div>
                            <div class="form-group">
                                <label for="4">City</label>
                                <input ng-model="evt.ven_city" type="text" class="form-control" id="4" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="5">Country</label>
                                <input ng-model="evt.ven_country" type="text" class="form-control" id="5" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="1">ZIP/Postal Code</label>
                                <input ng-model="evt.ven_zip" type="text" class="form-control" id="1" placeholder="Name of Venue" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="1">Location Map</label>
                            </div>
                            <div class="google-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9732473656413!2d90.40148511445582!3d23.748333394773283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b88fd1fd672d%3A0x9ba033810adabfd1!2sSystech+Unimax+Ltd.!5e0!3m2!1sen!2sbd!4v1470807167438" width="100%" height="400px;" frameborder="1" style="border:1px solid #88C659;" allowfullscreen></iframe>
                            </div>
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
                                    <input ng-model="ckt.tick_name" value="{{ ckt.id}}" type="text" placeholder="ex:Entry Pass" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select ng-model="ckt.tick_type" class="form-control">
                                        <option  ng-repeat="mtb in mtt" value="{{ mtb.id}}">{{ mtb.name}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input ng-model="ckt.tick_quantity" type="text" placeholder="ex:1" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="ticketPrice" class="control-label">Price</label>
                                    <input ng-model="ckt.tick_price"   type="text" ng-readonly="ckt.tick_type == 2"  placeholder="Ex: 1000" class="form-control" name="ticketPrice" id="ticketPrice{{$index}}" required="required">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <label style="margin-top: 10px;"><strong><span  class="ti-settings text-inverse"></span></strong> <input style="opacity:0;" type="checkbox" value="1" ng-model="ckt.rein" /></label>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button  type="button" class="btn btn-icon btn-simple" ng-click="removeTicket(index)"><strong><span class="ti-close text-inverse"></span></strong></button>
                                </div>
                            </div>
                        </div>
                        <fieldset ng-show="ckt.rein == 1" style="z-index: 1;" class="ng-hide">
                            <div class="col-md-12">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ticketPrice" class="control-label">Currency</label>
                                        <select ng-readonly="ckt.tick_type == 2"  ng-model="ckt.tick_currency" class="form-control">
                                            <option  value="" ng-selected="{{ckt.tick_currency}}==">Select Currency Type</option>
                                            <option ng-repeat="ect in LoadCurrency"  value="{{ect.id}}">{{ect.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Min Qty.</label>
                                        <input ng-model="ckt.tick_min_quan" type="text" placeholder="Min Qty." class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                                <input   type="radio" name="options" id="option1" value="available" checked="checked"/>
                                                Available<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success" ng-click="ckt.tick_availability = 2">
                                                <input    type="radio" name="options" id="option2" value="halt">
                                                Halt<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success" ng-click="ckt.tick_availability = 3">
                                                <input    type="radio" name="options" id="option3" value="hidden">
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
                                        <label class="control-label">Start Date</label>
                                        <input  name="tick_start_date"  id="{{$index}}" ng-init="InitDateTicket()"  type="text" class="form-control datepickerT"  placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Start Time</label>
                                        <input   name="tick_start_time"  id="{{$index}}" ng-init="InitTimeTicket()"  type="text" class="form-control timepickerT"  placeholder="Time Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input  name="tick_end_date"  id="{{$index}}" ng-init="InitDateTicket()" type="text" class="form-control datepickerT"  placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">End Time</label>
                                        <input  name="tick_end_time"  id="{{$index}}" ng-init="InitTimeTicket()" type="text" class="form-control timepickerT"   placeholder="Time Picker Here"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="1">Ticket Description</label>
                                        <textarea ng-model="evt.tick_desc" rows="3" placeholder="ex:This Ticket Includes Lunnch" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="1">Message To Attendee</label>
                                        <textarea ng-model="evt.tick_mess_atten" rows="3" placeholder="ex:Please Reach The Venue 15 Minutes Before The Show Start Time" class="form-control"></textarea>
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
                            <textarea ng-model="evt.evt_desc" rows="3" placeholder="Type Your Event Description Here" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="1">Event Tags</label>
                            <div class="tagsinput  tag-success" ng-model="tag" ng-keypress="($event.which === 13) ? eventtag(tag) : 0" id="tags1470823879022_tagsinput" style="height: 100%;">
                                <div id="tags1470823879022_addTag" class="tagsinput-add-container">
                                    <div class="tagsinput-add"></div>
                                    <input  data-default="" value="" id="tags1470823879022_tag" style="color: rgb(102, 102, 102); width: 50%;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 h" style="margin-top: 30px;">
                        <legend><span class="ti-receipt"></span> Payment Setting </legend>
                    </div>

                    <div class="col-md-6 h"  ng-repeat="pm in pmrows| limitTo:3">
                        <div class="form-group">
                            <div class="checkboxall">
                                <label><input type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="pm.check_namest"> {{ pm.check_name}} 
                                    <!--<span ng-hide="{{pm.check_t_c.length}}==''">({{pm.check_t_c}})</span>-->
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12"  style="margin-top: 10px;">
                        <legend>&nbsp;</legend>
                    </div>

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
                                <textarea ng-model="pplr.point_contact_detail" type="text" class="form-control" id="3" placeholder="point Contact Detail"></textarea><br>
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
                    <div class="col-md-6 h">
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
                <div class="clearfix"></div>

                <div class="clearfix" style="padding: 30px;"></div>
            </div>
            <!-- ./Left Part Ends Here -->
            <!-- Right Part Starts Here -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <!-- Step 6 -->
                <legend><span class="ti-gallery"></span> Design Your Event</legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
<!--                            <div ng-show="previewOneDefault" style="display: block;" class="col-sm-10 col-sm-offset-1 ">
                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageCover}}" />
                                <a href="javascript:void(0);" ng-click="clearCoverDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                            </div>-->
                            <div  ng-show="previewOne" style="display: block;" class="col-sm-10 col-sm-offset-1">

                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step}}" />
                                <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                            </div>

                            <div ng-hide="previewOne" class="col-sm-10 col-sm-offset-1 previewOne" >
                                <form method="post" enctype="multipart/form-data" id="event-cover-photo">

                                    <div  style="height: 180px; width: 100%;" data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="340" data-width="1350" class="dropzone event-photo event-photo-cover text-center hidden-xs" id="cover-photo">

                                        <label for="upload" class="btn btn-success">
                                            <span class="ti-plus"></span>
                                        </label>					
                                        <input id="upload" style="display:none;" type='file' file-input="files" onchange="angular.element(this).scope().imageUploadJourney(event)" />
                                        <p>
                                            <span class="text-uppercase">{{ UploadCoverImage}}</span>
                                            <!-- <i class="mdi mdi-help-circle"></i> -->
                                        </p>
                                        <p class="text-primary">1350px X 340px</p>
                                        <div class="row" style="margin:1%;"> 
                                        </div> 
                                    </div>
                                </form>


                            </div>

                        </div>

                    </div>
                </div>

                <div class="clearfix" style="height: 30px;"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
<!--                            <div ng-show="previewTwoDefault" style="display: block;" class="col-sm-10 col-sm-offset-1 ">
                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src=".././upload/event_default_images/{{imageThamb}}" />
                                <a href="javascript:void(0);" ng-click="clearThumbleDefault()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                            </div>-->
                            <div ng-show="previewTwo" style="display: block;" class="col-sm-10 col-sm-offset-1">
                                <img class="img-thumbnail img-responsive" style="height: 180px; width: 100%;"  ng-src="{{step_thumble}}" />
                                <a href="javascript:void(0);" ng-click="clearThumble()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                                
                            </div>
                             
                            
                            <div ng-hide="previewTwo" class="col-sm-10 col-sm-offset-1 previewTwo">
                                <form method="post" enctype="multipart/form-data" id="event-card-photo">
                                    <div data-image-type="card" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="200" data-width="420" class="dropzone event-photo event-photo-card text-center hidden-xs" id="card-photo" style="height: 185px; width: 100%;">
                                        <label for="uploads" class="btn btn-success">
                                            <span class="ti-plus"></span>
                                        </label>					
                                        <input id="uploads" style="display:none;" type='file' file-input="files"  class="input-xlarge" onchange="angular.element(this).scope().imageUpload_thumbleJourney(event)" />
                                        <p>
                                            <span class="text-uppercase">{{ UploadCardImage}}</span>
                                            <!-- <i class="mdi mdi-help-circle"></i> -->
                                        </p>
                                        <p class="text-primary">420px X 200px</p>
                                        <div class="row" style="margin:1%;"> 
                                        </div> 

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <p><span class="ti-check"></span> Pick an image from library</p>
                        </div>
                        <div class="content">
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="img-thumbnail">
                                    <img src="assets/img/background/background-2.jpg" alt="img" class="img-responsive" data-toggle="modal" data-target="#cover_image" >

                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="img-thumbnail">
                                    <img src="assets/img/background/background-5.png" alt="img" class="img-responsive" data-toggle="modal" data-target="#thumb_image" >
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="height: 30px;"></div>
                <!-- Step 6 -->
            </div>
            <!-- Right Part Ends Here -->
        </div>

        <div class="col-md-12">
            <button type="button" ng-click="createEventJourney(evt)" class="btn btn-success btn-fill"><span class="ti-save"></span> SAVE & EXIT </button>
            <button type="button" ng-click="createEventJourney(evt)" class="btn btn-success btn-fill"><span class="ti-eye"></span> PREVIEW </button>
            <button type="button" ng-click="createEventJourney(evt)" class="btn btn-success btn-fill"><span class="ti-new-window"></span> GO LIVE </button>
        </div>
        <!-- ./ End Create Event Journey Here -->
        <div class="clearfix"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cover_image" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Default Cover Image</h4>
            </div>
            <div class="modal-body">
                <div class="image">
                    <img ng-repeat="d_image in LoadEventDefaultImage" src=".././upload/event_default_images/{{d_image.banner_image}}" ng-click="defaultImageCover(d_image.banner_image)" alt="Default image" class="img-responsive img-thumbnail" class="close" data-dismiss="modal" style="max-width:185px; max-height:160px">
                </div>
            </div>

        </div>
    </div>
</div>    

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
                <div class="image">
                    <div class="image">
                     <img ng-repeat="d_image in LoadEventDefaultImage" src=".././upload/event_default_images/{{d_image.banner_image}}" ng-click="defaultImageThumb(d_image.banner_image)" alt="Default image" class="img-responsive img-thumbnail" class="close" data-dismiss="modal" style="max-width:185px; max-height:160px">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>    