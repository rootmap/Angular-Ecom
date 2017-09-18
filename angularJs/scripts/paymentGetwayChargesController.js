/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj', ['angular-growl']).controller('paymentGetwayChargesController', function($scope, $http, growl) {
	$scope.paymentgetawayListAll = function(paymentGetway) {
		$http.post("./php/controller/paymentGetwayChargesInsertController.php", {
			'event_id': paymentGetway.event_id,
			'payGateway': paymentGetway.payway
                
		}).success(function(data, status,  config) {
			if(data == 1) {
				growl.success("Thanks, Save Successfully.", {
					title: ' '
				});
				setTimeout(function() {
					window.location.href = 'paymentGetwayChargesServicesList.php'
				}, 2000)
			} else if(data == 2) {
				growl.success("Thanks, Updated Successfully.", {
					title: ' '
				});
				setTimeout(function() {
					window.location.href = 'paymentGetwayChargesServicesList.php'
				}, 2000)
			}else if(data == 3) {
				growl.error("Field is empty, please select event and button label.", {
					title: ' '
				})
			} else {
				growl.error("Something went wrong, Please try again later.", {
					title: ' '
				})
			}
		})
	}
	$scope.loadEvent = function() {
		$http.post("./php/controller/paymentMethodController.php").success(function(data, status,  config) {
			$scope.Evntpaymtd = data
		})
	}
	$scope.loadEvent();
	$scope.LoadPaymentGateway = function() {
		$http.get('./php/controller/paymentGatewayController.php').success(function(data, status,  config) {
			$scope.paygatewaymtd = data
		})
	}
	$scope.LoadPaymentGateway()
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])