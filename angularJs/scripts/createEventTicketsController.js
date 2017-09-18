/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj', ['angular-growl']).controller('createEventTicketsController', function($scope, $http, growl) {
	$scope.mrchntNew = [];
	$scope.typedef = 0;
        
	$scope.insert = function(mrchntNew,edit,tid,e_id) {
           
		$scope.stdate = $("#start-date").val();
		$scope.enddate = $("#end-date").val();
		$scope.sattime = $("#start-time").val();
		$scope.endtime = $("#EndTimeEdit").val();
                $scope.desc=$('#TicketDescriptionEdit').val();
                $scope.msg=$('#MessageToAttendeeEdit').val();
               // alert($scope.endtime);
		growl.info("Creating event ticket please wait...", {
			title: ' '
		});
		$http.post("./php/controller/createEventTicketsController.php", {
			'event_id': mrchntNew.event_id,
                        'eventid': e_id,
                        'ticket_id':tid,
			'TicketName': mrchntNew.TicketName,
			'Qty': mrchntNew.Qty,
			'MinQty': mrchntNew.MinQty,
			'MaxQty': mrchntNew.MaxQty,
			'TicketType': mrchntNew.TicketType,
			'Currency': mrchntNew.Currency,
			'Price': mrchntNew.Price,
			'Availability': mrchntNew.aid,
			'WhowillpayTicketchaifee': mrchntNew.WhowillpayTicketchaifee,
			'StartDate': $scope.stdate,
			'EndDate': $scope.enddate,
			'StartTime': $scope.sattime,
			'EndTime': $scope.endtime,
			'TicketDescription':$scope.desc,
			'MessageToAttendee': $scope.msg,
                        'checkIfedit':edit
		}).success(function(data, status, config) {
			growl.success("Insert Value Submit successfully", {
				title: ' '
			});
			$http.post('./email/merchentTicketCreation.php', {
				'event_id': mrchntNew.event_id,
				'TicketName': mrchntNew.TicketName
			}).success(function(data, status, config) {
				console.log('mail send');
				growl.success("Thank You, Your ticket is created successfully.", {
					title: ' '
				});
				growl.info("Redirecting...", {
					title: ' '
				});
				setTimeout(function() {
					window.location.href = "ticket_list.php"
				}, 1000);
				window.location.href = "ticket_list.php"
			});
			$scope.loadTicketsList()
		})
	}
	$scope.loadoEvent = function() {
		$http.post("./php/controller/paymentMethodController.php", {
			'event_id': 1
		}).success(function(data, status, config) {
			$scope.evtlist = data
		})
	}
	$scope.loadoEvent();
	$scope.aid = "0";
	$scope.availability = function(avd) {
		return $scope.aid = avd
	}
	$scope.loadTicketsType = function() {
		$http.get("./php/controller/ticketTypeController.php").success(function(data, status, config) {
			$scope.ticketTypedata = data
		})
	}
	$scope.loadTicketsType();
	$scope.loadCurrenccy = function() {
		$http.get("./php/controller/currencyController.php").success(function(data, status, config) {
			$scope.CurrentData = data
		})
	}
	$scope.loadCurrenccy();
	$(document).ready(function() {
		$("#start-date-box").click(function() {
			$("#start-date").click()
		})
	});
	$scope.loadTicketsList = function() {
		$http.post("./php/controller/ticketListController.php", {
			'TT_id': 1
		}).success(function(data, status, config) {
			$scope.ticketListdata = data;
			//console.log(data)
		})
	}
	$scope.loadTicketsList();
	$scope.EditDataGetticket = function(ticketList) {
		$http.post("./php/controller/ticketEditController.php", {
			'id': ticketList
		}).success(function(data, status, config) {
			$scope.typedefit = data[0].TT_type_id;
			$scope.curnt = data[0].TT_currency;
			$scope.mrchntNew.event_id = data[0].event_id;
			$scope.mrchntNew.TicketName = data[0].TT_type_title;
			$scope.mrchntNew.Qty = data[0].TT_ticket_quantity;
			$scope.mrchntNew.MinQty = data[0].TTmin_quantity;
			$scope.mrchntNew.MaxQty = data[0].TT_per_user_limit;
			$scope.mrchntNew.TicketType = data[0].TT_type_id;
			$scope.mrchntNew.Currency = data[0].TT_currency;
			$scope.mrchntNew.Price = data[0].TT_price;
			$scope.mrchntNew.aid = data[0].TT_availability;
			$scope.mrchntNew.WhowillpayTicketchaifee = data[0].TT_WhowillpayTicketchaifee;
			$scope.mrchntNew.startdate = data[0].TT_startDate;
			$scope.mrchntNew.starttime = data[0].TT_startTime;
			$scope.mrchntNew.enddate = data[0].TT_endDate;
			$scope.mrchntNew.endtime = data[0].TT_endTime
			$scope.mrchntNew.TicketDescription = data[0].TT_type_description;
			$scope.mrchntNew.MessageToAttendee = data[0].TT_MessageToAttendee
		})
	}
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
	$scope.whowillpayfee = function() {}
	$scope.newEventtickets = "Let's Add Your Ticket Details";
	$scope.TicketName = "Ticket Name";
	$scope.Qty = "Qty.";
	$scope.MinQty = "Min Qty.";
	$scope.MaxQty = "Max Qty.";
	$scope.TicketType = "Ticket Type";
	$scope.Currency = "Currency";
	$scope.Price = "Price";
	$scope.Availability = "Availability";
	$scope.WhowillpayTicketchaifee = "Who will pay Ticketchai fee";
	$scope.StartDate = "Start Date";
	$scope.StartTime = "Start Time";
	$scope.EndDate = "End Date";
	$scope.EndTime = "End Time";
	$scope.TicketDescription = "Ticket Description";
	$scope.MessageToAttendee = "Message To Attendee";
	$scope.Save = "Save"
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])