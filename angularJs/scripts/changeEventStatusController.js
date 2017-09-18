/*compile techonogy www.minifier.org
 * 
 */
angular.module('merchantaj',['angular-growl']).controller('changeEventStatusController',function($scope,$http,growl){$scope.eventStatus=[];$scope.DataSave=function(eventStatus){console.log(eventStatus);$http.post("./php/controller/changeEventStatusController.php",{'event':eventStatus.event,'eventStatus':eventStatus.Status}).success(function(data,status,heards,config){growl.success("Event Status Updated.",{title:' '});growl.info("Redirecting...",{title:' '});window.location.href="event_list.php"});if(data==1)
{growl.success("Data Insert Successfully",{title:' '})}else if(data==2)
{$scope.flyshow="Data Insert Falied";growl.error("Data Insert Falied",{title:' '})}}
$scope.loadoEventVenue=function(){$http.post("./php/controller/paymentMethodController.php",{'event_id':1}).success(function(data,status,heards,config){$scope.eventStatusList=data})}
$scope.LoadAutoEID=function(eid)
{console.log(eid);$scope.eventStatus.event=eid;$http.post("./php/controller/ChangeEventStatusShowController.php",{'event_id':eid}).success(function(data,status,heards,config){console.log(data)})}
$scope.loadoEventVenue();$scope.AutoVarVal=function(id,df)
{$scope.venueAllData[id]=df;console.log($scope.venueAllData)}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])