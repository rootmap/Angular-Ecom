/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

angular
    .module('frontEnd',['angular-growl'])

    
    .controller('subscribe_newsletterController', function ($scope, $http,$timeout, growl) {
        $scope.title = "Not Subscribed Our Weekly Newsletter Yet ?";
        $scope.p1 = "Let's Subscribe And Stay Tuned For Exciting Events !";
        $scope.label = "Email";
        $scope.button = "Subscribe";
        $scope.p2 = " Already Subscribed?";
        $scope.p3 = "Unsubscribe";

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

        
        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    if(response.data == 1){
                        growl.success('customar successfull suscribed !!', {title: ' '});
                    }else if(response.data == 2){
                        growl.warning('subscribe_customer_list query  !!', {title: ' '});
                    }else if(response.data == 3){
                        growl.warning('Customar gmail address already exists  !!', {title: ' '});
                    }else{
                        growl.danger('something is going wrong', {title: ' '});
                    }
                })
            }
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

      
      

    }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]) ;

 
function navClt($scope, $http) {

     


};
