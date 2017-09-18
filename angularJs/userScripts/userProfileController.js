

angular
        .module('user')
        .controller('userProfileController', function($scope , $http){
            $scope.test = 'User Profile Information';
               
               $scope.profileData = [];
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
            
            
            
        });
