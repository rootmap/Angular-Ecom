/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular
        .module('frontEnd', ['angular-growl', 'duScroll'])
        .controller('indexController', function ($scope, $http, growl) {

            $scope.panelHeading = "Share your Contact Details";
            $scope.featured = "Featured";
            $scope.covered = "Covered";
            $scope.upcoming = "Upcoming";
            $scope.events = "Events";
            $scope.btn_buy = "Buy Ticket";
            $scope.btn_fb = "Facebook";
            $scope.btn_tw = "Tweet";
            $scope.btn_g = "Google+";
            $scope.btn_viewMore = "View More";
            $scope.btn_readMore = "Read more";
            $scope.btn_moreInfo = "More Info";
            $scope.our_c = "What Our";
            $scope.customar_say = "Customers Say";
            $scope.customar_comments = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !";
            $scope.some_famous = "Someone famous";
            $scope.clients = "Our Valuable";
            $scope.clients1 = "Clients";
            $scope.client_span = "Our clients who hosted their events through our platform ";
            $scope.HTW = "How Ticketchai";
            $scope.HTW1 = "Works";
            $scope.CEPE = "CREATE EVENT PAGE EASILY";
            $scope.sell_ticket = "SELL TICKETS ONLINE";
            $scope.manage_text = "MANAGE FUNDS & REGISTRATIONS";
            $scope.btn_learnMore = "Learn More";
            $scope.we_g = "We are growing & how!";
            $scope.city = "Cities";
            $scope.organizers = "organizers";
            $scope.events_created = "events created";
            $scope.registrations = "registrations";
            $scope.feeling = "Feeling";
            $scope.interested = "Interested";
            $scope.about_us = "About Us?";
            $scope.create_freeEvent = "Create Event - It's Free!";


           




            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                    })
                }
            }


            // popup cart data
            //getdata();
            function getdata() {
                $scope.dataArray = '';
                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
                    $scope.popupCart = response.data;
                    $scope.dataArray = $scope.popupCart;
                });

                $http.get('php/popupCart/popupCartEventDetailsController.php').then(function (response) {
                    $scope.popupCartEventDetails = response.data;
                });

            }




            $scope.totalPrice = function () {

                var total = 0;
                for (i = 0; i < $scope.dataArray.length; i++) {
                    total += ($scope.dataArray[i].EITC_total_price - 0);

                }
                //console.log(total);
                return total;
            }

            // popup cart data end


            $scope.name = "Dhaka";
            $scope.IsVisibleT = false;
            $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisibleT = true;
            }
            $scope.selectCity = function (eventId, cName) {
//                console.log(eventId);

                $scope.name = cName;


                if (eventId != '') {
                    $http.post("php/indexSearchFeaturedEventByCityController.php", {"fcity": cName}).then(function (response) {

                        if (response.data != '') {
                            $scope.d = response.data;
                            growl.info("Your city's Current events are on loaded. Click on Search Button", {title: ' '});
                        } else {
                            growl.error("No current event can found in your city", {title: ' '});
                        }

                    });
                    $http.post("php/indexSearchCoveredEventByCityController.php", {"cName": cName}).then(function (response) {
                        $scope.c = response.data;

                    });
                    $http.post("php/indexSearchUpcomingEventByCityController.php", {"cName2": cName}).then(function (response) {
                        $scope.u = response.data;

                    });
                }

            }

            $scope.defineGalleryItem = [];
            $scope.LoadGalleryItem = function ()
            {
                $scope.defineGalleryItem = [
                    {item: 'tc-merchant-template/assets/img/slider/new_banner2.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner1.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner3.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner4.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner5.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner6.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner7.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner8.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/new_banner9.jpg'},
                    {item: 'tc-merchant-template/assets/img/slider/Banner-2015-03-04-11-16-26.jpg'}
                ];
            }

            
            
            setTimeout(function(){
                $scope.LoadGalleryItem();
            },2000);




//            index nav search box


            $http.get("php/mainNavSearchController.php").then(function (response) {
                $scope.searchData = response.data;
            });


//              $http.post('php/mainNavSearchController.php').success(function(data, status, heards, config){
//                  $scope.searchData = data;
//              });
//            index nav search box


            $scope.InitCrtHpST = function ()
            {
                $('.card .header img').each(function () {
                    $card = $(this).parent().parent();
                    $header = $(this).parent();

                    background_src = $(this).attr("src");

                    if (background_src != "undefined") {
                        new_css = {
                            "background-image": "url('" + background_src + "')",
                            "background-position": "center top",
                            "background-size": "cover"
                        };

                        $header.css(new_css);
                    }
                });
            }

            $scope.LoadFeatureInfo = function ()
            {
                $http.get('php/featuredEventController.php')
                        .then(function (response) {
                            $scope.featuredEvents = response.data;

                        });
            }

            $scope.LoadCoveredEvents = function ()
            {
                $http.post('php/coveredEventController.php')
                        .then(function (response) {
                            $scope.coveredEvents = response.data;


                        });
            }

            $scope.LoadUpcomingEvents = function ()
            {

                $http.post('php/upcomingEventController.php')
                        .then(function (response) {
                            $scope.upcomingEvents2 = response.data;
                        });
            }

            $scope.clientsInfo = function ()
            {
                $http.get('php/clientsController.php')
                        .then(function (response) {
                            $scope.clientsController = response.data;


                        });
            }

            $scope.GetTestimonial = function ()
            {
                $http.get('php/testimonialController.php').then(function (response) {
                    $scope.testimonialController = response.data;
                });
            }
            $scope.SearchCityController = '';
            $scope.GetAllCityInfo = function ()
            {
                $http.get('php/searchEventCityController.php')
                        .then(function (response) {
                            $scope.SearchCityController = response.data;
                        });
            }
            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                // $scope.menuElementEvent(response.data[0].category_id);
            });



//           $scope.dropDiv =false;
//           $scope.searchEvent = function(){
//               $scope.dropDiv = true;
//               
//               
//               $http.post("php/indexSearchPhpController.php").then(function(response){
//                   $scope.searchData = response.data;
//               });
//           }

//            var inputMin = 3;
//            $scope.searchresultdata = '';
//            $scope.EventHint = '';
//            $scope.searchEvent = function() {
//                
//                 if ($scope.EventHint.length >= inputMin) executeSomething()
//                 else $scope.searchresultdata = '';
//                
//
//            };
//
//            function executeSomething(){
//                $http.post("php/indexSearchPhpController.php").
//                        then(function (response) {
//                            
//                            $scope.searchResult = response.data; // Show result from server in our <pre></pre> element
//                        })
//            };


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
        growlProvider.globalTimeToLive(4000);
        growlProvider.globalDisableCountDown(true);
    }]);








