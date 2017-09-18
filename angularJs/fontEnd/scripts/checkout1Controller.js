/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 * minify http://www.minifier.org/
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
        .module('frontEnd', ['directives', 'angular-growl', 'duScroll', 'ngSocial'])
        .controller('checkout1Controller', function ($scope, $http, $window, growl) {
            $scope.promotion = "No offers and promotion found.";
            $scope.tab_one = "Tickets";
            $scope.tab_two = "About Event";
            $scope.tab_three = "Venue";
            $scope.tab_four = "Gallery";
            $scope.tab_fives = "T & C";
            $scope.checkout_heading = "New Checkout Test Event";
            $scope.btn_calender = "ADD TO CALENDAR";
            $scope.c_li1 = "Action";

            $scope.lebel_consert = "Concert";
            $scope.lebel_music = "Music";
            $scope.panel_h1 = "Event Tickets";
            $scope.panel_h2 = "Event Includes";
            $scope.tbl_h1 = "Ticket Type";
            $scope.tbl_h2 = "Quantity";
            $scope.tbl_h3 = "Price";
            $scope.tbl_h4 = "Action";

            $scope.cart1 = "Buy Tickets";
            $scope.lebel_consert = "concert";
            $scope.btn_calender = "ADD To calender";
            $scope.btn_direction = "GET DIRECTION";


            $scope.share_cDetail = "Attendee Details";
            $scope.payment_text = "Make Payment With";
            $scope.btn_payment1 = "Online Payment";
            $scope.btn_payment2 = "Cash On Delivery";
            $scope.btn_payment3 = "Bkash Payment";

            // Email Address Validation Function Starts
            function validateEmail(email) {
                var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                var valid = emailReg.test(email);
                if (!valid) {
                    return false;
                } else {
                    return true;
                }
            }
            // Email Address Validation Function Ends

            // Phone Number Validation Function Starts
            function validatePhone(txtPhone) {
                var a = txtPhone;
                var getlength = a.length;
                if (getlength > 10)
                {
                    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

                    if (filter.test(a)) {
                        return "1";
                    }
                    else {
                        return "2";
                    }
                }
                else
                {
                    return "3";
                }
            }
            // Phone Number Validation Function Ends

            //Steps For checkout in js starts here
            $('.bookticket').click(function () {
                window.scrollTo(0, 0);
                $('#checkout_top_banner').hide();
               // $('#bookticket-float').addClass("invisible");
                $('#step1').hide();
                $('#step3').hide();
                $('#step4').hide();
                $('#step5').hide();
                $('#step2').show();
            });
            $('#step2confirm').click(function () {
                window.scrollTo(0, 0);
                $('#checkout_top_banner').hide();
                $('#step1').hide();
                $('#step5').hide();
                $('#step4').hide();
                //$('#step3').show();
                var q = $("#qnty").html();
                // alert(q);
                if (q > 0) {
                    $('#step2').hide();
                    $('#step3').show();

                } else {
                    $('#step2').show();
                    $('#step3').hide();
                }
            });
            $('#step2confirmFree').click(function () {
                window.scrollTo(0, 0);
                $('#checkout_top_banner').hide();
                $('#step1').hide();
                $('#step5').hide();
                $('#step4').hide();
                //$('#step3').show();
                var q = $("#qnty").html();
                // alert(q);
                if (q > 0) {
                    $('#step2').hide();
                    $('#step3').show();

                } else {
                    $('#step2').show();
                    $('#step3').hide();
                }
            });
            $('#step3confirm').click(function () {
                window.scrollTo(0, 0);
                $('#checkout_top_banner').hide();
                $('#step1').hide();
                $('#step2').hide();

                if ($(".check_d").val().length == 0) {
                    $('#step5').hide();
                } else {
                    $('#step3').hide();
                    $('#step4').hide();
                    $('#step5').show();
                }

            });
            $('#step5confirm').click(function () {
                var cname = $('#customname').val();
                var cemail = $('#customemail').val();
                var cmobile = $('#customphone').val();

                var phone = 0;
                var email = 0;
                if (cemail == "") {

                    growl.error("Empty email address", {title: ' '});

                } else if (validateEmail(cemail) == false) {
                    growl.error("Invaild email address", {title: ' '});

                } else {
                    var email = 1;
                }

                if (cmobile == "") {

                    growl.error("Empty phone number", {title: ' '});

                } else if (validatePhone(cmobile) != 1) {
                    growl.error("Invaild phone number", {title: ' '});

                } else {
                    var phone = 1;
                }


                if (phone > 0 && email > 0) {

                    window.scrollTo(0, 0);
                    $('#checkout_top_banner').hide();
                    $('#step1').hide();
                    $('#step2').hide();
                    $('#step3').hide();

                    if ($(".check_d1").val().length == 0) {
                        //$('#step5').show();
                    } else {
                        $('#step4').show();
                        $('#step5').hide();
                    }
                }

            });
            $('#backDefault').click(function () {
                $('#checkout_top_banner').show();
                $('#step1').show();
                $('#step2').hide();
                $('#step4').hide();
                $('#step3').hide();
                $('#step5').hide();

            });
            $('#backDefault1').click(function () {
                $('#checkout_top_banner').show();
                $('#step1').hide();
                $('#step2').show();
                $('#step4').hide();
                $('#step3').hide();
                $('#step5').hide();
            });
            $('#backDefault2').click(function () {
                $('#checkout_top_banner').show();
                $('#step1').hide();
                $('#step2').hide();
                $('#step4').hide();
                $('#step3').show();
                $('#step5').hide();

            });
            //Steps For checkout in js ends here
     





            $scope.tckFree = [];
            $scope.tckFree_counter = 1;

            $scope.tckFreepass = function ()
            {
                $scope.tckFree.push({
                    'quantity': '0',
                    'price': '0',
                    'ticket_id': '0',
                    'id': $scope.tckFree_counter
                });
                $scope.tckFree_counter++;

            }



            $scope.tck = [];
            $scope.tck_counter = 1;

            $scope.tckpass = function ()
            {
                $scope.tck.push({
                    'quantity': '0',
                    'price': '0',
                    'ticket_id': '0',
                    'id': $scope.tck_counter
                });
                $scope.tck_counter++;

            }

            $scope.checkarray = function ()
            {
                console.log($scope.tck);
            }

            $scope.tck_inc = [];
            $scope.tck_counter_inc = 1;

            $scope.tckpass_inc = function ()
            {
                $scope.tck_inc.push({
                    'quantity': '0',
                    'price': '0',
                    'ticket_id': '0',
                    'id': $scope.tck_counter_inc
                });

                $scope.tck_counter_inc++;

            }

            $scope.InitScopeVar = function (dd)
            {
                $scope[dd] = "";
                $("#" + dd).keyup(function () {
                    console.log($(this).val());

                });

            }
//            
            $scope.eventPickPoint = function (id)
            {
                $http.post('./php/event_pick_point.php', {event_id: id}).then(function (response) {
                    $scope.point = response.data;
                });

            }


            $scope.total_qnty = 0;
            $scope.totalQP = function (q, ul) {
                if (ul > 0) {
                    if (q == ul) {
                        growl.info("You have reached max quantity", {title: ' '});
                    }
                }
                setTimeout(function () {
                    $http.post('./php/totalQP.php', {ticket: $scope.tck, include: $scope.tck_inc, free: $scope.tckFree}).then(function (response) {
                        $scope.obj = response.data;
                        $scope.total_amount = $scope.obj.total_amount;
                        $scope.total_qnty = $scope.obj.total_qnty;
                        $scope.tck_qnty = $scope.obj.tck_q;
                        $scope.tck_inc_qnty = $scope.obj.tck_inc_q;
                        //console.log($scope.obj);
                    });
                }, 50);

            }
            $scope.freeIncMsg = function (hasInc) {

                // console.log($scope.total_qnty);
                if (($scope.total_qnty > 0 && hasInc != null)) {
                    //growl.info("ok!.", {title: ' '});
                } else if (($scope.total_qnty > 0)) {
                   // growl.info("ok!.", {title: ' '});
                }
                else if ((hasInc == null || hasInc == 0)) {
                    growl.info("Please Select  Include Quantity!.", {title: ' '});
                }
            }

            $scope.deliveryCost = 0;

            $scope.citywisecost = function (c, c_id, e) {
                $scope.city = c_id;
                //console.log(e)

                $http.post('./php/eventwiseDeliveryCost.php', {event: e, city: c}).then(function (response) {
                    $scope.deliveryCost = response.data;
                    if ($scope.deliveryCost > 0) {
                        growl.success("Delivery cost" + $scope.deliveryCost + "TK. added", {title: ' '});
                    }
                });
            }
            $scope.pickupCountry = function (c, c_id) {
                $scope.country = c_id;
            }

            $scope.pickupAdd = function (c) {
                $scope.add = c;
            }
            $scope.selectedPM = function (pm) {
                $scope.p_method = pm;
                //console.log($scope.p_method)
            }

            $scope.pickupPoint = function (pp) {
                $scope.p_point = pp;
                //console.log(pp)
            }

            $scope.orgemail = function (org, o_name, e_id) {
                //alert(org.name);
                //console.log(org.name)
                $http.post('./email/organizereamil.php', {msg: org.msg, name: org.name, phone: org.phone, org_name: o_name, eventID: e_id}).then(function (response) {
                    $scope.feedback = response.data;
                    if ($scope.feedback == 1) {
                        growl.success("Message send", {title: ' '});
                        setTimeout(function () {
                            $('#close_model').click();
                        }, 3000);

                    } else {
                        growl.error("Message send failed !!", {title: ' '});
                    }
                });
            }

            $scope.buyInclude = function (tckFree, tck, tckInc, hCity, hCountry, add,eventID)
            {
                //tck_total_p tck_qnty tck_q tck_inc_qnty
                // alert(eventID);
                // console.log($scope.tck);
          
                if ($scope.p_method)
                {
//                    $http.post('./php/onePageCheckout.php', {ticket: $scope.tck, include: $scope.tck_inc, tck_total_p: $scope.total_amount, tck_qnty: $scope.total_qnty, tck_q: $scope.tck_qnty, tck_inc_qnty: $scope.tck_inc_qnty, e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield, pickup: p_point,homeDelivery:home_d}).then(function (data) {
                    //console.log(data.data)
                    $http.post('./php/onePageCheckout.php', {deliveryCost: $scope.deliveryCost, free: tckFree, ticket: tck, include: tckInc, paytype: $scope.p_method, e_id: eventID, ticketIncludeId: $scope.ticketIncludeId, userCreate: $scope.customer, customerInfo: $scope.customfield, pickup: $scope.p_point, city: hCity, country: hCountry, homeAdd: $scope.add}).then(function (data) {

                        var obj = data.data;
                        // console.log(obj);
                        var status = obj.status;
                        $scope.order_exists = status;
                        if (status == 1)
                        {
                            var ta = obj.total_amount;
                            var oid = obj.order_id;
                            var ouid = obj.order_user_id;
                            console.log(ouid);
                            if (ta != null && oid != null)
                            {
                                //console.log('test');
                                growl.success("Please wait processing...", {title: ' '});
                                growl.info("Your order successfully purchase,Check your email...", {title: ' '});
                                $scope.verifyPayment(oid, ta, $scope.p_method);
                                $scope.orderSubmitEmail(oid, ouid, ta, $scope.eventID, $scope.customfield);

                            } else
                            {
                                growl.warning("Please Reload Page & Try Again.", {title: ' '});
                            }
                        } else if (status == 4)
                        {
                            growl.error("Please Select Minimum (1) Ticket.", {title: ' '});
                        }
                        else if (status == 8)
                        {
                            growl.error("Order Already exists.", {title: ' '});
                            $window.location.href = 'index.php';
                        } else if (status == 3)
                        {
                            growl.error("Please Select Ticket & Include.", {title: ' '});
                        } else if (status == 2)
                        {
                            growl.error("Customer Detail is Empty , Please Fillup All.", {title: ' '});
                        } else if (status == 0)
                        {
                            growl.error("Please Select a Ticket.", {title: ' '});
                        } else
                        {
                            growl.error("something is wrong, Please Try Again.", {title: ' '});
                        }
                        //var obj=jQuery.parseJSON(data);
                        //console.log(obj.status);


                    });
                } else
                {
                    growl.info("Please Select a Payment Method", {title: ' '});
                }


            }

            $scope.orderSubmitEmail = function (order_id, order_user_id, tk, eventId, customerInfo) {
                $http.post('email/ordersubmit_email.php', {o_id: order_id, o_u_id: order_user_id, total: tk, e_id:eventId, attendee: $scope.customfield}).then(function (data) {
                });
            }

            $scope.buyFreeTicket = function (tckFree, tck, tckInc,eventID)
            {
              // alert(eventID)
                $http.post('./php/freeEventCheckout.php', {free: tckFree, ticket: tck, include: tckInc, e_id: eventID, userCreate: $scope.customer, customerInfo: $scope.customfield}).then(function (data) {

                    var obj = data.data;
                    // console.log(obj);
                    var status = obj.status;
                    $scope.order_exists = status;
                    if (status == 1)
                    {
                        var ta = obj.total_amount;
                        var oid = obj.order_id;
                        var ouid = obj.order_user_id;
                        console.log(ouid);
                        if (ta != null && oid != null)
                        {
                            //console.log('test');
                            growl.success("Please wait processing...", {title: ' '});
                            growl.info("Your order successfully purchase,Check your email...", {title: ' '});
                            $scope.verifyPayment(oid, ta, $scope.p_method);
                            $scope.orderSubmitEmail(oid, ouid, ta, $scope.eventID, $scope.customfield);

                        } else
                        {
                            growl.warning("Please Reload Page & Try Again.", {title: ' '});
                        }
                    } else if (status == 4)
                    {
                        growl.error("Please Select Minimum (1) Ticket.", {title: ' '});
                    }
                    else if (status == 8)
                    {
                        growl.error("Order Already exists.", {title: ' '});
                        $window.location.href = 'index.php';
                    } else if (status == 3)
                    {
                        growl.error("Please Select Ticket & Include.", {title: ' '});
                    } else if (status == 2)
                    {
                        growl.error("Customer Detail is Empty , Please Fillup All.", {title: ' '});
                    } else if (status == 0)
                    {
                        growl.error("Please Select a Ticket.", {title: ' '});
                    } else
                    {
                        growl.error("something is wrong, Please Try Again.", {title: ' '});
                    }
                    //var obj=jQuery.parseJSON(data);
                    //console.log(obj.status);


                });

            }



            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                    })
                }
            }

            getUserCountry_City();

            function getUserCountry_City() {
                $http.get('php/getAllCountry.php')
                        .then(function (response) {
                            $scope.getAllCountry = response.data;
                            // console.log( s);

                        });
                $http.get('php/getAllCity.php')
                        .then(function (response) {
                            $scope.getAllCity = response.data;
                            // console.log( s);

                        });

            }


