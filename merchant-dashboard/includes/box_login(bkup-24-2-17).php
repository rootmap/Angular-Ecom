<form method="#" action="javascript:void(0);" name="frmv" class="ng-dirty ng-valid ng-valid-email" ng-submit="loginInsert(loginData)">

    <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
    <div class="card" style=" -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);
         -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);
         box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);">
        <div class="header text-center bold bg-primary" style="top: -25px; margin-bottom: -50px; /*background-color: rgba(135, 203, 22, 100);*/ -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);
             -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);
             box-shadow: 0px 0px 5px 0px rgba(0,0,0,1);">
            <span class="pe-7s-unlock bold"></span>Organizer Login
            <p style="margin-bottom:10px !important;">(Login To Create/Manage Your Events)</p>
            <h6>&nbsp;</h6>
        </div>
        <div class="header text-center bold" style="top: -25px; margin-bottom: -50px;">
            <h4>{{ msg}}</h4>
            <div class="form-group text-center">
                <a href="#!" class="btn btn-outline btn-facebook" onclick="facebookLogin()">
                    <i class="fa fa-facebook-square"></i> Facebook Login 
                </a>
                <a href="#!" class="btn btn-outline btn-google" onclick="googleLogin()">
                    <i class="fa fa-google-plus"></i> Google Login
                </a>
            </div>
            <!--            <div class="form-group text-center">
                            <a href="#!" class="btn btn-outline btn-facebook btn-block">
                                <i class="fa fa-facebook-square"></i> Login With Facebook
                            </a>
                            <a href="#!" class="btn btn-outline btn-google btn-block">
                                <i class="fa fa-google-plus"></i> Login With Google
                            </a>
                        </div>-->
            <p style="margin-bottom:10px !important; font-weight: bold;">----- OR -----</p>
<!--            <p style="margin-bottom:10px !important;">{{ Ifyoualreadyhaveanaccount}}</p>-->

        </div>
        <div class="content">
            <div class="form-group">
                <label>Email address</label>
                <input class="form-control" required aria-required="true"
                       type="email" 
                       name="email" 
                       email="true"
                       autocomplete="off"
                       placeholder="ex: hello@ticketchai.com" class="ng-dirty ng-valid ng-valid-email" ng-model="loginData.Emailaddress" required />
                <span ng-show=" frmv.Emailaddress.$dirty && frmv.Emailaddress.$error.required">*Required</span>
                <span ng-show=" frmv.Emailaddress.$dirty && frmv.Emailaddress.$error.Emailaddress">Not an  E-mail</span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control"
                       name="password"
                       type="password"
                       required="true"
                       ng-minlength="5"
                       ng-maxlength="10"
                       placeholder="Password" ng-model="loginData.Password"  required />
                <span ng-show="frmv.password.$dirty && frmv.password.$error.required">*Required</span>
<!--                <span ng-show="frmv.password.$dirty && frmv.password.$error.minlength">Password is Too Short!!!</span>
                <span ng-show="frmv.password.$dirty && frmv.password.$error.maxlength">Password is To Long!!!</span>
                -->
            </div>                                    
            <div class="form-group">
                <div class="col-sm-8">
                    <label for="checkbox1" class="checkbox">
                        <span class="icons"><span class="first-icon fa fa-square"></span><span class="second-icon fa fa-check-square "></span></span><input type="checkbox" data-toggle="checkbox" id="checkbox1" value="" ng-model="loginData.Subscri">
                        Subscribe to newsletter
                    </label>
                </div>
                <div class="col-sm-4 bold">
                    <a href="register.php" style="line-height: 43px; color: #1F3A93;">
                        <span class="pe-7s-user bold"></span> Register
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="footer text-center" style="padding-top: 0px !important;">
<!--            <button type="submit" class="btn btn-fill btn-success btn-wd btn-round" ng-click="loginInsert(loginData)" ng-disabled="frmv.$invalid">{{ Login}}<span class="pe-7s-angle-right-circle bold"></span></button>-->
            <button type="submit" class="btn btn-fill btn-success btn-wd btn-round" ng-click="loginInsert(loginData)">{{ Login}}<span class="pe-7s-angle-right-circle bold"></span></button>
        </div>
    </div>

</form>