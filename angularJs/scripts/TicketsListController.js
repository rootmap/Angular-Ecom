/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */



angular.module('merchantaj', ['angular-growl']).controller('TicketListCon', function($scope, $http, $timeout, growl) {
	$scope.loadTicketsList = function() {
		$http.get("./php/controller/ticketListController.php").success(function(data, status, config) {
			$scope.ticketListdata = data
		})
	}
	$scope.loadTicketsList();
	$scope.DeleteticketList = function(ticketList) {
		$http.post("./php/controller/ticketListDeleteController.php", {
			'TT_id': ticketList
		}).success(function(data, status, config) {
			if(data == 1) {
				growl.success("Deleted Successfully", {
					title: ' '
				});
				$scope.loadTicketsList()
			} else {
				growl.error("Failed To Deleted", {
					title: ' '
				})
			}
		})
	}
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])

//angular.module('merchantaj',['angular-growl']).controller('TicketListCon',function($scope,$http,$timeout,growl){$scope.loadTicketsList=function(){$http.get("./php/controller/ticketListController.php").success(function(data,status,heard,config){$scope.ticketListdata=data})}$scope.loadTicketsList();$scope.DeleteticketList=function(ticketList){$http.post("./php/controller/ticketListDeleteController.php",{'TT_id':ticketList}).success(function(data,status,heard,config){if(data==1){growl.success("Deleted Successfully",{title:' '});$scope.loadTicketsList()}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])