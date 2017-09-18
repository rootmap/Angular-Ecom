<div class="card">
    <div class="header">
        <h4 class="title">{{ PersonalDetails}}</h4>
        <hr/>
        <h2>{{ flyshow }}</h2>
       
    </div>
    <div class="content">
        <div class="row">

            <div class="col-lg-8 col-md-7">
                <form method="post" ng-model="userUIDEdit" ng-submit="userinsert(userprofileData)">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ Username}}</label>
                                <input type="text" class="form-control border-input" placeholder="Username" value="michael23" ng-model="userUIDEdit.username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ Emailaddress}}</label>
                                <input type="email" class="form-control border-input" ng-readonly="true" placeholder="Email" ng-model="userUIDEdit.emailaddresss">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ FirstName}}</label>
                                <input type="text" class="form-control border-input" placeholder="Company" value="Chet" ng-model="userUIDEdit.firstName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ LastName}}</label>
                                <input type="text" class="form-control border-input" placeholder="Last Name" value="Faker" ng-model="userUIDEdit.lastName">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ Address}}</label>
                                <textarea rows="3" class="form-control border-input" placeholder="Here can be your Home Address" value="Address" ng-model="userUIDEdit.address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ City}}</label>
                                <input type="text" class="form-control border-input" placeholder="City" value="Melbourne" ng-model="userUIDEdit.city">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ Country}}</label>
                                <input type="text" class="form-control border-input" placeholder="Country" value="country" ng-model="userUIDEdit.country">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ PostalCode}}</label>
                                <input type="text" class="form-control border-input" placeholder="ZIP Code" ng-model="userUIDEdit.postalCode">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ Company}}</label>
                                <input type="text" class="form-control border-input" placeholder="Company" value="company" ng-model="userUIDEdit.company">
                            </div>
                        </div>
<!--                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ Password}}</label>
                                <input type="password" class="form-control border-input" placeholder="Password" value="" ng-model="userUIDEdit.password">
                            </div>
                        </div>-->
                    </div>
                    <br/>
                    <div class="text-center">
                        <button type="submit" ng-show="!update"  ng-click="userinsert(userUIDEdit)" class="btn btn-info btn-fill btn-wd">{{ saveProfile}}</button>
                        <button type="submit" ng-show="update" ng-click="UpdateUsaerData(userUIDEdit)" class="btn btn-info btn-fill btn-wd">{{ UpdateProfile}}</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div >
        </div>
    </div> 

</div>