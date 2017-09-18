/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj',['angular-growl']).controller('loginController',function($scope,$http,growl){$scope.loginInsert=function(loginData){$http.post('./php/controller/loginController.php',{'Emailaddress':loginData.Emailaddress,'Password':loginData.Password,'Subscri':loginData.Subscri}).success(function(data,status,heards,config){if(data==1){growl.success("Login Successfully Completed.",{title:' '});setTimeout(function(){growl.info("Redirecting page.....",{title:' '})},1500);setTimeout(function(){window.location.href="./events.php"},3000)}else if(data==2){growl.error("Failed, Email or Password was incorrect.",{title:' '})}else if(data==0){growl.error("Username & Password not match.",{title:' '})}else{console.log(data)}})}
$scope.sineUp="Organizer Login";$scope.Ifyoualreadyhaveanaccount="(If you already have an account)";$scope.loginMsg="(Login To Create/Manage Your Events)";$scope.Emailaddress="Email address";$scope.Password="Password";$scope.Subscribetonewsletter=" Subscribe to newsletter";$scope.Login="Login"}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])
