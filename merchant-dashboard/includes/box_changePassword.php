<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow }}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i>Change Password</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div> 
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form class="tsf-step-content" ng-model="FixedPassword">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                        
                            
                            <div class="form-group">
                                <label for="1">Old Password</label>
                                <input type="password" class="form-control" id="1" name="OldPassword" placeholder="Old Password..." value="" required  ng-model="FixedPassword.OldPassword">
                            </div>
                            <div class="form-group">
                                <label for="1">New Password</label>
                                <input type="password" class="form-control" id="1" name="NewPassword" placeholder="New Password..." value=""  required  ng-model="FixedPassword.NewPassword">
                            </div>
                            <div class="form-group">
                                <label for="1">Re-Type Password</label>
                                <input type="password" class="form-control" id="1" name="ReTypePassword" placeholder="Retype New Password..." value=""  required  ng-model="FixedPassword.ReTypePassword">
                            </div>
                        
                           
                       

                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">
                                   
                                    <button type="button" value="save" ng-click="DataSave(FixedPassword);" class="btn btn-fill btn-info btn-block">SAVE</button>
                                   
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

