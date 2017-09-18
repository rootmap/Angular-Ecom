/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


/* global angular */

angular.module('merchantaj',['angular-growl']).controller('newrefundRequestListController',function($scope,$http,$timeout,growl){$scope.loadAllRefund=function(){$http.get("./php/controller/refunRequestListController.php").success(function(data,status,heards,config){$scope.refundListdata=data})}
$scope.loadAllRefund();$scope.DeleterefundList=function(refundList){$http.post("./php/controller/refunRequestDeleteController.php",{'id':refundList}).success(function(data,status,heards,config){if(data==1)
{growl.success("Deleted Successfully",{title:' '});$scope.loadAllRefund()}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])

