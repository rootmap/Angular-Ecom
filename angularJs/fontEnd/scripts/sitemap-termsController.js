/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd')
    .controller('sitemap-termsController', function ($scope, $http) {
        

        $scope.num1 = "01.";
        $scope.num2 = "02.";
        $scope.num3 = "03.";
        $scope.num4 = "04.";
        $scope.num5 = "05.";
        $scope.num6 = "06.";
        $scope.num7 = "07.";
        $scope.num8 = "08.";
        $scope.num9 = "09.";
        $scope.num10 = "10.";
        $scope.num11 = "11.";
        $scope.num12 = "12.";
        $scope.num13 = "13.";
        $scope.num14 = "14.";
        $scope.num15 = "15.";
        $scope.num16 = "16.";
        $scope.num17 = "17.";
        $scope.num18 = "18.";
        $scope.num19 = "19.";

        //            table element variable start
        $scope.t_i_1 = "Terms & Condition";
        $scope.t_i_2 = "how to buy";
        $scope.t_i_3 = "Customer Support";
        $scope.t_i_4 = "Our Sponsor ";
        $scope.t_i_5 = "Sitemap ";
        //            table element variable end

        //            main content variables start


       

        

        
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

     


};