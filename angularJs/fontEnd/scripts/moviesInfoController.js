
angular
        .module('frontEnd',[])
        .controller('moviesInfoController', function ($scope, $http) {
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

       
          

     $scope.movies_info=function(id){
        
        var m='00'+id;
       // console.log(m);
                $http.post('php/moviesInfoPhpController.php',{"movie_id":id}).then(function(response) {
                 $scope.name= response.data;
                 console.log(id)
            });
         } 
         
         
         
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

        
            

        }) ;
