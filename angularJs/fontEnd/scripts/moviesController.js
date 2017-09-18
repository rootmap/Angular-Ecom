/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 /* global angular */
//angular.module('frontEnd').controller('navClt', navClt);
angular
.module('frontEnd', [])
.controller('moviesController', function ($scope, $http) {
    $scope.movies = "Movies ";
    $scope.movies_showing = "Now Showing ";
    $scope.buy_eventTickets = "Book Tickets Shortly";
    $scope.buy_eventTickets2 = "Book Movie Tickets Shortly";
    $scope.btn_buy = "Ticket";
    $scope.btn_trailer = "Trailer";
    $scope.blockbuster = "Blockbuster Cinamas";
    $scope.mid='';
    $scope.mdate='';
    $scope.mslot='';
        //$scope.btn_2d = "2D";
        //$scope.genre_d = "Drama";
       // $scope.genre_a = "Action";
        //$scope.genre_s = "Sports";
        $scope.lan_h = "HINDI";
        $scope.btn_viewMore = "View More";
        $scope.btn_info = "Info";
        $scope.comig_soonTitle = "Movies";
        $scope.comig_soonSpan = "Coming Soon";


        $http.post('php/navbarPhpController.php').then(function (response) {
            $scope.element = response.data;
        });

        
        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    $scope.msg=response.data;
                })
            }
        }
        //$scope.ActiveMovies='';
        $scope.loadMovies=function(){

            $http.get("php/activemoviesController.php?active").then(function(response){
                //console.log(response);
                $scope.AllMovieSlot=[""];
                 $scope.slotTitle="Select Movie & Date";
                $scope.ActiveMovies=response.data;
                console.log($scope.ActiveMovies);
            });
        }

        $scope.loadMovieDates=function(){
            console.log($scope.mid);
            //alert($scope.mid);
            if($scope.mid!='')
            {

                $http.get("php/activemoviesController.php?mid="+$scope.mid).then(function(response){
                //console.log(response);
                $scope.AllMovieDates=response.data;
            });
            }
            else
            {
                    console.log($scope.mid);
            }
        }

        $scope.slotTitle="Select Movie & Date";

        $scope.loadMovieSlot=function(){
            //console.log($scope.mid);
            //alert($scope.mid);
            if($scope.mid!='' && $scope.mdate!='')
            {
                $scope.slotTitle="Loading....";

                $http.get("php/activemoviesController.php?vid="+$scope.mid+"&vd="+$scope.mdate).then(function(response){
                //console.log(response);
                $scope.slotTitle="Select Schedule Time";
                $scope.AllMovieSlot=response.data;
            });
            }
            else
            {
                    console.log($scope.mid);
            }
        }

        $scope.loadMovieSeatInInfo=function(){
            //console.log($scope.mid);
            //alert($scope.mid);
            if($scope.mid!='' && $scope.mdate!='' && $scope.mslot!='')
            {
               window.location.href="movies_purchase.php?Mid="+$scope.mid+"&MDate="+$scope.mdate+"&MSlot="+$scope.mslot;
            }
            else
            {
                    alert("Please Select Movie, Date, Movie Schedule.");
            }
        }



        



         // popup cart data
            //     getdata(); 
            //  function getdata() {
            //         $scope.dataArray='';
            //         $http.get('php/popupCart/popupCartTotalPriceController.php').then(function(response){
            //             $scope.popupCart = response.data;  
            //             $scope.dataArray= $scope.popupCart;  
            //         });

            //         $http.get('php/popupCart/popupCartEventDetailsController.php').then(function(response){
            //             $scope.popupCartEventDetails=response.data;
            //         });

            //     }
            //     $scope.totalPrice = function(){

            //     var total = 0;
            //     for(i=0;i<$scope.dataArray.length;i++){
            //        total +=($scope.dataArray[i].EITC_total_price-0);

            //     }
            //      //console.log(total);
            //     return total;   
            // }

             // popup cart data end
             

             $http.get('php/moviesPhpController.php')
             .then(function(response) {
               $scope.name= response.data;
                //console.log( $scope.name)
            });





           // ******************************* popup cart *************************************
                //getdata(); 
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

            // ******************************* popup cart end*************************************
            
            
            
            
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