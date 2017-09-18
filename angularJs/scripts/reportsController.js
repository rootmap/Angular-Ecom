/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj').controller('reportsController', function($scope, $http) {
	$scope.salesReports = "0";
	$scope.custom_evt = "";
	$scope.loadAllEvent = function() {
		$http.post("./php/controller/reports_1Controller.php", {
			'reports': 1
		}).success(function(data, status,config) {
			$scope.salesReports = data
		})
	}
	$scope.loadAllEvent();
	$scope.loadreportslist = function() {
		$http.post("./php/controller/reportsController.php").success(function(data, status,config) {
			$scope.reportslistData = data
		})
	}
	$scope.loadreportslist();
	$scope.loadoEventAllList = function(param) {
		console.log(param);
		if(param == '') {
			$scope.param = {}
		} else {
			$scope.param = {
				'date': param
			}
		}
		$http.post("./php/controller/eventTicketInfoSoldController.php", $scope.param).success(function(data, status,config) {
			$scope.alleventdata = data.lstevt;
			$scope.totalSales = data.salesdata;
			$scope.NetEarnings = data.netearningsdata;
			$scope.Refunds = data.refundsdata;
			$scope.Refunds_remain = data.refundsremaindata;
			$scope.Registration = data.userdata;
			console.log(alleventdata)
		})
	}
	$scope.loadoEventWiseList = function(evtparam, param) {
		console.log(param);
		if(param == '') {
			$scope.param = {}
		} else {
			$scope.param = {
				'date': param,
				'evt': evtparam
			}
		}
		$http.post("./php/controller/eventTicketInfoSoldController.php", $scope.param).success(function(data, status,config) {
			$scope.alleventdata = data.lstevt;
			$scope.totalSales = data.salesdata;
			$scope.NetEarnings = data.netearningsdata;
			$scope.Refunds = data.refundsdata;
			$scope.Refunds_remain = data.refundsremaindata;
			$scope.Registration = data.userdata;
			$scope.custom_evt = data.lstevt[0].event_title
		})
	}
	$scope.loadoEventWiseDateList = function(evtparam, param, paramd) {
		if(param == '') {
			$scope.param = {}
		} else {
			$scope.param = {
				'startdate': param,
				'enddate': paramd,
				'evt': evtparam
			}
		}
		$http.post("./php/controller/eventTicketInfoSoldController.php", $scope.param).success(function(data, status,config) {
			$scope.alleventdata = data.lstevt;
			$scope.totalSales = data.salesdata;
			$scope.NetEarnings = data.netearningsdata;
			$scope.Refunds = data.refundsdata;
			$scope.Refunds_remain = data.refundsremaindata;
			$scope.Registration = data.userdata;
			$scope.custom_evt = data.lstevt[0].event_title
		})
	}
	$scope.totalSales = "0";
	$scope.NetEarnings = "0";
	$scope.RemainingToTransfer = "0";
	$scope.Refunds = "0";
	$scope.Registration = "0"
})



     