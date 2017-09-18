

angular
        .module('user', ['angular-growl'])
        .controller('editPasswordController', function ($scope, $http, growl) {
            
           
            $scope.SaveData = function(passData){
                $http.post('./php/controller/editPasswordController.php',{'oldPass':passData.oldPassword,'newPass':passData.newPassword,'rePass':passData.rePassword}).success(function(data, status, heards, config){
                    
                            if(data==1)
                            {
                                growl.success("Password Successfully Changed.", {title: ' '});
                            }
                            else if(data==2)
                            {
                                 growl.error("Failed To Update Password.", {title: ' '});
                            }
                            else if(data==3)
                            {
                                 growl.warning("Failed, Password Mismatch with Retype Password.", {title: ' '});
                            }
                            else if(data==4)
                            {
                                 growl.warning("Warning, Some Field is Empty.", {title: ' '});
                            }
                            else if(data==0)
                            {
                                 growl.warning("Failed, Your old password is wrong.", {title: ' '});
                            }
                            else
                            {
                                growl.error("Insert Failed To Submit", {title: ' '});
                            }
                    
                    
                });
            }
            
        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);

