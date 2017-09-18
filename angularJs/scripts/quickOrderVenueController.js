/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj', ['angular-growl']).controller('quickOrderVenueController', function($scope, $http, growl) {
	$scope.DatainsertQuick = function(quickOrderall) {
		console.log(quickOrderall);
		$http.post("./php/controller/quickorderVenueController.php", {
			'eventTitle': quickOrderall.eventTitle,
			'vanueTitle': quickOrderall.vanueTitle,
			'TCT': quickOrderall.TCT,
			'ticketQuantity': quickOrderall.ticketQuantity
		}).success(function(data, status, config) {
			if(data == 1) {
				growl.success("Data Insert Successfully", {
					title: ' '
				})
                                 setTimeout(function(){ growl.info("Redirecting...",{title:' '}); }, 2000);
                                 window.location.href="order_list.php";
			} else {
				growl.error("Failed, Please Try Again.", {
					title: ' '
				})
			}
		})
	}
	$scope.loadQuickOrder = function() {
		$http.post("./php/controller/paymentMethodController.php", {
			'event_id': 1
		}).success(function(data, status, config) {
			$scope.EvntQkOrderData = data
		})
	}
	$scope.loadQuickOrder();
	$scope.loadQuickVenueList = function(evt) {
		$http.post("./php/controller/manualOrderVenueController.php", {
			'venue_event_id': evt
		}).success(function(data, status, config) {
			$scope.VenueQuickData = data
		})
	}
	$scope.loadoofflineChkVTList = function(evts) {
		$http.post("./php/controller/manualOrderTickettypeController.php", {
			'evt': evts
		}).success(function(data, status, config) {
			$scope.ticketQuickData = data
		})
	}
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])

//angular.module('merchantaj',['angular-growl']).controller('quickOrderVenueController',function($scope,$http,growl){$scope.DatainsertQuick=function(quickOrderall){console.log(quickOrderall);$http.post("./php/controller/quickorderVenueController.php",{'eventTitle':quickOrderall.eventTitle,'vanueTitle':quickOrderall.vanueTitle,'TCT':quickOrderall.TCT,'ticketQuantity':quickOrderall.ticketQuantity}).success(function(data,status,heards,config){if(data==1)
//{growl.success("Data Insert Successfully",{title:' '})}
//else{growl.error("Failed, Please Try Again.",{title:' '})}})}
//$scope.loadQuickOrder=function(){$http.post("./php/controller/paymentMethodController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.EvntQkOrderData=data})}
//$scope.loadQuickOrder();$scope.loadQuickVenueList=function(evt){$http.post("./php/controller/manualOrderVenueController.php",{'venue_event_id':evt}).success(function(data,status,heards,config){$scope.VenueQuickData=data})}
//$scope.loadoofflineChkVTList=function(evts){$http.post("./php/controller/manualOrderTickettypeController.php",{'evt':evts}).success(function(data,status,heards,config){$scope.ticketQuickData=data})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}]) 