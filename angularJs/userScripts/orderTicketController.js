angular
        .module('user', ['ngSanitize'])
        .controller('orderticketController', function ($scope, $http) {


//            $scope.orderData = [];



            $scope.oData = function (oId) {
                $http.post('./php/controller/orderDetailsData.php', {'oid': oId}).success(function (data, status, config) {
                    $scope.orderData = data;
                    var html = $scope.orderData[0].event_description;
                    var txt = document.createElement("textarea");
                    txt.innerHTML = html;

                    $scope.content_test = txt.value;
                    //$scope.htmlcontent = $scope.orderData;
                    // $scope.disabled = false;
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
}).filter('htmlToPlaintext', function () {
    return function (text) {
        return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});

