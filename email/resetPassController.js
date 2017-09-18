/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
//angular.module('frontEnd').controller('navClt', navClt);
angular
    .module('frontEnd',['angular-growl'])
    .controller('reset_passwordController', function ($scope, $http,$window,growl) {
      

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
             $scope.resetPassUserId=function(u_id){
                 console.log(u_id);
             }
        $scope.resetPass=function(info){
			//console.log(info);
			
		
			if(info !=null){
				//growl.success("Password  matched", {title: ' '});
				$http.post('php/reset_passwordPhpController.php',{pass:info.pass,c_pass:info.c_pass})
				.then(function(response) {
					 //$scope.name= response.data;
					if(response.data==1){
						 growl.success("Password successfully changed.", {title: ' '});
					}else if(response.data==2){
						 growl.warning("Fail to change password.", {title: ' '});
					}else{
						 growl.error("Password not matched !!.", {title: ' '});
					}
				 
				});
			}else{
				 growl.error("Please fill up form", {title: ' '});
			}
			
		}


     $http.post('php/navbarPhpController.php').then(function (response) {
            $scope.element = response.data;
            //$scope.menuElementEvent(response.data[0].category_id);
        });

       

    });


function navClt($scope, $http) {

     


};