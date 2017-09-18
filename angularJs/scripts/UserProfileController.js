/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj').controller('userProfileController',function($scope,$http){$scope.usersData=[];$scope.loaduserprofile=function(currentuserid){$http.post("./php/controller/userListShowController.php",{'id':currentuserid}).success(function(data,status,heards,config){$scope.usersData=data})}})