/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
        .module('frontEnd', ['angular-growl'])
        .controller('orderFavoriteController', function ($scope, $http, $timeout, growl) {
            $scope.m_i_1 = "Dashboard";
            $scope.m_i_2 = "Address";
            $scope.m_i_3 = "Favorite Event";
            $scope.m_i_4 = "Order";

            $scope.selectAll = "SelectAll";

            $scope.p1 = "Photo";
            $scope.p2 = "Events Details";
            $scope.p3 = "Price";
            $scope.p4 = "Option";

            $scope.p7 = "ADD TO CARD";
            $scope.p8 = "REMOVE ITEM";

            $scope.p9 = "More info";

            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                    })
                }
            }

            getInfo();
            function getInfo() {
                $http.get('php/order-favoritePhpController.php')
                        .then(function (response) {
                            $scope.name = response.data;
//                    console.log( $scope.name);

                        });
            }

            // popup cart data
            getdata();
            function getdata() {
                $scope.dataArray = '';
                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
                    $scope.popupCart = response.data;
                    $scope.dataArray = $scope.popupCart;
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

            // popup cart data end

            $scope.deleteInfo = function (info) {



                $http.post("php/order-favoritePhpController.php", {"del_id": info.WL_id})
                        .then(function (response) {
                           
                            if (response.data != '') {
                                growl.success("Delete successfully", {title: ' '});
                                getInfo();
                            } else {
                                growl.error("Delete Unsuccessfully", {title: ' '});
                            }


                        });


            }



//        $scope.alert = function(){
//                $scope.showMsg = true;
//                $timeout(function() {
//                    $scope.showMsg = false;
//                }, 3000); 
//            }









            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });




             var minTime = 2;
             $scope.searchResult = '';
             $scope.EventHint = '';
             
             
             $scope.searchEvent = function(){
                 if($scope.EventHint.length == minTime )
                       $scope.executeSearchResult()
                 else  $scope.searchData = ' ';
             };
             
             $scope.executeSearchResult = function(){
                 $http.post("php/indexSearchPhpController.php").then(function(response){
                     $scope.searchResult = response.data;
                     
                 });
             }



        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);




function navClt($scope, $http) {




}
;