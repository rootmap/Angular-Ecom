/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular.module('frontEnd', ['angular-growl'])
        .controller('wishlistController', function ($scope, $http, growl) {
            //            page title start variables start
            $scope.your = "Your";
            $scope.Wishlist = "Wishlist";
            //            page title start variables end    

            //            table iteam variables start
            $scope.Item = "Item";
            $scope.Item_name = "Item name";

            $scope.Quantity = "Quantity";

            $scope.Date = "Date";

            $scope.Action = "Action";
            //            table iteam variables end 


            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        //$scope.msg=response.data;
                        growl.success("customar successfull subscribed !", {title: ' '});
                    })
                }
            }



            getWishlistData();
            function getWishlistData() {
                $http.get('php/wishlistPhpController.php')
                        .then(function (response) {
                            $scope.data = response.data;

                        });
            }

            $scope.deleteInfo = function (info) {
//               confirm("Do you want to delete data?");


                $http.post("php/wishlistPhpController.php", {"del_id": info.WL_id})
                        .then(function (response) {
                            if (response.data != '' ) {
                                growl.success('Delete successfully', {title: ' '});
                                getWishlistData();
                            }else if(response.data == '' ){
                                growl.error('Delete UnSuccessfully', {title: ' '});
                                getWishlistData();
                            }


                        });


            }

          
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

    // $scope.menuElementEvent = function (idn) {

    //     if (idn != '') {
    //         window.location.href="events.php?page="+idn;
    //     }

    // };


    $http.post('php/navbarPhpController.php').then(function (response) {
        $scope.element = response.data;
        //$scope.menuElementEvent(response.data[0].category_id);
    });
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



}
;
angular.module('frontEnd').controller('navClt', navClt);