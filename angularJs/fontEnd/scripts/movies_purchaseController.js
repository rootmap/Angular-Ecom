/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 /* global angular */
angular
.module('frontEnd')
.controller('movies_purchaseController', function ($scope, $http) {
    $scope.movieHeading = "Showing Now On ";
    $scope.movieHeading_span = " Blockbuster Cinemas";
    $scope.booking_tickets = "Please Start Booking Tickets Here !";
    $scope.request_date = "Current Requested Date: ";
    $scope.select_date = "Please select a date :";
    $scope.tbl_H1 = "SL";
    $scope.tbl_H2 = "THEATRE";
    $scope.tbl_H3 = "TIME";
    $scope.tbl_H4 = "TICKET";
    $scope.backTo_moviePage = "Get Back To All Movies Page";
    $scope.ticket_details = "Ticket";
    $scope.ticket_detailsSpan = "Detail";
    $scope.ticket_detailsText = "Your Ticket Details Here !";
    $scope.get_tickets = "Get Ticket";
    $scope.tickets_type = "Ticket Type";
    $scope.tickets_price = "Ticket Price";
    $scope.tickets_quantity = "Quantity";
    $scope.tickets_amount = "Ticket Amount";
    $scope.tickets_APIcharge = "API Charge";
    $scope.tickets_deliveryCharge = "Delivery Charge";
    $scope.tickets_Tamount = "Total Amount";
    $scope.seat_num = "Seat Number";
    $scope.seat_holdTime = "Seat Hold Time";


    $http.post('php/navbarPhpController.php').then(function (response) {
        $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });


    $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                    })
                }
            }

            $scope.loadMovieDetail=function(mid){

                $http.get("php/activemoviesController.php?MovieDetail="+mid).then(function(response){
                    //console.log(response);
                    $scope.MovieDetail=response.data;
                    //console.log($scope.MovieDetail);
                    $scope.banner="http://ticketchai.com/upload/event_web_banner/desktop/"+$scope.MovieDetail.event_web_banner;
                    $scope.thumb="http://ticketchai.com/upload/event_web_logo/"+$scope.MovieDetail.event_web_logo;
                    //$scope.getMetaBanner($scope.banner);
                    //alert($scope.fgh);
                    //alert($scope.MovieDetail.event_web_banner);
                    //alert($scope.source);
                    /*Utils.isImage($scope.source).then(function(result) {
                        $scope.result = result;
                        console.log($scope.result);
                    });
*/

                });
            }

            

            // popup cart data
//                getdata(); 
//             function getdata() {
//                    $scope.dataArray='';
//                    $http.get('php/popupCart/popupCartTotalPriceController.php').then(function(response){
//                        $scope.popupCart = response.data;  
//                        $scope.dataArray= $scope.popupCart;  
//                    });
//
//                    $http.get('php/popupCart/popupCartEventDetailsController.php').then(function(response){
//                        $scope.popupCartEventDetails=response.data;
//                    });
//         
//                }
//                $scope.totalPrice = function(){
//                
//                var total = 0;
//                for(i=0;i<$scope.dataArray.length;i++){
//                   total +=($scope.dataArray[i].EITC_total_price-0);
//
//                }
//                 //console.log(total);
//                return total;   
//            }

            // popup cart data end
// $scope.getNumber = function (num) {
//                //alert(num);
//                return new Array(num);
//               // console.log(Array(num));
//
//            }

$scope.getShowtime = function (mid, sDate) {
    console.log(mid, sDate);
    $http.post('php/movies_purchasePhpController.php',{Mid:mid,date:sDate})
    .then(function (response) {
        $scope.name = response.data;
        console.log($scope.name)

    });
}

//        $http.get('php/movies_purchasePhpController.php')
//        .then(function(response) {
//             $scope.name= response.data;
//            console.log( $scope.name)
//         
//        });


var minTime = 2;
$scope.searchResult = '';
$scope.EventHint = '';


$scope.searchEvent = function () {
    if ($scope.EventHint.length == minTime)
        $scope.executeSearchResult()
    else
        $scope.searchData = ' ';
};

$scope.executeSearchResult = function () {
    $http.post("php/indexSearchPhpController.php").then(function (response) {
        $scope.searchResult = response.data;




    });
}



})

.factory('Utils', function($q) {
    return {
        isImage: function(src) {

            var deferred = $q.defer();

            var image = new Image();
            image.onerror = function() {
                deferred.resolve(false);
            };
            image.onload = function() {
                deferred.resolve(true);
            };
            image.src = src;

            return deferred.promise;
        }
    };
});