
<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1" >
    <div class="card card-user">

        <div class="image">
            <img class="img" src="assets/img/background/background-2.jpg" alt="..."/>
        </div>

        <div class="content">



            <div class="author">
                <a href="user_profile_image.php" >
                    <img class="avatar" style="border: 5px solid #87CB16;" src="../upload/user_images/<?php echo $defimage;?>" alt="NO user image"/></a>
<!--                                            <p class="update">Edit</p>   -->
<!--                                            <p class="update">Update profile</p>-->

            </div>




            <ul class="list-unstyled team-members">
                <li>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <a href="edit_profile.php" class="btn btn-info  btn-fill btn-wd "><i class="fa fa-edit"></i> Edit Profile</a>
                            <a class="btn btn-info  btn-fill btn-wd" href="dashboard.php" role="button"><i class="fa fa-backward"></i> Back to Dashboard</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-user"></i></button>
                        </div>
                        <div class="col-xs-11" ng-model="usersData">
                    
                           
                            <small class="bold">Name : </small>
                            <strong  class="" name="username">{{profileData[0].fullname != " " ? profileData[0].fullname:'Sorry no data available !'}}</strong>
                        </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-envelope"></i></button>
                        </div>
                        <div class="col-xs-11" ng-model="usersData">
                    
                           
                            <small class="bold">Email : </small>
                            <strong  class="" name="username">{{profileData[0].user_email != "" ? profileData[0].user_email:'Sorry no data available !'}}</strong>
                        </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-phone"></i></button>
                        </div>
                        <div class="col-xs-11" ng-model="usersData">
                    
                           
                            <small class="bold">Phone : </small>
                            <strong  class="" name="username">{{profileData[0].user_phone != ""  ? profileData[0].user_phone:'Sorry no data available !'}}</strong>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-map-marker"></i></button>
                        </div>
                        <div class="col-xs-11" ng-model="usersData">
                    
                           
                            <small class="bold">Address : </small>
                            <strong  class="" name="username">{{profileData[0].UA_address != NULL  ? profileData[0].UA_address:'Sorry no data available !'}}</strong>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <hr>
        <div class="text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5><span class="badge badge-black">{{profileData[0].totalcart}} Iteam</span><br /><small class="bold">Cart</small></h5>
                </div>
                <div class="col-md-4">
                    <h5><span class="badge badge-black">{{profileData[0].totalwishlist}} Iteam</span><br /><small class="bold">Wishlist</small></h5>
                </div>
                <div class="col-md-4">
                    <h5><span class="badge badge-black">{{profileData[0].totalspent}}</span><br /><small class="bold">Spent</small></h5>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<!--                            <div class="col-lg-8 col-md-7">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">{{test}}</h4>
                                        <hr/>
                                    </div>
                                    <div class="content">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Username: </label>
                                                        <strong><p class="userInfo">Shanto Kumar Sarker</p></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address :</label>
                                                        <strong><p class="userInfo">shanto@systechunimax.com</p></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>First Name: </label>
                                                        <strong><p class="userInfo">Shanto Kumar</p></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name: </label>
                                                        <strong><p class="userInfo">Sarker</p></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address: </label>
                                                        <strong><p class="userInfoTextarea">Razzak Plaza (8th Floor),1 New Eskaton Road, Moghbazar Circle, Dhaka-1217</p></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>City: </label>
                                                        <strong><p class="userInfo">Dhaka</p></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Country: </label>
                                                        <strong><p class="userInfo">Bangladesh</p></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Postal Code: </label>
                                                        <strong><p class="userInfo">1202</p></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company: </label>
                                                        <strong><p class="userInfo">Systechunimax</p></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password: </label>
                                                        <strong><p class="userInfo">password</p></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>-->