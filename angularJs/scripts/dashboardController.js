/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile  techonology  http://www.minifier.org/
Chat Conversation End

 */
angular.module('merchantaj').controller('dashboardController',function($scope,$http){$scope.eventname="Total Events";$scope.totaleventplace="0";$scope.totalsales="Total Sales";$scope.totalsalesamount="0";$scope.users="Users";$scope.totalusers="0";$scope.netbalance="Net Balance";$scope.totalnetbalance="0";$scope.refunds="Refunds";$scope.refundsamount="0";$scope.TotalOrder="Total Order";$scope.TotalOrderAmount="0";$scope.ticketList="0";$scope.paymentmethod="0";$scope.checkInmanagement="0";$scope.loadoEventAllDashboradList=function(param){console.log(param);if(param=='')
{$scope.param={}}
else{$scope.param={'evt':param}}
$http.post("./php/controller/eventTicketInfoSoldDashbordController.php",$scope.param).success(function(data,status,heards,config){$scope.totaleventplace=data.lstevt;$scope.totalsalesamount=data.totalsalesdata;$scope.totalusers=data.usersdata;$scope.totalnetbalance=data.totalnetdata;$scope.refundsamount=data.refundsdata;$scope.TotalOrderAmount=data.TotalOrderAmount;$scope.ticketList=data.ticketList;$scope.paymentmethod=data.paymentmethod;$scope.checkInmanagement=data.checkInmanagement})}})