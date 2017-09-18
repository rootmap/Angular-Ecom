/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular
    .module('frontEnd')
    .controller('order-dashboardController', function ($scope, $http) {

        $scope.m_i_1 = "Dashboard";
        $scope.m_i_2 = "Address";
        $scope.m_i_3 = "Favorite Event";
        $scope.m_i_4 = "Order";

        $scope.p1 = "My details";
        $scope.p2 = "First Name";
        $scope.p3 = "Last name";
        $scope.p4 = "Email";
        $scope.p5 = "Address";
        $scope.p6 = "Phone";
        $scope.p7 = "Postcode";
        $scope.p8 = "Update";
        $scope.p9 = "Settings";
        $scope.p10 = "Comments are enabled on My Events";
        $scope.p11 = "New Password";
        $scope.p12 = "Confirm Password";
        $scope.p13 = "Update";
        $scope.p14 = "Preferences";
        $scope.p15 = "I want to receive newsletter.";
        $scope.p16 = "I want to receive advice on buying and selling.";

        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    $scope.msg=response.data;
                })
            }
        }

         // popup cart data
                getdata(); 
             function getdata() {
                    $scope.dataArray='';
                    $http.get('php/popupCart/popupCartTotalPriceController.php').then(function(response){
                        $scope.popupCart = response.data;  
                        $scope.dataArray= $scope.popupCart;  
                    });

                    $http.get('php/popupCart/popupCartEventDetailsController.php').then(function(response){
                        $scope.popupCartEventDetails=response.data;
                    });
         
                }
                $scope.totalPrice = function(){
                
                var total = 0;
                for(i=0;i<$scope.dataArray.length;i++){
                   total +=($scope.dataArray[i].EITC_total_price-0);

                }
                 //console.log(total);
                return total;   
            }

             // popup cart data end
             
        
        $http.get('php/order-dashboardPhpController.php')
        .then(function(response) {
             $scope.name= response.data;
            console.log( $scope.name)
         
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