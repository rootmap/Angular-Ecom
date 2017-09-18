/*compile techonogy www.minifier.org
 * 
 */

angular.module('merchantaj', ['angular-growl']).controller('addQuestionsController', function($scope, $http, growl) {
	$scope.addSingelData = function(offLineCheck) {
		if(offLineCheck.eventTitle != null) {
			$http.post("./php/controller/addQuestionsController.php", {
				'eventTitle': offLineCheck.eventTitle
			}).success(function(data, status,config) {
				growl.success("Data Insert Successfully", {
					title: ' '
				})
			})
		} else {
			growl.info("Please select an event", {
				title: ' '
			})
		}
	}
	$scope.makeDefEvent = function(id) {
		$scope.addSingelData.eventTitle = id;
		console.log(id)
	}
	$scope.addSingelDataandMore = function(offLineCheck) {
            
		if(offLineCheck.eventTitle != null) {
			$http.post("./php/controller/addQuestionsController.php", {
				'eventTitle': offLineCheck.eventTitle
			}).success(function(data, status,config) {
				if(data == 1) {
					growl.success("Data Insert Successfully", {
						title: ' '
					});
					setTimeout(function() {
						window.location.href = "add_more_questions.php?event_id=" + offLineCheck.eventTitle
					}, 1500)
				} else {
					growl.error("Failed, Please Try Again.", {
						title: ' '
					})
				}
			})
		} else {
			growl.info("Please select an event", {
				title: ' '
			})
		}
	}
	$scope.addskipData = function(offLineCheck,whenEdit) {
           //alert(offLineCheck);
          // alert(whenEdit)
		if(offLineCheck != null && offLineCheck != '') {
                   
			growl.info("Please wait we are processing your data.", {
				title: ' '
			});
			setTimeout(function() {
				window.location.href = "add_more_questions.php?event_id=" + offLineCheck
			}, 1500)
		}
                else if(whenEdit != null && whenEdit != '') {
                    // alert(whenEdit);
			growl.info("Please wait we are processing your data.", {
				title: ' '
			});
			setTimeout(function() {
				window.location.href = "add_more_questions.php?event_id=" + whenEdit
			}, 1500)
		}else {
			$scope.flyshow = "";
			growl.info("Please select an event", {
				title: ' '
			})
		}
	}
	$scope.loadoofflineChkListdd = function() {
		$http.post("./php/controller/paymentMethodController.php", {
			'event_id': 1
		}).success(function(data, status,config) {
			$scope.EvntOffChk = data;
			console.log(data)
		})
	}
	$scope.loadoofflineChkListdd();
	$scope.TicketsDetails = "Let's Add Your Event Question/Custom Field Details";
	$scope.NameMandatory = "Name (Mandatory)";
	$scope.EmailMandatory = "Email (Mandatory)";
	$scope.AddMoreQuestions = "Save & Add More Questions"
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])