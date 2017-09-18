/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compiler techonology http://www.minifier.org/
 */
angular.module('merchantaj').controller('eventController', function($scope, $http) {
	$scope.eventsdata = [];
	$scope.loadAllActive = function(param) {
		$scope.loading = !0;
		$scope.params = 'active';
		$scope.params_bg = ' ';
		if(param == 1) {
			$scope.params = 'active'
		} else if(param == 2) {
			$scope.params = 'covered';
			$scope.params_bg = ' red_corner'
		} else if(param == 3) {
			$scope.params = 'pending';
			$scope.params_bg = ' blue_corner'
		} else if(param == 4) {
			$scope.params = 'upcoming';
			$scope.params_bg = ' blue_corner'
		}
		$http.post("./php/controller/eventsController.php", {
			'status': $scope.params
		}).success(function(data, status,  config) {
			$scope.eventsdata = data;
			$scope.loading = !1;
		})
	}
        //growl.error("Invaild email address", {title: ' '});
        $scope.publishUnPublish =function(status,id){
            $http.post("./php/controller/eventsController.php", {
			'event_status': status,'event_id':id
		}).success(function(data, status,  config) {
			//growl.error("Invaild email address", {title: ' '});
                       // $scope.loadAllActive();
                       location.reload(); 
		})
        }
        
})