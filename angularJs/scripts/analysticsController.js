/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj').controller('analysticsController',function($scope,$http){$scope.loadAllOrderQuantity=function(){$http.post("./php/controller/analysticsController.php",{'event':1}).success(function(data,status,heards,config){$scope.totalOrderQuantity=data})}
$scope.loadAllOrderQuantity();$scope.loadAllOrderTotalOrderAmount=function(){$http.post("./php/controller/analysticsController.php",{'event':2}).success(function(data,status,heards,config){$scope.totalOrderAmountData=data})}
$scope.loadAllOrderTotalOrderAmount();$scope.loadAllRefundRequest=function(){$http.post("./php/controller/analysticsController.php",{'event':3}).success(function(data,status,heards,config){$scope.refundRequestData=data})}
$scope.loadAllRefundRequest();$scope.loadAllTotalEvent=function(){$http.post("./php/controller/analysticsController.php",{'event':4}).success(function(data,status,heards,config){$scope.totalEventData=data})}
$scope.loadAllTotalEvent();$scope.loadAllCustomer=function(){$http.post("./php/controller/analysticsController.php",{'event':5}).success(function(data,status,heards,config){$scope.Customer=data})}
$scope.loadAllCustomer();$scope.loadAllVisitEvents=function(){$http.post("./php/controller/analysticsController.php",{'event':6}).success(function(data,status,heards,config){$scope.visitevents=data})}
$scope.loadAllVisitEvents();$scope.loadAllVisitEvents=function(){$http.post("./php/controller/analysticsController.php",{'event':7}).success(function(data,status,heards,config){$scope.paidOrders=data})}
$scope.loadAllVisitEvents();$scope.loadAllPublishedAllEvents=function(){$http.post("./php/controller/analysticsController.php",{'event':8}).success(function(data,status,heards,config){$scope.publishedAllEvents=data})}
$scope.loadAllPublishedAllEvents();$scope.boxTitle="Total Order Quantity";$scope.totalOrderQuantity="0";$scope.TotalOrderAmount="Total order Amount";$scope.totalOrderAmountData="0";$scope.refund="Total Refund Request";$scope.refundRequestData="0";$scope.Totalevent="Total Event Found";$scope.totalEventData="0";$scope.Customer="0";$scope.visitevents="0";$scope.paidOrders="0";$scope.publishedAllEvents="0";$scope.Monthlysalesstarget="Monthly sales target";$scope.orders="Orders";$scope.completed="Completed";$scope.NewVisitors="New Visitors";$scope.Outoftotalnumber="Out of total number";$scope.subscriptions="Subscriptions";$scope.Monthlynewsletter="Monthly newsletter"})



     