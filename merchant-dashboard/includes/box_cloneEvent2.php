<!-- Wizard Sarts Here -->
<div class="card padding_top15">
    <div class="col-md-12">
        <!-- BEGIN STEP FORM WIZARD -->
        <div class="tsf-wizard tsf-wizard-1">
            <div class="wizard-title">
                <h3><i class="fa fa-clone"></i> Clone Event</h3>
            </div>

            <!-- BEGIN NAV STEP-->
            <div class="tsf-nav-step">
                <!-- BEGIN STEP INDICATOR-->
                <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
                    <li class="current" data-target="step-1">
                        <a href="#!">
                            <span class="number">1</span>
                            <span class="desc">
                                <label>Basics</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-2">
                        <a href="#!">
                            <span class="number">
                                2
                            </span>
                            <span class="desc">
                                <label>Ticket</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-3">
                        <a href="#!">
                            <span class="number">
                                3
                            </span>
                            <span class="desc">
                                <label>Location</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-4">
                        <a href="#!">
                            <span class="number">
                                4
                            </span>
                            <span class="desc">
                                <label>Description</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-5">
                        <a href="#!">
                            <span class="number">
                                5
                            </span>
                            <span class="desc">
                                <label>Photos</label>
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- END STEP INDICATOR--->
                
            </div>
            <!-- END NAV STEP-->
            <!-- BEGIN STEP CONTAINER -->



            <div class="tsf-container">
                <!-- BEGIN CONTENT-->
                <div class="tsf-content">
                    <!-- BEGIN STEP 1-->
                    <div class="tsf-step step-1 active">
                        <fieldset>
                            <legend>{{ ProvideYBEventDetails}}</legend>

                            <h2>{{ informatonSms}}</h2>
                            <div class="row">
                                <!-- BEGIN STEP CONTENT-->
                                <!--ng-submit="createEvent(addEvent)"-->
                                <!--ng-model="addEvent"-->
                                <form class="tsf-step-content"  >
                                    <div class="col-lg-12">
                                        
                                        <div class="form-group col-md-12">
                                            <label for="event-name">{{ EventName}}</label>
                                            <input type="text" ng-keyup="createNewEvtLink(addEvent)" ng-model="addEvent.EventName"  class="form-control" id="eventNameEdit" placeholder="eg: Ticketchai Hackathon 2016" required >
                                        </div>
                                        
                                        <div class="form-group col-md-9">
                                            <label for="basic-url">{{ EventURL}}</label>
                                            <div class="input-group">
                                                <style type="text/css">
                                                    #basic-addon3{ padding-right: 0px; border-right: 0px; } 
                                                </style>    
                                                <span class="input-group-addon" id="basic-addon3">http://www.ticketchai.org/event/</span>
                                                <input type="text" ng-keyup="createNewEvtLinkCus(addEvent)" ng-model="addEvent.EventURL" class="form-control"  id="basic-url" aria-describedby="basic-addon3" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label for="basic-url">&nbsp;</label>
                                            <div class="input-group">
                                                <button ngshow="EventURLStatus_success==true" type="button" class="btn btn-success btn-fill pull-right">
                                                  <span class="" style="color:{{EventURLStatusColor}}"> {{EventURLStatus2}} URL</span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Start Date</label>
                                                <div class="clearfix"></div>
                                                <input  id="start-date" ng-init="InitDate('start-date')" type="text" class="form-control datepicker1"  datepicker-options="options" placeholder="Date Picker Here"/>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-6">  
                                            <div class="form-group">
                                                <label class="control-label">Start Time</label>
                                                <input name="evt_start_time" id="start-time"  ng-init="InitTime()" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <div class="clearfix"></div>
                                                <input  id="end-date" ng-init="InitDate('end-date')" type="text" class="form-control datepicker1"  datepicker-options="options" placeholder="Date Picker Here"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">  
                                            <div class="form-group">
                                                <label class="control-label">End Time</label>
                                                <input name="evt_end_time" id="end-time"  ng-init="InitTime()" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">  
                                                <label for="event-name">Event Category</label>
                                                <select class="form-control" data-title="Select Category" id="EventCategoryEdit" ng-model="addEvent.EventCategory">
                                                    <option ng-selected="{{addEvent.EventCategory}}==" value="">Select Category</option>
                                                    <option ng-repeat="cat in eventcategorydata" ng-selected="{{cat.id}}=={{addEvent.EventCategory}}" value="{{cat.id}}">{{cat.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="event-name">{{ EventSubCategory}}</label>
                                                <input ng-show="newsubcat" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Enter New Sub-Category Name" ng-model="addEvent.newsubcat">
                                                <select ng-hide="newsubcat" class="form-control" ng-change="checkNewSub(addEvent.EventSubCategory)" data-title="Select Sub Category" id="sub-cat" ng-model="addEvent.EventSubCategory">
                                                    <option ng-selected="{{addEvent.EventSubCategory}}==" value="">Select Sub Category</option>
                                                    <option ng-selected="{{addEvent.EventSubCategory}}== 0" value="0">Create New Sub Category</option>
                                                    <option ng-repeat="scat in eventsubcategorydata" ng-selected="{{scat.id}}=={{addEvent.EventSubCategory}}" value="{{scat.id}}">{{scat.name}}</option>
                                                </select>
                                            </div>    
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="exampleInputPassword1">{{ EventType}}</label>
                                                <select class="form-control" data-title="Select Sub Category" id="sub-cat"  ng-model="addEvent.EventType">
                                                    <option ng-selected="{{addEvent.EventType}}==" value="">Select Event Type</option>
                                                    <option ng-repeat="etd in eventtypedata" ng-selected="{{etd.id}}=={{addEvent.EventType}}" value="{{etd.id}}">{{etd.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="event-name">{{ OrganizedBy}}</label>
                                                <input type="text" class="form-control" id="OrganizedByEdit" aria-describedby="basic-addon3" ng-model="addEvent.OrganizedBy">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                                <!-- END STEP CONTENT-->
                            </div>
                        </fieldset>
                    </div>
                    <!-- END STEP 1-->
                    
                    
                    <!-- BEGIN STEP 2-->
                    <div class="tsf-step step-2">
                        <fieldset>
                            <legend><span class="ti-ticket"></span>Provide Your Event Ticket</legend>
                            <!-- BEGIN STEP CONTENT-->
                            <div class="row"  id="ticket-row">
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
                                    
                                    <!--  [paste this code if want to hide fieldset]   ng-show="ckt.rein == 1" class="ng-hide" style="z-index: 1;min-width:50%"--> 
                                    <fieldset >
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
                                                    <textarea ng-model="ckt.tick_description"  rows="3" id="tick_desc" placeholder="ex:This Ticket Includes Lunnch" class="form-control"></textarea>

                                                </div> 
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="1">Message To Attendee</label>
                                                    <textarea ng-model="ckt.tick_mess_atten" id="tick_mess_atten" rows="3" placeholder="ex:Please Reach The Venue 15 Minutes Before The Show Start Time" class="form-control"></textarea>
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
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 2-->
                    
                    
                    <!-- BEGIN STEP 3-->
                    <div class=" tsf-step step-3 ">
                        
<!--                        <div class="row" id="venue-row">
                            <div class="col-md-12" style="margin-top: 30px;">
                                <legend><span class="ti-location-pin"></span> Event Location / Venue</legend>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="1">Name of Venue </label>
                                    <input ng-model="addEvent.NameOfVenue" type="text"  class="form-control"  id="pac-input"  placeholder="Name of Venue"  ng-required="true">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <fieldset id="">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="1">Event Venue</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="2">Address Line</label>
                                        <input ng-model="addEvent.StreetLine1" type="text" value="{{ addEvent.StreetLine1}}" class="form-control" id="street_number" placeholder="Street Line 1">
                                    </div>
                                    <div class="form-group">
                                        <label for="3">Address Line 2</label>
                                        <input ng-model="addEvent.StreetLine2" type="text" value="{{ addEvent.StreetLine2}}"  class="form-control" id="route"  placeholder="Street Line 2">
                                    </div>
                                    <div class="form-group">
                                        <label for="4">City</label>
                                        <input ng-model="addEvent.CityFrom" type="text" value="{{ addEvent.CityFrom}}"  class="form-control" id="locality"   placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <label for="5">Country</label>
                                        <input ng-model="addEvent.CountryFiled" type="text" value="{{ addEvent.CountryFiled}}"  class="form-control" id="country"   placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <label for="1">ZIP/Postal Code</label>
                                        <input ng-model="addEvent.ven_zip" type="text" value="{{ addEvent.ven_zip}}"  class="form-control" id="postal_code"     placeholder="Name of Venue" required>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="1">Location Map</label>
                                    </div>
                                    <div id="map" style="height: 300px;"></div>
                                </div>
                            </fieldset>
                        </div>-->
                    </div>
                    <!-- END STEP 3-->
                    <!-- BEGIN STEP 4-->
                    <div class="tsf-step step-4">
                        <fieldset>
                            <legend>{{ PurEventDescription}}</legend>
                            <!-- BEGIN STEP CONTENT-->
                            <form class="tsf-step-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="1">{{ EventDescription}}</label>
                                            <textarea rows="3" placeholder="Type Your Event Description Here" class="form-control" ng-model="addEvent.EventDescription"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="1">Event Tags</label>
                                            <div style=" background-color: #f1f8e9;border: 1px solid #82bd55;  border-radius: 4px;padding: 5px 5px">
                                                <p class="label label-success " style="margin:5px 5px;border-radius: 4px;padding: 5px;" 
                                                   ng-repeat="(key, value) in list">&nbsp;
                                                    <span ng-click="remove($index)">&nbsp;{{value}}<a href="javascript:void(0)" class="ti-close" style="color:#fff;"></a></span>
                                                </p>
                                                <a href="javascript:void(0)"  ng-click="addToList(todo)" class="ti-plus" ></a> 
                                                <input type="text" ng-model="todo" ng-keyup="$event.keyCode == 13 ||$event.keyCode == 32 ? addToList(todo) : null"
                                                       style=" background-color: #f1f8e9;border: 1px solid #82bd55;  width:20%;padding: 5px 5px"> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="1">{{ PaymentGatewayAndServiceCharge}}</label>
                                            <select class="form-control" data-title="Single Select" data-style="btn-success btn-block" ng-model="addEvent.PaymentGatewayAndServiceCharge">
                                                <option class="bs-title-option" value="1">Select Charges Policy</option>
                                                <option  value="2">Organiser Pay Both The Fees (3.99%+S.tax)</option>
                                                <option  value="3">Pass Payment Gateway fee to Customer (1.99%+S.tax)</option>
                                                <option  value="4">Pass Service Charge to Customer (2%+S.tax)</option>
                                                <option value="5">Customer Pay Both The Fees (3.99%+S.tax)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="1">{{ ChangetheLabel}}</label>
                                            <select class="form-control" data-title="Single Select" data-style="btn-success btn-block" ng-model="addEvent.ChangetheLabel">
                                                <option class="bs-title-option" value="">Select Ticket Button Label</option>
                                                <option value="1"> Buy Ticket </option>
                                                <option value="2"> Register Now </option>
                                                <option value="3"> Book Now </option>
                                                <option value="4"> Donate </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 4-->
                    <!-- BEGIN STEP 5-->
                    <div class="tsf-step step-5">
                        <fieldset  class="tsf-step-content">

                            <legend>{{ UploadYourEventPhotos}}</legend>
                            <!-- BEGIN STEP CONTENT-->
                            
                            <div class="row">
                                <div  ng-show="goCats" style="display: block;" class="col-sm-10 col-sm-offset-1">
                                    <img class="img-thumbnail img-responsive" style="height: 340px; width: 100%;"  ng-src="{{step}}" />
                                    <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                                </div>

                                <div   ng-hide="goCats" class="col-sm-10 col-sm-offset-1" ng-click="upload()">
                                    <form method="post" enctype="multipart/form-data" id="event-cover-photo">

                                        <div  style="height: 180px; width: 100%;" data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="340" data-width="1350" class="dropzone event-photo event-photo-cover text-center hidden-xs" id="cover-photo">

                                            <label for="upload" class="btn btn-success">
                                                <i class="fa fa-plus fa-3x"></i>
                                            </label>					
                                            <input id="upload" style="display:none;" type='file' file-input="files"  class="input-xlarge" onchange="angular.element(this).scope().imageUpload(event)" />
                                            <p>
                                                <span class="text-uppercase">{{ UploadCoverImage}}</span>
                                                <!-- <i class="mdi mdi-help-circle"></i> -->
                                            </p>
                                            <p class="text-primary">1170px X 370px</p>
                                            <div class="row" style="margin:1%;"> 
                                            </div> 
                                        </div>
                                    </form>
                                    
                                    
                                </div>

                            </div>
                            <div class="clearfix" style="height: 30px;"></div>
                            <div class="row">

                                <div  ng-show="goCats_thumble" style="display: block;" class="col-sm-6 col-sm-offset-3">
                                    <img class="img-thumbnail img-responsive" style="height: 200px; width: 420px;"  ng-src="{{step_thumble}}" />
                                    <a href="javascript:void(0);" ng-click="clearThumble()" class="label label-danger" style="position: absolute; left:13px; bottom:-23px; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                                </div>

                                <div ng-hide="goCats_thumble" class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
                                    <form method="post" enctype="multipart/form-data" id="event-card-photo">
                                        <div data-image-type="card" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="200" data-width="420" class="dropzone event-photo event-photo-card text-center hidden-xs" id="card-photo" style="height: 185px; width: 100%;">
                                            <label for="uploads" class="btn btn-success">
                                                <i class="fa fa-plus fa-3x"></i>
                                            </label>					
                                            <input id="uploads" style="display:none;" type='file' file-input="files"  class="input-xlarge" onchange="angular.element(this).scope().imageUpload_thumble(event)" />
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
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 5-->

                </div>
                <!-- END CONTENT-->
                <!-- BEGIN CONTROLS-->
                <div class="tsf-controls ">
                    <!-- BEGIN PREV BUTTTON-->
                    <button type="button" data-type="prev" class="btn btn-left tsf-wizard-btn">
                        <i class="fa fa-chevron-left"></i> {{ PREV}}
                    </button>
                    <!-- END PREV BUTTTON-->
                    <!-- BEGIN NEXT BUTTTON-->
                    <button type="button" data-type="next" class="btn btn-right tsf-wizard-btn">
                        {{ NEXT}} <i class="fa fa-chevron-right"></i>
                    </button>
                    <!-- END NEXT BUTTTON-->
                    <!-- BEGIN FINISH BUTTTON-->
                    <button  ng-click="createEvent(addEvent)"  type="button" id="submit" value="submit" data-type="finish" class="btn btn-right tsf-wizard-btn">
                        FINISH
                    </button>
                    <!-- END FINISH BUTTTON-->
                </div>
                <!-- END CONTROLS-->
            </div>
            <!-- END STEP CONTAINER -->


        </div>
        <!-- END STEP FORM WIZARD -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix" style="padding: 30px;"></div>
</div>
<!--./ Wizard Ends Here -->