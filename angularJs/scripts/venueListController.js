/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj',['angular-growl']).controller('venueListController',function($scope,$http,growl){$scope.loadVenuelist=function(){$http.post("./php/controller/venueListDataShowController.php",{'venue_id':1}).success(function(data,status,heards,config){$scope.venueListdata=data})}
$scope.loadVenuelist();$scope.DeleteVenueList=function(venueList){$http.post("./php/controller/venueDeleteListController.php",{'venue_id':venueList}).success(function(data,status,heards,config){if(data==1)
{growl.success("Venue Data Deleted Successfully",{title:' '});$scope.loadVenuelist()}
else{growl.error("Venue Data Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])

