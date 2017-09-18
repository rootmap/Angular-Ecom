/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

/* global angular */

angular.module('merchantaj').controller('attendeesReportController',function($scope,$http){$scope.datalength=[];$scope.attendlistdata="";$scope.ModelDataReportDateWise=function(modelData){var start_date=$("#start-date-order").val();var end_date=$("#end-date-order").val();console.log(modelData);if(start_date!=null&&end_date!=null)
{$http.post("./php/controller/attendeesDateWiseReportController.php",{'event':modelData.event,'startdate':start_date,'enddate':end_date}).success(function(data,status,heards,config){$scope.attendlistdata=data})}}
$scope.loadoEventVenue=function(){$http.post("./php/controller/paymentMethodController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.VenueNewData=data})}
$scope.loadoEventVenue();$scope.loadattendtList=function(){$http.post("./php/controller/attendeesReportController.php").success(function(data,status,heards,config){$scope.attendlistdata=data})}
$scope.loadattendtList()})

