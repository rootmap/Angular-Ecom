angular
        .module('user', ['angular-growl'])
        .directive('fileInput', function ($parse) {
            return{
                redirect: 'A',
                link: function (scope, elem, attrs) {
                    elem.bind('change', function () {
                        $parse(attrs.fileInput).assign(scope, elem[0].files);
                        scope.$apply();
                    });
                }
            }
        })
        .controller('userpicController', function ($scope, $http, growl) {


            $scope.imageUpload = function (event) {
                var fiels = event.target.files;
                var file = fiels[fiels.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded;
                reader.readAsDataURL(file);



            }

            $scope.imageIsLoaded = function (e) {
                $scope.$apply(function () {
                    $scope.openPic = true;
                    $scope.fullImage = e.target.result;

                    if ($scope.fullImage) {
                        growl.success("Image uploaded successfully.<br/>Click on your profile image", {title: ' '});
                    } else {
                        growl.error("There something is going wrong.", {title: ' '});
                    }
                    $scope.imagecover = e.target.result;

                    $scope.upload($scope.fullImage);


                });
            }

            $scope.clearCover = function ()
            {
                $scope.fullImage = '';
                $scope.openPic = false;

            }

            $scope.clearCover = function ()
            {
                $scope.imagecover = '';
                $scope.openPic = false;

                console.log('Function Working');
            }


            $scope.imageUpload_thumble = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded_thumble;
                reader.readAsDataURL(file);

            }

            $scope.imageIsLoaded_thumble = function (e) {
                $scope.$apply(function () {
                    $scope.goCats_thumble = true;
                    $scope.step_thumble = e.target.result;
                    $scope.imagethumble = e.target.result;
                });
            }

            $scope.clearThumble = function ()
            {
                $scope.imagethumble = '';
                $scope.goCats_thumble = false;
            }

            $scope.upload = function (val) {
//                console.log('clicking');
               
                if (val != null)
                {
                    
                    $http.post("./php/controller/user_profile_imageController.php", {'photo': val}).success(function (response) {
                        growl.info("Redirecting.......", {title: ' '});
                        setTimeout(function () {
                            window.location.href = 'user_profile.php';
                        }, 2000);
                    });
                }
            }



        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);
