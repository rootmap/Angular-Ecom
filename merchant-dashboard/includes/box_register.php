<div class="col-md-8 col-md-offset-2">
    <div class="card card-wizard" id="wizardCard">
        <form id="wizardForm" method="post" ng-submit="registerinsert(registerData)">

            <div class="header text-center">
                <h5 class="title"><span class="pe-7s-note bold"></span>{{ merchantUp}} </h5>
                <h2>{{ flyshow}}</h2>
            </div>

            <div class="content">
                <ul class="nav">
                    <li><a href="#tab1" data-toggle="tab">{{ Step01}}</a></li>
                    <li><a href="#tab2" data-toggle="tab">{{ Step02}}</a></li>
                    <!--                                                <li><a href="#tab3" data-toggle="tab">{{ Step03 }}</a></li>-->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <h5 class="title text-center">{{RegistrationApproval}}</h5>
                        <div class="row margin-top-15">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label">{{ FirstName}}<star>*</star></label>
                                    <input class="form-control" required="required" aria-required="true" 
                                           type="text" 
                                           name="first_name" 
                                           autocomplete="off"
                                           placeholder="Type Your First Name"
                                           ng-model="registerData.firstName"/>
                                </div> 
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">{{ LastName}}<star>*</star></label>                                                    
                                    <input class="form-control" required="required" aria-required="true"
                                           type="text" 
                                           name="last_name" 
                                           required="true"
                                           autocomplete="off"
                                           placeholder="Type Your Last Name"
                                           ng-model="registerData.lastName"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label">{{ Email}}<star>*</star></label>
                                    <input class="form-control" type="email" 
                                           placeholder="ex: hello@ticketchai.com"
                                           ng-required="required"
                                           ng-minlength="5"
                                           ng-maxlength="50"
                                           ng-model="registerData.email"/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab2">
                        <!--                                                    <h5 class="text-center">Please give us more details about your platform.</h5>-->
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label">{{ YourAddress}}<star>*</star></label>
                                    <textarea class="form-control"  required="required" aria-required="true"
                                              name="address"
                                              required="true"
                                              autocomplete="off"
                                              placeholder="Address" ng-model="registerData.yourAddress"> 
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label">{{ Password}} <star>*</star></label>
                                    <input class="form-control" required="required" aria-required="true"
                                           name="password"
                                           id="registerPassword"
                                           type="password"
                                           required="true"
                                           ng-minlength="5"
                                           ng-maxlength="10"
                                           ng-model="registerData.password" />
                                           <span ng-show="frmv.password.$dirty && frmv.password.$error.minlength">Password is Too Short!!!</span>
                                    <span ng-show="frmv.password.$dirty && frmv.password.$error.maxlength">Password is To Long!!!</span>
                                 
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">{{ ConfirmPassword}} <star>*</star></label>
                                    <input class="form-control" required="required" aria-required="true"
                                           name="password_confirmation"
                                           id="registerPasswordConfirmation"
                                           type="password"
                                           required="true"
                                           equalTo="#registerPassword"
                                           ng-model="registerData.confirmPassword"/>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label">{{ PhoneMobileNo}}<star>*</star></label>
                                    <input class="form-control" required="required" aria-required="true"
                                           type="text" 
                                           name="phone" 
                                           required="true"
                                           number="true"
                                           maxLength="11"
                                           autocomplete="off"
                                           placeholder="ex: 01923391079"
                                           ng-model="registerData.phoneMobileNo"/>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="col-sm-6">
                                    <div class="form-group" style="font-family:Times New Roman, Times, serif">
                                        <label ng-click="InitiateCaptche()" style="cursor: pointer;" class="control-label">{{ CaptchaCode}}<star><i  title="Refresh Captcha" class="fa fa-refresh"></i></star></label>
                                        <input id="captcha_code" ng-model="registerData.captcha_code" class="form-control black-bg" 
                                               type="text" 
                                               name="captcha" 
                                               disabled=""
                                               value="GRPX21"
                                               autocomplete="off"
                                               />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Type Captcha</label>                                              
                                        <input class="form-control" required="required" aria-required="true"
                                               type="text" 
                                               name="captcha"
                                               autocomplete="off"
                                               equalTo="#captcha_code"
                                               ng-model="registerData.CaptchaCode"/>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--
                                                                    <div class="tab-pane" id="tab3">
                                                                        <h2 class="text-center text-space">{{ thankYou }} <br><small> Click on "<b>Finish</b>" to complete your "<b>Sign Up</b>" process</small></h2>
                                                                    </div>-->

                </div>
            </div>

            <div class="footer">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left" id="pre"><span class="pe-7s-angle-left-circle bold"></span> {{Back}}</button>

                    <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right" id="nxt">{{ Next}} <span class="pe-7s-angle-right-circle bold"></span></button>
                    <button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" id="fns"  ng-click="registerinsert(registerData)">{{ Finish}} <span class="pe-7s-angle-right-circle bold"></span></button>
                    <!--onclick="onFinishWizard()"-->
                </div>

                <div class="clearfix"></div>
            </div>
        </form>

    </div>                        
</div> 