//            $http.post('php/dynamicFormPhpController.php')
//                    .then(function (response) {
//                        $scope.formData = response.data;
//                        // growl.success("Added successfully.", {title: ' '});
//                    });

            //dynamicForm();

            $scope.sameAS = function (id) {

                $scope.s_ipa = id;
                //alert( $scope.s_ipa);
                //$scope.RunAl();
                setTimeout(function () {
                    $('.click').click();
                    $scope.customerData1();
                }, 3000);
            }

            $scope.getNumber = function (num) {
                // alert(num);
                return new Array(num);
                console.log(Array(num) + 'df');

            }

            $scope.customerData = function (mod) {
                var getvalue = $("#custom" + mod).val();

                $scope.customer[n] = getvalue;
                //console.log($scope.customer);
            }
            $scope.customerData1 = function (mod) {
                //alert(mod);
                var getvalue = $("#custom" + mod).val();

                $scope.customer[mod] = getvalue;
                console.log($scope.customer);
                // console.log('customer1');
            }

            $scope.customer = {};

            $scope.customfieldpush = function (mod, ipa, kal)
            {
                var getvalue = $("#" + ipa + "custom" + mod).val();
                $scope.customfield[ipa][kal] = getvalue;
                //
                //$scope.customfield[mod] = getvalue;
                // console.log($scope.customfield)

            }



            $scope.autoRun = function ()
            {
                console.log($scope.customfield)
            }

            $scope.customfield = [];


            //$scope.customfield['ff'] = "";
            $scope.pushAttenArr = function (inx, kaf, fid)
            {
                $scope.customfield[inx][kaf] = "";
                //$scope.customfield[inx]['fid_name']=kaf;
                //$scope.customfield[inx]['fid'+kaf]=fid;
                //console.log(inx,kaf);

                // console.log($scope.customfield);
            }

            $scope.dynamicFormMsg = function () {
                if ($(".check_d").val().length == 0) {
                    growl.error("Please fill-up attendees details form!!.", {title: ' '});


                }
                if ($(".check_d1").val().length == 0) {
                    growl.error("Please fill-up attendees details form!!.", {title: ' '});


                }
            }

            $scope.dynamicForm = function (id) {
                //console.log(id)
                // alert($scope.total_qnty);

                if ($scope.total_qnty != 0)
                {
                    $scope.eventId = id;
                    $http.post('php/dynamicFormPhpController.php', {e_id: id})
                            .then(function (response) {
                                // growl.success("Added successfully.", {title: ' '});

                                $scope.formData = response.data;
                                // console.log(response.data);
                                //alert($scope.formData);
                                $scope.customfield = [];
                                $scope.lovevalentine = 0;
                                for ($scope.iname = 1; $scope.iname <= $scope.total_qnty; $scope.iname++) {

                                    $scope.customfield.push({
                                        //id:$scope.lovevalentine,
                                        //fid:$scope.formData[$scope.lovevalentine].form_id,
                                        //fid_name:$scope.formData[$scope.lovevalentine].form_field_name
                                    });
                                    console.log($scope.formData[$scope.lovevalentine]);
                                    $scope.lovevalentine++;
                                    //console.log($scope.formData[$scope.iname].form_id);
                                }



                            });
                }
                else
                {
                    growl.warning("Please Select tickeet Quantity.", {title: ' '});
                }

            }

