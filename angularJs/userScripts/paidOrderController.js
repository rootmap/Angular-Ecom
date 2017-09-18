angular
        .module('user')
        .controller('paidorderController', function($scope, $http){
            $scope.test = 'Paid Order List';
            $scope.tableH1 = 'Order ID';
            $scope.tableH2 = 'No. of items';
            $scope.tableH3 = 'Total Ammount';
            $scope.tableH4 = 'Payment Method';
            $scope.tableH5 = 'Status';
            $scope.tableH6 = 'Action';
            
            
            $scope.orderData = [];
            
            loadOrder();
            function loadOrder(){
                $http.post("./php/controller/paidOrderController.php").success(function(data, status,heards,config){
                    $scope.paidOrderData = data;
                });
            }
            
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
            
            
        });