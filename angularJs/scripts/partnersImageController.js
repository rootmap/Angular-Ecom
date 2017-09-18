/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */


angular.module('merchantaj',['angular-growl']).controller('partnersImgController',function($scope,$http,$timeout,growl){$scope.loadEvent=function(){$http.get("./php/controller/ticketListController.php").success(function(data,status,heards,config){$scope.Evntpaymtd=data})}
$scope.loadEvent();$scope.imageUpload=function(event){var fiels=event.target.files;var file=fiels[fiels.length-1];$scope.file=file;var reader=new FileReader();growl.success("Please wait a while! your image is processing",{title:' '});reader.onload=$scope.imageIsLoaded;reader.readAsDataURL(file)}
$scope.imageIsLoaded=function(e){$scope.$apply(function(){$scope.openPic=!0;$scope.fullImage=e.target.result;if($scope.fullImage){growl.success("Image upload successfully done",{title:' '})}else{growl.error("There something is going wrong.",{title:' '})}
$scope.imagecover=e.target.result})}
$scope.clearCover=function()
{$scope.fullImage='';$scope.openPic=!1}
$scope.AddPartnerImage=function(eid){if(eid!=null)
{$http.post("./php/controller/partner_imageController.php",{photo:$scope.fullImage,event_id:eid}).success(function(data){if(data==1){growl.success("Insert successfully",{title:' '})}else if(data==2){growl.success("Updated successfully",{title:' '})}else{growl.error("Something going wrong",{title:' '})}})}
else{growl.error("Select An Event",{title:' '})}}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])