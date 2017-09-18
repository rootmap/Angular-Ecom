/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd')
    .controller('busController', function ($scope, $http) {
        $scope.panelHeading = "Share your Contact Details";
        $scope.btn_search = "Search Buses"
        $scope.search = "Search Result Between From- To";
        $scope.t_no = "# No";
        $scope.t_busName = "Bus Name";
        $scope.t_sit = "Sit";
        $scope.t_time = "Departure Time";
        $scope.t_price = "Price";
        $scope.t_buy = "Buy Tickets";

      
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