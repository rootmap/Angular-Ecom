/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj', ['angular-growl']).controller('venueAddController', function($scope, $http, growl) {
	$scope.venueAllData ={};
	$scope.DataSave = function(venueAllData) {
		console.log(venueAllData);
		growl.info("Creating venue ticket please wait...", {
			title: ' '
		});
		$http.post("./php/controller/VenueDataInsertController.php", {
			'event': venueAllData.event,
			'NameOfVenue': venueAllData.ven_name,
			'StreetLine': venueAllData.ven_address,
			'CityFrom': venueAllData.ven_city,
			'Country': venueAllData.ven_country
		}).success(function(data, status,  config) {
			growl.success("Insert Value Submit successfully", {
				title: ' '
			});
			$http.post('./email/merchentVenueCreation.php', {
				'event': venueAllData.event,
				'NameOfVenue': venueAllData.ven_name
			}).success(function(data, status,  config) {
				console.log('mail send');
				growl.success("Thank You, Your venue ticket is created successfully.", {
					title: ' '
				});
				growl.info("Redirecting...", {
					title: ' '
				})
			});
			if(data == 1) {
				growl.success("Data Insert Successfully", {
					title: ' '
				})
			} else if(data == 2) {
				$scope.flyshow = "Data Insert Falied";
				growl.error("Data Insert Falied", {
					title: ' '
				})
			}
		})
	}
	$scope.loadoEventVenue = function() {
		$http.post("./php/controller/paymentMethodController.php", {
			'event_id': 1
		}).success(function(data, status,  config) {
			$scope.VenueNewData = data
		})
	}
         
      
        
	$scope.loadoEventVenue();
	$scope.LoadvenueEditList = function(venueList) {
		$http.post("./php/controller/VenueListEditController.php", {
			'venue_id': venueList
		}).success(function(data, status,  config) {
			$scope.update = !0;
			$scope.venueAllData.venue_id = data[0].venue_id;
			$scope.venueAllData.event = data[0].venue_event_id;
			$scope.venueAllData.ven_name = data[0].venue_title;
			$scope.venueAllData.ven_addresss = data[0].venue_description;
			$scope.venueAllData.ven_city = data[0].city;
			$scope.venueAllData.ven_country = data[0].country;
			
		})
	}
        
        
	$scope.AutoVarVal = function(id, df) {
		$scope.venueAllData[id] = df;
		console.log($scope.venueAllData)
	}
	$scope.UpdateDataSave = function(venueAllData) {
		$http.post("./php/controller/VenueDataInsertController.php", {
			'venue_id': venueAllData.venue_id,
			'event': venueAllData.event,
			'NameOfVenue': venueAllData.ven_name,
			'StreetLine': venueAllData.ven_address,
			'CityFrom': venueAllData.ven_city,
			'Country': venueAllData.ven_country
		}).success(function(data, status,  config) {
			if(data == 1) {
				growl.success("Successfully Update Data", {
					title: ' '
				});
				$scope.update = !1
			} else if(data == "2") {
				growl.error("Failed To Update Data", {
					title: ' '
				})
			}
		})
	}
}).config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
	growlProvider.globalDisableCountDown(!0)
}])


//angular.module('merchantaj',['angular-growl']).controller('venueAddController',function($scope,$http,growl){$scope.venueAllData=[];$scope.DataSave=function(venueAllData){console.log(venueAllData);growl.info("Creating venue ticket please wait...",{title:' '});$http.post("./php/controller/VenueDataInsertController.php",{'event':venueAllData.event,'NameOfVenue':venueAllData.NameOfVenue,'StreetLine':venueAllData.StreetLine,'CityFrom':venueAllData.CityFrom,'Country':venueAllData.Country}).success(function(data,status,config){growl.success("Insert Value Submit successfully",{title:' '});$http.post('./email/merchentVenueCreation.php',{'event':venueAllData.event,'NameOfVenue':venueAllData.NameOfVenue}).success(function(data,status,config){console.log('mail send');growl.success("Thank You, Your venue ticket is created successfully.",{title:' '});growl.info("Redirecting...",{title:' '})});if(data==1)
//{growl.success("Data Insert Successfully",{title:' '})}else if(data==2)
//{$scope.flyshow="Data Insert Falied";growl.error("Data Insert Falied",{title:' '})}})}
//$scope.loadoEventVenue=function(){$http.post("./php/controller/paymentMethodController.php",{'event_id':1}).success(function(data,status,config){$scope.VenueNewData=data})}
//$scope.loadoEventVenue();$scope.LoadvenueEditList=function(venueList){$http.post("./php/controller/VenueListEditController.php",{'venue_id':venueList}).success(function(data,status,config){$scope.update=!0;$scope.venueAllData.venue_id=data[0].venue_id;$scope.venueAllData.event=data[0].venue_event_id;$scope.venueAllData.NameOfVenue=data[0].venue_title;$scope.venueAllData.StreetLine=data[0].venue_description;$scope.venueAllData.CityFrom=data[0].city;$scope.venueAllData.Country=data[0].country;console.log(data)})}
//$scope.AutoVarVal=function(id,df)
//{$scope.venueAllData[id]=df;console.log($scope.venueAllData)}
//$scope.UpdateDataSave=function(venueAllData){$http.post("./php/controller/VenueDataInsertController.php",{'venue_id':venueAllData.venue_id,'event':venueAllData.event,'NameOfVenue':venueAllData.NameOfVenue,'StreetLine':venueAllData.StreetLine,'CityFrom':venueAllData.CityFrom,'Country':venueAllData.Country}).success(function(data,status,config){if(data==1)
//{growl.success("Successfully Update Data",{title:' '});$scope.update=!1}else if(data=="2")
//{growl.error("Failed To Update Data",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])