/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('paymentMethodControllerList',function($scope,$http,$timeout,growl){$scope.loadPaymentmethodList=function(){$http.get("./php/controller/paymentMethodListShow.php").success(function(data,status,heards,config){$scope.payeventdata=data;console.log(data)})}
$scope.loadPaymentmethodList();$scope.DeletepayList=function(payEvent){$http.post("./php/controller/paymentMethodDeleteController.php",{'pay_id':payEvent}).success(function(data,status,heards,config){if(data==1)
{growl.success("Deleted Successfully",{title:' '});$scope.loadPaymentmethodList()}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])