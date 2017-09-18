/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

angular
        .module('frontEnd', ['angular-growl'])
        .controller('bkashController', function ($scope, $http, growl) {
            
//            function validatePhone(txtPhone) {
//                            var a = txtPhone;
//                            var getlength = a.length;
//                            if (getlength > 10 )
//                            {
//                                var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
//
//                                if (filter.test(a)) {
//                                    return "1";
//                                }
//                                else {
//                                    return "2";
//                                }
//                            }
//                            else
//                            {
//                                return "3";
//                            }
//                        }
//                     
//                             
//                            $("#btn").click(function () {
//                                var phone = 0;
//                            var cmobile = $('#customphone').val();
//                            if (cmobile == "") {
//                                // alert('sd')
//                                growl.error("Empty phone number", {title: ' '});
//
//                            } else if (validatePhone(cmobile) != 1) {
//                                growl.error("Invaild phone number", {title: ' '});
//                                //alert('in')
//
//                            } else {
//                                var phone = 1;
//                            }
//                                // $("#divId").attr("name", hj);
//                                $('#btn').attr('name', 'btnsubmit')
//                                alert($("#btn").attr("name"));
//                            });
                        // growl.error("Empty phone number", {title: ' '});
            //end bakash code
            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {
                        "email": Email
                    }).then(function (response) {
                        $scope.msg = response.data;
                        growl.success("customar Successfully subscribe.", {
                            title: ' '
                        });
                    })
                }
            }

            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });


            $scope.check_payment =function (tid,o_id) {
               // console.log(order_id)
                $http.post('ajax/bkash_payment_method_ajax.php',{o_id:o_id,t_id:tid}).then(function (response) {
                    $scope.searchResult = response.data;

                });
                
            }

//            var minTime = 2;
//            $scope.searchResult = '';
//            $scope.EventHint = '';
//
//
//            $scope.searchEvent = function () {
//                if ($scope.EventHint.length == minTime)
//                    $scope.executeSearchResult()
//                else
//                    $scope.searchData = ' ';
//            };
//
//            $scope.executeSearchResult = function () {
//                $http.post("php/indexSearchPhpController.php").then(function (response) {
//                    $scope.searchResult = response.data;
//
//                });
//            }







        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }])
function navClt($scope, $http) {

}


