<!DOCTYPE html>
<html lang="en">
    <head>
        <title>VividCortex reCaptcha Directive Example</title>

        <!-- Bootstrap is NOT required, it's just here to make the demo look better -->
        <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">

        <!-- Include AngularJS -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.js"></script>

        <!-- Include the JS ReCaptcha API -->
        <script type="text/javascript" src="//www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

        <!-- Include the ngReCaptcha directive -->
        <script src="recaptcha.js"></script>

        <!-- define your app and make it depend on vcRecaptcha module -->
        <script>
            var app = angular.module('testApp', ['vcRecaptcha']);

            app.controller('testCtrl', function ($scope, vcRecaptchaService) {
                console.log("this is your app's controller");

                $scope.submit = function () {
                    var valid;

                    console.log('sending the captcha response to the server', vcRecaptchaService.data());

                    // You need to implement your server side validation here.
                    // Send the model.captcha object to the server and use some of the server side APIs to validate it
                    // See https://developers.google.com/recaptcha/docs/

                    if (valid) {
                        console.log('Success');

                    } else {
                        console.log('Failed validation');

                        // In case of a failed validation you need to reload the captcha because each challenge can be checked just once
                        vcRecaptchaService.reload();
                    }
                };
            });
        </script>

    </head>
    <body>
    <div class="container" ng-app="testApp" ng-controller="testCtrl">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <h1>VividCortex reCaptcha Directive Example</h1>
        <p>
            This the <b>reccomended</b> way of using the reCaptcha directive.
            Instead of using ng-model to get the challenge and response, you use a service.
            This way it's safer because we don't depend on a timeout hack that we are currently using in the directive.
        </p>

        <form>
            <div
                vc-recaptcha
                tabindex="3"
                theme="clean"
                key="=== REPLACE THIS WITH YOUR PUBLIC KEY ==="
            ></div>

            <!-- Call a method in the scope of your controller to handle data submit -->
            <button class="btn" ng-click="submit()">Submit</button>
        </form>

    </div>
    </body>
</html>
