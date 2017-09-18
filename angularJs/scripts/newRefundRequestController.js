/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */
/* global angular */

angular.module('merchantaj',['angular-growl']).controller('newRefundRequestController',function($scope,$http,$timeout,growl){$scope.RefundndMethod=[];$scope.RefundndMethod.id=0;$scope.flyshow="";$scope.MerchantID="Merchant";$scope.AvailableAmount="Available Amount";$scope.RequestAmount="Request Amount";$scope.RemarksNote="Remarks/Note";$scope.RefundMethod="Refund Method";$scope.BankName="Bank Name";$scope.AcNumber="Ac/Number";$scope.mobilenumber="Mobile Number"
$scope.DataSave=function(RefundndMethod){console.log(RefundndMethod);if(RefundndMethod.AvailableAmount!=''&&RefundndMethod.RequestAmount!=''&&RefundndMethod.RemarksNote!=''&&RefundndMethod.RefundMethodnew!='')
{if(RefundndMethod.AvailableAmount>=RefundndMethod.RequestAmount)
{$http.post("./php/controller/newRefundRquestDataController.php",{'marchentid':RefundndMethod.marchentid,'AvailableAmount':RefundndMethod.AvailableAmount,'RequestAmount':RefundndMethod.RequestAmount,'RemarksNote':RefundndMethod.RemarksNote,'RefundMethodnew':RefundndMethod.RefundMethodnew,'BankName':RefundndMethod.BankName,'AcNumber':RefundndMethod.AcNumber,'mobilenumber':RefundndMethod.mobilenumber}).success(function(data,status,heards,config){if(data==1)
{$scope.loadrfundMtd();growl.success("Successfully Insert Data",{title:' '});setTimeout(function(){window.location.href="refundRequestList.php"},1500)}
else if(data==2)
{$scope.flyshow="";growl.error("Failed To Insert Data",{title:' '})}})}
else{$scope.flyshow="";growl.warning("Insufficient Requested Fund.",{title:' '})}}
else{$scope.flyshow="";growl.error("Please Fillup Form To Process Withdraw.",{title:' '})}}
$scope.loadrfundMtd=function(){$http.get("./php/controller/refundSeletedController.php").success(function(data,status,heards,config){$scope.RefundndMethod.AvailableAmount=data[0].netbalance;$scope.RefundndMethod.RemarksNote="Request For Withdraw."})}
$scope.loadrfundMtd();$scope.loadrfund=function(){$http.get("./php/controller/refundFundNameController.php").success(function(data,status,heards,config){$scope.Refundpaydata=data})}
$scope.loadrfund();$scope.getRMethod=function(RefundndMethod)
{$scope.bank=!1;$scope.bkash=!1;$scope.cash=!1;RefundndMethod.mobilenumber='';RefundndMethod.BankName='';RefundndMethod.AcNumber='';if(RefundndMethod.RefundMethodnew==1)
{$scope.bank=!0;$scope.bkash=!1;$scope.cash=!1}
else if(RefundndMethod.RefundMethodnew==2)
{$scope.bank=!1;$scope.bkash=!0;$scope.cash=!1}}
$scope.EditDataRefund=function(refundList){$http.post("./php/controller/refunRequestEditShowController.php",{'id':refundList}).success(function(data,status,heards,config){$scope.update=!0;$scope.RefundndMethod.id=data[0].id;$scope.RefundndMethod.marchentid=data[0].merchant_id;$scope.RefundndMethod.AvailableAmount=data[0].available_amount;$scope.RefundndMethod.RequestAmount=data[0].request_amount;$scope.RefundndMethod.RemarksNote=data[0].remarks;$scope.RefundndMethod.RefundMethodnew=data[0].refund_method;if($scope.RefundndMethod.RefundMethodnew==1)
{$scope.bank=!0;$scope.bkash=!1;$scope.cash=!1}
else if($scope.RefundndMethod.RefundMethodnew==2)
{$scope.bank=!1;$scope.bkash=!0;$scope.cash=!1}
$scope.RefundndMethod.mobilenumber=data[0].mobile_number;$scope.RefundndMethod.BankName=data[0].bank_name;$scope.RefundndMethod.AcNumber=data[0].ac_number})}
$scope.updateDataSave=function(RefundndMethod){$http.post("./php/controller/newRefundRquestDataController.php",{'id':RefundndMethod.id,'marchentid':RefundndMethod.marchentid,'AvailableAmount':RefundndMethod.AvailableAmount,'RequestAmount':RefundndMethod.RequestAmount,'RemarksNote':RefundndMethod.RemarksNote,'RefundMethodnew':RefundndMethod.RefundMethodnew,'BankName':RefundndMethod.BankName,'AcNumber':RefundndMethod.AcNumber,'mobilenumber':RefundndMethod.mobilenumber}).success(function(data,status,heards,config){if(data=="1")
{growl.success("Successfully Update Data",{title:' '});$scope.update=!1}else if(data=="2")
{growl.error("Failed To Update Data",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])