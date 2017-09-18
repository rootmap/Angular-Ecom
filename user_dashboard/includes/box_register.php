<div class="col-md-8 col-md-offset-2">
                                <div class="card card-wizard" id="wizardCard">
                                    <form id="wizardForm" method="" action="">

                                        <div class="header text-center">
                                            <h5 class="title"><span class="pe-7s-note bold"></span>{{userSignup}}</h5>
                                            <!--msg-->
                                            <!--<h3></h3>-->
                                            <!--msg-->
                                        </div>

                                        <div class="content">
                                            <ul class="nav">
                                                <li><a href="#tab1" data-toggle="tab">Step - 01</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Step - 02</a></li>
                                                <li><a href="#tab3" data-toggle="tab">Step - 03</a></li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane" id="tab1">
                                                    <h5 class="title text-center">Dear User, Please Provide Your Credential - For Login / Registration Approval</h5>
                                                    <div class="row margin-top-15">
                                                        <div class="col-md-5 col-md-offset-1">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name<star>*</star></label>
                                                                <input class="form-control" required="required" aria-required="true" 
                                                                       type="text" 
                                                                       name="first_name" 
                                                                       autocomplete="off"
                                                                       placeholder="Your First Name"
                                                                       ng-model="registerData.ufirstName"
                                                                       />
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name<star>*</star></label>                                                    
                                                                <input class="form-control" required="required" aria-required="true"
                                                                       type="text" 
                                                                       name="last_name" 
                                                                       required="true"
                                                                       autocomplete="off"
                                                                       placeholder="Your Last Name"
                                                                       ng-model="registerData.ulastName"
                                                                       />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <div class="form-group">
                                                                <label class="control-label">Email<star>*</star></label>
                                                                <input class="form-control" required="required" aria-required="true"
                                                                       type="text" 
                                                                       name="email" 
                                                                       email="true"
                                                                       autocomplete="off"
                                                                       placeholder="ex: hello@ticketchai.com"
                                                                       ng-model="registerData.uEmail"
                                                                       />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="tab2">
                                                    <!--                                                    <h5 class="text-center">Please give us more details about your platform.</h5>-->
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <div class="form-group">
                                                                <label class="control-label">Your Address<star>*</star></label>
                                                                <textarea class="form-control"  required="required" aria-required="true"
                                                                          name="address"
                                                                          required="true"
                                                                          autocomplete="off"
                                                                          placeholder="Your Present Addres"
                                                                          ng-model="registerData.uAddress"
                                                                          > 
                                                                          
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-5 col-md-offset-1">
                                                            <div class="form-group">
                                                                <label class="control-label">Password <star>*</star></label>
                                                                <input class="form-control" required="required" aria-required="true"
                                                                       name="password"
                                                                       id="registerPassword"
                                                                       type="password"
                                                                       required="true"
                                                                       ng-model="registerData.uPassword"
                                                                       />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Confirm Password <star>*</star></label>
                                                                <input class="form-control" required="required" aria-required="true"
                                                                       name="password_confirmation"
                                                                       id="registerPasswordConfirmation"
                                                                       type="password"
                                                                       required="true"
                                                                       equalTo="#registerPassword"
                                                                       ng-model="registerData.uConfirmPassword"
                                                                       />
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-5 col-md-offset-1">
                                                            <div class="form-group">
                                                                <label class="control-label">Phone/Mobile No.<star>*</star></label>
                                                                <input class="form-control" required="required" aria-required="true"
                                                                       type="text" 
                                                                       name="phone" 
                                                                       required="true"
                                                                       number="true"
                                                                       maxLength="11"
                                                                       autocomplete="off"
                                                                       placeholder="ex: "
                                                                       ng-model="registerData.uPhone"
                                                                       />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Captcha Code<star>*</star></label>
                                                                    <input id="captcha_code" class="form-control black-bg" 
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
                                                                    <label class="control-label">&nbsp;</label>                                              
                                                                    <input class="form-control" required="required" aria-required="true"
                                                                           type="text" 
                                                                           name="captcha"
                                                                           autocomplete="off"
                                                                           equalTo="#captcha_code"
                                                                           ng-model="registerData.uCaptchaCode"
                                                                           />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="tab3">
                                                    <h2 class="text-center text-space">Thank You! <br><small> Click on "<b>Finish</b>" to complete your "<b>Sign Up</b>" process</small></h2>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="footer">
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left"><span class="pe-7s-angle-left-circle bold"></span> Back</button>

                                                <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next <span class="pe-7s-angle-right-circle bold"></span></button>
                                                <button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" ng-click="registerDataInsert(registerData)">Finish <span class="pe-7s-angle-right-circle bold"></span></button>
                                            </div>
                                                   <!--onclick="onFinishWizard()"-->
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>

                                </div>                        
                            </div>
