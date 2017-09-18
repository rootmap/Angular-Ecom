

angular
        .module('user', ['angular-growl'])
        .controller('editProfileController', function ($scope, $http, growl) {

            //show Field label code start here
            $scope.PersonalDetails = 'Personal/Profile Details';
            //show Field label code start here


            $scope.update = true;
            $scope.message = "";

            loadusersEdit();
            function loadusersEdit() {
//                console.log(userId);

                $http.post("./php/controller/editProfileEditController.php").success(function (data, status, heards, config) {

                    $scope.updateUserData.id = data[0].user_id;
                    $scope.updateUserData.email = data[0].user_email;
                    $scope.updateUserData.first_name = data[0].user_first_name;
                    $scope.updateUserData.last_name = data[0].user_last_name;
                    $scope.updateUserData.address = data[0].UA_address;
                    $scope.updateUserData.zip = data[0].user_zip;
                    $scope.updateUserData.phone = data[0].user_phone;
                    $scope.updateUserData.password = data[0].user_password;
                    //$scope.updateUserData.city = data[0].city_name;
                    //$scope.updateUserData.country = data[0].country_name;

                });
            }


            $scope.updateUserData = function (updateUserData) {

                $http.post("./php/controller/editProfileUpdateController.php", {
                    'uId': updateUserData.id,
                    'uEmail': updateUserData.email,
                    'uFname': updateUserData.first_name,
                    'uLname': updateUserData.last_name,
                    'uAddress': updateUserData.address,
                    'uZip': updateUserData.zip,
                    'uPhone': updateUserData.phone,
                    'uPass': updateUserData.password,
                    'uCity': updateUserData.city,
                    'uCountry': updateUserData.country}).then(function (response) {
                      
                      if(response.data == 1){
                          growl.success("Data updated successfully.", {title: ' '});
                          signupMail(updateUserData.id,updateUserData.email,updateUserData.first_name,updateUserData.last_name,updateUserData.address,updateUserData.zip);
                      }else if(response.data == 2){
                          growl.error("There something is going wrong.", {title: ' '});
                      }else if(response.data == 3){
                          growl.success("New data inserted.", {title: ' '});
                      }else{
                          growl.error("There something is going wrong.",{title: ''});
                      }

                });

            }
//            first_name, last_name, address, zip, city, country
            function signupMail(user_id,user_email, user_fname, user_lname, user_address, user_zip  ){
                console.log(user_id);
                $http.post('./email/userEditProfile.php',{"id":user_id, "email":user_email,"fname":user_fname,"lname":user_lname,"addr":user_address,"zip":user_zip}).then(function(response){
//                    ,"first_name":first_name,"last_name":last_name,"address":address,"zip":zip,"city":city,"country":country
                });
            }



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




            $scope.inputType = 'password';

            // Hide & show password function
            $scope.hideShowPassword = function () {
                if ($scope.inputType == 'password')
                    $scope.inputType = 'text';
                else
                    $scope.inputType = 'password';
            };
            
            
            
            loadUserData();
            function loadUserData(){
                $http.post("./php/controller/userProfileController.php").success(function(data, status, heards, config){
                    $scope.profileData = data;
                });
            }



        }).config(['growlProvider', function(growlProvider) {
          growlProvider.globalTimeToLive(3000);
          growlProvider.globalDisableCountDown(true);
        }]);
