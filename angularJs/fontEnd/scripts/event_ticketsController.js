/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
//angular.module('frontEnd').controller('navClt', navClt);
 //.module('frontEnd',['directives'])
angular
       
        .module('frontEnd', ['directives','angular-growl'])
        .controller('event_ticketsController', function ($scope, $http,growl) {
            $scope.promotion = "No offers and promotion found.";
            $scope.tab_one = "Tickets";
            $scope.tab_two = "About Event";
            $scope.tab_three = "Venue";
            $scope.tab_four = "Gallery";
            $scope.tab_fives = "T & C";
            $scope.checkout_heading = "New Checkout Test Event";
            $scope.btn_calender = "ADD TO CALENDAR";
            $scope.c_li1 = "Action";
            $scope.c_li2 = "Another action";
            $scope.c_li3 = "Something else here";
            $scope.c_li4 = "Separated link";
            $scope.c_li5 = "One more separated link";
            $scope.lebel_consert = "Concert";
            $scope.lebel_music = "Music";
            $scope.panel_h1 = "Event Tickets";
            $scope.panel_h2 = "Event Includes";
            $scope.tbl_h1 = "Ticket Type";
            $scope.tbl_h2 = "Quantity";
            $scope.tbl_h3 = "Price";
            $scope.tbl_h4 = "Action";

           


            $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
                if (Email !='') {
                    $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                        $scope.msg=response.data;
                        growl.success("Customar Successfully subscribed.", {title: ' '});
                    })
                }
            }

            

            $scope.addToWishlist = function(Eid,Etype){
                if(Eid != ''){
                    $http.post('php/wishlistPhpController.php',{'id':Eid,'type':Etype}).then(function(response){
                        $scope.data = response.data;
                       // console.log(Eid,Etype)
                       //eventDetailCall();
                       growl.success("Item Successfully add to wishlist.", {title: ' '});
                    });
                }
            }

            // popup cart 
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
           

            $scope.addTocart = function(type, eventID, venueID, itemID,count){
                if(eventID != ''){
                    console.log(type, eventID,venueID,itemID,count) 
                    $http.post('php/addToCartController.php',{'type':type,'eventID':eventID,'venueID':venueID,'itemID':itemID,'quantity':count}).then(function(response){
                        $scope.addToCartEventTicketType = response.data; 
                        getdata();  
                        growl.success("Item Successfully add to cart.", {title: ' '});        
                    });
                }
            }
               
          
            $scope.totalPrice = function(){
                
                var total = 0;
                for(i=0;i<$scope.dataArray.length;i++){
                   total +=($scope.dataArray[i].EITC_total_price-0);

                }
                 //console.log(total);
                return total;   
            }

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

       
             

        }).config(['growlProvider', function(growlProvider) {
  growlProvider.globalTimeToLive(3000);
  growlProvider.globalDisableCountDown(true);
}]);

angular.module('directives', []).directive('map', function($http) {
    return {
        restrict: 'E',
        replace: true,
        template: '<div></div>',
      
        link: function($scope, element, attrs) {
          
             $scope.eventVisit = function(Eid,pageName){
               // console.log(Eid,pageName);
                if(Eid != ''){
                    var page='event_tickets.php';
                    $http.post('php/eventVisit.php',{'id':Eid,'page':page}).then(function(response){
                        $scope.data = response.data;
                        console.log('re')
                       //eventDetailCall();
                       growl.success("Item Successfully add to wishlist.", {title: ' '});
                    });
                }
            }
           

             $scope.f_eventDetailCall = function (Eid) {
                
                if (Eid != '')
                {
                    
                    $http.post('php/featured_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
                        $scope.details = response.data;
                        venue($scope.details);
                         getdata();
                    });
                    $http.post('php/eventTicketTypeTicketController.php', {'id':Eid}).then(function (response) {
                      // console.log(Eventid);
                        $scope.eventTicketTypeTicket = response.data;
                       
                                               
                    });
                       $http.post('php/eventTicketTypeIncludeController.php', {'id':Eid}).then(function (response) {
                      // console.log(Eventid);
                        $scope.eventTicketTypeInclude = response.data;
                      
                    });
                    
               }
            }
             $scope.c_eventDetailCall = function (Eid) {
                
                if (Eid != '')
                {
                    
                    $http.post('php/covered_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
                        $scope.details = response.data;
                        $scope.hide='true';
                        venue($scope.details);
                         getdata();
                    });   
               }
            }
            $scope.up_eventDetailCall = function (Eid) {
                
                if (Eid != '')
                {
                    
                    $http.post('php/upcomming_event_ticketsPhpController.php', {'id':Eid}).then(function (response) {
                        $scope.details = response.data;
                        $scope.hide='true';
                        venue($scope.details);
                         getdata();
                    });   
               }
            }
            


        var venue= function(city) {         
        
               var coordinate = city[0].venue_geo_location;
               // coordinate = coordinate.replace('"','');
               var coordinates =city[0].venue_geo_location.split(',');

                var myLatlng =coordinates[0];
                var myLatlng1 =coordinates[1];

                console.log(myLatlng)
                console.log(myLatlng1)

                  var center = new google.maps.LatLng(myLatlng,myLatlng1);

                var map_options = {
                    zoom: 14,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };          
              
                // create map
                var map = new google.maps.Map(document.getElementById(attrs.id), map_options);
                
                // configure marker
                var marker_options = {
                    map: map,
                    position: center
                };
                
                // create marker
                var marker = new google.maps.Marker(marker_options);
            };

        }
    }



});
// function navClt($scope, $http) {

     


// };


