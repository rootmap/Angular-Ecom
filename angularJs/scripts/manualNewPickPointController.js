/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('manualNewPickPointController',function($scope,$http,$timeout,growl){$scope.AddPaymentMethod=function(pickpoint)
{$http.post("./php/controller/manualNewPickPointController.php",{'event_id':pickpoint.eventValue,'pointAddress':pickpoint.pointAddress,'pointContactdetailsAddress':pickpoint.pointContactdetailsAddress,'PickPointName':pickpoint.PickPointName}).success(function(data,status,heards,config){if(data==1)
{growl.success("Pickup Point Save Successfully",{title:' '});window.location.href='pickPointList.php'}
else if(data==2)
{growl.success("Pickup Point Updated Successfully",{title:' '});window.location.href='pickPointList.php'}
else{growl.error("Insert Failed To Submit",{title:' '})}})}
$scope.loadEvent=function(){$http.get("./php/controller/paymentMethodController.php").success(function(data,status,heards,config){$scope.Evntpaymtd=data})}
$scope.loadEvent()}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])