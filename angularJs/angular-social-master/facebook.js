app.directive('ngSocialFacebook', ['$parse', function ($parse) {
        'use strict';
//        function LoadFeatureInfo() {
//            $http.get('php/featuredEventController.php').then(function (response) {
//                $scope.featuredEvents = response.data
//            })
//        }
//        LoadFeatureInfo();
//        console.log($scope.featuredEvents);

        var options = {
            
            popup: {
               
                url: 'http://www.facebook.com/sharer/sharer.php?u={url}&picture=http://ticketchai.com/ticketchaiorg/upload/event_web_logo/{image}&description={description}&title={title}',
                // url: 'caption=[caption]&description=[description]&u=[website]&picture=[image-url]'
                width: 600,
                height: 500

            },
            track: {
                'name': 'facebook',
                'action': 'send'
            }
        };
        return {
            restrict: 'C',
            require: '^?ngSocialButtons',
            scope: true,
            replace: true,
            transclude: true,
            template: '<span>' +
                    '<a ng-href="{{ctrl.link(options)}}" target="_blank" ng-click="ctrl.clickShare($event, options)"' +
                    ' class="ng-social-button btn btn-default btn-raised btn-fab btn-fab-mini btn-round">' +
                    '<span class="ng-social-icon"></span>' +
                    '<span class="ng-social-text" ng-transclude></span>' +
                    '</a>' +
                    '</span>',
            link: function (scope, element, attrs, ctrl) {
                element.addClass('ng-social-facebook');
                if (!ctrl) {
                    return;
                }
//                $http.get('php/featuredEventController.php').then(function (response) {
//                    $scope.featuredEvents = response.data
//                })
                options.urlOptions = {
                    url: $parse(attrs.url)(scope)
                };
                scope.options = options;
                scope.ctrl = ctrl;
                console.log(options);
                ctrl.init(scope, element, options);
            }
        };
    }]);