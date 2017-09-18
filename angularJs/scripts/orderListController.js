/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj',['angular-growl']).controller('orderListController', function($scope, growl, $http) {
    
    
      
    
	$scope.ModelDataReportDateWise = function(modelData) {
		console.log(modelData);
		var start_date = $("#start-date-order").val();
		var end_date = $("#end-date-order").val();
		if(start_date != null && end_date != null && modelData.event != null) {
			$http.post("./php/controller/OrderDateWiseController.php", {
				'event': modelData.event,
				'startdate': start_date,
				'enddate': end_date
			}).success(function(data, status, config) {
				$scope.orderlistdata = data
			})
		}
	}
	$scope.MEventWOrderReport = function(modelDataG) {
		console.log(modelDataG);
		if(modelDataG.event != null) {
			$http.post("./php/controller/EvntWiseOrderReportController.php", {
				'event': modelDataG.event
			}).success(function(data, status, config) {
				$scope.orderlistdata = data
			})
		}
	}
	$scope.loadoOrderList = function() {
		$http.post("./php/controller/orderListController.php", {
			'order_id': 1
		}).success(function(data, status, config) {
			$scope.orderlistdata = data
		})
	}
	$scope.loadoOrderList();
	$scope.loadoEventVenue = function() {
		$http.post("./php/controller/paymentMethodController.php", {
			'event_id': 1
		}).success(function(data, status, config) {
			$scope.VenueNewData = data
		})
	}
	$scope.loadoEventVenue();
	$scope.DeleteticketList = function() {
		$http.post("./php/controller/orderListDeleteController", {
			'order_id': 1
		}).success(function(data, status, config) {
			$scope.orderlistdata = data
		})
	}
	$scope.loadoOrderList();
	$scope.oid = '';
	$scope.email = '';
	$scope.msg = '';
	$scope.BindOIDcEm = function(Eticket) {
		$scope.oid = Eticket;
		console.log(Eticket)
	}
	$scope.sendmassage = function() {
            
//            alert($scope.msg);
//            alert($scope.oid);
		$http.post("./php/controller/e_ticketAndSmsSendContorller.php", {
			'etemail': $scope.email,
			'message': $scope.msg,
			'oid': $scope.oid
		}).success(function(data, status, config) {
			if(data == 1) {
				//$scope.flyshow = "data send successfully"
                                growl.success("Message Sent Successfully",{title:' '});
			} else if(data == 0) {
				//$scope.flyshow = "data send failed"
                                growl.error("Failed To Send Message",{title:' '});
			}
		})
	}
	$scope.attendeesEmailAll = '';
	$scope.attendeesEmailAll = 'Please Wait...';
	$scope.AllAttendeesEmail = function() {
		$http.post("./php/controller/allAttendeesForMerchent.php", {
			'id': 1
		}).success(function(data, status, config) {
			console.log(data);
			$scope.attendeesEmailAll = data
                        if(data == 1) {
				//$scope.flyshow = "data send successfully"
                                growl.success("Message Sent Successfully",{title:' '});
			} else if(data == 0) {
				//$scope.flyshow = "data send failed"
                                growl.error("Failed To Send Message",{title:' '});
			}
		})
	}
	$scope.AllAttendeesEmail();
	$scope.attendeesEmailAll = '';
	$scope.attendeesmsgAll = '';
	$scope.SendMessageToAllAttendees = function() {
		$http.post("./php/controller/e_ticketAndSmsAllSendContorller.php", {
			'email': $scope.attendeesEmailAll,
			'msg': $scope.attendeesmsgAll
		}).success(function(data, status, config) {
			$scope.VenueNewData = data
                        if(data == 1) {
				//$scope.flyshow = "data send successfully"
                                growl.success("Message Sent Successfully",{title:' '});
			} else if(data == 0) {
				//$scope.flyshow = "data send failed"
                                growl.error("Failed To Send Message",{title:' '});
			}
		})
	}
})
.config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])