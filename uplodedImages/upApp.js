angular
        .module('merchantaj')
        .directive('fileInput', function ($parse) {
            return{
                restrict: 'A',
                link: function (scope, elem, attrs) {
                    elem.bind('change', function () {
                        $parse(attrs.fileInput).assign(scope, elem[0].files);
                        scope.$apply();
                    });
                }
            }
        })
        .controller('myController', function ($scope, $http, $timeout) {

            $scope.imageUpload = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded;
                reader.readAsDataURL(file);
            }

            $scope.imageIsLoaded = function (e) {
                $scope.$apply(function () {
                    $scope.step = e.target.result;
                });
            }

            $scope.upload = function () {
                //var name = $scope.name;
                var fd = new FormData();
                angular.forEach($scope.files, function (file) {
                    fd.append('file', file);
                });
               // fd.append('name', name);
                var request = $http({
                    method: 'POST',
                    url: '../UPLOAD_PICTURE/php_files/upload.php',
                    data: fd,
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}

                });
                request.then(function (data, status, headers, config) {
                    $scope.msg = 'Insert Successfully';
                    $scope.alert();
                }, function (error) {
                    $scope.msg = error.data;
                    $scope.alert();
                });
            }

            $scope.alert = function () {
                $scope.showMsg = true;
                $timeout(function () {
                    $scope.showMsg = false;
                }, 3000);
            }

        });