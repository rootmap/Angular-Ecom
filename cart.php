<?php
include './cms/plugin.php';
$cms = new plugin();
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php $cms->baseUrl(" assets/img/fav1.png "); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


        <?php
        echo $cms->pageTitle("Cart | Ticketchai.com...");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("cart"));
        ?>

        
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="cartController">
     
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        
        <div growl></div>
        <?php echo $cms->FbSocialScript(); ?>

        <?php include 'include/navbar.php'; ?>

        <div class="wrapper">

            <!-- main content part of cart starts here -->
            <div class="main" style="background-color: transparent;">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 ">
                            <h2>Cart</h2>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">

                        </div>
                    </div>
                </div>



                <div class="container">
                    <div class="row">
                        <!--left part starts here-->
                        <div class=" col-lg-9 col-md-9 col-sm-9 col-xm-12">
                       
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr ng-hide="popupCartEventDetails == 0">
                                            <th>{{item}}</th>
                                            <th>{{i_name}}</th>
                                            <th>{{price}}</th>
                                            <th>{{quntity}}</th>
                                            <th>{{total}}</th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="x in popupCartEventDetails">
                                            <td><img src="upload/event_web_banner/New_folder/{{x.event_web_logo}}" class="img-rounded" alt="Image missing" width="104" height="100"></td>

                                            <td>
                                                <div class="form-group">
                                                    <p id="cart_Left_Table_p">{{x.event_title}}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <p id="cart_Left_Table_p">{{x.EITC_unit_price}}</p>
                                                </div>
                                            </td>

                                            <td class="sprinoff">
                                                <div class="input-group">
                                                    <span  ng-click="qntyChange(count = (count == '1' ? count = '1' : count - 1), x.EITC_id);count = (count == x.EITC_quantity ? count = x.EITC_quantity : count - 1)" ng-init="count = x.EITC_quantity"  class="input-group-addon minus">-</span>
                                                   <div class="form-group">
                                                        <input value="1" ng-model="count" ng-change="" class="form-control" type="text">
                                                        
                                                    </div>
                                                    <span  ng-click="qntyChange(count - 0 + 1, x.EITC_id);count = (count - 0 + 1)" ng-init="count = x.EITC_quantity" class="input-group-addon plus">+</span>
                                                </div>
                                            </td>


                                            <td>
                                                <p id="cart_Left_Table_p">৳ {{x.EITC_unit_price * count}}</p>
                                            </td>
                                            <td>
                                                <button type="button" ng-click="delectInfo(x)" class="btn btn-fab btn-fab-mini btn-round danger-rounded-outline waves-effect"><i class="fa fa-close" aria-hidden="true">&nbsp;</i></button>

                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                                <br><div style="border:1px solid#ededed;background:#DCEDC8">
                                    <h4 ng-show="popupCartEventDetails == 0">No item added to cart yet.</h4>  
                                </div>

                            </div>


                        </div>
                        <!--Left part ends here-->
                        <!--Right part starts here-->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xm-12 rightPart">
                            <div class="table-responsive">
                                <h3>{{cart_summary}}</h3>
                                <table class="table custom_table2">

                                    <tr>
                                        <td>{{st_item}}</td>
                                        <td class="text-right">{{totalQuantity + 0}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{st_price}}</td>
                                        <td class="text-right">TK.{{totalPrice() | currency}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{st_discount}}</td>
                                        <td class="text-right">TK.{{totalDiscount| currency}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{st_tax}}</td>
                                        <td class="text-right">TK. 0
                                            00</td>
                                    </tr>

                                    <tr>
                                        <td>{{st_shopping}}</td>
                                        <td class="text-right"><b>FREE!</b></td>
                                    </tr>

                                    <tr>
                                        <td>{{st_subtotal}}</td>
                                        <td class="text-right">TK.{{totalPrice() - totalDiscount | currency}}</td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
                                        <div class="form-group label-floating success">
                                            <label class="control-label">Copne Code</label>
                                            <input type="text" class="form-control" name="senderName" id="senderNameId">
                                        </div>
                                        <br>
                                        <div class="">
                                            <button class="btn btn-raised btn-success btn-block btn-login waves-effect text-center" type="button">{{btn_apply}}<i class="fa fa-check-square" aria-hidden="true"></i>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <a href="checkout3.php">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                            <button class="btn btn-raised btn-success btn-block btn-login waves-effect text-center" type="button">{{btn_checkout}}<i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </a>
                                    <p class="text-center">{{btn_ctext}}</p>
                                </div>
                            </div>


                        </div>
                        <!--Right part ends here-->

                    </div>
                </div>
                <!-- Cart section ends here -->

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
                <!-- ticketchai simple section ends here -->
            </div>
            <!-- main content part of cart ends here -->

            <?php include 'include/footer.php'; ?>

        </div>

        <!-- Sart Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple">Nice Button</button>
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--  End Modal -->
        <!--Please Don't Remove This Part-->
        <!--<div id="checkRadios"  style="display: none !important;">
    <div class="row">
        <div style="display: none;" class="col-sm-3">
            <div class="title">
                <h3>Sliders</h3>
            </div>

            <div id="sliderRegular" class="slider"></div>
            <div id="sliderDouble" class="slider slider-info"></div>
        </div>
    </div>
</div>-->
    
        <?php echo $cms->fotterJs(array('cart')); ?>
        <?php echo $cms->angularJs(array('cart_angular')); ?>
        

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
        <!-- Spinoff javascript -->
        <script text="text/javascript">
                    $(document).ready(function () {
                        $(".minus").click(function () {

                            var minValue = $(this).html();

                            if (minValue == "-") {

                                var value = '';
                                var getValue = $(this).parent("div").find("input").val();

                                if (getValue > 0) {
                                    value = getValue - 1;
                                    $(this).parent("div").find("input").css("color", "#000");
                                } else {
                                    value = 0;
                                    $(this).parent("div").find("input").css("color", "#f00");
                                }

                                $(this).parent("div").find("input").val(value);

                            }

                        });
                    });


                    $(document).ready(function () {
                        $(".plus").click(function () {

                            var plusValue = $(this).html();

                            if (plusValue == "+") {

                                var value = '';
                                var getValue = $(this).parent("div").find("input").val();


                                value = (getValue - 0) + (1 - 0);
                                $(this).parent("div").find("input").css("color", "000");

                                $(this).parent("div").find("input").val(value);

                            }

                        });
                    });

        </script>



    </body>

</html>