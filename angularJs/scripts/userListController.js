/*compile techonogy www.minifier.org
 * 
 */

angular.module('merchantaj', ['angular-growl']).controller('userListController', function($scope, $http, growl) {
	$scope.loadUserList = function() {
		$http.get("./php/controller/userListController.php").then(function(response) {
			$scope.userlistdata = response.data;
		})
	}
	$scope.loadUserList();
//	$scope.loadoEventVenue = function() {
//		$http.post("./php/controller/paymentMethodController.php", {
//			'event_id': 1
//		}).success(function(data, status,  config) {
//			$scope.VenueNewData = data
//		})
//	}
//	$scope.loadoEventVenue();
	$scope.ModelDataReportDateWise = function(modelDataG) {
		//console.log(modelDataG);
		if(modelDataG.event != null) {
			$http.post("./php/controller/EvntWiseUserReportController.php", {
				'event': modelDataG.event
			}).success(function(data, status,  config) {
				$scope.userlistdata = data
			})
		}
	}
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])