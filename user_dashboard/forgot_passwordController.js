/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
//angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd',['angular-growl'])
    .controller('forgot_passwordController', function ($scope, $http,$window,growl) {
        $scope.title = "Forgot your password ?";

        $scope.des = "Let's Recover It Quickly And Start Again";
        $scope.p2 = "Reset";
        $scope.p3 = "Return To";
        $scope.p4 = "Login";

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
             $scope.name=0;
        $scope.forgor_pass=function(email){
			
			if(email !=null){
			
				$http.post('php/forgotPassController.php',{email:email})
				.then(function(response) {
					 //$scope.name= response.data;
                                 
					if(response.data>=1){
                                                 email_send(response.data);
						 growl.success("Please check your email and click the given link.", {title: ' '});
                                                 
					}else if(response.data==2){
						 growl.warning("This email is not registered.", {title: ' '});
					}else{
						 growl.error("Wrong !!, Give a valid email address.", {title: ' '});
					}
				 
				});
			}else{
				growl.error("Enter a valid email address.", {title: ' '});
			}
		}
                //email();
                function email_send(id){
                    $http.post('email/forgot_password.php',{user_id:id}).then(function(response) {
                        console.log($scope.name);
                    });
                }
     $http.post('php/navbarPhpController.php').then(function (response) {
            $scope.element = response.data;
            //$scope.menuElementEvent(response.data[0].category_id);
        });

       

    });


function navClt($scope, $http) {

     


};