

angular
        .module('user')
        .controller('orderController', function($scope, $http){
            $scope.test = 'Order List';
            $scope.tableH1 = 'Order ID';
            $scope.tableH2 = 'No. of items';
            $scope.tableH3 = 'Total Amount';
            $scope.tableH4 = 'Payment Method';
            $scope.tableH5 = 'Status';
            $scope.tableH6 = 'Action';
            
            
            $scope.orderData = [];
            
            loadOrder();
            function loadOrder(){
                $http.post("./php/controller/orderController.php").success(function(data, status,heards,config){
                    $scope.orderData = data;
                });
            }
            
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
            
            
        });



