/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('pickpointlistController',function($scope,$http,$timeout,growl){$scope.loadPickPointList=function(){$http.post("./php/controller/pickPointListController.php").success(function(data,status,heards,config){$scope.pickPointListdata=data;console.log(data)})}
$scope.loadPickPointList();$scope.DeletepickPointList=function(pickPointList){$http.post("./php/controller/pickpointDeleteListController.php",{'id':pickPointList}).success(function(data,status,heards,config){if(data==1)
{growl.success("Deleted Successfully",{title:' '});$scope.loadPickPointList()}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])