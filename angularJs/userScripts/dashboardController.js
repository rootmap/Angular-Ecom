

angular
        .module('user')
        .controller('dashboardController', function($scope, $http){
            
           $scope.Profile_View = "User Profile";
           $scope.Order_History = "Order History";
           $scope.totalOrder = "0";
           $scope.My_Wishlist = "User Wishlist";
           $scope.totalWishlist = "0";
           $scope.Default_Address = "Edit Address";
           $scope.Cart = "Cart";
           $scope.totalCart = "0";
           $scope.Edit_Profile_Details = "Edit Profile Details";
           $scope.Paid_Order = "Paid Order";
           $scope.Pandding_Order = "Pandding Order";
           
           $scope.dashboardData = [];
           
           loadDashboard();
           function loadDashboard(){
               $http.post("./php/controller/dashboardController.php").success(function(data, status, heards, config){
                   $scope.dashboardData = data;
               });
           }
           
           
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
           
            
        });