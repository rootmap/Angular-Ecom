<!-- Wizard Sarts Here -->
<div class="card padding_top15">
    <div class="col-md-12">
        <!-- BEGIN STEP FORM WIZARD -->
        <div class="tsf-wizard tsf-wizard-1">
            <div class="wizard-title">
                <h3>{{ AddEventDetails}}</h3>
            </div>

            <!-- BEGIN NAV STEP-->
            <div class="tsf-nav-step">
                <!-- BEGIN STEP INDICATOR-->
                <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
                    <li class="current" data-target="step-1">
                        <a href="#!">
                            <span class="number">1</span>
                            <span class="desc">
                                <label>{{ Basics}}</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-2">
                        <a href="#!">
                            <span class="number">2</span>
                            <span class="desc">
                                <label>{{ DateAndTime}}</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-3">
                        <a href="#!">
                            <span class="number">
                                3
                            </span>
                            <span class="desc">
                                <label>{{ Location}}</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-4">
                        <a href="#!">
                            <span class="number">
                                4
                            </span>
                            <span class="desc">
                                <label>{{ Description}}</label>
                            </span>
                        </a>
                    </li>
                    <li data-target="step-5">
                        <a href="#!">
                            <span class="number">
                                5
                            </span>
                            <span class="desc">
                                <label>{{ Photos}}</label>
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
                                <form class="tsf-step-content" ng-model="addEvent" >
                                    <div class="col-lg-12">
                                        <div class="form-group col-md-6">
                                            <label for="event-name">{{ EventName}}</label>
                                            <input type="text" ng-keyup="createNewEvtLink(addEvent)" class="form-control" id="eventNameEdit" placeholder="eg: Ticketchai Hackathon 2016" required ng-model="addEvent.EventName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="basic-url">{{ EventURL}}</label>
                                            <div class="input-group">
                                                <style type="text/css">
                                                    #basic-addon3{ padding-right: 0px; border-right: 0px; } 
                                                </style>    
                                                <span class="input-group-addon" id="basic-addon3">ticketchai.com/event/</span>
                                                <input type="text" class="form-control"  id="basic-url" aria-describedby="basic-addon3" ng-model="addEvent.EventURL">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-6">
                                            <label for="event-name">{{ EventCategory}}</label>
                                            <select class="form-control" data-title="Select Category" id="EventCategoryEdit" ng-model="addEvent.EventCategory">
                                                <option ng-selected="{{addEvent.EventCategory}}==" value="">Select Category</option>
                                                <option ng-repeat="cat in eventcategorydata" ng-selected="{{cat.id}}=={{addEvent.EventCategory}}" value="{{cat.id}}">{{cat.name}}</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label for="event-name">{{ EventSubCategory}}</label>
                                            <input ng-show="newsubcat" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Enter New Sub-Category Name" ng-model="addEvent.newsubcat">
                                            <select ng-hide="newsubcat" class="form-control" ng-change="checkNewSub(addEvent.EventSubCategory)" data-title="Select Sub Category" id="sub-cat" ng-model="addEvent.EventSubCategory">
                                                <option ng-selected="{{addEvent.EventSubCategory}}==" value="">Select Sub Category</option>
                                                <option ng-selected="{{addEvent.EventSubCategory}}== 0" value="0">Create New Sub Category</option>
                                                <option ng-repeat="scat in eventsubcategorydata" ng-selected="{{scat.id}}=={{addEvent.EventSubCategory}}" value="{{scat.id}}">{{scat.name}}</option>
                                            </select>

<!--                                            <input type="text" class="form-control" id="sub-cat" aria-describedby="basic-addon3">-->
                                        </div>
                                        <div class="form-group"><!--id="box-rad" -->
                                            <div class="col-md-6">
                                                <label class="control-label" for="exampleInputPassword1">{{ EventType}}</label>
                                                <!--<div class="row">
                                                    <div class="radio ts-radios boxed col-sm-6">
                                                        <input type="radio" id="eventTypePublic" value="public" ng-model="eventType" name="radio" class="ng-pristine ng-untouched ng-valid">
                                                        <label for="eventTypePublic" class="box-style-radio">
                                                            <i class="icon-user-pair icon-4x">&nbsp;&nbsp;</i><span>Public</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio ts-radios col-sm-6" style="margin-top: 10px !important;">
                                                        <input type="radio" id="eventTypeInvitation" value="invitation" ng-model="eventType" name="radio" class="ng-pristine ng-untouched ng-valid">
                                                        <label for="eventTypeInvitation" class="box-style-radio">
                                                            <i class="icon-lock-alt icon-4x">&nbsp;</i><span>Private</span>
                                                        </label>
                                                    </div>
                                                </div>-->

                                                <select class="form-control" data-title="Select Sub Category" id="sub-cat"  ng-model="addEvent.EventType">
                                                    <option ng-selected="{{addEvent.EventType}}==" value="">Select Event Type</option>
                                                    <option ng-repeat="etd in eventtypedata" ng-selected="{{etd.id}}=={{addEvent.EventType}}" value="{{etd.id}}">{{etd.name}}</option>
                                                </select>


<!--                                                <select class="form-control selectpicker" data-title="Select Event Type" id="EventTypeEdit" data-style="btn-success btn-block" ng-model="addEvent.EventType">
                                                    <option>Public</option>
                                                    <option>Private</option>
                                                </select>-->
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="event-name">{{ OrganizedBy}}</label>
                                                 <input type="text" class="form-control" id="OrganizedByEdit" aria-describedby="basic-addon3" ng-model="addEvent.OrganizedBy">
