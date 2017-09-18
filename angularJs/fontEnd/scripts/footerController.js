/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular
        .module('frontEnd')
        .controller('footerController', function ($scope) {
            $scope.panelHeading = "Share your Contact Details";
            $scope.btn_search ="Search Buses"
            $scope.search = "Search Result Between From- To";
            $scope.t_no = "# No";
            $scope.t_busName = "Bus Name";
            $scope.t_sit = "Sit";
            $scope.t_time = "Departure Time";
            $scope.t_price = "Price";
            $scope.t_buy = "Buy Tickets";
            
            
            
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

