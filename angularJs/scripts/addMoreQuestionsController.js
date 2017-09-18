/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

angular.module('merchantaj',['angular-growl']).controller('addMoreQuestionsController',function($scope,$http,growl){$scope.adqc={};$scope.rows=[];$scope.counter=1;$scope.addRow=function(){$scope.rows.push({id:$scope.counter,rein:'requ'+$scope.counter,qt:'',ft:'',ep:'no',vd:'no'});$scope.counter++;console.log($scope.rows)}
$scope.addRow();$scope.AddAllQCData=function()
{$scope.dataparam=$scope.rows;if($scope.EventId!=null)
{$http.post("./php/controller/addMoreQuestionsController.php",{'data':$scope.dataparam,'event_id':$scope.EventId}).success(function(data,status,heards,config){if(data==1)
{$scope.flyshow="";growl.success("Data Insert Successfully",{title:' '})}
else{$scope.flyshow="";growl.error("Data Failed To Insert",{title:' '})}});console.log($scope.rows)}
else{growl.warning("Something went wrong, Please goto back page and select event.",{title:' '})}}
$scope.morequstion=function(){$scope.question.push({name:$scope.name});console.log($scope.question);$http.post("./php/controller/addMoreQuestionsController.php",{'qustiontitle':addMoreQustion.qustiontitle,'QuestionType':addMoreQustion.QuestionType,'Showfollowingtickets':addMoreQustion.Showfollowingtickets,'Required':addMoreQustion.Required,'Optional':addMoreQustion.Optional}).success(function(data,status,heards,config){growl.success("Data Insert Successfully",{title:' '})})}
$scope.loadQuestionEditdata=function(questionList){$http.post("./php/controller/questionListEditController.php",{'from_id':questionList}).success(function(data,status,heards,config){$scope.rows=[];$scope.counter=1;$scope.update=!0;angular.forEach(data,function(value,key){$scope.rows.push({id:$scope.counter,rein:'requ'+$scope.counter,qt:value.form_field_title,ft:value.form_field_type,ep:value.entry_pass,vd:value.form_field_is_required});$scope.counter++;console.log(value.name)})})}
$scope.AddAllQCDataUpdate=function()
{if($scope.EventId!=null)
{$scope.dataparam=$scope.rows;$http.post("./php/controller/moreQuestionsUpdateController.php",{'data':$scope.dataparam,'event_id':$scope.EventId}).success(function(data,status,heards,config){if(data==1)
{growl.success("Data Updated Successfully",{title:' '})}
else{growl.error("Data Failed To Update",{title:' '})}});console.log($scope.rows)}
else{growl.warning("Something went wrong, Please goto back page and select event.",{title:' '})}}
$scope.headeTitle="Let's Add Your Ticket Details";$scope.QuestionTitle="Question Title";$scope.QuestionType="Question Type";$scope.Showfollowingtickets="Show this question for the following tickets";$scope.EntryPass="Entry Pass";$scope.QuestionStatus="Question Status";$scope.required="Required";$scope.optional=" Optional";$scope.AddMoreQuestions="Add More Questions";$scope.Submit="Submit"}).config(['growlProvider',function(growlProvider){growlProvider.globalTimeToLive(3000);growlProvider.globalDisableCountDown(!0)}])