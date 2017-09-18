<div class="col-lg-12 col-md-10">
    <div class="card card-user">

        <div class="image">
            <img class="img" src="assets/img/background/background-2.jpg" alt="..."/>
        </div>

        <div class="content">



            <div class="author">

                <img class="avatar" style="border: 5px solid #87CB16;" src="../upload/merchent_images/<?php echo $defimage; ?>" alt="..."/>
<!--                                            <p class="update">Edit</p>   -->
<!--                                            <p class="update">Update profile</p>-->

            </div>




            <ul class="list-unstyled team-members">
                <li>
                    <div class="row">
                        <div class="col-xs-12 text-center">
<!--                            <a href="user_edit_profile.php" class="btn btn-info  btn-fill btn-wd "><i class="fa fa-edit"></i> Edit Profile</a>-->
                            <a class="btn btn-info  btn-fill btn-wd" href="dashboard.php" role="button"><i class="fa fa-backward"></i> Back to Dashboard</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                       
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-user"></i></button>
                        </div>
                        <div class="col-xs-11" ><!--ng-model="usersData" -->
                    
                           
                            <small class="bold">Name :</small>
                            <strong  class="userInfo" name="username"> usersData[0].admin_full_name</strong>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-envelope"></i></button>
                        </div>
                        <div class="col-xs-11" ><!-- ng-model="usersData" -->
                          <small class="bold">E-mail :</small>
                         
                         
                            <strong  class="userInfo"> usersData[0].admin_email}</strong>
                        </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-phone"></i></button>
                        </div>
                        <div class="col-xs-11" > ng-model="usersData" 
                            <small class="bold">Phone :</small>
                          
                            <strong class="userInfo" >{{  usersData[0].admin_phone }}</strong>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-xs-1">
                            <button class="btn btn-sm btn-disabled btn-icon"><i class="fa fa-map-marker"></i></button>
                        </div>
                        <div class="col-xs-11">
                        <small class="bold">Address :</small>
                          
                            <strong class="userInfo">{{ usersData[0].admin_address}}</strong>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <hr>
<!--        <div class="text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5><span class="badge badge-black">1 Event</span><br /><small class="bold">Cart</small></h5>
                </div>
                <div class="col-md-4">
                    <h5><span class="badge badge-black">2 Event</span><br /><small class="bold">Wishlist</small></h5>
                </div>
                <div class="col-md-4">
                    <h5><span class="badge badge-black">24,6$</span><br /><small class="bold">Spent</small></h5>
                </div>
            </div>
        </div>-->
    </div>
</div>
<!--<div class="col-lg-8 col-md-7">
    <div class="card">
        <div class="header">
            <h4 class="title">User Profile Information</h4>
            <hr/>
        </div>
        <div class="content">
            <form ng-model="usersData">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username: </label>
                            <strong><p class="userInfo" name="username">{{ usersData[0].admin_full_name}}</p></strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address :</label>
                            <strong><p class="userInfo">{{ usersData[0].admin_email}}</p></strong>
                        </div>
                    </div>
                </div>
             
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address: </label>
                            <strong><p class="userInfoTextarea">{{ usersData[0].admin_address}}</p></strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>City: </label>
                            <strong><p class="userInfo">{{ usersData[0].admin_city}}</p></strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Country: </label>
                            <strong><p class="userInfo">{{ usersData[0].admin_country}}</p></strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Postal Code: </label>
                            <strong><p class="userInfo">{{ usersData[0].postal_code}}</p></strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company: </label>
                            <strong><p class="userInfo">{{ usersData[0].admin_company}}</p></strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password: </label>
                            <strong><p class="userInfo">{{ usersData[0].admin_password}}</p></strong>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>

    </div>
</div>-->