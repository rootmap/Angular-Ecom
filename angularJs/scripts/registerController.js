/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
angular.module('merchantaj',['angular-growl']).controller('registerController',function($scope,$http,growl){$scope.registerData={};$scope.registerinsert=function(registerData){console.log(registerData);if(registerData.CaptchaCode==registerData.captcha_code)
{if(registerData.password==registerData.confirmPassword)
{$http.post('./php/controller/registerController.php',{'firstName':registerData.firstName,'lastName':registerData.lastName,'email':registerData.email,'yourAddress':registerData.yourAddress,'password':registerData.password,'phoneMobileNo':registerData.phoneMobileNo}).success(function(data,status,heards,config){if(data==1)
{growl.success("Thanks, Your organizer account created successfully.",{title:' '});growl.info("Page is redirecting, Please be patient...",{title:' '});$http.get('./email/merchentAccountCreation.php').success(function(data,status,heards,config){console.log('mail send')});setTimeout(function(){window.location.href="./events.php"},1500)}
else if(data==0)
{growl.warning("Field is empty, Please check all mandatory field.",{title:' '})}
else if(data==2)
{$("#tab1").addClass("active");growl.warning("Email address already exists, please enter a new email and reset your password.",{title:' '})}
else if(data==3)
{growl.error("Failed to create your organizer account, Please try again or contact ticketchai support.",{title:' '})}
else if(data==4)
{growl.error("Failed to create your organizer info, Please try again or contact ticketchai support.",{title:' '})}})}
else{growl.error("Failed Password Mismatch, Please Type Your Password Carefully.",{title:' '})}}
else{growl.error("Failed Captcha Mismatch, Please Type Correct Captcha.",{title:' '})}}
$scope.InitiateCaptche=function()
{$scope.text="";$scope.possible="ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";for(var i=0;i<5;i++)
$scope.text+=$scope.possible.charAt(Math.floor(Math.random()*$scope.possible.length));$scope.registerData.captcha_code=$scope.text}
$scope.InitiateCaptche();$scope.merchantUp="Organizer Sign Up / Registration";$scope.Step01="Step01";$scope.Step02="Step - 02";$scope.Step03="Step - 03";$scope.RegistrationApproval="Dear Organizer, Please Provide Your Credential - For Login / Registration Approval";$scope.FirstName="First Name";$scope.LastName="Last Name";$scope.Email="Email";$scope.YourAddress="Your Address";$scope.Password="Password";$scope.ConfirmPassword="Confirm Password";$scope.PhoneMobileNo="Phone/Mobile No.";$scope.CaptchaCode="Captcha ";$scope.Back="Back";$scope.Next="Next";$scope.Finish="Finish";$scope.thankYou="Thank You!"}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(4000);growlProvider.globalDisableCountDown(!0)}])

