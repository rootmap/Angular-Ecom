/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj',['angular-growl']).directive('fileInput',function($parse){return{restrict:'A',link:function(scope,elem,attrs){elem.bind('change',function(){$parse(attrs.fileInput).assign(scope,elem[0].files);scope.$apply()})}}}).controller('profileImageController',function($scope,$http,$timeout,growl){$scope.imageUpload=function(event){var files=event.target.files;var file=files[files.length-1];$scope.file=file;var reader=new FileReader();reader.onload=$scope.imageIsLoaded;reader.readAsDataURL(file)}
$scope.imageIsLoaded=function(e){$scope.$apply(function(){$scope.openPic=!0;$scope.fullImage=e.target.result;if($scope.fullImage){growl.success("Image upload successfully done.",{title:' '})}else{growl.error("There something is going wrong.",{title:' '})}
$scope.imagecover=e.target.result;$scope.upload($scope.fullImage)})}
$scope.clearCover=function()
{$scope.fullImage='';$scope.openPic=!1}
$scope.imageUpload_thumble=function(event){var files=event.target.files;var file=files[files.length-1];$scope.file=file;var reader=new FileReader();reader.onload=$scope.imageIsLoaded_thumble;reader.readAsDataURL(file)}
$scope.imageIsLoaded_thumble=function(e){$scope.$apply(function(){$scope.goCats_thumble=!0;$scope.step_thumble=e.target.result;$scope.imagethumble=e.target.result})}
$scope.clearThumble=function()
{$scope.imagethumble='';$scope.goCats_thumble=!1}
$scope.upload=function(val){if(val!=null)
{$http.post("./php/controller/profileImageController.php",{'photo':val}).success(function(response){growl.info("Redirecting.......",{title:' '});setTimeout(function(){window.location.href='user_profile.php'},2000)})}}}).config(['growlProvider',function(growlProvider){}])




            
           
            
           
            
         