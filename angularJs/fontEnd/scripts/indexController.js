angular
        .module('frontEnd', ['angular-growl', 'duScroll', 'ngSocial'])
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
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {
                        "email": Email
                    }).then(function (response) {
                        $scope.msg = response.data
                    })
                }
            }

//    function getdata() {
//        $scope.dataArray = '';
//        $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
//            $scope.popupCart = response.data;
//            $scope.dataArray = $scope.popupCart
//        });
//        $http.get('php/popupCart/popupCartEventDetailsController.php').then(function (response) {
//            $scope.popupCartEventDetails = response.data
//        })
//    }
//
//    $scope.totalPrice = function () {
//        var total = 0;
//        for (i = 0; i < $scope.dataArray.length; i++) {
//            total += ($scope.dataArray[i].EITC_total_price - 0)
//        }
//        return total
//    }

            $scope.SearchCityController = '';
            $http.get('php/searchEventCityController.php').then(function (response) {
                $scope.SearchCityController = response.data
            });


            $scope.cityName = "ALL";
            $scope.IsVisibleT = !1;
            $scope.ShowHide = function () {
                $scope.IsVisibleT = !0
            }




            $scope.allCityproduct = function () {
                alert('all');
//     $scope.cityName = 'All City';
//     $('#CitySearchResultPanel').hide();
            }

            $scope.scroller = function () {
                window.scrollTo(700, 700).animate({
//   scrollTop: $("#hiddenPartOfFeature").offset().top
                }, 2000)
            }

            $scope.eventLoadOnCityName = function (cityName) {


                if (cityName == 1) {
                    window.scrollTo($('#showPart'), 700);
                    $('#searchModal').hide();
                    $scope.cityName = 'All';

                    $('#showPart').show();
                    $('#CitySearchResultPanel').hide();
                } else {
                    
//                  $('#searchModal').hide();
                    $('#searchModal').modal('hide');
                    
                    $scope.cityName = cityName;

                    $('#CitySearchResultPanel').show();
                    $('#showPart').hide();

                    $http.post("php/indexSearchFeaturedEventByCityController.php", {"fcity": cityName}).then(function (response) {
                        window.scrollTo($('#CitySearchResultPanel'), 700);
                        $scope.cityName = cityName;
                        $scope.featureEventByCity = response.data;
                        growl.success("Responsed Successfully", {
                            title: ' '
                        });


                    });


                    $http.post("php/indexSearchCoveredEventByCityController.php", {"cName": cityName}).then(function (response) {

                        $scope.cityName = cityName;
                        $scope.PopularEventByCity = response.data;
//                        growl.success("Popular Event Responsed Successfully", {
//                            title: ' '
//                        });

                    });


                    $http.post("php/indexSearchUpcomingEventByCityController.php", {"cName2": cityName}).then(function (response) {


                        $scope.cityName = cityName;
                        $scope.UpcomingEventByCity = response.data;
//                        growl.success("Upcoming Event Responsed Successfully", {
//                            title: ' '
//                        });

                    });


                }
            }



            $scope.selectCity = function (cName) {

                if (cName == 1) {

                    $('#searchModal').hide();
                    //alert('All city');
                    window.scrollTo($('#showPart'), 700);
                    $('#showPart').show();
                    $('#CitySearchResultPanel').hide();

                    $scope.cityName = 'All';

                } else {

                    $('#searchModal').hide();
//            alert(cName);

                    $scope.cityName = cName;

                    $('#CitySearchResultPanel').show();
                    $('#showPart').hide();


                    window.scrollTo($('#CitySearchResultPanel'), 700);



//            $http.post("php/indexSearchUpcomingEventByCityController.php", {
//                "cName2": cName
//            }).then(function (response) {
//                if (response.data != '') {
//                    $scope.UpcomingEventByCity = response.data;
//                    //$('#hiddenPartOfUpcoming').show()
//                } else {
//                    //$('#cityUpcoming').hide();
//                    growl.warning("No Upcoming event can found in your city", {
//                        title: ' '
//                    })
//                }
//            });


                }

            }


            $scope.defineGalleryItem = [];
            $scope.LoadGalleryItem = function () {
                $scope.defineGalleryItem = [{
                        item: 'tc-merchant-template/assets/img/slider/new_banner2.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner1.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner3.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner4.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner5.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner6.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner7.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner8.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/new_banner9.jpg'
                    }, {
                        item: 'tc-merchant-template/assets/img/slider/Banner-2015-03-04-11-16-26.jpg'
                    }]
            }
            setTimeout(function () {
                $scope.LoadGalleryItem()
            }, 2000);
            $http.get("php/mainNavSearchController.php").then(function (response) {
                $scope.searchData = response.data
            });
            $scope.InitCrtHpST = function () {
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
                        $header.css(new_css)
                    }
                })
            }
            $scope.LoadFeatureInfo = function () {
                $http.get('php/featuredEventController.php').then(function (response) {
                    $scope.featuredEvents = response.data
                })
            }
            $scope.LoadCoveredEvents = function () {
                $http.post('php/coveredEventController.php').then(function (response) {
                    $scope.coveredEvents = response.data
                })
            }
            $scope.LoadUpcomingEvents = function () {
                $http.post('php/upcomingEventController.php').then(function (response) {
                    $scope.upcomingEvents2 = response.data
                })
            }
            $scope.clientsInfo = function () {
                $http.get('php/clientsController.php').then(function (response) {
                    $scope.clientsController = response.data
                })
            }
            $scope.GetTestimonial = function () {
                $http.get('php/testimonialController.php').then(function (response) {
                    $scope.testimonialController = response.data
                })
            }
            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data
            });
            var minTime = 2;
            $scope.searchResult = '';
            $scope.EventHint = '';
            $scope.searchEvent = function () {
                if ($scope.EventHint.length == minTime)
                    $scope.executeSearchResult()
                else
                    $scope.searchData = ' '
            };
            $scope.executeSearchResult = function () {
                $http.post("php/indexSearchPhpController.php").then(function (response) {
                    $scope.searchResult = response.data
                })
            }
        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(4000);
        growlProvider.globalDisableCountDown(!0)
    }]).directive('checkImage', function ($http) {
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
}).value('duScrollOffset', 75);