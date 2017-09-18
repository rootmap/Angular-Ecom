/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj',['angular-growl']).controller('paymentMethodofflineList',function($scope,$http,$timeout,growl){$scope.loadPaymentmethodOfflineList=function(){$http.get("./php/controller/paymentMethodofflineListShow.php").success(function(data,status,heards,config){$scope.payOfflinedata=data;console.log(data)})}
$scope.loadPaymentmethodOfflineList();$scope.DeletepayOffList=function(paymethodOff){$http.post("./php/controller/paymentMethodOfflinelListDataDelete.php",{'payoff_id':paymethodOff}).success(function(data,status,heards,config){if(data==1)
{$scope.loadPaymentmethodOfflineList();growl.success("Deleted Successfully",{title:' '})}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])