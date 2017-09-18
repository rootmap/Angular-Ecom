/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
        .module('frontEnd', ['directives', 'angular-growl', 'duScroll'])
        .controller('checkout1Controller', function ($scope, $http, $window, growl, $sce) {
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


            $scope.share_cDetail = "Share your Contact Details";
            $scope.payment_text = "Make Payment With";
            $scope.btn_payment1 = "Online Payment";
            $scope.btn_payment2 = "Cash On Delivery";
            $scope.btn_payment3 = "Bkash Payment";


            // $scope.f_eventDetailCall = function (Eid) {

            //     if (Eid != '')
            //     {
            //         $http.post('php/featured_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
            //             $scope.details = response.data;
            //            getdata();
            //         });
            //         $http.post('php/eventTicketTypeTicketController.php', {'id':Eid}).then(function (response) {
            //           // console.log(Eventid);
            //             $scope.eventTicketTypeTicket = response.data;


            //         });
            //            $http.post('php/eventTicketTypeIncludeController.php', {'id':Eid}).then(function (response) {
            //           // console.log(Eventid);
            //             $scope.eventTicketTypeInclude = response.data;

            //         });


            //     }
            // }
            //  $scope.c_eventDetailCall = function (Eid) {

            //     if (Eid != '')
            //     {
            //         $http.post('php/covered_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
            //             $scope.details = response.data;
            //             $scope.hide='true';
            //             getdata();
            //         });
            //     }
            // }
            //  $scope.up_eventDetailCall = function (Eid) {

            //     if (Eid != '')
            //     {
            //         $http.post('php/upcomming_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
            //             $scope.details = response.data;
            //             $scope.hide='true';
            //             getdata();
            //         });

            //     }
            // }

            $scope.tckFree = [];
            $scope.tck_counterFree = 1;

            $scope.tckpassFree = function ()
            {
                $scope.tckFree.push({
                    'quantity': '0',
                    'price': '0',
                    'ticket_id': '0',
                    'id': $scope.tck_counterFree
                });
                $scope.tck_counterFree++;
                console.log($scope.tckFree);
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

                $scope.ticketQPT.push({
                    id: $scope.tck_counter,
                    quantity: '0'
                });

                $scope.freeQPF.push({
                    id: $scope.tck_counter,
                    quantity: '0'
                });

                $scope.tck_counter++;
                console.log($scope.tck);
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

                $scope.includeQPI.push({
                    quantity: '0',
                    id: $scope.tck_counter_inc
                });

                $scope.tck_counter_inc++;
                console.log($scope.tck_inc);
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



            $scope.totalQP = function () {
//getNumber();
                setTimeout(function () {
                    $http.post('./php/totalQP.php', {ticket: $scope.tck, include: $scope.tck_inc}).then(function (response) {
                        $scope.obj = response.data;
                        $scope.total_amount = $scope.obj.total_amount;
                        $scope.total_qnty = $scope.obj.total_qnty;
                        $scope.tck_qnty = $scope.obj.tck_q;
                        $scope.tck_inc_qnty = $scope.obj.tck_inc_q;
                       
                        //console.log($scope.obj);
                    });
                }, 50);

            }

//            $scope.automergeQuantity = function ()
//            {
//                $scope.totalMergeQuan = 0;
//                angular.forEach($scope.ticketQPT, function (val, index) {
//                    console.log(val.quantity);
//                    $scope.totalMergeQuan += parseInt(val.quantity);
//                });
//
//
//
//                angular.forEach($scope.freeQPF, function (val, index) {
//                    console.log(val.quantity);
//                    $scope.totalMergeQuan += parseInt(val.quantity);
//                });
//
//                angular.forEach($scope.includeQPI, function (val, index) {
//                    console.log(val.quantity);
//                    $scope.totalMergeQuan += parseInt(val.quantity);
//                });
//                $scope.tck_inc_qnty = $scope.totalMergeQuan;
//                //$scope.totalMergeQuan=0;
//                console.log($scope.totalMergeQuan);
//            }
//
//            $scope.ticketQPT = [];
//            $scope.totalQPT = function (param, ked) {
//                $scope.ticketQPT[ked].quantity = param;
//                console.log($scope.ticketQPT);
//                $scope.automergeQuantity();
//                setTimeout(function () {
//                    $http.post('./php/totalQP.php', {ticket: $scope.tck, include: $scope.tck_inc}).then(function (response) {
//                        $scope.obj = response.data;
//                        $scope.total_amount = $scope.obj.total_amount;
//                        $scope.total_qnty = $scope.obj.total_qnty;
//                        $scope.tck_qnty = $scope.obj.tck_q;
//                        $scope.tck_inc_qnty = $scope.obj.tck_inc_q;
//                        //console.log($scope.obj);
//                    });
//                }, 100);
//
//            }
//
//            $scope.freeQPF = [];
//            $scope.totalQPF = function (param, key) {
//                $scope.freeQPF[key].quantity = param;
//                console.log($scope.freeQPF);
//                $scope.automergeQuantity();
//                setTimeout(function () {
//                    $http.post('./php/totalQP.php', {ticket: $scope.tck, include: $scope.tck_inc}).then(function (response) {
//                        $scope.obj = response.data;
//                        $scope.total_amount = $scope.obj.total_amount;
//                        $scope.total_qnty = $scope.obj.total_qnty;
//                        $scope.tck_qnty = $scope.obj.tck_q;
//                        $scope.tck_inc_qnty = $scope.obj.tck_inc_q;
//                        //console.log($scope.obj);
//                    });
//                }, 100);
//
//            }
//
//
//
//            $scope.includeQPI = [];
//            $scope.totalQPI = function (param, key) {
//                $scope.includeQPI[key].quantity = param;
//                console.log($scope.includeQPI);
//
//                setTimeout(function () {
//                    $http.post('./php/totalQP.php', {ticket: $scope.tck, include: $scope.tck_inc}).then(function (response) {
//                        $scope.obj = response.data;
//                        $scope.total_amount = $scope.obj.total_amount;
//                        $scope.total_qnty = $scope.obj.total_qnty;
//                        $scope.tck_qnty = $scope.obj.tck_q;
//                        $scope.tck_inc_qnty = $scope.obj.tck_inc_q;
//                        //console.log($scope.obj);
//                    });
//                }, 100);
//
//            }



            $scope.orgemail = function (org, o_name) {
                //alert(o_name);
                $http.post('./email/organizereamil.php', {msg: org, org_name: o_name}).then(function (response) {
                    $scope.feedback = response.data;
                    if ($scope.feedback == 1) {
                        growl.success("Please wait message is processing...", {title: ' '});
                    } else {
                        growl.error("Message send failed !!", {title: ' '});
                    }
                });
            }

            $scope.buyInclude = function (tck, tckInc, pm, p_point, hCity, hCountry, add)
            {
                //tck_total_p tck_qnty tck_q tck_inc_qnty
                console.log(pm)
                // console.log($scope.tck);
                //var c = confirm("are you sure to proced ?");
                if (pm)
                {
//                    $http.post('./php/onePageCheckout.php', {ticket: $scope.tck, include: $scope.tck_inc, tck_total_p: $scope.total_amount, tck_qnty: $scope.total_qnty, tck_q: $scope.tck_qnty, tck_inc_qnty: $scope.tck_inc_qnty, e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield, pickup: p_point,homeDelivery:home_d}).then(function (data) {
                    //console.log(data.data)
                    $http.post('./php/onePageCheckout.php', {ticket: tck, include: tckInc,paytype:pm, e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield, pickup: p_point, city: hCity, country: hCountry, homeAdd: add}).then(function (data) {

                        var obj = data.data;
                        // console.log(obj);
                        var status = obj.status;

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
                                $scope.verifyPayment(oid, ta, pm);
                                $scope.orderSubmitEmail(oid, ouid, ta, $scope.eventId);

                            } else
                            {
                                growl.warning("Please Reload Page & Try Again.", {title: ' '});
                            }
                        } else if (status == 4)
                        {
                            growl.error("Please Select Minimum (1) Ticket.", {title: ' '});
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

            $scope.orderSubmitEmail = function (order_id, order_user_id, tk, customerInfo, eventId) {
                $http.post('email/ordersubmit_email.php', {o_id: order_id, o_u_id: order_user_id, total: tk, e_id: $scope.eventId}).then(function (data) {
                });
            }

            $scope.buyFreeTicket = function (tck, tckInc, pm, p_point, hCity, hCountry, add)
            {

                //console.log($scope.tckFree);
                // var c = confirm("are you sure to proced ?");
                if (pm)
                {
                    //$http.post('php/freeEventCheckout.php', {ticket: $scope.tck, include: $scope.tck_inc, e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield,pickup:p_point})
//                    $http.post('./php/freeEventCheckout.php', {ticket: $scope.tck, include: $scope.tck_inc, tck_total_p: $scope.total_amount, tck_qnty: $scope.total_qnty, tck_q: $scope.tck_qnty, tck_inc_qnty: $scope.tck_inc_qnty, e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield, pickup: p_point,homeDelivery:home_d}).then(function (data) {
                    $http.post('./php/freeEventCheckout.php', {ticket: tck, include: tckInc, pay_type:pm,e_id: $scope.eventId, ticketIncludeId: $scope.ticketIncludeId, customerInfo: $scope.customfield, pickup: p_point, city: hCity, country: hCountry, homeAdd: add}).then(function (data) {
                        console.log(data.data);
                        var obj = data.data;

                        var status = obj.status;
                        if (status == 1)
                        {
                            var ta = obj.total_amount;
                            var oid = obj.order_id;
                            if (ta != null && oid != null)
                            {
                                //console.log('test');
                                growl.success("Please wait processing...", {title: ' '});
                                growl.info("Your order successfully purchase,Check your email...", {title: ' '});
                                $scope.verifyPayment(oid, ta, pm);
                                $scope.orderSubmitEmail(oid, ta, $scope.eventId);
                            } else
                            {
                                growl.warning("Please Reload Page & Try Again.", {title: ' '});
                            }
                        } else if (status == 3)
                        {
                            growl.error("Please Select Minimum (1) Ticket.", {title: ' '});
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





            /* $scope.Initqval = function ()
             {
             $(".tqv").keyup(function () {
             if ($(this).val() == null || $(this).val() == 0)
             {
             $(this).val("0");
             }
             console.log($(this).val());
             });
             } */

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
            
            
            
            $scope.getNumber = function (num) {
                alert(num);
                return new Array(num);
                console.log(Array(num)+'df');

            }

            $scope.customfieldpush = function (mod,ipa,kal)
            {
                var getvalue = $("#"+ipa+"custom" + mod).val();
                $scope.customfield[ipa][kal]=getvalue;
                //
                //$scope.customfield[mod] = getvalue;
                console.log($scope.customfield)
                
            }
            
            $scope.autoRun=function()
            {
                console.log($scope.customfield)
            }

            $scope.customfield = [];


            //$scope.customfield['ff'] = "";
            $scope.pushAttenArr=function(inx,kaf,fid)
            {
                $scope.customfield[inx][kaf]="";
                //$scope.customfield[inx]['fid_name']=kaf;
                //$scope.customfield[inx]['fid'+kaf]=fid;
                //console.log(inx,kaf);
                
                console.log($scope.customfield);
            }

            $scope.dynamicForm = function (id) {
                //console.log(id)
                 //alert(id);
                console.log($scope.total_qnty);
                if ($scope.total_qnty != 0)
                {
                    $scope.eventId = id;
                    $http.post('php/dynamicFormPhpController.php', {e_id: id})
                            .then(function (response) {
                                // growl.success("Added successfully.", {title: ' '});

                                $scope.formData = response.data;
                               // console.log(response.data);
                                alert($scope.formData);
                                $scope.customfield=[];
                                $scope.lovevalentine=0;
                                for ($scope.iname =1; $scope.iname <= $scope.total_qnty; $scope.iname++) {
                                    
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
                    growl.warning("Please Select Quantity.", {title: ' '});
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

            $scope.freeEventpaymentmethod = function (id) {

                $http.post('php/freeEventpaymentmethod.php', {id: id}).then(function (response) {
                    $scope.freeEventpayment_method = response.data;
                    //growl.success("Added successfully.", {title: ' '});
                });
            }

            $scope.eventTags = function eventTags(id) {
                //alert(id);
                $http.post('php/event_tagController.php', {eventID: id})
                        .then(function (response) {
                            $scope.tags = response.data;
                            console.log(response.data);
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

                        $('.condition').show();
                        $('.normal').hide();
                        //$scope.hide= true;
                        console.log('ok')
                    } else {
                        $('#normal').show();
                        $('#condition').hide();

                        $('.normal').show();
                        $('.condition').hide();
                        //$scope.hide= false;
                        console.log('nope')
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


//            $scope.addTocart = function (type, eventID, venueID, itemID, count) {
//                if (eventID != '') {
//                    console.log(type, eventID, venueID, itemID, count)
//                    $http.post('php/addToCartController.php', {'type': type, 'eventID': eventID, 'venueID': venueID, 'itemID': itemID, 'quantity': count}).then(function (response) {
//                        $scope.addToCartEventTicketType = response.data;
//                        getdata();
//                        growl.success("Item successfully add cart.", {title: ' '});
//                    });
//                }
//            }




//            getdata();
//            function getdata() {
//                $scope.dataArray = '';
//                $scope.totalDiscount = '';
//                $scope.totalQuantity = '';
//                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
//                    $scope.popupCart = response.data;
//                    $scope.dataArray = $scope.popupCart;
//
//                    for (i = 0; i < $scope.dataArray.length; i++) {
//                        $scope.totalDiscount = ($scope.totalDiscount - 0) + ($scope.dataArray[i].EITC_total_discount - 0);
//                        $scope.totalQuantity = ($scope.totalQuantity - 0) + ($scope.dataArray[i].EITC_quantity - 0);
//                    }
//                    //console.log($scope.totalQuantity)
//                });
//
//                $http.get('php/popupCart/popupCartEventDetailsController.php').then(function (response) {
//                    $scope.popupCartEventDetails = response.data;
//                });
//
//            }
//
//            $scope.totalPrice = function () {
//
//                var total = 0;
//                for (i = 0; i < $scope.dataArray.length; i++) {
//                    total += ($scope.dataArray[i].EITC_total_price - 0);
//
//                }
//                //console.log(total);
//                return total;
//            }


            $scope.qntyChange = function (qnty, id) {
                $http.post("php/changeCartQnty.php", {"qnty": qnty, "EITC_id": id})
                        .then(function (response) {
                            growl.success("Update successfully", {title: ' '});
                            getdata();
                        });
                console.log(qnty, id);
            };


            $scope.verifyPayment = function (orderID, TA, PM) {
                //console.log(checkStatus)
                var linkpre = "?oid=" + orderID + "&total=" + TA;
                if (PM != '') {
                    if (PM == 'Online Payment') {
                        $window.location.href = 'redirect.php' + linkpre;
                    }else if (PM == 'Pay Online & Get E-Ticket on Your E-Mail') {
                        $window.location.href = 'redirect.php' + linkpre;
                    }else if (PM == 'Bkash Payment') {
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
var app = angular.module('directives',['textAngular']);
app.directive('map', function ($http, $sce) {
    return {
        restrict: 'E',
        replace: true,
        template: '<div></div>',
        link: function ($scope, element, attrs, $sce) {

            $scope.f_eventDetailCall = function (Eid) {
                if (Eid != '')
                {

                    $http.post('php/featured_event_ticketsPhpController.php', {'id': Eid}).then(function (response) {
                        $scope.details = response.data;
                        // $scope.details = $sce.trustAsHtml($scope.detail);
                        $scope.detail = $scope.details[0].event_description;

                        venue($scope.details);


                        getdata();
                    });
                    $http.post('php/eventTicketTypeTicketController.php', {'id': Eid}).then(function (response) {
                        // console.log(Eventid);
                        $scope.eventTicketTypeTicket = response.data;


                    });
//                    $http.post('php/eventTicketTypeTicketController.php', {'id': Eid}).then(function (response) {
//                        // console.log(Eventid);
//                        $scope.eventTicketFreeTicket = response.data;
//
//
//                    });
//                    
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
                    });
                }
            }

            var venue = function (city) {

                var coordinate = city[0].venue_geo_location;
                // coordinate = coordinate.replace('"','');
                var coordinates = city[0].venue_geo_location.split(',');

                var myLatlng = coordinates[0];
                var myLatlng1 = coordinates[1];

                console.log(myLatlng)
                console.log(myLatlng1)

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
