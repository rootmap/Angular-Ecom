/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular.module('frontEnd', ['angular-growl'])

    .controller('cartController', function ($scope, $http,growl) {
        $scope.item = "Item";
        $scope.i_name = "Item name";
        $scope.price = "Unit Price";
        $scope.quntity = "Quantity";
        $scope.total = "SubTotal";
        $scope.cart_summary = "Cart Summary";
        $scope.st_item = "Totals Iteams";
        $scope.st_price = "Total Price";
        $scope.st_discount = "Discount";
        $scope.st_tax = "Tax";
        $scope.st_shopping = "Shopping";
        $scope.st_subtotal = "Subtotal";
        $scope.btn_apply = "Apply ";
        $scope.btn_checkout = "CHECKOUT";
        $scope.btn_ctext = "You can review this order before it's final";

       
        
            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {"email": Email}).then(function (response) {
                        $scope.msg = response.data;
                         growl.success("Customar Successfully subscribed.", {title: ' '});
                    })
                }
            }
          
            $scope.delectInfo = function (info) {
                //console.log(ETC_id,EITC_id);
//                var retVal = confirm("Do you want to delete data?");

                if (retVal == true) {
                    $http.post("php/cartPhpController.php", {"ETC_id":info.ETC_id,"EITC_item_id":info.EITC_item_id})
                    .then(function (response) {
                        growl.success("Item delete Successfully.", {title: ' '});
                        getdata() ;

                    });
                }

            }

           $scope.qntyChange = function(qnty,id) {
                $http.post("php/changeCartQnty.php", {"qnty":qnty,"EITC_id":id})
                    .then(function (response) {
                         growl.info("Your ticket quntity "+qnty, {title: ' '});
                         getdata(); 
                    });
//                console.log( qnty,id );
              };



               getdata(); 
            function getdata() {
                $scope.dataArray='';
                $scope.totalDiscount='';
                $scope.totalQuantity='';
                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function(response){
                    $scope.popupCart = response.data; 
                    $scope.dataArray= $scope.popupCart;  

                    for(i=0; i<$scope.dataArray.length; i++){
                       $scope.totalDiscount=($scope.totalDiscount-0)+($scope.dataArray[i].EITC_total_discount-0);
                       $scope.totalQuantity=($scope.totalQuantity-0)+($scope.dataArray[i].EITC_quantity-0);
                    }
                    //console.log($scope.totalQuantity)
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


function navClt($scope, $http) {
   


};
