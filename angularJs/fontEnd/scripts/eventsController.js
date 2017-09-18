/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. "http://www.w3schools.com/angular/customers.php"
 */
/* global angular */

//angular.module('frontEnd').controller('navClt', navClt);
angular.module('frontEnd', ['angular-growl'])

        .controller('eventClt', function ($scope, $http, $window, growl) {



            $scope.events_title = "Hottest events specially selected just for you!";
            $scope.buyTickets = "Buy Tickets Shortly";
            $scope.buy_eventTickets = "Buy Event Tickets Shortly";
            $scope.pnael_title = "Featured";
            $scope.pnael_titleStrong = " Events";
            $scope.btn_buy = "Buy Ticket";
            $scope.btn_details = "View Details";
            $scope.more_info = "More Info";
            $scope.addTo_wishlist = "Add To Wishlist";
            $scope.btn_viewAllFeture = "View All Featured Events";
            $scope.btn_viewAllUpcoming = "View All Upcoming Events";
            $scope.btn_viewAllCovered = "View All Covered Events";
            $scope.pnael2_title = "Upcoming";
            $scope.pnael2_titleStrong = " Events";
            $scope.up_commingEvents = "Some awesome events waiting to go live soon!";
            $scope.pnael3_title = "Covered";
            $scope.pnael3_titleStrong = " Events";
            $scope.panel3_text = "Some Successful Events Hosted Through Our Platform !";

            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                        growl.success("customar Successfully subscribe.", {title: ' '});
                    })
                }
            }



           $scope.addToWishlist = function(Eid,Etype){
              // console.log(Eid,Etype);
            if(Eid != ''){
                $http.post('php/wishlistPhpController.php',{'id':Eid,'type':Etype}).then(function(response){
                    
                    if(response.data != ''){
                         growl.success("Item added in wishlist Successfully", {title: ' '});
                    }else{
                        growl.error("Can't added with wishlist",{title: ' '});
                    }
                    
                  
                });
            }
        };

            $scope.AllCity=[];
            $scope.CityLocation = function ()
            {
                $http.get('php/searchEventCityController.php').then(function (response) {
                    $scope.AllCity = response.data;
                    console.log($scope.AllCity);
                });
            }
            
            setTimeout(function(){
                $scope.CityLocation();
            },4000);

//            <!--update in here-->

            $scope.getEventByKeys = function (location, category) {
//                alert(location);
//               alert(category);
                 
                 if(location != null || category != null){
                    window.scrollTo($('#s'), 400);
                    
                    $('#c').hide();
                    $('#c2').hide();
                    $('#c3').hide();
                    $('#viewMorePanel').hide();
                    $('#searchEvent').show();
                    $scope.loading = true;
                    
                    $http.post('php/events_searchController.php', {'location':location,'category': category}).then(function (response) {
                        $scope.searchResult = response.data;
                        $scope.loading = false;
                        $scope.title = 'Search Result';
                    });
                 }else{
                     growl.error("Please select location OR category first",{title: ' '});
                 }
                     
                 
               
                
            }
             
$scope.viewMoreData = function (categoryId, type) {
                //console.log(vm_id,type);
                
                if(categoryId != null && type != null){
                    window.scrollTo(400, 400);
                    $('#c').hide();
                    $('#c2').hide();
                    $('#c3').hide();
                    $('#viewMorePanel').show();
                    $scope.moreloading = true;
                    if (type == 'f') {
                        $http.post('php/eventsPhpController.php', {'idm': categoryId}).then(function (response) {
                            $scope.more = response.data;
                            $scope.moreloading = false;
                            $scope.title = 'Featured events';
                        });
                    } else if(type == 'up'){
                        $http.post('php/eventsUpcomingEvents.php', {'idm2': categoryId}).then(function (response) {
                            $scope.more = response.data;
                            $scope.moreloading = false;
                            $scope.title = 'Upcoming events';
                        });
                    }else if(type == 'c'){
                        $http.post('php/eventsCoveredEvents.php', {'idm3': categoryId}).then(function (response) {
                            $scope.more = response.data;
                            $scope.moreloading = false;
                            $scope.title = 'Covered events';
                        })
                    }else{
                        
                    }
                    
                }else{
                     growl.error("Something is going wrong",{title: ' '});
                 }
                
                
            }
            
            
