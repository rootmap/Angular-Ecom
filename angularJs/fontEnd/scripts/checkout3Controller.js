/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd',['directives', 'angular-growl'])
    .controller('checkout3Controller', function ($scope, $http,$window,growl) {
        $scope.checkoutOne = "CHECKOUT METHOD";
        $scope.checkoutTwo = "BILLING & SHIPPING";
        $scope.checkoutThree = "YOUR ORDER & PAYMENT ";
        $scope.signin_text = "Sign in";
        $scope.btn_fb = "Facebook";
        $scope.btn_g = "Google";
        $scope.or_text = "--------- OR ---------";
        $scope.btn_login = "Log in";
        $scope.lost_pass = "Lost your password?";
        $scope.createNewAcc = "Create New Account";
        $scope.terms = " Accept TicketChai";
        $scope.terms2 = "Terms And Conditions";
        $scope.signup = "Create Account";
        $scope.selectAdd = " Select Addresses: I want to...";
        $scope.have_tickets = "Have my ticket(s) delivered at home.";
        $scope.pick_from = "Pick from Ticketchai office.";
        $scope.venue = "Pick from Venue.";
        $scope.select_billingAdd = "Select Delivery & Billing Address";
        $scope.your_add = "Your Billing Address";
        $scope.checkbox_makeAdd = "Make this my delivery address";
        $scope.your_add2 = "Your Shipping Address";
        $scope.venue_add = "Our Venue Address";
        $scope.venue_add2 = " Razzak Plaza (8th Floor),1 New Eskaton Road, Moghbazar Circle, Dhaka-1217";
        $scope.btn_continue = "Continue";
        $scope.btn_continue2 = "Continue";
        $scope.office_add = "Our Office Adderss";
        $scope.office_add2 = " Razzak Plaza (8th Floor),1 New Eskaton Road, Moghbazar Circle, Dhaka-1217 ";
        $scope.office_add3 = " +880-1971-842538,+880-447-8009569";
        $scope.btn_continue3 = "Continue ";
        $scope.payment_method = "Payment Method";
        $scope.online_payment = "Online Payment";
        $scope.online_paymentText = "The easiest and safest way to send or receive money instantly on your mobile ";
        $scope.bkash_payment = "Bkash Payment";
        $scope.bkash_paymentText = "Bkash is one of the payment methods for making purchases on ticketchai.com. ";
        $scope.cash_onDelivery = "Cash On Delivery";
        $scope.cash_onDeliveryText = "Cash on Delivery is one of the payment methods for making purchases on ticketchai.com. ";
        $scope.cart_summary = "Cart Summary";
        $scope.cart_tblH1 = "Total Ticket Quantity";
        $scope.cart_tblH2 = "Total Ticket Price";
        $scope.cart_tblH3 = "Total Include Quantity";
        $scope.cart_tblH4 = "Total Include Price";
        $scope.cart_tblH5 = "Test(10.00%)";
        $scope.cart_tblH6 = "Extra API (5.00%)";
        $scope.cart_tblH7 = "Delivery Charge";
        $scope.cart_tblH8 = "asdasdsa(5%)";
        $scope.cart_tblH9 = "Payable Amount : ";


        // $scope warning=function(){
        //     growl.warning("please accept trams and condition", {title: ' '});
        // }

        // $http.get('php/checkout3PhpController.php')
        // .then(function(response) {
        //      $scope.name= response.data;
        //     console.log( $scope.name)
         
        // });

        getdata(); 
            function getdata() {
                $scope.dataArray='';
                $scope.totalDiscount='';
                $scope.totalQuantity='';
                $scope.cost='';
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

            $scope.registerUser=function(info) {
                //console.log(info.name,info.email,info.pass,info.con_pass);
                $http.post('php/checkout3SaveRegistrationData.php',{"name":info.name,"email":info.email,"pass":info.pass,"con_pass":info.con_pass}).then(function(response){
                    //$scope.popupCartEventDetails=response.data;
                    //console.log(info.name,info.email,info.pass,info.con_pass);
                    growl.success("customar registration complete.", {title: ' '});
                });
            }

            $scope.userSignin=function(id,pass) {
                console.log(id,pass);
                if (id !='' && pass !='') {
                    $http.post('php/signinPhpController.php',{"Emailaddress":id,"Password":pass}).then(function(response){
                    //console.log(info.name,info.email,info.pass,info.con_pass);
                    if (response.data == 1) {
                                growl.success("Login Successfully Completed.", {title: ' '}); 
                                $window.location.reload();                                  
                            } else if (response.data == 2) {
                                growl.error("Failed, Wrong Password.", {title: ' '});
                            } else if (response.data == 0) {
                                 growl.error("Username & Password not match.", {title: ' '});
                            }else{
                                console.log(data);
                            }

                    });
                }
                
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
       // getUserDefualtAdd() ;
        
        // function getUserDefualtAdd() {

            $http.get('php/shipping_billing.php')
            .then(function(response) {
                    $scope.getUserDeliveryAdd= response.data;
                    $scope.address=$scope.getUserDeliveryAdd[0].UA_address;
                    $scope.city=$scope.getUserDeliveryAdd[0].city_name;
                    $scope.city_id=$scope.getUserDeliveryAdd[0].UA_city_id;
                    $scope.zip=$scope.getUserDeliveryAdd[0].UA_zip;
                    $scope.country=$scope.getUserDeliveryAdd[0].country_name;
                    $scope.country_id=$scope.getUserDeliveryAdd[0].UA_country_id;
                    $scope.phone=$scope.getUserDeliveryAdd[0].UA_phone;
                    $scope.UA_id=$scope.getUserDeliveryAdd[0].UA_id;
                    $scope.UA_user_id=$scope.getUserDeliveryAdd[0].UA_user_id;
                  // console.log($scope.country);
   
                });

      // }

                 $scope.info=function(){
                    growl.success("please accept trams and condition.", {title: ' '});
                    
                 }   



       $scope.makeShippingAdd=function(a,c,z,coun,p,UA_id,user_id){
        //console.log(user_id)
            var retVal = confirm("Do you want to make your Billing Address your Shipping Address for this order??");

            if (retVal == true) {        
                $scope.add=a;
                $scope.city_id=c;
                $scope.s_zip=z;
                $scope.country_id=coun;
                $scope.s_phone=p;
             $http.post('php/checkout3PhpController.php',{"UA_id":UA_id,"UA_user_id":user_id,"address":a,"city":c,"zip":z,"country":coun,"phone":p}).then(function(response){
                growl.info("Now your billing address is shipping address.", {title: ' '});
             });
         }
       }

       
        $scope.getDeliveryCostResult=function(cityId){
            
            $http.post('php/getDeliveryCost.php',{"cityID":cityId}).then(function(response){
                $scope.dlyCost=response.data;
                $scope.cost= $scope.dlyCost[0].city_delivery_charge;
            });
        }

        $scope.verifyPayment = function(checkStatus) {
            //console.log(checkStatus)
            if (checkStatus !='') {
                 if (checkStatus=='1') {
                    $window.location.href = 'bkash-payment.php';
                 }else if(checkStatus=='2'){
                    $window.location.href = 'confirmation.php';
                }else{
                    $window.location.href = 'bkash-payment.php';
                }
            }else{
                 growl.warning("NO Payment option selected!! Please select option.", {title: ' '});
            }
            //$location.url('http://test.com/login.jsp');
        }

        // $http.get('php/checkout3PhpController.php')
        //     .then(function(response) {
        //             $scope.ticketPickPoint= response.data;
        //             $scope.homeDelivery=$scope.ticketPickPoint[0].event_is_home_delivery;
        //             $scope.pickFromOffice=$scope.ticketPickPoint[0].event_is_pickable_from_office;
        //             $scope.isPickable=$scope.ticketPickPoint[0].event_is_pickable;
                    
        //           // console.log($scope.country);
   
        //         });


       $scope.subscribe_newsletter=function(Email) {
            //console.log(Email);
            if (Email !='') {
                $http.post('php/subscribe_newsletterPhpController.php',{"email":Email}).then(function(response){
                    $scope.msg=response.data;
                    growl.success("customar Successfully subscribe.", {title: ' '});
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


 
}).config(['growlProvider', function(growlProvider) {
          growlProvider.globalTimeToLive(3000);
          growlProvider.globalDisableCountDown(true);
        }]);



angular.module('directives', []).directive('map', function($http) {
    return {
        restrict: 'E',
        replace: true,
        template: '<div></div>',
      
        link: function($scope, element, attrs) {
     
               $http.get('php/checkout3PhpController.php')
                .then(function(response) {
                    $scope.ticketPickPoint= response.data;
                    $scope.homeDelivery=$scope.ticketPickPoint[0].event_is_home_delivery;
                    $scope.pickFromOffice=$scope.ticketPickPoint[0].event_is_pickable_from_office;
                    $scope.isPickable=$scope.ticketPickPoint[0].event_is_pickable;
                    venue($scope.ticketPickPoint);
                  // console.log($scope.country);
   
                });
     
        var venue= function(city) {         
        
               var coordinate = city[0].venue_geo_location;
               // coordinate = coordinate.replace('"','');
               var coordinates =city[0].venue_geo_location.split(',');

                var myLatlng =coordinates[0];
                var myLatlng1 =coordinates[1];

               // console.log(myLatlng)
               // console.log(myLatlng1)

                  var center = new google.maps.LatLng(myLatlng,myLatlng1);

                var map_options = {
                    zoom: 14,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };          
              
                // create map
                var map = new google.maps.Map(document.getElementById(attrs.id), map_options);
                
                // configure marker
                var marker_options = {
                    map: map,
                    position: center
                };
                
                // create marker
                var marker = new google.maps.Marker(marker_options);
            };

        }
    }



});


function navClt($scope, $http) {

     


};

    
