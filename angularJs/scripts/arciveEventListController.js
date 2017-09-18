/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonogy www.minifier.org/
 */
/* global angular */
angular.module('merchantaj').controller('arciveEventListController',function($scope,$http,$timeout){$scope.loadEventList=function(){$http.post("./php/controller/arciveEventListController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.eventlistdata=data;console.log(data)})}
$scope.loadEventList();$scope.Deleteventlist=function(eventlist){$http.post("./php/controller/arciveEventListDeleteController.php",{'event_id':eventlist}).success(function(data,status,heards,config){if(data==1)
{$scope.loadEventList();growl.success("Deleted Successfully",{title:' '})}else{growl.error("Failed To Deleted",{title:' '})}})}})