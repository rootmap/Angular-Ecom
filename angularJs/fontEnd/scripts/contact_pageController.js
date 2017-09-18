/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
        .module('frontEnd',['angular-growl'])
        .controller('contact_pageController', function ($scope, $http,growl) {
            $scope.contact_title = "Please Get in Touch With Us";
            $scope.title_span = "Please feel free to contact us any time we will get back to you asp.";
            $scope.btn_send = "Send";
            $scope.question = "Have Any Question?";
            $scope.share = "Share";
            $scope.c_info = "Contact Info";
            $scope.c_infoText1 = "You can contact or visit us in our office from Saturday to Thursday from 10:00 AM - 06:00 PM";
            $scope.c_infoText2 = "Razzak Plaza (8th Floor),1 New Eskaton Road, Moghbazar Circle, Dhaka-1217";
            $scope.c_infoText3 = "+880-1971-842538";
            $scope.c_infoText4 = "+880-1971-842538";
            $scope.c_infoText5 = "support@ticketchai.com";
            $scope.contact_title = "Please Get in Touch With Us";


            // popup cart data
           /* getdata();
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

            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                    })
                }
            }*/
            
            $scope.contact = function (info) {
                console.log(info);
                $http.post('php/contact_pagePhpController.php',{name:info.name,email:info.email,sub:info.sub,msg:info.msg})
                        .then(function (response) {
                            //$scope.name = response.data;
                            //console.log($scope.name)
                        });
                        $http.post('email/contact.php',{name:info.name,email:info.email,sub:info.sub,msg:info.msg}).then(function (response) {
                            $scope.status=response.data;
							if($scope.status==1){
								growl.success("Message successfully sent to ticketchai.", {
								title: ' '});
							}else{
								growl.error("Fail! send message.", {
                                    title: ' '});
							}
                        });
					}
					
            
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



        });


function navClt($scope, $http) {




}
;