//            $scope.customfieldpush = function (mod)
//            {
//                var getvalue = $("#custom" + mod).val();
//                $scope.customfield[mod] = getvalue;
//            }
//
//            $scope.customfield = {};
//
//            $scope.dynamicForm = function (id) {
//                //console.log(id)
//                // alert(id);
//                $scope.eventId = id;
//                $http.post('php/dynamicFormPhpController.php', {e_id: id})
//                        .then(function (response) {
//                            // growl.success("Added successfully.", {title: ' '});
//                            $scope.formData = response.data;
//                            //console.log(response.data);
//
//                            $.each(response.data, function (index, val) {
//                              //  console.log(val.form_field_name);
//                                $scope.customfield[val.form_field_name] = "";
//                                //$scope.dynamicForm[val]
//                            });
//
//                            //console.log($scope.customfield);
//
//                        });
//            }

            $scope.eventwisepaymentmethod = function (id) {
                //console.log(id)
                $http.post('php/eventwisepaymentmethod.php', {id: id}).then(function (response) {
                    $scope.payment_method = response.data;
                    //growl.success("Added successfully.", {title: ' '});
                });
            }

            $scope.eventwiseDeliverymethod = function (id) {
                //console.log(id)
                $http.post('php/eventwiseDeliverymethod.php', {id: id}).then(function (response) {
                    $scope.d_payment_method = response.data;
                    //growl.success("Added successfully.", {title: ' '});
                });
            }

            $scope.freeEventpaymentmethod = function (id) {

                $http.post('php/freeEventpaymentmethod.php', {id: id}).then(function (response) {
                    $scope.freeEventpayment_method = response.data;
                    //growl.success("Added successfully.", {title: ' '});
                });
            }
            $scope.event_id = '';
            $scope.eventTags = function eventTags(id) {
                //alert(id);
                $scope.event_id = id;
                $http.post('php/event_tagController.php', {eventID: id})
                        .then(function (response) {
                            $scope.tags = response.data;
                            //console.log(response.data);
                        });

            };


            $scope.checkFreeEvent = function (id) {
                //alert(id)

                if (id != null) {
                    $http.post('php/checkout1PhpController.php', {"id": id}).then(function (response) {
                        $scope.ticketType = response.data;
                        //console.log(response.data);
                        //growl.success("Added successfully.", {title: ' '});

                        if (response.data.length > 0) {
                            // $scope.hide=true
                            //alert('1')
                            $scope.RunAlways();
                            $scope.hideEvent = true
                        } else {
                            //	alert('0')
                            //$scope.hide=false;
                            $scope.hideEvent = false;
                        }

                    });
                } else {
                    growl.warning("Something is going wrong, please check.", {title: ' '});
                }


            }



                    if ($scope.eventTicketTypeTicket > 0) {
                     
                            $('.ckeckincludeQN').hide();
                            $('.ckeckincludeQC').show();
                        } else {
                            $('.ckeckincludeQN').show();
                            $('.ckeckincludeQC').hide();
                        }

            $scope.RunAlways = function ()
            {

                setInterval(function () {
                    // console.log($scope.tck);
                    $scope.tclpr = 0;
                    angular.forEach($scope.tck_inc, function (value, key) {
                        //console.log(value.tick_price);
                        $scope.tclpr += (value.quantity - 0);
                    });
                    

                    //console.log($scope.tclpr);
                    if ($scope.tclpr > 0)
                    {

                        $('#condition').show();
                        $('#normal').hide();

                        $('.conditionfree').show();
                        $('.normalfree').hide();

                        $('.condition').hide();
                        $('.normal').show();
                        //$scope.hide= true;
                        // console.log('ok')
                        if ($scope.tck_inc_qnty > 0 ) {
                            $('.ckeckincludeQN').hide();
                            $('.ckeckincludeQC').show();
                        } else {
                            $('.ckeckincludeQN').show();
                            $('.ckeckincludeQC').hide();
                        }
                    } else {

                        $('.conditionfree').hide();
                        $('.normalfree').show();

                        $('#normal').show();
                        $('#condition').hide();

                        $('.normal').show();
                        $('.condition').hide();
                        //$scope.hide= false;
                        //console.log('nope')
                        if ($scope.tck_inc_qnty > 0) {
                            $('.ckeckincludeQN').hide();
                            $('.ckeckincludeQC').show();
                        } else {
                            $('.ckeckincludeQN').show();
                            $('.ckeckincludeQC').hide();
                        }
                    }



                }, 1000);
            }

