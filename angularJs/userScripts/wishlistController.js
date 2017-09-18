
angular
        .module('user')
        .controller('wishlistController', function ($scope, $http) {
            $scope.test = 'Wishlist';


            $scope.wishlistData = [];
            loadWishlistData();
            function loadWishlistData() {
                    $http.post("./php/controller/userWishlistController.php").success(function (data, status, heards, config) {
                        $scope.wishlistData = data;
                    });
            }


            $scope.deleteInfo = function (info) {

                $http.post('./php/controller/userWishlistController.php', {"del_id": info.WL_id}).success(function (data, status, heards, config) {
                    $scope.msg = 'Delete successfully';
                    loadWishlistData();
                });
            }
            
           
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }
            
            
            

        });


