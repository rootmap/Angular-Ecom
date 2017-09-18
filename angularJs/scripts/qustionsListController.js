/*compile techonogy www.minifier.org
 * 
 */
angular.module('merchantaj',['angular-growl']).controller('qustionsListController',function($scope,$http,$timeout,growl){$scope.loadQuestionList=function(){$http.post("./php/controller/questionListShowController.php").success(function(data,status,heards,config){$scope.questionListdata=data;console.log(data)})}
$scope.loadQuestionList();$scope.DeleteQustionList=function(questionList){$http.post("./php/controller/questionListDeleteController.php",{'form_id':questionList}).success(function(data,status,heards,config){if(data==1)
{growl.success("Deleted Successfully",{title:' '});$scope.loadQuestionList()}else{growl.error("Failed To Deleted",{title:' '})}})}}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])