/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj', ['angular-growl']).controller('paymentgetawayServicesChargeslistController', function($scope, $http, growl) {
	$scope.loadpaymentGetaway = function() {
		$http.post("./php/controller/paymentgetawayServicesChargeslistController.php").success(function(data, status,config) {
			$scope.payGetawaydata = data;
			
		})
	}
	$scope.loadpaymentGetaway();
        
        $scope.Deletepaymentgetaway = function(id) {
		$http.post("./php/controller/paymentGetwayChargesInsertController.php",{pmdel:id}).success(function(data, status,config) {
                    
			 if(data == '4') {
				growl.error("Data Delete Successfull.", {
					title: ' '
				});
                                $scope.loadpaymentGetaway();
			} else {
				growl.error("Something went wrong, Please try again later.", {
					title: ' '
				})
			}
			
		})
	}
        
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])