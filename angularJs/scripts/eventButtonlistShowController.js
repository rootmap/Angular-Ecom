/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj', ['angular-growl']).controller('eventButtonlistShowController', function($scope, $http, growl) {
	$scope.loadpaymentGetaway = function() {
		$http.post("./php/controller/eventButtonListShowController.php").success(function(data, status, config) {
			$scope.eventBtndata = data;
			console.log(data)
		})
	}
	$scope.loadpaymentGetaway();
        
        $scope.DeletepayList=function(event_id){
            //alert(event_id)
            $http.post("./php/controller/eventButtonListSaveController.php",{e_id:event_id}).success(function(data, status, config) {
			$scope.delete = data;
			console.log(data)
                        $scope.loadpaymentGetaway();
		})
        }
        
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])
//angular.module('merchantaj',['angular-growl']).controller('eventButtonlistShowController',function($scope,$http,growl){$scope.loadpaymentGetaway=function(){$http.post("./php/controller/eventButtonListShowController.php").success(function(data,status,heards,config){$scope.eventBtndata=data;console.log(data)})}
//$scope.loadpaymentGetaway()}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])