<div class="card" ng-show="maincard">
    <div class="card padding_top15">
        <div class="clearfix"></div>




        <div ng-repeat="x in getAddressData">
            <div class="row" >
                <div class="col-lg-4 col-md-12 col-xs-12 address_panel">
                    <h4 class="address_h4 text-left">&nbsp;&nbsp;&nbsp;{{x.UA_title}}</h4>
                    <blockquote class="address_blo">

                        <p class="address_p">{{x.UA_address}}, {{x.city_name}}</p>
                        <p class="address_p">{{x.country_name}}</p>
                        <p class="address_p">phone: {{x.UA_phone}}</p>
                        <p class="address_p">Zip/Postal Code: {{x.UA_zip}}</p>
                    </blockquote>

                    <div class="row edit_button">
                        <div class="col-md-6">
                            <a id="edit" >
                                <button class="btn btn-info btn-block show" ng-click="editAddress(x)">Edit</button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button style="margin-left:0px;" class="btn btn-danger btn-block" type="submit" ng-click="deleteUserAddress(x.UA_id)">Delete</button>
                        </div>
                    </div>




                </div>

            </div>

            <div class="row label" >
                <div class="col-md-6" >

                    <label style="margin-top:10px;" class="" ng-click="getType(x.UA_id, 'shipping')">
                        <input style="" id="checkbox1" value="" type="checkbox" >
                        <span style="color:black;">Default Delivery</span> 
                    </label>


                </div>
                <div class="col-md-6" >
                    <label style="margin-top:10px;" class="" ng-click="getType(x.UA_id, 'billing')">
                        <input style="" id="checkbox1" value="" type="checkbox" >
                        <span style="color:black;">Default Billing </span> 
                    </label>

                </div>
                <!--                                                    <div class="col-md-6"></div>-->
            </div>



        </div>










        <hr>
        <div class="row label" id="add_address_btn">
            <div class="col-lg-12 col-md-12 col-xs-12 address_panel">


                <div class="addr_add_button">
                    <button type="submit" class="btn btn-fill btn-wd btn-block addr_add_button1"><i class="fa fa-plus"></i> ADD ADDRESS</button>
                </div>

            </div>
            <div class="col-lg-8 col-md-12 col-xs-12"></div>
        </div>
        <br>
        <br>

        <div class="row" id="add_address" style="display:none;">
            <div class="col-md-12 text-center  address_panel">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <p class="panel_h4"><i class="fa fa-plus"></i> Add New Address</p>
                            </div>
                            <div class="col-lg-9 col-md-9"></div>
                        </div>
                    </div>
                </div>
                <!--//////////////////////////////////////-->
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group order_custom_form" >
                                <label class="col-sm-3 control-label order_custom_label ">Address title</label>
                                <div class="col-sm-9 order_custom_form_input " >
                                    <input style="margin-bottom: 20px!important;" class="form-control order_address_input" placeholder="Address Title" type="text" ng-model="address.addTitle">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group order_custom_form" style="padiing-top:5px;">
                                <label class="col-sm-3 control-label order_custom_label ">Phone</label>
                                <div class="col-sm-9 order_custom_form_input ">
                                    <input style="margin-bottom: 20px!important;" class="form-control order_address_input" placeholder="phone" type="text" ng-model="address.phone">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group order_custom_form">
                                <label class="col-sm-3 control-label order_custom_label">Address</label>
                                <div class="col-sm-9 order_custom_form_input ">
                                    <textarea class="form-control  order_address_input"  placeholder="address" type="text" rows="3" cols="4" ng-model="address.address"></textarea>
                                </div>
                            </div>

                            <div class="form-group order_custom_form" >
                                <label class="col-sm-3 control-label order_custom_label form_margin">Zip/Postal Code</label>
                                <div class="col-sm-9 order_custom_form_input form_margin" >
                                    <input class="form-control order_address_input" placeholder="zip code" type="text" ng-model="address.zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label order_custom_label ">City</label>
                                <div class="col-sm-9 order_custom_form_input ">
                                    <select id="selectArea" class="form-control order_address_input" ng-model="address.city">
                                        <option value=""> --- Please Select City --- </option>
                                        <option ng-repeat="city in getAllCity" value="{{city.city_id}}">{{city.city_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label order_custom_label form_margin" >Country</label>
                                <div class="col-sm-9 order_custom_form_input form_margin">
                                    <select id="selectArea" class="form-control order_address_input" ng-model="address.country">
                                        <option value=""> --- Please Select Country --- </option>
                                        <option value="16" style="font-weight: bold;">Bangladesh</option>
                                        <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="padiing-top:5px;">
                                <label class="col-sm-3 control-label custom_label"></label>
                                <div class="col-sm-9 order_custom_form_input">



                                    <div class="row form_margin">
                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="btn btn-fill btn-block addr_add_button1" ng-click="addAdderss(address)"><i class="fa fa-plus"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>       

                    </div><br><br>

                </div>
                <!--//////////////////////////////////////-->

            </div>
        </div>








        <div class="clearfix"></div>
    </div>
</div>

<!-- Modal -->
<div class="card" ng-show="invisible">
    <div class="card padding_top15">
        <div class="clearfix"></div>


        <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group order_custom_form" >
                                <label class="col-sm-3 control-label order_custom_label form_margin">Address title</label>
                                <div class="col-sm-9 order_custom_form_input form_margin" >
                                    <input class="form-control order_address_input" placeholder="Address title" type="text"  value="{{currentInfo.UA_title }}" ng-model="currentInfo.UA_title">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group order_custom_form" style="padiing-top:5px;">
                                <label class="col-sm-3 control-label order_custom_label form_margin">Phone</label>
                                <div class="col-sm-9 order_custom_form_input form_margin">
                                    <input class="form-control order_address_input" placeholder="phone" type="text" value="{{currentInfo.UA_phone}}" ng-model="currentInfo.UA_phone">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group order_custom_form">
                                <label class="col-sm-3 control-label order_custom_label">Address</label>
                                <div class="col-sm-9 order_custom_form_input ">
                                    <textarea class="form-control  order_address_input"  placeholder="address" type="text" rows="3" cols="4" value="{{currentInfo.UA_address}}" ng-model="currentInfo.UA_address"></textarea>
                                </div>
                            </div>

                            <div class="form-group order_custom_form" >
                                <label class="col-sm-3 control-label order_custom_label form_margin">Zip/Postal Code</label>
                                <div class="col-sm-9 order_custom_form_input form_margin" >
                                    <input class="form-control order_address_input" placeholder="zip code" type="text" value="{{currentInfo.UA_zip}}" ng-model="currentInfo.UA_zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label order_custom_label ">City</label>
                                <div class="col-sm-9 order_custom_form_input ">
                                    <select id="selectArea" class="form-control order_address_input" ng-model="currentInfo.ciid">
                                        <option value=""> --- Please Select City --- </option>
                                        <option ng-repeat="citys in getAllCity" value="{{citys.city_id}}">{{citys.city_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label order_custom_label form_margin" >Country</label>
                                <div class="col-sm-9 order_custom_form_input form_margin">
                                    <select id="selectArea" class="form-control order_address_input" ng-model="currentInfo.coid">
                                        <option value=""> --- Please Select Country --- </option>
                                        <option ng-repeat="countrys in getAllCountry" value="{{countrys.country_id}}">{{countrys.country_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="padiing-top:5px;">
                                <label class="col-sm-3 control-label custom_label"></label>
                                <div class="col-sm-9 order_custom_form_input">



                                    <div class="row form_margin">
                                        <div class="col-lg-6 col-md-6">
                                            <button type="submit" class="btn btn-fill btn-block addr_add_button1" ng-click="saveAddress(currentInfo)"><i class="fa fa-plus"></i> Save</button>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <button type="submit" class="btn btn-fill btn-block addr_add_button1" ng-click="backAddress()"><i class="fa fa-backward"></i> Back</button>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>       

                    </div>

                </div>


        <div class="clearfix"></div>
    </div>
</div>



