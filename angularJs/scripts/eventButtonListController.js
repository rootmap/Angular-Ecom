/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj',['angular-growl']).controller('eventButtonListController',function($scope,$http,growl){$scope.eventbuttonListAll=function(eventButton){$http.post("./php/controller/eventButtonListSaveController.php",{'event_id':eventButton.event_id,'buttonValue':eventButton.evtBtn}).success(function(data,status,heards,config){if(data==1)
{growl.success("Thanks, Save Successfully.",{title:' '})}
else if(data==2)
{growl.success("Thanks, Updated Successfully.",{title:' '})}
else if(data==3)
{growl.error("Field is empty, please select event and button label.",{title:' '})}
else{growl.error("Something went wrong, Please try again later.",{title:' '})}})}
$scope.loadEvent=function(){$http.post("./php/controller/paymentMethodController.php").success(function(data,status,heards,config){$scope.Evntpaymtd=data})}
$scope.loadEvent();$scope.loadEventButton=function(){$http.post("./php/controller/event_button_list.php").success(function(data,status,heards,config){$scope.Evntbtnmtd=data})}
$scope.loadEventButton()}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])