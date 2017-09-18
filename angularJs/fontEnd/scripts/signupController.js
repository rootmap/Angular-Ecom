/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

angular.module('frontEnd', ['angular-growl'])
        .controller('signupController', function ($scope, $http, growl) {
            $scope.title = "Let's create your Free account !";

            $scope.des = "Let's Sign Up In Few Minutes And Enjoy Our Awsome Services";

            $scope.p1 = "I agree to Ticketchai";
            $scope.p2 = "T&C and Privacy Policy.";
            $scope.p3 = "Sign Up";
            $scope.p4 = "Already Registered?";
            $scope.p5 = "Login";
            $scope.p6 = "OR";
            $scope.p7 = "Sign in with Facebook";
            $scope.p8 = "Sign in with Twitter";
            $scope.p9 = "Sign in with Google";

            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        // $scope.msg=response.data;
                        growl.success("customar Successfully subscribe.", {title: ' '});
                    })
                } else {
                    growl.error("customar subscribe failed.", {title: ' '});
                }
            }

            getdata();
            function getdata() {
                $scope.dataArray = '';
                $scope.totalDiscount = '';
                $scope.totalQuantity = '';
                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
                    $scope.popupCart = response.data;
                    $scope.dataArray = $scope.popupCart;

                    for (i = 0; i < $scope.dataArray.length; i++) {
                        $scope.totalDiscount = ($scope.totalDiscount - 0) + ($scope.dataArray[i].EITC_total_discount - 0);
                        $scope.totalQuantity = ($scope.totalQuantity - 0) + ($scope.dataArray[i].EITC_quantity - 0);
                    }
                    //console.log($scope.totalQuantity)
                });

                $http.get('php/popupCart/popupCartEventDetailsController.php').then(function (response) {
                    $scope.popupCartEventDetails = response.data;
                });

            }


            $scope.totalPrice = function () {

                var total = 0;
                for (i = 0; i < $scope.dataArray.length; i++) {
                    total += ($scope.dataArray[i].EITC_total_price - 0);

                }
                //console.log(total);
                return total;
            }

            $scope.registerUser = function (info) {
//                 alert(1);
//                console.log(info.name,info.email,info.pass,info.con_pass);
                $http.post('php/signupPhpController.php', {"name": info.name, "email": info.email, "pass": info.pass, "phone": info.phone, "check": info.checked}).then(function (response) {
//                    console.log(response.data);
                    if (response.data == 1) {
                        growl.warning("User email already exist, Try with another email address.", {title: ' '});
                    } else if (response.data > 0) {
                        growl.success("User signUp seccessfully done.", {title: ' '});
                        setTimeout(function () {
                            growl.info("Redirecting page.....", {
                                title: ' '
                            });
                        }, 1500);
                        setTimeout(function () {
                            window.location.href = "user_dashboard/dashboard.php"; /*[local server]*/
                        }, 3000);
                        signupMail(response.data);
                    } else if (response.data == 3) {
                        growl.error("There is problem in signup.", {title: ' '});
                    } else if (response.data == 4) {
                        growl.error("please fill all the fields..", {title: ' '});
                    }

                });
            }


            function signupMail(user_id) {

                $http.post('email/signup.php', {"id": user_id}).then(function (response) {

                });
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
        growlProvider.globalTimeToLive(4000);
        growlProvider.globalDisableCountDown(true);
    }]);


function navClt($scope, $http) {




}
;
