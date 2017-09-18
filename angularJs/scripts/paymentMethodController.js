/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('paymentMethodController',function($scope,$http,$timeout,growl){$scope.AddPaymentMethod=function()
{$http.post("./php/controller/paymentMethodSaveController.php",{'event_id':$scope.event_id,'param':$scope.rows}).success(function(data,status,heards,config){if(data==1)
{growl.success("Payment Method Save Successfully",{title:' '});growl.info("Redirecting to list page....",{title:' '});setTimeout(function(){window.location.href="./paymentMethodList.php"},1000)}
else if(data==2)
{growl.success("Payment Method Updated Successfully",{title:' '});growl.info("Redirecting to list page....",{title:' '});setTimeout(function(){window.location.href="./paymentMethodList.php"},1000)}
else{growl.error("Insert Failed To Submit",{title:' '})}})}
$scope.loadEvent=function(){$http.get("./php/controller/paymentMethodController.php").success(function(data,status,heards,config){$scope.Evntpaymtd=data})}
$scope.loadEvent();$scope.loadEventpayment=function(){$http.get("./php/controller/paymentMethodAllname.php").success(function(data,status,heards,config){$scope.rows=[];angular.forEach(data,function(value,key){$scope.rows.push({check_namest:'0',check_name_ID:value.id,check_name:value.name,check_box:'false'});console.log(value.name)})})}
$scope.loadEventpayment();$scope.loadPaymentmethodEdit=function(payEvent){$http.post("./php/controller/paymentMethodEditController.php",{'id':payEvent}).success(function(data,status,heards,config){$scope.rows=[];$scope.event_id=payEvent;angular.forEach(data,function(value,key){$scope.rows.push({check_namest:value.pmst,check_name_ID:value.id,check_name:value.name});console.log(value.name)});console.log($scope.event_id)})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])