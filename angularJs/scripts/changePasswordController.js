/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('changePasswordController',function($scope,$http,$timeout,growl){$scope.DataSave=function(FixedPassword)
{$http.post("./php/controller/changePasswordController.php",{'OldPassword':FixedPassword.OldPassword,'NewPassword':FixedPassword.NewPassword,'ReTypePassword':FixedPassword.ReTypePassword}).success(function(data,status,heards,config){if(data==1)
{$scope.email(FixedPassword.ReTypePassword);growl.success("Password Successfully Changed.",{title:' '})}
else if(data==2)
{growl.error("Failed To Update Password.",{title:' '})}
else if(data==3)
{growl.warning("Failed, Password Mismatch with Retype Password.",{title:' '})}
else if(data==4)
{growl.warning("Warning, Some Field is Empty.",{title:' '})}
else if(data==0)
{growl.warning("Failed, Your old password is wrong.",{title:' '})}})}
$scope.email=function(id){$http.post("email/changePassword_email.php",{admin_id:id}).success(function(data,status,heards,config){})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])