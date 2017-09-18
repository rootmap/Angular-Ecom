/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */
angular.module('frontEnd').controller('navClt', navClt);

angular.module('frontEnd', ['angular-growl'])
        .controller('signinController', function ($scope, $http, growl) {
            
            
            
    
            $scope.signin = "HAPPY TO SEE YOU BACK !";
            $scope.signin_span = "Let's Sign In And Have Fun";
            $scope.btn_login = "Login";
            $scope.signup_text = " Don't Have An Account? ";
            $scope.btn_signup = "Signup";
            $scope.singin_or = "OR";
            $scope.signin_fb = "Sign in with Facebook ";
            $scope.signin_tw = "Sign in with Twitter ";
            $scope.singin_g = "Sign in with Google ";
            $scope.remembar_pass = "Remember My Password On This Device. ";

            $scope.subscribe_newsletter = function (Email) {
                //console.log(Email);
                if (Email != '') {
                    $http.post('php/subscribe_newsletterPhpController.php', {
                        "email": Email
                    }).then(function (response) {
                        $scope.msg = response.data;
                        growl.success("customar Successfully subscribe.", {
                            title: ' '
                        });
                    })
                }
            }


            // popup cart data
//            getdata();
//
//            function getdata() {
//                $scope.dataArray = '';
//                $http.get('php/popupCart/popupCartTotalPriceController.php').then(function (response) {
//                    $scope.popupCart = response.data;
//                    $scope.dataArray = $scope.popupCart;
//                });
//
//                $http.get('php/popupCart/popupCartEventDetailsController.php').then(function (response) {
//                    $scope.popupCartEventDetails = response.data;
//                });
//
//            }
//            $scope.totalPrice = function () {
//
//                var total = 0;
//                for (i = 0; i < $scope.dataArray.length; i++) {
//                    total += ($scope.dataArray[i].EITC_total_price - 0);
//
//                }
//                //console.log(total);
//                return total;
//            }


            //Function Submit from start here.
            $scope.loginInsert = function (loginData) {
                $http.post('php/signinPhpController.php', {
                    'Emailaddress': loginData.userEmail,
                    'Password': loginData.userPassword
                })
                        .then(function (response) {
                            if (response.data == 1) {
                                growl.success("Login Successfully Completed.", {
                                    title: ' '
                                });
                                setTimeout(function () {
                                    growl.info("Redirecting page.....", {
                                        title: ' '
                                    });
                                }, 1500);

                                setTimeout(function () {
//                                    window.location.href = "../user_dashboard/dashboard.php"; /*[local server]*/
                                    window.location.href = "user_dashboard/dashboard.php"; /*[local server]*/
                                }, 3000);
                            } else if (response.data == 2) {
                                growl.error("Failed, Wrong Password.", {
                                    title: ' '
                                });
                            } else if (response.data == 0) {
                                growl.error("Username & Password not match.", {
                                    title: ' '
                                });
                            } else {
                                growl.info("Something is going wrong.", {
                                    title: ' '
                                });
                            }



                        });
            }

            //gmail login

//            $scope.gmail = {
//                username: "",
//                user_first_name: "",
//                user_last_name: "",
//                email: "",
//                user_social_id: "",
//                user_social_gender: "",
//                user_social_type: "",
//                user_verification: ""
//            };
//
//            $scope.clickOnGoogleLoginButton = function () {
//                var myParams = {
//                    'clientid': '413106088104-uahfd7jd2n037c73lgnrthkqrepa5shk.apps.googleusercontent.com',
//                    'cookiepolicy': 'single_host_origin',
//                    'callback': function (result) {
//                        if (result['status']['signed_in']) {
//                            var request = gapi.client.plus.people.get(
//                                    {
//                                        'userId': 'me'
//                                    }
//                            );
//
//
//                            request.execute(function (resp) {
//
//                                $scope.$apply(function () {
//                                    $scope.gmail.username = resp.displayName;
//                                    $scope.gmail.user_first_name = resp['name']['givenName'];
//                                    $scope.gmail.user_last_name = resp['name']['familyName'];
//                                    $scope.gmail.email = resp.emails[0].value;
//                                    $scope.gmail.user_social_id = resp['id'];
//                                    $scope.gmail.user_social_gender = resp['gender'];
//                                    $scope.gmail.user_social_type = 'google';
//                                    $scope.gmail.user_verification = 'yes';
//                                    // console.log($scope.gmail.email);
//
//                                    $http.post('php/social_signinPhpController.php',
//                                            {
//                                                'user_first_name': $scope.gmail.user_first_name,
//                                                'user_last_name': $scope.gmail.user_last_name,
//                                                'email': $scope.gmail.email,
//                                                'user_phone': $scope.gmail.phone,
//                                                'user_social_id': $scope.gmail.user_social_id,
//                                                'user_social_gender': $scope.gmail.user_social_gender,
//                                                'user_social_type': $scope.gmail.user_social_type,
//                                                'user_verification': $scope.gmail.user_verification
//                                            }
//                                    ).then(function (response) {
//
//                                        if (response.data == 1) {
//                                            growl.success("Wellcome back dear user", {
//                                                title: ' '
//                                            });
//                                            setTimeout(function () {
//                                                growl.info("Redirecting page.....", {
//                                                    title: ' '
//                                                });
//                                            }, 1500);
//
//                                            setTimeout(function () {
//                                                window.location.href = "../ticketchai_aj/index.php";
//                                            }, 3000);
//                                        } else if (response.data == 2) {
//                                            growl.success("Registration successfully complete.", {
//                                                title: ' '
//                                            });
//                                            setTimeout(function () {
//                                                growl.info("Redirecting page.....", {
//                                                    title: ' '
//                                                });
//                                            }, 1500);
//
//                                            setTimeout(function () {
//                                                window.location.href = "../ticketchai_aj/index.php";
//                                            }, 3000);
//                                        }
//
//                                    });
//
//                                });
//
//                            });
//
//
//
//                        }
//                    },
//                    'approvalprompat': 'force',
//                    'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
//                };
//                gapi.auth.signIn(myParams);
//            }
            //gmail login end


            // FB login start
//            $scope.facebook = {
//                username: "",
//                user_first_name: "",
//                user_last_name: "",
//                email: "",
//                user_social_id: "",
//                user_social_gender: "",
//                user_social_type: "",
//                user_verification: ""
//            };
//
//
//             $scope.clickOnFBLoginButton = function() {
//        
//                FB.login(function(response) {
//                       //console.log(1);
//                    if (response.authResponse) {
//                        FB.api('/me', 'GET', {fields: 'email, name, first_name, last_name, id, gender'}, function(response) {
//                            $scope.$apply(function() {
//                                $scope.facebook.username = response.name;
//                                $scope.facebook.user_first_name = response.first_name;
//                                $scope.facebook.user_last_name = response.last_name;
//                                $scope.facebook.email = response.email;
//                                $scope.facebook.user_social_id = response.id;
//                                $scope.facebook.user_social_gender = response.gender;
//                                $scope.facebook.user_social_type = 'facebook';
//                                $scope.facebook.user_verification = 'yes';
//                                
//                                
//                                $http.post('php/social_signinPhpController.php',
//                                            {
//                                                'user_first_name': $scope.facebook.user_first_name,
//                                                'user_last_name': $scope.facebook.user_last_name,
//                                                'email': $scope.facebook.email,
//                                                'user_phone': $scope.facebook.phone,
//                                                'user_social_id': $scope.facebook.user_social_id,
//                                                'user_social_gender': $scope.facebook.user_social_gender,
//                                                'user_social_type': $scope.facebook.user_social_type,
//                                                'user_verification': $scope.facebook.user_verification
//                                            }
//                                    ).then(function (response) {
//
//                                        if (response.data == 1) {
//                                            growl.success("Wellcome back dear user", {
//                                                title: ' '
//                                            });
//                                            setTimeout(function () {
//                                                growl.info("Redirecting page.....", {
//                                                    title: ' '
//                                                });
//                                            }, 1500);
//
//                                            setTimeout(function () {
//                                                window.location.href = "../ticketchai_aj/index.php";
//                                            }, 3000);
//                                        } else if (response.data == 2) {
//                                            growl.success("Registration successfully complete.", {
//                                                title: ' '
//                                            });
//                                            setTimeout(function () {
//                                                growl.info("Redirecting page.....", {
//                                                    title: ' '
//                                                });
//                                            }, 1500);
//
//                                            setTimeout(function () {
//                                                window.location.href = "../ticketchai_aj/index.php";
//                                            }, 3000);
//                                        }
//
//                                    });
//                                
//                                
//                            });
//                        });
//                    } else {
//
//                    }
//                }, {
//                    scope: 'email, user_likes',
//                    return_scopes: true
//                });
//                
//                
//            }
            // FB login end







            $http.post('php/navbarPhpController.php').then(function (response) {
                $scope.element = response.data;
                //$scope.menuElementEvent(response.data[0].category_id);
            });



            var minTime = 2;
             $scope.searchResult = '';
             $scope.EventHint = '';
             
             
             $scope.searchEvent = function(){
                 if($scope.EventHint.length == minTime )
                       $scope.executeSearchResult()
                 else  $scope.searchData = ' ';
             };
             
             $scope.executeSearchResult = function(){
                 $http.post("php/indexSearchPhpController.php").then(function(response){
                     $scope.searchResult = response.data;
                     
                 });
             }






        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);

function navClt($scope, $http) {

}
;
//
//$scope.loginDoor = function(loginData){
//   
////              console.log(loginData);
//              $http.post("php/signinPhpController.php",{'email':loginData.userEmail, 'password':loginData.userPassword})
//                      .then(function(response){
//                  // window.location.reload();
//                  if(response.data == 1){
//                      $scope.msg = "Login Succesfully";
//                      
//                        setTimeout(function(){
//                            $scope.msg = "Redirecting page..."
//                        }, 1500);
//                        
//                        setTimeout(function(){
//                            window.location.href = "../ticketchai_aj/user_dashboard/dashboard.php";
//                            //window.reload();
//                            
//                        }, 3000);
//                  } else if (response.data == 2){
//                      $scope.msg ="Failed, Worng password.";
//                  }else if(response.data == 0){
//                      $scope.msg = "Username &amp; password should't be Empty."
//                  } else{}
//                    
//              });
//          }