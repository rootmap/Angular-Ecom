
angular
        .module('user', ['angular-growl'])
        .controller('userAddressController', function ($scope, $http, growl) {



            $scope.getAddressData = [];
            
            getUserAddress();
            
            function getUserAddress() {
                $http.post('./php/controller/userAddressController.php').success(function (data, status, heards, config) {
                    $scope.getAddressData = data;
                });
            }

            

            $scope.getType = function (aid, type) {
                
                 growl.success("Updated successfully", {title: ' '});
                $http.post('./php/controller/userAddressController.php', {'uaId': aid, 'requestType': type}).success(function (data, status, heards, config) {
                    $scope.msg = data;
                });

            }


            $scope.deleteUserAddress = function (delobj) {

                var val = confirm("Do you want to delete this");

                if (val == true) {
                    if (delobj != '') {
                        $http.post('./php/controller/userAddressController.php', {'delId': delobj}).success(function (data, status, heards, config) {
                           getUserAddress();
                        });
                    }
                }

            }


            $scope.currentUserInfo = [];

            $scope.editInfo = function (info) {
                $scope.currentUserInfo = info;
            }



//         $scope.cities = [];
//         $scope.counties = [];
//         
//         $scope.getCountiesCitie = function(){
//             
//             $http.post('./php/controller/getAllCity.php').success(function(data, status, heards, config){
//                 $scope.getAllCity = data;
//             });
//             
////             $http.post('./php/controller/getAllCounties.php').success(function(data, status, heards, config){
////                 $scope.counties = data;
////             });
//             
//         }



            getUserCountry_City();

            function getUserCountry_City() {
                $http.get('./php/controller/getAllCity.php')
                        .then(function (response) {
                            $scope.getAllCity = response.data;
                            // console.log( s);

                        });
                $http.get('./php/controller/getAllCounties.php')
                        .then(function (response) {
                            $scope.getAllCountry = response.data;
                            // console.log( s);

                        });
            }

//        $scope.adDatas = [];
//        $scope.addAddress = function(){
//           
//            $http.post('./php/controller/addNewAddress.php',{'title':$scope.addTitle,'phone':$scope.phone,'address':$scope.address,'city':$scope.city, 'zip':$scope.zip,'country':$scope.country}).then(function(reponse){
////                $scope.adDatas = response.data;
////                $scope.getUserAddress();
////                 console.log($scope.addTitle);
//            });
//        }


            $scope.addAdderss = function (address) {
                $http.post('./php/controller/addNewAddress.php', {"Addtitle": address.addTitle, "phone": address.phone, "address": address.address, "zip": address.zip, "country": address.country, "city": address.city})
                        .then(function (response) {
                            getUserAddress();
                            $scope.d = response.data;
                            
                        });
            }





//        edit

            $scope.maincard = true;
            $scope.invisible = false;
            $scope.currentInfo = [];
            
            $scope.editAddress = function (info) {
                $scope.maincard = false;
                $scope.invisible = true;
                
                $scope.currentInfo = info;
                console.log(info);
                
            }
            
            $scope.changeData = [];
            $scope.saveAddress = function(infos){
                console.log(infos);
                $http.post('./php/controller/updateAddress.php',{'id':infos.UA_id,'user_id':infos.UA_user_id,"title":infos.UA_title,"phone":infos.UA_phone,"address":infos.UA_address,"zip":infos.UA_zip,"city":infos.ciid,"country":infos.coid}).success(function(data, status, heards, config){
                   
                    $scope.maincard = true;
                    $scope.invisible = false;
                     getUserAddress();
                 
//                    $scope.info=[""];
                });
                
            }
            
            $scope.backAddress = function(){
                $scope.maincard = true;
                $scope.invisible = false;
            }

            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }


          



        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);
