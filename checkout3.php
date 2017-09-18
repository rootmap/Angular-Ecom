<?php
include './cms/plugin.php';
$cms = new plugin();
?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <script sr="map.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>

        <?php
        echo $cms->pageTitle("Checkout3 | Ticketchai.com...");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("checkout3"));
        ?>




                <!-- mahedi create costom CSS Files start-->
                <link rel="stylesheet" href="assets/css/checkout3.css">
                <!--        <link rel="stylesheet" type="text/css" href="assets/css/style.css">-->
                <!--<link rel="stylesheet" type="text/css" href="assets/css/simply-toast.min.css">
        <!-- For custom design -->
                <!-- <link rel="stylesheet" type="text/css" href="assets/css/customs.css">
        <!-- mahedi create costom CSS Files start-->
<style>
     #map_canvas {
                        margin: 0;
                        padding: 0;
                        height: 400px;
                        border: 1px solid #ccc;
                    }
</style>


    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="checkout3Controller">
         <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>

            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:90px;">
                        <div class="clearfix"></div>
                        <!-- sitemap section starts here -->
                        <div class="section-simple2 ">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-left" id="according_start">
                                        <div id="accordion" role="tablist" aria-multiselectable="true" stye="padding:15px;">

                                            <div class="row p1">

                                                <div class="panel panel-default  pane1" style="">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title ">
                                                    <a data-toggle="collapse" data-parent="#accordion"role="button" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="ph_one">
                                                        <span class="h_lebel">1</span><b> {{checkoutOne}}</b><span class="h_icon pull-right"><i class="fa fa-chevron-down"></i></span>
                                                    </a>
                                                </h4>
                                                    </div>

                                                    

                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="col-md-6" id="panelOne_body">
                                                            <div class="col-inside">
                                                                <h4 class="col-title-h3"><b>{{signin_text}}</b></h4>
                                                                <div class="form-group-icon col-md-6 col-sm-6 col-xs-12 pull-left">
                                                                    <a href="javascript:void(0);" onclick="facebookLogin();" class="btn btn-block btn-success" style="outline: none;background:rgb(35, 82, 125) none repeat scroll 0% 0%;color:#fff">
                                                                        <i class="fa fa-facebook"></i> {{btn_fb}}
                                                                    </a>
                                                                </div>
                                                                <div class=" col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                    <a href="javascript:void(0);" onclick="googleLogin();" style="background-color: #dd4b39 !important; border-color: #dd4b39; outline: none;" class="btn btn-block btn-facebook">
                                                                        <i class="fa fa-google-plus"></i> {{btn_g}}+
                                                                    </a>
                                                                </div>
                                                                <br/>
                                                                <div class="clearfix"></div>
                                                                <h4 class="text-center">{{or_text}}</h4>
                                                                <form class="sign-form" name="signinForm" ng-submit="userSignin(userId,userPass)">
                                                                    <div class="form-group has-success has-feedback">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                                            <input type="text" ng-model="userId" name="userId" class="form-control" id="inputGroupSuccess1" placeholder="   Id/Email Address" required>
                                                                        </div>
                                                                        <span style="color:red" ng-show="signinForm.userId.$dirty && signinForm.userId.$invalid">
                                                                        <span ng-show="signinForm.userId.$error.required">Username is required.</span>
                                                                    </div>

                                                                    <div class="form-group has-success has-feedback">
                                                                    
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                            <input type="password" ng-model="userPass" class="form-control" name="userPass" placeholder="    Password"  required>
                                                                        </div>
                                                                        <span style="color:red" ng-show="signinForm.userPass.$dirty && signinForm.userPass.$invalid">
                                                                        <span ng-show="signinForm.userPass.$error.required">Password is required.</span>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary btn-block" ng-disabled="!signinForm.$valid" style="border:1px solid#75bd47;color:#333"  id="clickSignIn"><strong>{{btn_login}}</strong></button>
                                                                </form>
                                                                <div class="remind-bar clearfix">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm-6"></div>
                                                                        <div class="col-md-6 col-sm-6 text-right">
                                                                            <a href="reset_password.php">{{lost_pass}}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" id="panelOne_body">
                                                            <div class="col-inside">
                                                                <h4 class="col-title-h3"><b>{{createNewAcc}}</b></h4>
                                                                <form class="sign-form" name="myForm">

                                                                    <div class="form-group has-success has-feedback">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                            <input type="text" class="form-control" id="inputGroupSuccess1" ng-model="info.name" placeholder="  Your Name" name="name" required>
                                                                            
                                                                        </div>
                                                                        <span style="color:red" ng-show="myForm.name.$dirty && myForm.name.$invalid">
                                                                        <span ng-show="myForm.name.$error.required">Username is required.</span>
                                                                    </div>
                                                                    <div class="form-group has-success has-feedback">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                                            <input type="email" class="form-control" id="inputGroupSuccess1" ng-model="info.email" placeholder="  Email Address" name="email" required> 
                                                                            
                                                                        </div>
                                                                        <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
                                                                        <span ng-show="myForm.email.$error.required">Email is required.</span>
                                                                        <span ng-show="myForm.email.$error.email">Invalid email address.</span>
                                                                    </div>

                                                                    <div class="form-group has-success has-feedback">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                            <input type="password" class="form-control" id="inputGroupSuccess1" ng-model="info.pass" placeholder="  Password" name="pass" required>
                                                                        </div>
                                                                         <span style="color:red" ng-show="myForm.pass.$dirty && myForm.pass.$invalid">
                                                                        <span ng-show="myForm.pass.$error.required">password is required.</span>
                                                                        
                                                                    </div>
                                                                    <div class="form-group has-success has-feedback">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                            <input type="password" class="form-control" id="inputGroupSuccess1" ng-model="info.con_pass" placeholder="  confirm Password" name="con_pass" required>
                                                                            
                                                                        </div>
                                                                         <span style="color:red" ng-show="myForm.con_pass.$dirty && info.pass!=info.con_pass">
                                                                         <span ng-show="myForm.con_pass.$dirty "></span> 
                                                                        <span style="color:red" ng-show="info.pass!=info.con_pass">password not matched!!</span>

                                                                    </div>

                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" ng-model="info.checked" name="optionsCheckboxes" ng-value="chk">{{terms}} <a target="_blank" href="sitemap-terms.php">{{terms2}}</a>
                                                                        </label>
                                                                    </div>
                                                                    <br/>
                                                                    <button type="button" ng-click="registerUser(info)" ng-hide="!info.checked" class="btn btn-primary btn-block btn-signup" style="border:1px solid#75bd47;color:#333"><strong>{{signup}}</strong></button>
                                                                    <button type="button" ng-click="info()" ng-show="!info.checked" class="btn btn-primary btn-block btn-signup" style="border:1px solid#75bd47;color:#333"><strong>{{signup}}</strong></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p2">
                                                <div class="panel panel-default panel2" style="">
                                                    <div class="panel-heading " role="tab" id="headingTwo">
                                                        <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" id="ph_one">
                                                        <span class="h_lebel">2</span> <b>{{checkoutTwo}}</b><span class="h_icon pull-right"><i class="fa fa-chevron-down"></i></span>
                                                    </a>
                                                </h4>
                                                    </div>
                                                    <div id="collapseTwo" class=" collapseTwo panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h4 class="text-left"><i class="fa fa-map-marker"></i>{{selectAdd}}</h4>
                                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 radio" ng-show="homeDelivery=='yes'">
                                                                <input type="radio" name="accordion-group" id="option-1" value="r-1" />
                                                                <label for="option-1">
                                                                    <p class="radio-lebel">{{have_tickets}}</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 radio" ng-show="pickFromOffice=='yes'">
                                                                <input type="radio" name="accordion-group" id="option-2" value="r-2" />
                                                                <label for="option-2">
                                                                    <p class="radio-lebel">{{pick_from}}</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 radio" ng-show="isPickable=='yes'">
                                                                <input type="radio" name="accordion-group" id="option-3" value="r-3" />
                                                                <label for="option-3">
                                                                    <p class="radio-lebel">{{venue}}</p>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 add_left" >
                                                            <h4 class="col-title-h4 pull-left">{{select_billingAdd}}</h4>
                                                            <h4 class="pull_left_title">{{your_add}}</h4>
                                                            <br>
                                                            <form action="" style=" ">

                                                                <div class="form-group text_area">
                                                                    <textarea class="form-control" placeholder="Here can be your nice text" id="UA_billing_address" type="text" ng-model="address" ></textarea>
                                                                    <!-- <textarea class="form-control" placeholder="Here  your nice text " id="UA_billing_address "  ng-hide="address.UA_address!=''" type="text"></textarea> -->
                                                                </div>

                                                                <div class="form-group text_area">
                                                                    <label for="sel1">City:</label>
                                                                    <select class="form-control" id="sel1" ng-model="city_id" >   
                                                                        <option selected>{{city}} </option>
                                                                        <option  ng-repeat="city in getAllCity" value="{{city.city_id}}">{{city.city_name}}</option>

                                                                    </select>
                                                                </div>
                                                                <div class="form-group text_area" >
                                                                    <label>Zip/Postal Code: </label>
                                                                    <input type="text" ng-model="zip"  placeholder=" zip/postal code" class="form-control" />
                                                                   <!--  <input type="text" ng-hide="address.UA_zip!=''" value="{{address.UA_zip}}" placeholder=" zip/postal code2" class="form-control" /> -->
                                                                </div>
                                                                <div class="form-group text_area" >
                                                                    <label for="sel1">Country:</label>
                                                                    <select class="form-control" id="sel1"  ng-model="country_id">
                                                                        <option selected>{{country}}</option>
                                                                        <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group text_area">
                                                                    <label>Phone: </label>
                                                                    <input type="text" ng-model="phone" placeholder="01680895968" class="form-control" />
                                                                </div>
                                                                <div class="checkbox" id="isRadioChecked" style="display:none">
                                                                    <label>
                                                                        <input type="checkbox" name="optionsCheckboxes" ng-click="makeShippingAdd(address,city_id,zip,country_id,phone,UA_id,UA_user_id)"> {{checkbox_makeAdd}}
                                                                    </label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right" style="margin-top:5.5%;border-left:1px solid#77C048;border-left-style: dashed;">
                                                            <div class="radio_one box" style="display:none">
                                                                <h4 class="pull_left_title">{{your_add2}}</h4>

                                                                <form action="" >

                                                                    <div class="form-group text_area">
                                                                    <textarea class="form-control" placeholder="Here can be your nice text" id="UA_billing_address" type="text" ng-model="add" ></textarea>
                                                                    <!-- <textarea class="form-control" placeholder="Here  your nice text " id="UA_billing_address "  ng-hide="address.UA_address!=''" type="text"></textarea> -->
                                                                </div>

                                                                <div class="form-group text_area">
                                                                    <label for="sel1">City:</label>
                                                                    <select class="form-control" id="sel1"  ng-model="city_id" ng-change="getDeliveryCostResult(city_id)" >   
                                                                        <option selected=>select city</option>
                                                                        <option ng-repeat="city in getAllCity"  value="{{city.city_id}}">{{city.city_name}}</option>

                                                                    </select>
                                                                </div>
                                                                <div class="form-group text_area" >
                                                                    <label>Zip/Postal Code: </label>
                                                                    <input type="text" ng-model="s_zip"  placeholder=" zip/postal code" class="form-control" />
                                                                   <!--  <input type="text" ng-hide="address.UA_zip!=''" value="{{address.UA_zip}}" placeholder=" zip/postal code2" class="form-control" /> -->
                                                                </div>
                                                                <div class="form-group text_area" >
                                                                    <label for="sel1">Country:</label>
                                                                    <select class="form-control" id="sel1"  ng-model="country_id">
                                                                        <option selected>{{country}}</option>
                                                                        <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group text_area">
                                                                    <label>Phone: </label>
                                                                    <input type="text" ng-model="s_phone" placeholder="01680895968" class="form-control" />
                                                                </div>
                                                                    <button id="next" style="display:block;background: #88C659!important;color:#333"  type="button" class="btn btn-primary"><strong>NEXT <i class=" fa fa-angle-right"></i></strong></button>
                                                                </form>
                                                            </div>
                                                            <div>
                                                                <div class="radio_two box" id="pickPointVenue" style="display: none;margin-top: 8% !important;">
                                                                    <h4 text-left>{{venue_add}}</h4>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="optionsRadios">
                                                                            <i class="fa fa-map-marker"></i>{{venue_add2}}
                                                                        </label>
                                                                    </div>

                                                                    <div class="clearfix"></div>
                                                                    <br>
                                                                    <!--here goes button next-->
                                                                    <div class="form-group">
                                                                        <button style="display: block; background:#88C659 !important;" id="sbtopm1" onclick="javscript:verifyAddressID();" name="submitAddress" type="button" class="btn btn-primary btn-md btn-block "><strong>{{btn_continue}} <i class="fa fa-angle-right"></i></strong></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="radio_three box" style="display:none;margin-bottom:1%">
                                                                <h4 style="margin-top: 8% !important;">Our Venue Address</h4>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 map">
                                                                    <h3>{{details[0].venue_address}}</h3>
                                                    <map id="map_canvas"></map>
                                                                    <br>
                                                                </div>
                                                                <div style="margin-top:4% !important;">
                                                                    <br>
                                                                    <h4>{{office_add}}</h4>
                                                                    <p><i class="fa fa-map-marker"></i>{{office_add2}}</p>
                                                                    <p><i class="fa fa-phone">{{office_add3}}</i></p>

                                                                </div>
                                                                <div class="form-group">
                                                                    <!--here goes button next-->
                                                                    <button style="display:block;background: #88C659!important;" id="sbtopm1" onclick="javscript:verifyAddressID();" name="submitAddress" type="button" class="btn btn-primary btn-md btn-block "><strong>{{btn_continue2}} <i class=" fa fa-angle-right"></i></strong></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p3">
                                                <div class="panel panel-default panel3" style="overflow-hidden">
                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                    <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="ph_one">
                                                        <span class="h_lebel">3</span><b> {{checkoutThree}}</b><span class="pull-right h_icon"><i class="fa fa-chevron-down"></i></span>
                                                    </a>
                                                </h4>
                                                    </div>
                                                    <div id="collapseThree" class="collapseThree panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="col-md-12 col-sm-12 pull-left" style="overflow:hidden">
                                                            <h3 class="pull-left">{{payment_method}}</h3>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 pull-left" style="padding: 15px;">
                                                            <div class="col-pay">
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio"  ng-model="checkStatus" name="optionsRadios" ng-value='1'>
                                                                        <i style="font-size: large;" class="fa fa-credit-card"></i>&nbsp;&nbsp;{{online_payment}}
                                                                    </label>
                                                                </div>
                                                                <hr>
                                                                <div>
                                                                    {{online_paymentText}}
                                                                </div>

                                                            </div>
                                                            <div class="col-pay">
                                                                <div class="radio">
                                                                    <br>
                                                                    <label>
                                                                        <input type="radio" ng-model="checkStatus" name="optionsRadios" ng-value='2'>
                                                                        <i style="font-size: large;" class="fa fa-mobile fa-lg"></i>&nbsp;&nbsp;{{bkash_payment}}
                                                                    </label>
                                                                    <hr>
                                                                </div>
                                                                                                                                <div>
                                                                    {{bkash_paymentText}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right" style="padding: 15px;">
                                                            <div class="col-pay">
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio"  ng-model="checkStatus" name="optionsRadios" ng-value='3'>
                                                                        <i style="font-size: large;" class="fa fa-exchange"></i>&nbsp;&nbsp;{{cash_onDelivery}}
                                                                    </label>
                                                                </div>
                                                                <hr>
                                                                <div>
                                                                    {{cash_onDeliveryText}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button style="background: #88C659 !important;" id="paymentbtn" ng-disabled="!checkStatus" type="button" ng-click="verifyPayment(checkStatus)" class="btn btn-default btn-primary btn-lg btn-block pull-right next2"><strong>{{btn_continue3 }}<i class="fa fa-angle-right"></i></strong></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right cart_summary" style="">
                                        <div class="sidebar-cart">
                                            <h4 class="sidebar-title-cart">{{cart_summary}}</h4>
                                            <div class="table-responsive">
                                            <table class="table table-cart-summary table-custom-padd">
                                                <tbody>
                                                    <tr>
                                                        <td><i class="fa fa-ticket"></i></td>
                                                        <td>{{cart_tblH1}}</td>
                                                        <td id="s_ticket_quantity">{{totalQuantity+0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-ticket"></i></td>
                                                        <td>{{cart_tblH2}}</td>
                                                        <td id="s_ticket_total_amount" class="hahahehe">{{totalPrice() | currency}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-bullhorn"></i></td>
                                                        <td>Total Include Quantity</td>
                                                        <td id="s_include_quantity">0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-bullhorn"></i></td>
                                                        <td>Total Include Price</td>
                                                        <td id="s_include_total_amount" class="hahahehe">0.00</td>
                                                    </tr>


                                                    <tr class="hidecost">
                                                        <td><i class="fa fa-bullhorn"></i></td>
                                                        <td>Vat(10.00%)</td>
                                                        <td id="extra_cost_total_14">10.00</td>
                                                    </tr>
                                                    <tr class="hidecost">
                                                        <td><i class="fa fa-bullhorn"></i></td>
                                                        <td>Extra API (5.00%)</td>
                                                        <td id="extra_cost_total_15">5.00</td>
                                                    </tr>

                                                    <tr id="show_cod_cost" class="hidecost_city_delivery">
                                                        <td><i class="fa fa-truck"></i></td>
                                                        <td>Delivery Charge</td>
                                                        <td id="s_cod_cost">{{cost-0}}</td>
                                                    </tr>
    
                                                    <tr id="s_total_amount_row">
                                                        <td colspan="2" style="font-weight: bolder; font-size: 14px;"><i class="fa fa-money">&nbsp;&nbsp;</i>{{cart_tblH9}}</td>
                                                        <td>
                                                            <h4><strong>{{+cost+totalPrice() | currency}}</strong></h4>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                </div>-->
                            <!--            </div>-->

                            <div class="clearfix"></div>
                            <!-- ticketchai simple section starts here -->
                            <div class="section section-simple-close">
                                <div class="container">
                                    <div class="row section_padd60">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include 'include/footer.php';?>

                </div>

                <?php echo $cms->fotterJs(array('checkout3'));?>
                    <?php echo $cms->angularJs(array('checkout3_angular'));?>

                     <<!-- script>
                            $(document).ready(function(){
                                $(".collapseThree").removeClass("in");
                                $("#next").click(function(){
                                    $(".collapseThree").addClass("in");
                                    $(".collapseTwo").removeClass("in");
                                });
                            });
                        </script>
 -->

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#subscription').hide();
                                setTimeout(function (a) {
                                    $('#subscription').slideDown(1000);
                                }, 15000);
                                setTimeout(function (b) {
                                    $('#subscription').slideUp(3000);
                                }, 30000);
                                $('#btn-sclose').click(function () {
                                    $('#subscription').slideUp(1000);
                                });

                                $('#nav-search-btn').click(function () {
                                    $('#nav-search-field').show();
                                    $('#nav-search-btn').hide();
                                });
                                $('#nav-search-close').click(function () {
                                    $('#nav-search-field').hide();
                                    $('#nav-search-btn').show();
                                });
                            });

                            setTimeout(function () {
                                $('#odometer1').html('50');
                                $('#odometer2').html('100');
                                $('#odometer3').html('200');
                                $('#odometer4').html('10000');
                            }, 1000);
                        </script>
                        <!--  Select Picker Plugin -->

                        <!--for collapse active -->
                       <script type="text/javascript">
                            // $(document).ready(function () {

                            //     $('.panel').on('show.bs.collapse', function (e) {
                            //         var heading = $(this).find('.panel-heading');
                            //         heading.addClass("active-panel");
                            //     });

                            //     $('.panel').on('hidden.bs.collapse', function (e) {
                            //         var heading = $(this).find('.panel-heading');
                            //         heading.removeClass("active-panel");
                            //     });
                            // });
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('input[type="radio"]').click(function () {
                                    if ($(this).attr("value") == "r-1") {
                                        $(".box").not(".radio_one").hide();
                                        $(".radio_one").show('50');
                                        $("#isRadioChecked").show();
                                    }
                                    if ($(this).attr("value") == "r-2") {
                                        $(".box").not(".radio_two").hide();
                                        $(".radio_two").show('50');
                                        $("#isRadioChecked").show();
                                    }
                                    if ($(this).attr("value") == "r-3") {
                                        $(".box").not(".radio_three").hide();
                                        $(".radio_three").show('50');
                                        $("#isRadioChecked").show();
                                    }
                                });
                            });



                        </script>



                 <?php
        if (isset($_SESSION['USER_DASHBOARD_USER_ID'])) {
            $userID =$_SESSION['USER_DASHBOARD_USER_ID'];
            if (isset($userID)) {
                ?>
                <script>
                                                            
                    $(document).ready(function () {
         
                        $('#collapseOne').removeClass('in');
                        $('#headingOne').removeClass('active-panel');
                        $('#collapseTwo').addClass('in');
                        $('#headingTwo').addClass('active-panel');
                        $('#collapseThree').removeClass('in');
                        $('#headingThree').removeClass('active-panel');

                        $('#accordion > .panel').on('show.bs.collapse', function (e) {
                            var heading = $(this).find('.panel-heading');
                            heading.addClass("active-panel");
                            //setProgressBar(heading.get(0).id);
                        });

                        $('#accordion > .panel').on('hidden.bs.collapse', function (e) {
                            var heading = $(this).find('.panel-heading');
                            heading.removeClass("active-panel");
                            //setProgressBar(heading.get(0).id);
                        });

                        load_default_bill_ship_detail = {'user_id': '<?php echo $userID; ?>'};
                        ticketchai.post('shipping_billing.php', load_default_bill_ship_detail, function (data) {
                            $('#shipbilldata').html(data);
                        });

                        load_payment_method = {'user_id': '<?php echo $userID; ?>'};
                        ticketchai.post('payment_method.php', load_payment_method, function (datas) {
                            $('#paymentmethod').html(datas);
                        });

//                        load_confirmation = {'user_id': '<?php //echo $userID;  ?>'};
//                                ticketchai.post('confirmation.php', load_confirmation, function (datasc) {
//                                $('#confirmation').html(datasc);
//                            });

                        $('#collapse-h1').click(function () {
                            error("Please Fillup Your Detail first.");
                        });
                        $('#collapse-h2').click(function () {
                            error("Please Fillup Your Detail first.");
                        });
                        $('#collapse-h3').click(function () {
                            error("Please Fillup Your Detail first.");
                        });


                    });
                </script>
                <?php
            }
        } else {
            ?>
            <script>
               
                $(document).ready(function () {
                    $('#collapseOne').addClass('in');
                    $('#headingOne').addClass('active-panel');
                    $('#collapseTwo').removeClass('in');
                    $('#headingTwo').removeClass('active-panel');
              

                    $('#accordion > .panel').on('show.bs.collapse', function (e) {
                        var heading = $(this).find('.panel-heading');
                        heading.addClass("active-panel");
                        //setProgressBar(heading.get(0).id);
                    });

                    $('#accordion > .panel').on('hidden.bs.collapse', function (e) {
                        var heading = $(this).find('.panel-heading');
                        heading.removeClass("active-panel");
                        //setProgressBar(heading.get(0).id);
                    })

                });
            </script>
            <?php
        }
        ?>

    </body>

    </html>