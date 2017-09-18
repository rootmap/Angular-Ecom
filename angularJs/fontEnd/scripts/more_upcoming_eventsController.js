/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. "http://www.w3schools.com/angular/customers.php"
 */
/* global angular */

angular
    .module('frontEnd', [])
    .controller('moreUpcomingEventsController', function ($scope, $http) {
        $scope.upcoming = "Upcoming ";
        $scope.events = "Events";
        $scope.btn_fb ="Facebook";
        $scope.btn_tw ="Tweet";
        $scope.btn_g ="Google+";
         $scope.btn_buy = "Buy Ticket";


         $scope.all = function(cID , status){
             if(status == 1){
                 moreUeventOnCategory(cID);
             }else{
                 moreUevent();
             }
         }
         $scope.all();
         
         $scope.floading = true;
         function moreUeventOnCategory(catid){
             $http.get('php/more_upcomingeventsPhpControllerOnCetagory.php',{'cid':catid})
                .then(function(response) {
                     $scope.moreupcomingEvents= response.data;
                     $scope.floading = false;

                });
         }
         
         function moreUevent(){
              $http.get('php/more_upcoming_eventsPhpController.php')
                .then(function(response) {
                     $scope.moreupcomingEvents= response.data;
                     $scope.floading = false;
                });
         }

        

        
        
        $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });


        $scope.addToWishlist = function(Eid,Etype){
                if(Eid != ''){
                    $http.post('php/wishlistPhpController.php',{'id':Eid,'type':Etype}).then(function(response){
                        $scope.data = response.data;
                       //console.log(Eid,Etype)
                    });
                }
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

    

    }).directive('checkImage', function ($http) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            attrs.$observe('ngSrc', function (ngSrc) {
                $http.get(ngSrc).success(function () {
//                    alert('image exist');
                }).error(function () {
                    // alert('image not exist');
                    element.attr('src', '/ticketchaiorg/upload/event_web_banner/defaultImg.jpg'); // set default image
                    element.attr('src', '/ticketchaiorg/upload/event_web_logo/defaultImg.jpg'); // set default image
                });
            });
        }
    };
});