<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i> Upload Partners Logo</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form class="tsf-step-content">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="row-fluid">

                                <select  ng-model="eve_id" class="form-control"  data-title="Single Select">
                                    <option ng-selected="{{eve.TT_event_id}}" value="">Please Select Event</option>
                                    <option ng-repeat="eve in Evntpaymtd" value="{{ eve.TT_event_id}}">{{ eve.event_title}}</option>
                                </select>

<!--                                <select  ng-model="tt_id" class="form-control"  data-title="Single Select" style="margin-top:20px;">
    <option ng-selected="{{eventMtd.TT_id}}" value="">Please Select Ticket</option>
    <option ng-repeat="eventMtd in Evntpaymtd" ng-selected="{{ eventMtd.TT_id}}=={{ event_id}}" value="{{ eventMtd.TT_id}}">{{ eventMtd.TT_type_title}}</option>
</select>-->
                            </div>

                            <!--<label class="row-fluid">Please Select Your Partners Logo</label>-->

                            <!--[Logo upload part starts]-->
                            <div class="row"><br>
                                
                                <div class="col-md-6 col-xs-12 pull-right">
                                    <h4 class="text-center" style="margin-top:0px;">Sample Image</h4><br/>
                                    <img class="img-responsive" src=".././upload/Partner-Logo-collection.jpg" alt="sponsor img sample1"/><br/>
                                    <p class="text-center">Width: 1215px & Height: 228px</p>
                                    <img class="img-responsive" src=".././upload/Partner-Logo-collection2.jpg" alt="sponsor img sample2"/>
                                    <p class="text-center">Width: 1215px & Height: 102px</p>    
                                </div>
                                
                                <div class="col-md-6 col-xs-12 pull-left">
                                    <div ng-show="openPic"  style="display: block;" class="col-sm-4 col-sm-offset-4">
                                        <img class="img-thumbnail img-responsive img-rounded" style="max-height:150px; width: 100%;" ng-src="{{fullImage}}" />
                                        <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:6%; bottom:0%; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                                    </div>

                                    <div  ng-hide="openPic" ng-click="upload(event)">
                                        <form  ng-upload method="post"  enctype="multipart/form-data" id="event-cover-photo">
                                            <div  data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" 
                                                  data-ghost="false" data-originalsize="false" style="border:2px solid #7ac29a; border-radius: 15px;" 
                                                  class=" event-photo event-photo-cover text-center  col-sm-12" id="cover-photo">
                                                <label style="margin-top: 30px;" for="upload" class="btn btn-success">
                                                    <i class="fa fa-plus fa-3x"></i>
                                                </label>					
                                                <input id="upload" style="display:none;" type='file' file-input="files" onchange="angular.element(this).scope().imageUpload(event)" /> 
                                                <p>
                                                    <span class="text-uppercase"> Upload Sponsor Image</span>
                                                </p>
                                                <p class="text-primary">1215px X 228px</p>
                                                <div class="row" style="margin:1%;"> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                                
                            </div>
                            <!--[Logo upload part ends]-->

                            <!--<div class="row-fluid" style="margin-top: 20px;text-align: center;">-->
                            <!--                                <div class="col-md-4 ">
                                                                <button type="submit" class="btn btn-fill btn-info btn-block"  ng-click="AddPartnerImage(tt_id, eve_id)">SAVE</button>
                                                            </div>-->
                            <!--</div>-->

                            <div class="row" style="margin-top:20px;">
                                <div class="col-sm-5 col-sm-offset-3" >
                                    <button type="submit" class="btn btn-fill btn-info btn-block"  ng-click="AddPartnerImage(eve_id)">SAVE</button>
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


