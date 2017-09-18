angular
        .module('user')
        .controller('panddingorderController', function($scope, $http){
            $scope.test = 'Pandding Order List';
            $scope.tableH1 = 'Order ID';
            $scope.tableH2 = 'No. of items';
            $scope.tableH3 = 'Total Ammount';
            $scope.tableH4 = 'Payment Method';
            $scope.tableH5 = 'Status';
            $scope.tableH6 = 'Action';
            
            
            $scope.orderData = [];
            
            loadOrder();
            function loadOrder(){
                $http.post("./php/controller/panddingOrderController.php").success(function(data, status,heards,config){
                    $scope.panddingOrderData = data;
                });
            }
            
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
            
            
        });