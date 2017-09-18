/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *compile techonogy www.minifier.org/
/* global angular */
angular.module('merchantaj').controller('currentEventListController',function($scope,$http,$timeout){$scope.ModelDataReportDateWise=function(modelData){var start_date=$("#start-date").val();var end_date=$("#end-date").val();if(start_date!=null&&end_date!=null)
{$http.post("./php/controller/currentEventWiseDateController.php",{'startdate':start_date,'enddate':end_date}).success(function(data,status,heards,config){$scope.eventlistdata=data})}}
$scope.loadEventList=function(){$http.post("./php/controller/currentEventListController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.eventlistdata=data;console.log(data)})}
$scope.Deleteventlist=function(eventlist){$http.post("./php/controller/currentEventListDeleteController.php",{'event_id':eventlist}).success(function(data,status,heards,config){if(data==1)
{$scope.loadEventList();growl.success("Deleted Successfully",{title:' '})}else{growl.error("Failed To Deleted",{title:' '})}})}})