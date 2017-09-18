/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular
    .module('frontEnd')
    .controller('sitemap-sponsorController', function ($scope, $http) {
        $scope.t_i_1 = "Terms &amp; Condition";
        $scope.t_i_2 = "how to buy";
        $scope.t_i_3 = "Customer Support";
        $scope.t_i_4 = "Our Sponsor";
        $scope.t_i_5 = "Sitemap";

        $scope.title = "OUR SPONSORS";
        $scope.des1 = "Welcome to Ticketchai.  Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.";




        $scope.req1 = " Listing as Platinum Level Sponsor on the Ticketchai website";

        $scope.req11 = " Listing as Gold Level Sponsor on the Ticketchai website";

        $scope.req1111 = " Listing as Silver Level Sponsor on the Ticketchai website";


        $scope.req9 = " Prominent logo positioning on Ticketchai sponsorship page linking to the sponsor homepage or designated URL";

        $scope.req3 = " Press Release announcing sponsorship of Ticketchai";

        $scope.req4 = " Feature in Ticketchai annual magazine";


        $scope.req5 = " Sponsorship placard at Ticketchai booth during industry events";

        $scope.req6 = " Company signage at Ticketchai sponsored events";

        $scope.req7 = " Option to use the Ticketchai logo on your company’s promotional material for one year*";

        $scope.req8 = " Complimentary admission to Ticketchai events**";



        $scope.req12 = " Our Platinum Level Sponsors";

        $scope.req13 = "Our Gold Level Sponsors";

        $scope.req14 = " Our Sliver Level Sponsors";

        
        
        
        $http.post('php/navbarPhpController.php').then(function (response) {
        $scope.element = response.data;
        //$scope.menuElementEvent(response.data[0].category_id);
    });


         $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    $scope.msg=response.data;
                })
            }
        }
        
        $scope.sponsor=function() {
           
                $http.post('php/sitemap-sponsorPhpController.php').then(function(response){
                    $scope.sponsor=response.data;
                    console.log($scope.sponsor)
                })
           
        }
$scope.sponsor();

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



    });