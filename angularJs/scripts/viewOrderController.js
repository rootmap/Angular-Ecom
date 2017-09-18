/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj',['angular-growl','textAngular']).controller('vieworderController',function($scope,$http,growl){$scope.orderData=[];$scope.oData1=function(oId){$http.post('./php/controller/orderTotalItem.php',{oid:oId}).success(function(data,status,heards,config){$scope.orderItem=data})}
$scope.oData=function(oId){$http.post('./php/controller/orderDetailsData.php',{'oid':oId}).success(function(data,status,heards,config){$scope.orderData=data})}
$scope.DataSave=function(orderStatus,orderNum){$http.post("./php/controller/changeOrderStatusController.php",{'orderNum':orderNum,'orderStatus':orderStatus.Status}).success(function(data,status,heards,config){if(data==1)
{growl.success("Data Insert Successfully",{title:' '});setTimeout(function(){growl.info("Redirecting page.....",{title:' '})},1500);setTimeout(function(){window.location.href="order_list.php"},3000)}else if(data==2)
{growl.error("Data Insert Falied.",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])