//$scope.RunAlways();
            $scope.addToWishlist = function (Eid, Etype) {
                $scope.eventId = Eid;
                if (Eid != '') {
                    $http.post('php/wishlistPhpController.php', {'id': Eid, 'type': Etype}).then(function (response) {
                        $scope.data = response.data;
                        // console.log(Eid,Etype)
                        //eventDetailCall();
                        growl.info("Item add wishlist successfully!.", {title: ' '});
                    });
                }
            }






            // popup cart 




            $scope.verifyPayment = function (orderID, TA, PM) {
                //console.log(PM);
                //alert(PM)
                var linkpre = "?oid=" + orderID + "&total=" + TA;
                if (PM != '') {
                    if (PM == 'Online Payment') {
                        $window.location.href = 'redirect.php' + linkpre;
                    }
                    else if (PM == 'Online') {
                        $window.location.href = 'redirect.php' + linkpre;
                    } else if (PM == 'Pay Online & Get E-Ticket on Your E-Mail') {
                        $window.location.href = 'redirect.php' + linkpre;
                    } else if (PM == 'Bkash Payment') {
                        $window.location.href = 'bkash-payment.php' + linkpre;
                    } else {
                        $window.location.href = 'thankyou.php' + linkpre;
                    }
                } else {
                    confirm("NO Payment option selected!! Please select option.")
                }
                //$location.url('http://test.com/login.jsp');
            }

            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });



            var minTime = 2;
            $scope.searchResult = '';
            $scope.EventHint = '';


            $scope.searchEvent = function () {
                if ($scope.EventHint.length == minTime)
                    $scope.executeSearchResult()
                else
                    $scope.searchData = ' ';
            };

            $scope.executeSearchResult = function () {
                $http.post("php/indexSearchPhpController.php").then(function (response) {
                    $scope.searchResult = response.data;

                });
            }





        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]).value('duScrollOffset', 75);


