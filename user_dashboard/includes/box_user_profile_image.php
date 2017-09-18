<div class="col-md-12" >
    <div class="card">
        <div class="header">

            <legend>
                <h4 class="title">Profile Image</h4>
                <code>After select image.Please wait few second,your image is processing..</code>
            </legend>

<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>

        <!-- BEGIN STEP 5-->
        <div>
            <fieldset  class="tsf-step-content">

                <div class="row">
                    <div  ng-show="openPic"  style="display: block;" class="col-sm-4 col-sm-offset-4">
                        <a href="user_profile.php"><img class="img-thumbnail img-responsive img-rounded img-circle" style="height: 340px; margin-bottom:50px; width: 100%;"   ng-src="{{fullImage}}" /></a>
                        <a href="javascript:void(0);" ng-click="clearCover()" class="label label-danger" style="position: absolute; left:40%; bottom:20%; z-index: 9999; height:auto;  width: auto;"><i class="fa fa-close"></i> Remove</a>
                        
                    </div>

                    <div   ng-hide="openPic" ng-click="upload()">
                        <form    enctype="multipart/form-data" id="event-cover-photo">

                            <div  data-image-type="cover" data-image="" data-resize="true" data-canvas="true" data-ajax="false" data-ghost="false" data-originalsize="false" style="height:250px; margin-bottom: 40px;" class="dropzone event-photo event-photo-cover text-center hidden-xs img-circle col-sm-3 col-sm-offset-4" id="cover-photo">

                                <label style="margin-top: 30px;" for="upload" class="btn btn-success">
                                    <i class="fa fa-plus fa-3x"></i>
                                </label>					
                                <input id="upload" style="display:none;" type='file' file-input="files"  class="input-xlarge" onchange="angular.element(this).scope().imageUpload(event)"/>
                                <p>
                                    <span class="text-uppercase"> Upload Profile Image</span>
                                </p>
                                <p class="text-primary">1170px X 370px</p>
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
</div>


