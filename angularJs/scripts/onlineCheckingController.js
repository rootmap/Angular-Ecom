/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


/* global angular */

angular.module('merchantaj',['angular-growl']).controller('onlineCheckingController',function($scope,$http,$timeout,growl){$scope.rw=[];$scope.rw.inout=0;$scope.DataSave=function(RefundndMethod){console.log(RefundndMethod);$scope.flyshow="Processing...";console.log(RefundndMethod.inout);if(RefundndMethod.inout==0)
{$http.post("./php/controller/onlinecheckinController.php",{tid:RefundndMethod.tocken,status:'NONE'}).success(function(data,status,heards,config){$scope.flyshow="";if(data==1)
{growl.success("Valid Ticket ID & Checkin Eventsy",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==2)
{growl.success("Valid Ticket ID & CheckOut From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==3)
{growl.warning("Ticket ID Valid But Not Checkout From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==4)
{growl.warning("Ticket ID Valid But Not Checkin Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else{growl.error("Invalid Ticket NO.",{title:' '})}})}
else if(RefundndMethod.inout=="IN")
{$http.post("./php/controller/onlinecheckinController.php",{'tid':RefundndMethod.tocken,'status':'IN'}).success(function(data,status,heards,config){if(data==1)
{growl.success("Valid Ticket ID & Checkin Events",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==2)
{growl.success("Valid Ticket ID & CheckOut From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==3)
{growl.warning("Ticket ID Valid But Not Checkout From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==4)
{growl.warning("Ticket ID Valid But Not Checkin Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else{growl.error("Invalid Ticket NO.",{title:' '})}})}
else if(RefundndMethod.inout=="OUT")
{$http.post("./php/controller/onlinecheckinController.php",{'tid':RefundndMethod.tocken,'status':'OUT'}).success(function(data,status,heards,config){if(data==1)
{growl.success("Valid Ticket ID & Checkin Events",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==2)
{growl.success("Valid Ticket ID & CheckOut From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==3)
{growl.warning("Ticket ID Valid But Not Checkout From Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else if(data==4)
{growl.warning("Ticket ID Valid But Not Checkin Events.",{title:' '});$scope.DataLoad(RefundndMethod.tocken)}
else{growl.error("Invalid Ticket NO.",{title:' '})}})}}
$scope.DataLoad=function(tid)
{$http.post("./php/controller/onlinecheckinListController.php",{'tid':tid}).success(function(data,status,heards,config){if(data!=0)
{$scope.checkinlistdata=data;$scope.rw.tocken=""}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])