//            $scope.moreloading = true;
//                console.log('moreloading: '+ $scope.moreloading);
//                if (vm_id != '') {
//                    if (type == 'f') {
//                        $http.post('php/eventsPhpController.php', {'idm': vm_id}).then(function (response) {
//                            $scope.more = response.data;
//                            $scope.moreloading = false;
//                            $scope.title = 'Featured events';
//                            
//                        });
//                    } else if (type == 'up') {
//                        $http.post('php/eventsUpcomingEvents.php', {'idm2': vm_id}).then(function (response) {
//                            $scope.more = response.data;
//                            $scope.moreloading = false;
//                            $scope.title = 'Upcoming events';
//                        });
//                    } else {
//                        $http.post('php/eventsCoveredEvents.php', {'idm3': vm_id}).then(function (response) {
//                            $scope.more = response.data;
//                            $scope.moreloading = false;
//                            $scope.title = 'Covered events';
//                        });
//                    }
//
//                }


            $scope.categoryData = function (c_id) {
                
//                alert(c_id);
                if (c_id != '') {
//                       alert(c_id);
                    $http.post('php/bannerPhpController.php', {'categoryId': c_id}).then(function (response) {
//                          alert(response.data);
                        $scope.bannerValue1 = response.data;
                        
                        
                    });

                    $http.post('php/eventsPhpController.php', {'idm': c_id}).then(function (response) {

                        $scope.eventsValue1 = response.data;


                    });
                    $http.post('php/eventsUpcomingEvents.php', {'idm2': c_id}).then(function (response) {

                        $scope.eventsValue2 = response.data;

                    });
                    $http.post('php/eventsCoveredEvents.php', {'idm3': c_id}).then(function (response) {

                        $scope.eventsValue3 = response.data;

                    });
                }

            }






            // console.log($scope.id);

            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
            });

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



        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]).directive('checkImage', function($http) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            attrs.$observe('ngSrc', function(ngSrc) {
                $http.get(ngSrc).success(function(){
//                    alert('image exist');
                }).error(function(){
                   // alert('image not exist');
                    element.attr('src', '/ticketchaiorg/upload/event_web_banner/defaultImg.jpg'); // set default image
                    element.attr('src', '/ticketchaiorg/upload/event_web_logo/defaultImg.jpg'); // set default image
                });
            });
        }
    };
});



// function navClt($scope, $http,$window) {





// };











// angular
// .module('frontEnd')
// .controller('eventsController', function ($scope, $http) {

//$.getScript("navbarController.js");
//        $.getScript("navbarController.js", function(){

//    alert("Script loaded but not necessarily executed.");

// });


// $scope.events_title = "Hottest events specially selected just for you!";
// $scope.buyTickets = "Buy Tickets Shortly";
// $scope.buy_eventTickets = "Buy Event Tickets Shortly";
// $scope.pnael_title = "Featured";
// $scope.pnael_titleStrong = " Events";
// $scope.btn_buy = "Buy Ticket";
// $scope.map = "DHAKA";
// $scope.more_info = "More Info";
// $scope.addTo_wishlist = "Add To Wishlist";
// $scope.btn_viewAllFeture = "View All Featured Events";
// $scope.pnael2_title = "Upcoming";
// $scope.pnael2_titleStrong = " Events";
// $scope.up_commingEvents = "Some awesome events waiting to go live soon!";
// $scope.pnael3_title = "Covered";
// $scope.pnael3_titleStrong = " Events";
// $scope.panel3_text = "Some Successful Events Hosted Through Our Platform !";







// $scope.sportElementEvent = function(idn){
//   //console.log(idn);    
//    if(idn != ''){
//        $http.post('php/eventsPhpController.php',{'idm':idn}).then(function(response){

//         $scope.sportsValue1 = response.data;


//        });
//        $http.post('php/eventsUpcomingEvents.php',{'idm2':idn}).then(function(response){

//         $scope.sportsValue2 = response.data;

//        });
//        $http.post('php/eventsCoveredEvents.php',{'idm3':idn}).then(function(response){

//         $scope.sportsValue3 = response.data;

//        });
//    }

// };


// $scope.addToWishlist = function(Eid,Etype){
//        if(Eid != ''){
//            $http.post('php/wishlistPhpController.php',{'id':Eid,'type':Etype}).then(function(response){
//                //$scope.d = response.data;
//                console.log(Eid,Etype)
//               //eventDetailCall();
//            });
//        }
//    }


// });



//  $http.post('php/eventsPhpController.php')
// .then(function(response) {
//      $scope.name= response.data;
//       if($scope.name != ''){
//          $scope.name1= true;
//          $scope.name2= false;
//       }


// });

// $http.post('php/eventsUpcomingEvents.php')
// .then(function(response) {
//      $scope.upcomingData= response.data;

// });

// $http.post('php/eventsCoveredEvents.php')
// .then(function(response) {
//      $scope.coveredData= response.data;

// });





// $http.get('php/eventsFreaturedEventsPhpController.php')
// .then(function(response) {
//      $scope.fevent= response.data;

// });

// $scope.menuElementId = function(Eid){
//         if(Eid != ''){
//             $http.post('php/eventsPhpController.php',{'id':Eid}).then(function(response){
//                 $scope.data = response.data;
//                console.log(Eid);
//             });
//         }
//     }