function navClt($scope, $http) {




}
;
var app = angular.module('directives', ['textAngular']);
app.directive('map', function ($http) {
    return {
        restrict: 'E',
        replace: true,
        template: '<div></div>',
        link: function ($scope, element, attrs) {

            $scope.f_eventDetailCall = function (Eid) {
                if (Eid != '')
                {

                    $http.post('php/featured_event_ticketsPhpController.php', {'id': Eid}).then(function (response) {
                        $scope.details = response.data;

                        var deta = $scope.details[0].event_description;
                        var text = $(deta).text();

                        $scope.fbshare = text;
                        venue($scope.details);


                        getdata();
                    });
                    $http.post('php/eventTicketTypeTicketController.php', {'id': Eid}).then(function (response) {
                        // console.log(Eventid);
                        $scope.eventTicketTypeTicket = response.data;


                    });
                    $http.post('php/eventTicketTypeFreeController.php', {'id': Eid}).then(function (response) {
                        // console.log(Eventid);
                        $scope.eventTicketFreeTicket = response.data;


                    });

                    $http.post('php/eventTicketTypeIncludeController.php', {'id': Eid}).then(function (response) {
                        // console.log(Eventid);
                        $scope.eventTicketTypeInclude = response.data;
                        $scope.ticketIncludeId = $scope.eventTicketTypeInclude[0].TT_type_id;
                        //console.log($scope.ticketIncludeId);
                    });

                }
            }

            $scope.c_eventDetailCall = function (Eid) {

                if (Eid != '')
                {

                    $http.post('php/covered_event_ticketsPhpController.php', {'id': Eid}).then(function (response) {
                        $scope.details = response.data;
                        $scope.none = 'true';
                        venue($scope.details);
                        getdata();

                        var deta = $scope.details[0].event_description;
                        var text = $(deta).text();

                        $scope.fbshare = text;
                    });
                }
            }
            $scope.up_eventDetailCall = function (Eid) {

                if (Eid != '')
                {

                    $http.post('php/upcomming_event_ticketsPhpController.php', {'id': Eid}).then(function (response) {
                        $scope.details = response.data;
                        $scope.none = 'true';
                        venue($scope.details);
                        getdata();

                        var deta = $scope.details[0].event_description;
                        var text = $(deta).text();

                        $scope.fbshare = text;
                    });
                }
            }

            var venue = function (city) {

                var coordinate = city[0].venue_geo_location;
                // coordinate = coordinate.replace('"','');
                var coordinates = city[0].venue_geo_location.split(',');

                var myLatlng = coordinates[0];
                var myLatlng1 = coordinates[1];

                //console.log(myLatlng)
                //* console.log(myLatlng1)

                var center = new google.maps.LatLng(myLatlng, myLatlng1);

                var map_options = {
                    zoom: 14,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                // create map
                var map = new google.maps.Map(document.getElementById(attrs.id), map_options);

                // configure marker
                var marker_options = {
                    map: map,
                    position: center
                };

                // create marker
                var marker = new google.maps.Marker(marker_options);
            };

        }
    }



});


app.directive('checkImage', function ($http) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            attrs.$observe('ngSrc', function (ngSrc) {
                $http.get(ngSrc).success(function () {
//                    alert('image exist');
                }).error(function () {
                    // alert('image not exist');
                    element.attr('src', '/ticketchaiorg/upload/event_web_banner/defaultImg.jpg'); // set default image
                    element.attr('src', '/ticketchaiorg/upload/event_web_logo/defaultImg.jpg'); // set default image
                });
            });
        }
    };
});





