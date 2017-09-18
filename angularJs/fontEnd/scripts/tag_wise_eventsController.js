angular
        .module('frontEnd', [])
        .controller('tagEventsController', function ($scope, $http, $window) {

                   
            $scope.dataLoadOnTag = function(tag) {
//                console.log(tag);
                        $http.post('php/tag_eventsPhpControllerOnCetagory.php', {'tagd': tag}).then(function (response) {
                            $scope.tagEvent = response.data;
                        });
                    }
                    
            $scope.dataLoadOnTag();        

            
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

