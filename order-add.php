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

        <?php
        echo $cms->pageTitle("Order-Add | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php
        echo $cms->headCss(array("order"));
        ?>

    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="order_addController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
     <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>
            <?php include'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:70px;">
                        <div class="clearfix"></div>
                        <!-- sitemap section starts here -->
                        <div class="section-simple2 ">
                            <div class="container">
                                <div class="row custom_menu">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu">
                                        <ul class="nav nav-pills nav-justified  nav-tab-bar">
                                            <li class=""><a href="user_dashboard/dashboard.php"><span class="fa fa-dashboard"></span> {{m_i_1}}</a> </li>
                                            <li class="active"><a href="order-add.php"><span class="fa fa-map-marker"></span> {{m_i_2}}</a> </li>
                                            <li class=""><a href="order-favorite.php"><span class="fa fa-heart"></span> {{m_i_3}}</a> </li>
                                            <li class=""><a href="order.php"><span class="fa fa-heart"></span> {{m_i_4}}</a> </li>
                                        </ul>
                                    </div>
                                </div>

                                

                                <div class="row one" style="">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_content" id="one" style="">
                                        <div class="row" ng-repeat="x in orderAdd">
                                            <div class="col-lg-3 col-md-12 col-xs-12 address_panel">
                                                <h4 class="address_h4 text-left">&nbsp;&nbsp;&nbsp;{{x.UA_title}}</h4>
                                                <blockquote class="address_blo">

                                                    <p class="address_p">{{x.UA_address}} {{x.city_name}}</p>
                                                    <p class="address_p">{{x.country_name}}</p>
                                                    <p class="address_p">phone:{{x.UA_phone}}</p>
                                                    <p class="address_p">{{p8}}:{{x.UA_zip}}</p>
                                                </blockquote>

                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 addr_button">
                                                    <a href="javascript:void(0)"  ng-click="editInfo(x)" class="btn btn-primary"
                                                       data-toggle="modal" data-target="#myModal" 
                                                       style="background: #286090;color: #fff">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>
                                                        {{p1}}
                                                    </a>
                                                    <a href="javascript:void(0)" ng-click=deleteUserAddress(x.UA_id) class="btn btn-danger pull-right" style="background: #D9534F;color: #fff">
                                                            <i class="fa fa-times" aria-hidden="true">&nbsp;</i>{{p2}}
                                                    </a>
                                                </div>

                                                <div class="row">

                                                    <div class="addr_checkbox_goup">
                                                        <div class="checkbox">
                                                            <label class="check2">
                                                                 <input type="checkbox" name="optionsCheckboxes"  ng-class="{'checked':x.user_default_shipping==x.UA_id}" ng-checked="x.user_default_shipping==x.UA_id" ng-model="shipping" ng-change="setDefaultAddress(x.UA_id,'shipping')"></input>{{p3}}
                                                            </label>
                                                            <label class="check1">
                                                                <input type="checkbox" name="optionsCheckboxes"  ng-class="{'checked':x.user_default_billing==x.UA_id}" ng-checked="x.user_default_billing==x.UA_id" ng-model="billing" ng-change="setDefaultAddress(x.UA_id,'billing')">{{p4}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <hr>
                                        <div class="row" id="add_address_btn">
                                            <div class="col-lg-3 col-md-12 col-xs-12 address_panel">


                                                <div class="addr_add_button">
                                                    <button type="submit" class="btn btn-fill btn-wd btn-block addr_add_button1">
                                                        <i class="fa fa-plus"></i>Add New Address</button>
                                                </div>

                                            </div>
                                            <div class="col-lg-8 col-md-12 col-xs-12"></div>
                                        </div>
                                        <br>
                                        <br>

                                        <div class="row" id="add_address" style="display:none">

                                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 address_panel">
                                                <div class="panel panel-default">

                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3">
                                                                <h4 class="panel_h4"><i class="fa fa-plus"></i>{{p13}}</h4>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9"></div>
                                                        </div>


                                                    </div>

                                                    <div class="panel-body">
                                                        <form>
                                                        <div class="form-group order_custom_form">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p11}}</label>
                                                            <div class="col-sm-9 order_custom_form_input ">
                                                                <input class="form-control order_address_input" placeholder="Address title" type="text" ng-model="address.addTitle">
                                                            </div>
                                                        </div>

                                                        <div class="form-group order_custom_form">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p6}}</label>
                                                            <div class="col-sm-9 order_custom_form_input ">
                                                                <input class="form-control order_address_input" placeholder="phone" type="text" ng-model="address.phone">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p7}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <textarea class="form-control  order_address_input" ng-model="address.address" placeholder="address" type="text" rows="3" cols="4"></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p8}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <input class="form-control order_address_input" ng-model="address.zip" placeholder="zip/postal Code:" type="text">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p9}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <select id="selectArea" class="form-control order_address_input" ng-model="address.city" >
                                                                    <option value=""> --- Please Select City --- </option>
                                                                     <option ng-repeat="city in getAllCity" value="{{city.city_id}}">{{city.city_name}}</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p10}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <select id="selectArea" class="form-control order_address_input" ng-model="address.country" >
                                                                    <option value=""> --- Please Select Country --- </option>
                                                                    <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label custom_label"></label>
                                                            <div class="col-sm-9 order_custom_form_input">



                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <a href="javascript:void(0)" ng-click="addAdderss(address)" class="btn btn-fill btn-block addr_add_button1"><i class="fa fa-plus"></i>{{p12}}</a>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10">
                                                                        <button type="reset" class="btn btn-google btn-fill btn-block addr_add_button2"> {{p14}}</button>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

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


                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit user address</h4>
                              </div>
                              <div class="modal-body">
                              <form class="form-horizontal">
                                                        <div class="form-group order_custom_form">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p6}}</label>
                                                            <div class="col-sm-9 order_custom_form_input ">
                                                                <input class="form-control order_address_input" placeholder="currentUser.phone" type="text" ng-model="currentUser.UA_phone" value="{{currentUser.UA_phone}}">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p7}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <textarea class="form-control  order_address_input" placeholder="currentUser.address" type="text" rows="3" cols="4" ng-model="currentUser.UA_address" value="{{currentUser.UA_address}}"></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p8}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <input class="form-control order_address_input" type="text" ng-model="currentUser.UA_zip" value="{{urrentUser.UA_zip}}">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p9}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <select id="selectArea" class="form-control order_address_input" name="area_id" ng-model="currentUser.city_name">
                                                                    <option ng-repeat="city in getAllCity" value="{{city.city_id}}">{{city.city_name}}</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label order_custom_label">{{p10}}</label>
                                                            <div class="col-sm-9 order_custom_form_input">
                                                                <select id="selectArea" class="form-control order_address_input" ng-model="currentUser.coun_id">
                                                                    <option ng-repeat="country in getAllCountry" value="{{country.country_id}}">{{country.country_name}}</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                    <div class="col-sm-9">
                                                                        <button type="submit" ng-click="UpdateInfo(currentUser)" class="btn btn-fill btn-block addr_add_button1" data-dismiss="modal"><i class="fa fa-plus"></i> {{p12}}</button>
                                                                    </div>
                                                                    <div class="col-sm-3 pull-right">
                                                                        <button type="button" class="btn btn-google btn-fill btn-block addr_add_button2" data-dismiss="modal"><i class="fa fa-minus"></i> Close</button>
                                                                    </div>
                                                        </div>
                                                        </form>
                              </div>
                              <div class="modal-footer">
                                
                              </div>
                            </div>

                          </div>
                        </div>



                    </div>

                    <?php include 'include/footer.php';?>

                </div>


                <!--   Core JS Files   -->
                <?php
        echo $cms->fotterJs(array('order_add'));
        echo $cms->angularJs(array('oAdd_angular'));
        ?>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            // the body of this function is in assets/material-kit.js
                            //materialKit.initSliders();
                            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

                            window_width = $(window).width();

                            if (window_width >= 768) {
                                big_image = $('.wrapper > .header');

                                $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                            }

                        });
                    </script>
                    <!--for collapse active -->
                    <script type="text/javascript">
                        $(document).ready(function () {
                           
                            $('#add_address_btn').click(function () {
                                $('#add_address').toggle('slow');
                            })
                        });
                    </script>
                    
                    
                    
                    
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#edit_btn').click(function () {
                                $('#add_address').toggle('slow');
                                alert("option");
                            })
                        });
                    </script>

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
                    $('#rslt-div').hide();
                    $('#nav-search-btn').show();
                    $('#searchInput').val('');
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
        <!--searchbar script-->
    <script>
            $(document).ready(function () {
    
            $('.control').keyup(function () {

    // If value is not empty
    if ($(this).val().length == 0) {
    // Hide the element
    $('.show_hide').hide();
    } else {
    // Otherwise show it
    $('.show_hide').show();
    }
    }).keyup();
    });</script>
    <!--searchbar script-->
    </body>

    </html>