<!--                                                <select class="form-control selectpicker" data-title="Select Organizer" id="OrganizedByEdit" data-style="btn-success btn-block" ng-model="addEvent.OrganizedBy">
                                                    <option value="1">admin</option>
                                                    <option value="2">co-admin</option>
                                                </select>-->
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
                    <div class=" tsf-step step-2 ">
                        <fieldset>
                            <legend>{{ ProvideDateAndTime}}</legend>
                            <!--                            <h2>{{ informatonSms }} </h2>-->
                            <!-- BEGIN STEP CONTENT-->
                            <form class="tsf-step-content">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ StartDate}}</label>
                                            <div class="clearfix"></div>
                                            <input id="start-date" type="text" class="form-control datepicker" id="StartDateEdit" date-format='yyyy-MM-dd' placeholder="Date Picker Here" ng-model="addEvent.StartDate"/>
                                            <!--                                                                            <a href="javascript:void(0);" id="start-date-box" class="preview preview-date start">
                                                                                                                                                                        <input type="text" class='form-control input-group date' id='datetimepicker1' required>
                                                                                                                            <div id="date-start">
                                                                                                                                <p class="text-info">
                                                                                                                                    <span>08</span>
                                                                                                                                    <br>
                                                                                                                                    <span>Aug, 2016</span>
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </a>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ StartTime}}</label>
                                            <input name="StartTime" type="text" class="form-control timepickerT"  placeholder="Time Picker Here" />
                                            <div class="clearfix"></div>
                                            <!--                                                                            <a href="javascript:void(0);" id="start-time-box" class="preview preview-time start">
                                                                                                                                                                        <input type="text"class="form-control date-time-sr-only" id="startTime">
                                                                                                                            <div>
                                                                                                                                <p class="text-info">
                                                                                                                                    <span>06:00</span>
                                                                                                                                    <span>PM</span>
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ EndDate}}</label>
                                            <input id="end-date" type="text" class="form-control datepicker" id="EndDateEdit" date-format='yyyy-MM-dd'   placeholder="Date Picker Here" ng-model="addEvent.EndDate"/>
                                            <div class="clearfix"></div>
                                            <!--                                                                            <a href="javascript:void(0);" id="end-date-box" class="preview preview-date start">
                                                                                                                                                                        <input type="text" class="form-control date-time-sr-only" required>
                                                                                                                     </a>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ EndTime}}</label>
                                            <input name="EndTime" type="text" class="form-control timepickerT" placeholder="Time Picker Here"/>
                                            <div class="clearfix"></div>
                                            <!--                                                                            <a href="javascript:void(0);" id="end-time-box" class="preview preview-time start">
                                                                                                                                                                        <input type="text" class="form-control date-time-sr-only" id="startTime">
                                                                                                                      </a>-->
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END STEP CONTENT-->
                        </fieldset>
                    </div>
                    <!-- END STEP 2-->
                    <!-- BEGIN STEP 3-->
                    <div class=" tsf-step step-3 ">
                        <fieldset>
                            <legend>{{ Venue}}</legend>
                            <!-- BEGIN STEP CONTENT-->
                            <form class="tsf-step-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="1">{{ EventVenue}}</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="1">{{ NameOfVenue}}</label>
                                            <input type="text" class="form-control" id="1" placeholder="Name of Venue" required ng-model="addEvent.NameOfVenue">
                                        </div>
                                        <div class="form-group">
                                            <label for="2">{{ StreetLine1}}</label>
                                            <input type="text" class="form-control" id="2" placeholder="Street Line 1" ng-model="addEvent.StreetLine1">
                                        </div>
                                        <div class="form-group">
                                            <label for="3">{{ StreetLine2}}</label>
                                            <input type="text" class="form-control" id="3" placeholder="Street Line 2" ng-model="addEvent.StreetLine2">
                                        </div>
                                        <div class="form-group">
                                            <label for="4">{{ CityFrom}}</label>
                                            <input type="text" class="form-control" id="4" placeholder="City" ng-model="addEvent.CityFrom">
                                        </div>
                                        <div class="form-group">
                                            <label for="5">{{ CountryFiled}}</label>
                                            <input type="text" class="form-control" id="5" placeholder="Country" ng-model="addEvent.CountryFiled">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="1">{{ LocationMapFixed}}</label>
                                        </div>
                                        <div class="google-map">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9732473656413!2d90.40148511445582!3d23.748333394773283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b88fd1fd672d%3A0x9ba033810adabfd1!2sSystech+Unimax+Ltd.!5e0!3m2!1sen!2sbd!4v1470807167438" width="100%" height="400px;" frameborder="1" style="border:1px solid #88C659;" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END STEP CONTENT-->

                        </fieldset>
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
                                            <label for="1">{{ EventTags}}</label>
                                            <div class="tagsinput  tag-success" id="tags1470823879022_tagsinput" style="height: 100%;">
                                                <div id="tags1470823879022_addTag" class="tagsinput-add-container">
                                                    <div class="tagsinput-add"></div>
                                                    <input data-default="" ng-keyup="myFunc()" value="" id="tags1470823879022_tag" style="color: rgb(102, 102, 102); width: 50%;" ng-model="addEvent.EventTags">
                                                </div>
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


<!--                                            <i class="fa fa-plus fa-3x"></i>
<p>
    <span for="upload" class="text-uppercase">{{ UploadCardImage}}</span>
</p>
<p class="text-primary">420px X 200px</p>
<input id="uploads_thumbke"  type="file" file-input="files"  name="card" onchange="angular.element(this).scope().imageUpload_thumble(event)">-->
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
                        {{  FINISH}}
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