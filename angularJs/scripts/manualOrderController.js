/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj', ['angular-growl']).controller('manualOrderController', function ($scope, $http, growl) {
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

    $scope.Datainsert = function (offLineCheck) {


        var fname = offLineCheck.customerFirstName;
        var cmobile = offLineCheck.customerPhone;
        // console.log(cmobile);
        var cemail = offLineCheck.customerEmail;
        //console.log(cemail);
        var phone = 0;
        var email = 0;
        var name = 1;

        if (fname = "" || fname == null) {

            growl.error("Empty customer name", {title: ' '});
            name = 0;
        }

        if (cemail = "" || cemail == null) {

            growl.error("Empty email address", {title: ' '});

        } else if (validateEmail(cemail) == false) {
            growl.error("Invaild email address", {title: ' '});

        } else {
            var email = 1;
        }

        if (cmobile = "" || cmobile == null) {

            growl.error("Empty phone number", {title: ' '});

        } else if (validatePhone(cmobile) != 1) {
            growl.error("Invaild phone number", {title: ' '});

        } else {
            var phone = 1;
        }


        if (phone > 0 && email > 0) {

            if (offLineCheck.customerFirstName != null && offLineCheck.customerEmail != null && offLineCheck.customerPhone != null && offLineCheck.ticketQuantity != null && offLineCheck.eventTitle != null) {
                $http.post("./php/controller/manualOrderDataInsertController.php", {
                    'eventTitle': offLineCheck.eventTitle,
                    'vanueTitle': offLineCheck.vanueTitle,
                    'TCT': offLineCheck.TCT,
                    'ticketQuantity': offLineCheck.ticketQuantity,
                    'customerFirstName': offLineCheck.customerFirstName,
                    'customerLastName': offLineCheck.customerLastName,
                    'customerPhone': offLineCheck.customerPhone,
                    'customerEmail': offLineCheck.customerEmail,
                    'hmDelivery': offLineCheck.hmDelivery
                }).success(function (data, status, config) {
                    var obj = data;
                    var status = obj.status
                    if (status == 8) {
                        growl.error("Order Already exists.Please try again!", {title: ' '});
                        //window.location.reload();
                        // location.reload(true);
                        window.location.href = "manual_order.php";
                    } else {
                        growl.success("Data Insert Successfully.", {
                            title: ' '
                        });
                        setTimeout(function () {
                            growl.info("Redirecting...", {title: ' '});
                        }, 2000);
                    }



                    var ouid = obj.order_user_id;
                    var o_id = obj.order_id;

                    $scope.orderSubmitEmail(ouid, o_id);

                    // $scope.manulausercreateEmail(ouid)
                    window.location.href = "order_list.php";
                })

            } else {
                growl.error("Please enter all information.", {
                    title: ' '
                });
            }

        }

//                if(offLineCheck.customerEmail==''){
//                    growl.error("Please enter customer email.", {
//				title: ' '
//			});
//                }else{}
//                if(offLineCheck.customerPhone==''){
//                    growl.error("Please enter customer phone.", {
//				title: ' '
//			});
//                }else{}
//                if(offLineCheck.ticketQuantity==''){
//                    growl.error("Please select ticket quantity.", {
//				title: ' '
//			});
//                }else{}
//                if(offLineCheck.eventTitle==''){
//                    growl.error("Please select event.", {
//				title: ' '
//			});
//                }else{
//                    
//                }
//                if(offLineCheck.customerPhone==''){
//                    growl.error("Please enter customer phone.", {
//				title: ' '
//			});
//                }
//                

    }
    $scope.orderSubmitEmail = function (order_user_id, order_id) {
        $http.post('email/ordersubmit_email.php', {
            o_u_id: order_user_id, o_id: order_id
        }).then(function (data) {
        })
    }

//        $scope.manulausercreateEmail = function(order_user_id) {
//		$http.post('email/manualuser_signup.php', {
//			u_id: order_user_id
//		}).then(function(data) {})
//	}

    $scope.loadoofflineChkListdd = function () {
        $http.post("./php/controller/paymentMethodController.php", {
            'event_id': 1
        }).success(function (data, status, config) {
            $scope.EvntOffChk = data
        })
    }
    $scope.loadoofflineChkListdd();
    $scope.loadoofflineChkVTList = function (evt) {
        $http.post("./php/controller/manualOrderVenueController.php", {
            'venue_event_id': evt
        }).success(function (data, status, config) {
            $scope.VenueData = data
        })
    }
    $scope.loadoofflineChkTCtypeList = function (evt) {
        $http.post("./php/controller/manualOrderTickettypeController.php", {
            'evt': evt
        }).success(function (data, status, config) {
            $scope.ticketData = data
        })
    }
}).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(!0)
    }])
//angular.module('merchantaj',['angular-growl']).controller('manualOrderController',function($scope,$http,growl){$scope.Datainsert=function(offLineCheck){console.log(offLineCheck);$http.post("./php/controller/manualOrderDataInsertController.php",{'eventTitle':offLineCheck.eventTitle,'vanueTitle':offLineCheck.vanueTitle,'TCT':offLineCheck.TCT,'ticketQuantity':offLineCheck.ticketQuantity,'customerFirstName':offLineCheck.customerFirstName,'customerLastName':offLineCheck.customerLastName,'customerPhone':offLineCheck.customerPhone,'customerEmail':offLineCheck.customerEmail,'hmDelivery':offLineCheck.hmDelivery}).success(function(data,status,heards,config){growl.success("Data Insert Successfully.",{title:' '});var obj=data;var ouid=obj.order_user_id;$scope.orderSubmitEmail(ouid)})}
//$scope.orderSubmitEmail=function(order_user_id){$http.post('email/ordersubmit_email.php',{o_u_id:order_user_id}).then(function(data){})}
//$scope.loadoofflineChkListdd=function(){$http.post("./php/controller/paymentMethodController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.EvntOffChk=data})}
//$scope.loadoofflineChkListdd();$scope.loadoofflineChkVTList=function(evt){$http.post("./php/controller/manualOrderVenueController.php",{'venue_event_id':evt}).success(function(data,status,heards,config){$scope.VenueData=data})}
//$scope.loadoofflineChkTCtypeList=function(evt){$http.post("./php/controller/manualOrderTickettypeController.php",{'evt':evt}).success(function(data,status,heards,config){$scope.ticketData=data})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])