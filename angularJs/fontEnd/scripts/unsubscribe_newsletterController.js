/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

    angular.module('frontEnd', ['angular-growl'])
    .controller('unsubscribe_newsletterController', function ($scope, $http,growl) {

        $scope.title = " Bored Of Our Weekly Newsletters ?";
        $scope.p1 = " Let's Unubscribe And Keep Smiling !";
        $scope.label = "Email";
        $scope.button = "Unsubscribe";
        $scope.p2 = "Not Subscribed Yet?";
        $scope.p3 = " Subscribe";


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

        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    //$scope.msg=response.data;
                    growl.success("customar successfull subscribed !!", {title: ' '});
                })
            }else{
                growl.error("customar subscribed failed !!", {title: ' '});
            }
        }


          $scope.autoClick = function(oNum,o_id){
              console.log(o_id);
              
              $http.post('email/ordercancle_email.php',{osessionId:oNum,order_id:o_id}).then(function(response){
                  
              });
          }

        $scope.unsubscribe_newsletter=function(Email) {
//            console.log(Email);
           
                $http.post('php/unsubscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
//                        console.log(response.data);
                    if(response.data == 1){
                        growl.success("Unsubscribed Successfully!!", {title: ' '});
                    }else{
                        growl.warning("You are not a Subscribed User!!", {title: ' '});
                    }
                    
                })
            
        }

//growl.success("Customar successfull unsubscribed !!", {title: ' '});

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
}])


function navClt($scope, $http) {

     


};