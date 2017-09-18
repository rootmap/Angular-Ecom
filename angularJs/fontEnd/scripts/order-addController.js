/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

angular.module('frontEnd', ['angular-growl'])
    .controller('order_addController', function ($scope, $http,growl) {

        $scope.m_i_1 = "Dashboard";
        $scope.m_i_2 = "Address";
        $scope.m_i_3 = "Favorite Event";
        $scope.m_i_4 = "Order";


        $scope.p0 = "true";
        $scope.p1 = "Edit";
        $scope.p2 = "Delete";
        $scope.p3 = "Default Delivery ";
        $scope.p4 = "Default Billing ";
        $scope.p5 = "ADD ADDRESS";
        $scope.p6 = "Phone:";
        $scope.p7 = "Address:";
        $scope.p8 = "Zip/Postal Code:";
        $scope.p9 = "City:";
        $scope.p10 = "Country:";
        $scope.p11 = "Title:";
        $scope.p12 = "Save";
        $scope.p13 = "Add New Address";
        $scope.p14 = "Reset";


        $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                   // $scope.msg=response.data;
                   growl.success("customar Successfully subscribe.", {title: ' '});
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
             
        

        getUserAddressData() ;
        
        function getUserAddressData() {
             $http.get('php/order-addPhpController.php')
                .then(function(response) {
                    $scope.orderAdd= response.data;
                   // console.log( s);

                });

        }

        getUserCountry_City() ;
        
        function getUserCountry_City() {
                $http.get('php/getAllCountry.php')
                .then(function(response) {
                    $scope.getAllCountry= response.data;
                   // console.log( s);

                });
                $http.get('php/getAllCity.php')
                .then(function(response) {
                    $scope.getAllCity= response.data;
                   // console.log( s);

                });

        }
        $scope.setDefaultAddress=function (USB_id,addType) {
            
 
  
            if (USB_id!='') {
                    //console.log(USB_id,addType);
                    $scope.fieldName='user_default_shipping'
                    $http.post('php/order-addPhpController.php',{'user_id':USB_id,'fieldName':addType}).then(function(response) {
                        //$scope.msg=response.data;
                        growl.success("Set default address successfully.", {title: ' '});
                    })
            }
        }

         $scope.deleteUserAddress=function (USB_id) {
            
//            var retVal = confirm("Do you want to delete data?");

                
                    if (USB_id!='') {
                    $http.post('php/order-addPhpController.php',{"UA_id":USB_id}).then(function(response) {
                        //$scope.msg=response.data;
                        getUserAddressData() 
                        growl.success("Address deleted successfully.", {title: ' '});
                    });
            }
               
         }


        $scope.currentUser = {};
    
            $scope.editInfo = function(info){
             
                    $scope.currentUser = info;
                   // console.log(info);
                }
    
        

        $scope.UpdateInfo = function(info){
            console.log(info);
            
                $http.post('php/userAddressUpdateController.php',{"UA_id":info.UA_id,"UA_user_id":info.UA_user_id,"phone":info.UA_phone,"address":info.UA_address,"zip":info.UA_zip,"city":info.city_name,"country":info.coun_id})
                .then(function(response){
                    //$scope.update=response.data;
                    //console.log(info.UA_zip);
                    getUserAddressData() ;
                    growl.success("Address update successfully.", {title: ' '});
            });  
                                                                   
        }

        $scope.addAdderss=function (address) {
            $http.post('php/addNewUserAddress.php',{"Addtitle":address.addTitle,"phone":address.phone,"address":address.address,"zip":address.zip,"city":address.city,"country":address.country})
            .then(function(response){
                
                if(response.data != ''){
                    growl.success("New address added successfully.", {title: ' '});
                    getUserAddressData();
                }else{
                     growl.error("Please fill all the fields.", {title: ' '});
                }
                
//                $scope.d=response.data;
//               getUserAddressData() ;
//                //console.log($scope.d);
//                 growl.success("New address add successfully.", {title: ' '});
            });
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


function navClt($scope, $http) {

     


};