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
                            <input type="text" ng-model="evt.name" class="form-control" id="example_username" placeholder="eg: Ticketchai Hackathon 2016" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="basic-url">Event URL</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">ticketchai.com/event/</span>
                                <input ng-model="evt.url" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="basic-url">&nbsp;</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-success btn-fill pull-right"><span class="ti-check-box"></span> Check Aavailability </button>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="event-name">Event Category</label>
                            <select ng-model="evt.cat" class="form-control selectpicker" data-title="Select Category" data-style="btn-success btn-block">
                                <option>Event</option>
                                <option>Event</option>
                                <option>Sports</option>
                                <option>Music</option>
                                <option>Movies</option>
                                <option>Theater</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="event-name">Event Sub-Category</label>
                            <input  ng-model="evt.scat" type="text" class="form-control" id="sub-cat" aria-describedby="basic-addon3">
                        </div>
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="exampleInputPassword1">Event Type</label>
                                <select  ng-model="evt.type" class="form-control selectpicker" data-title="Select Event Type" data-style="btn-success btn-block">
                                    <option>Public</option>
                                    <option>Private</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-name">Organized By</label>
                                <select ng-model="evt.orgby" class="form-control selectpicker" data-title="Select Organizer" data-style="btn-success btn-block">
                                    <option>Shanto Kumar Sarker</option>
                                </select>
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
                                <input  ng-model="evt.start_date"  id="start-date" type="text" class="form-control datepicker" placeholder="Date Picker Here"/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Start Time</label>
                                <input ng-model="evt.start_time" ng-keyup="open($index)" id="start-time" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input ng-model="evt.end_date" ng-keyup="open($index)" id="end-date" type="text" class="form-control datepicker" placeholder="Date Picker Here"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">End Time</label>
                                <input ng-model="evt.end_time" ng-keyup="open($index)" id="end-time" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
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
                                <label for="2">Address Line 1</label>
                                <input ng-model="evt.ven_address" type="text" class="form-control" id="2" placeholder="Street Line 1">
                            </div>
                            <div class="form-group">
                                <label for="3">Address Line 2</label>
                                <input ng-model="evt.ven_addresss" type="text" class="form-control" id="3" placeholder="Street Line 2">
                            </div>
                            <div class="form-group">
                                <label for="4">City</label>
                                <input type="text" class="form-control" id="4" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="5">Country</label>
                                <input ng-model="evt.ven_city" type="text" class="form-control" id="5" placeholder="Country">
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
                <div class="row" id="ticket-row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <legend><span class="ti-ticket"></span> Event Ticket</legend>
                    </div>
                    <div class="row" ng-repeat="ckt in tck" myRepeatDirective>
                        <div class="col-md-12">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Ticket Name</label>
                                    <input ng-model="evt.tick_name" value="{{ ckt.id }}" type="text" placeholder="ex:Entry Pass" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select ng-model="evt.tick_type" class="form-control">
                                        <option class="bs-title-option" value="">Select</option>
                                        <option label="PAID" value="">PAID</option>
                                        <option label="FREE" value="">FREE</option>
                                        <option label="ADD-ON" value="">ADD-ON</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input ng-model="evt.tick_quantity" type="text" placeholder="ex:1" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="ticketPrice" class="control-label">Price</label>
                                    <input ng-model="evt.tick_price" type="text"  placeholder="Ex: 1000" class="form-control" name="ticketPrice" id="ticketPrice" required="required">
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
                                    <button id="tbtnc{{ ckt.id }}" type="button" class="btn btn-icon btn-simple"><strong><span class="ti-close text-inverse"></span></strong></button>
                                </div>
                            </div>
                        </div>
                        <fieldset ng-show="ckt.rein == 1" class="ng-hide">
                            <div class="col-md-12 well">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ticketPrice" class="control-label">Currency</label>
                                        <select ng-model="evt.tick_currency" class="form-control">
                                            <option label="EUR" value="" selected="selected">BDT</option>
                                            <option label="INR" value="">INR</option>
                                            <option label="USD" value="">USD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Min Qty.</label>
                                        <input ng-model="evt.tick_min_quan" type="text" placeholder="Min Qty." class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Max Qty.</label>
                                        <input ng-model="evt.tick_max_quan" type="text" placeholder="Max Qty." class="form-control">
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
                                            <label class="btn btn-success active">
                                                <input ng-model="evt.tick_availability" type="radio" name="options" id="option1" value="available" checked="checked"/>
                                                Available<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success">
                                                <input ng-model="evt.tick_availability" type="radio" name="options" id="option2" value="halt">
                                                Halt<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success">
                                                <input ng-model="evt.tick_availability" type="radio" name="options" id="option3" value="hidden">
                                                Hidden<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Who will pay Ticketchai fee</label><br/>
                                        <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
                                            <label class="btn btn-success active">
                                                <input ng-model="evt.tick_fee_from" type="radio" name="options2" id="options1" value="me" checked="checked"/>
                                                Me<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                            <label class="btn btn-success">
                                                <input ng-model="evt.tick_fee_from" type="radio" name="options2" id="options2" value="customer">
                                                Customer<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
           

                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input  type="text" class="form-control datepicker1" placeholder="Date Picker Here" ng-init="InitDate()"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Start Time</label>
                                        <input ng-model="evt.tick_start_time"  id="start-time{{ ckt.id }}" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input ng-model="evt.tick_end_date" id="end-date{{ ckt.id }}" type="text" class="form-control datepicker" placeholder="Date Picker Here"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">End Time</label>
                                        <input ng-model="evt.tick_end_time" id="end-time{{ ckt.id }}" type="text" class="form-control timepicker" placeholder="Time Picker Here"/>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="1">Payment Gateway & Service Charge</label>
                            <select ng-model="evt.pm_gt_fee" class="form-control selectpicker" data-title="Single Select" data-style="btn-success btn-block">
                                <option class="bs-title-option" value="">Select Charges Policy</option>
                                <option selected="selected" value="">Organiser Pay Both The Fees (3.99%+S.tax)</option>
                                <option value="gatewaycharge">Pass Payment Gateway fee to Customer (1.99%+S.tax)</option>
                                <option value="servicecharge">Pass Service Charge to Customer (2%+S.tax)</option>
                                <option value="both">Customer Pay Both The Fees (3.99%+S.tax)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="1">Change the Label</label>
                            <select ng-model="evt.evt_btn_lbl" class="form-control selectpicker" data-title="Single Select" data-style="btn-success btn-block">
                                <option class="bs-title-option" value="">Select Ticket Button Label</option>
                                <option value="Buy"> Buy Ticket </option>
                                <option value="Register Now"> Register Now </option>
                                <option value="Book Now"> Book Now </option>
                                <option value="Donate"> Donate </option>
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
                        <form method="post" enctype="multipart/form-data" id="event-cover-photo">
                            <div data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="340" data-width="1350" class="dropzone event-photo event-photo-cover text-center hidden-xs" id="cover-photo" style="height: 180px; width: 100%;">
                                <i class="fa fa-plus fa-3x"></i>
                                <p>
                                    <span class="text-uppercase">Upload Cover Image</span>
                                    <!-- <i class="mdi mdi-help-circle"></i> -->
                                </p>
                                <p class="text-primary">1350px X 340px</p>
                                <input type="file" name="cover">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix" style="height: 30px;"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <form method="post" enctype="multipart/form-data" id="event-card-photo">
                            <div data-image-type="card" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" data-height="200" data-width="420" class="dropzone event-photo event-photo-card text-center hidden-xs" id="card-photo" style="height: 185px; width: 100%;">
                                <i class="fa fa-plus fa-3x"></i>
                                <p>
                                    <span class="text-uppercase">Upload Card Image</span>
                                </p>
                                <p class="text-primary">420px X 200px</p>
                                <input type="file" name="card">
                            </div>
                        </form>
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
                                    <img src="assets/img/background/background-2.jpg" alt="img" class="img-responsive"/>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="img-thumbnail">
                                    <img src="assets/img/background/background-5.png" alt="img" class="img-responsive"/>
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