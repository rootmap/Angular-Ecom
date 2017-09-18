/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd')
    .controller('sitemap_customar_supportController', function ($scope, $http) {
        $scope.title = "CUSTOMER SUPPORT";
        $scope.title2 = "TICKETCHAI TERMS OF SERVICE AGREEMENT";

        $scope.des1 = "Tell us more about your shopping needs to be connected with a sales specialist in the Country .";

        $scope.des2 = "Welcome to Ticketchai. Ticketchai enables people all over the world to plan, promote, and sell tickets to any event. And we make it easy for everyone to discover events, and to share the events they are attending with the people they know. The following pages contain our Terms of Service, which govern all use of our Services.";

        $scope.des3 = "Chat with an Ticketchai Home & Home Office sales specialist before You buy, check your order status or get help with an order you already placed.";

        $scope.des4 = "Ticketchai Home & Home Office Email team provides sales and order assistance for customers purchasing from within the Country.";

        $scope.des5 = "To speak with a sales specialist. Available 6 days a week, from 9 am to 6 pm Bangladeshi time.";

        $scope.p1 = "Chat";
        $scope.p2 = "CHAT";
        $scope.p3 = "Email";
        $scope.p4 = "EMAIL";
        $scope.p5 = "Call +8801971842538";


        $scope.t_i_1 = "Terms & Condition";
        $scope.t_i_2 = "how to buy";
        $scope.t_i_3 = "Customer Support";
        $scope.t_i_4 = "Our Sponsor";
        $scope.t_i_5 = "Sitemap";



        
        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    $scope.msg=response.data;
                })
            }
        }



         // popup cart data
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
                $scope.totalPrice = function(){
                
                var total = 0;
                for(i=0;i<$scope.dataArray.length;i++){
                   total +=($scope.dataArray[i].EITC_total_price-0);

                }
                 //console.log(total);
                return total;   
            }

             // popup cart data end

             
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

       
       

    });


function navClt($scope, $http) {

     


};