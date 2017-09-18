/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. "http://www.w3schools.com/angular/customers.php"
 */
/* global angular */

//angular.module('frontEnd').controller('navClt', navClt);
angular.module('frontEnd', ['angular-growl'])

.controller('eventClt',function($scope, $http,$window,growl) {



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

    $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                  $scope.msg=response.data;
                    growl.success("customar Successfully subscribe.", {title: ' '});
                })
            }
        }

     

    $scope.addToWishlist = function(Eid,Etype){
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



    $http.get('php/searchEventCityController.php').then(function (response) {
        $scope.SearchCityController = response.data;
    });


        $scope.getEventByKeyword=function(cID,catId){
            console.log(cID,catId);
            if (catId != '') {
                $http.post('php/events_searchController.php', {'catId': catId}).then(function (response) {
                         $scope.searchResult = response.data;
                         $scope.title= 'Search Result';
                     });
                  
            }
        }
        
     
        
         $scope.categoryData=function(c_id){
            
           
                if (c_id != '') {
                    
                     $http.post('php/bannerPhpController.php', {'categoryId': c_id}).then(function (response) {

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


         
         

            // view more button

            $scope.viewMoreData=function(vm_id,type){
            //console.log(vm_id,type);
                window.scrollTo(360, 360); 
                if (vm_id != '') {
             
                    if (type=='f') {
                         $http.post('php/eventsPhpController.php', {'idm': vm_id}).then(function (response) {
                             $scope.more= response.data;
                             $scope.title= 'Featured events';
              
                         });
                     }else if (type=='up') {
                        $http.post('php/eventsUpcomingEvents.php', {'idm2': vm_id}).then(function (response) {
                         $scope.more = response.data;
                         $scope.title= 'Upcoming events';
                     });
                     }else{
                        $http.post('php/eventsCoveredEvents.php', {'idm3': vm_id}).then(function (response) {
                         $scope.more = response.data;
                         $scope.title= 'Covered events';
                     });
                     }
                     
                }
            }
            

            // view more button end

        
            
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



}).config(['growlProvider', function(growlProvider) {
  growlProvider.globalTimeToLive(3000);
  growlProvider.globalDisableCountDown(true);
}]);



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



