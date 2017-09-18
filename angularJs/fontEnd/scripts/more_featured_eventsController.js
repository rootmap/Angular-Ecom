/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. "http://www.w3schools.com/angular/customers.php"
 */
/* global angular */

//angular.module('frontEnd').controller('navClt', navClt);
angular
        .module('frontEnd', [])
        .controller('moreFeaturedEventsController', function ($scope, $http, $window) {

$scope.all=function(cetagoryId,status){
    //alert(status);
    if(status==1){
        showCategoryFeatureEvents(cetagoryId);
    }else{
        allFeatureEvents();
    }
}
 $scope.all();
            //$scope.showCategoryFeatureEvents = function (cetagoryId) {
            $scope.floading = true;
            function showCategoryFeatureEvents(cetagoryId) {
                        //console.log(cetagoryId);
                       // alert('fdg');
                        $http.post('php/more_featured_eventsPhpControllerOnCetagory.php', {'cid': cetagoryId}).then(function (response) {
                            //$scope.cEvent = response.data;
                            $scope.moreEvent = response.data;
                            $scope.floading = false; 
                        });
                    }

            //$scope.allFeatureEvents = function () {
            
            function allFeatureEvents() {
                
                $http.get('php/more_featured_eventsPhpController.php').then(function (response) {
                    $scope.moreEvent = response.data;
                     $scope.floading = false;
                    
                });
            }


            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });


            $scope.addToWishlist = function (Eid, Etype) {
                if (Eid != '') {
                    $http.post('php/wishlistPhpController.php', {'id': Eid, 'type': Etype}).then(function (response) {
                        $scope.data = response.data;
                        //console.log(Eid,Etype)
                    });
                }
            }


//     var minTime = 2;
//             $scope.searchResult = '';
//             $scope.EventHint = '';
//             
//             
//             $scope.searchEvent = function(){
//                 if($scope.EventHint.length == minTime )
//                       $scope.executeSearchResult()
//                 else  $scope.searchData = ' ';
//             };
//             
//             $scope.executeSearchResult = function(){
//                 $http.post("php/indexSearchPhpController.php").then(function(response){
//                     $scope.searchResult = response.data;
//                     
//                 });
//             }
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
function navClt($scope, $http) {




}
;