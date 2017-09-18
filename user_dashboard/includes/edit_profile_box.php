

<div class="card">
    <div class="header">
        <h4 class="title">{{PersonalDetails}}</h4>
        <hr/>
        <h3>{{msg}}</h3>
    </div>
    <div class="content" >
        <form method="post" ng-model="updateUserData">
            <div class="row">
<!--                <div class="col-md-2 col-sm-3 col-md-offset-5 profileImg">
                    <a href="user_profile_image.php" >
                    <img class="img-circle img-responsive" src="../upload/user_images/<?php echo  $defimage;?>" alt="NO user image" />
                    </a>

                </div>-->
<!--   Edit option start-->
<!--            <div class="col-md-2 col-sm-3 col-md-offset-5 ">
                    <input title="Edit your image" class="edit_input" type="file" name="fileupload" value="fileupload">
                    <a href="">
                        <p class="plus" title="Edit your image">Edit Image</p>
                    </a>
                </div>-->
<!--   Edit option end-->
            </div>

            <div class=" row ">
                <div class="col-md-12 ">
                    <div class="form-group ">
                        <label>User Email</label>
                        <input type="email" class="form-control border-input " placeholder="Email"  ng-model="updateUserData.email">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <label>First Name</label>
                        <input type="text " class="form-control border-input " placeholder="first name" ng-model="updateUserData.first_name" >
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <label>Last Name</label>
                        <input type="text " class="form-control border-input " placeholder="Last Name " ng-model="updateUserData.last_name">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="form-group ">
                        <label>Address</label>
                        <textarea rows="3 " class="form-control border-input " placeholder="Here can be your Home Address " ng-model="updateUserData.address"></textarea>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 ">
                    <div class="form-group ">
                        <label>City</label>
<!--                        <input type="text " class="form-control border-input " placeholder="City " value="Melbourne ">-->
                        <select id="selectArea" class="form-control border-input" ng-model="updateUserData.city">
                            <option value=""> --- Please Select City --- </option>
                            <option ng-repeat="city in getAllCity" value="{{city.city_id}}">{{city.city_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group ">
                        <label>Country</label>
                        <!--<input type="text " class="form-control border-input " placeholder="Country " value="Australia ">-->
                        <select id="selectArea" class="form-control border-input" ng-model="updateUserData.country">
                            <option value=""> --- Please Select Country --- </option>
                            <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group ">
                        <label>Postal Code</label>
                        <input type="text" class="form-control border-input " placeholder="ZIP Code " ng-model="updateUserData.zip">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <label>Phone</label>
                        <input type="text " class="form-control border-input " placeholder="Company " ng-model="updateUserData.phone">
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <label>Password</label>
                         <!--ng-model="updateUserData.password"-->
                        <input  type="{{inputType}}" class="form-control border-input " placeholder="Password"  disabled>
<!--\\192.168.1.48\htdocs\ticketchai_aj\user_dashboard\editPassword.php-->
                    
<!--                            <input type="checkbox" id="checkbox" ng-model="passwordCheckbox" ng-click="hideShowPassword()" />
                            <span for="checkbox" ng-if="passwordCheckbox">Hide password</span>
                            <span for="checkbox" ng-if="!passwordCheckbox">Show password</span>-->
                        <a href="editPassword.php"><span for="checkbox" >Change Password</span></a>

                    </div>
                </div>
            </div>

            <br/>
            <div class="text-center ">
                <button type="submit " ng-show="update" ng-click="updateUserData(updateUserData)" class="btn btn-info btn-fill btn-wd ">Update Profile</button>

            </div>
            <div class="clearfix "></div>
        </form>
    </div>
</div>




