
app.directive('ngSocialTwitter', ['$parse', function ($parse) {
  'use strict';

  var options = {
//    counter: {
//      url: '//urls.api.twitter.com/1/urls/count.json?url={url}&callback=JSON_CALLBACK',
//      getNumber: function (data) {
//        return data.count;
//      }
//    },
    popup: {
        
      url: 'http://twitter.com/intent/tweet?url={url}&text={title}',
      width: 600,
      height: 450
    },
    click: function (options) {
      // Add colon to improve readability
      if (!/[\.:\-–—]\s*$/.test(options.pageTitle)) options.pageTitle += ':';
      return true;
    },
    track: {
      'name': 'twitter',
      'action': 'tweet'
    }
  };
  return {
    restrict: 'C',
    require: '^?ngSocialButtons',
    scope: true,
    replace: true,
    transclude: true,
    template: '<span> \
                    <a ng-href="{{ctrl.link(options)}}" target="_blank" ng-click="ctrl.clickShare($event, options)" class="ng-social-button btn btn-default btn-raised btn-fab btn-fab-mini btn-round"> \
                        <span class="ng-social-icon"></span> \
                        <span class="ng-social-text" ng-transclude></span> \
                    </a> \
                    <span ng-show="count" class="ng-social-counter">{{ count }}</span> \
                   </span>',
    link: function (scope, element, attrs, ctrl) {
      element.addClass('ng-social-twitter');
      if (!ctrl) {
        return;
      }
      options.urlOptions = {
        url: $parse(attrs.url)(scope),
        title: $parse(attrs.title)(scope)  
      };
      scope.options = options;
      scope.ctrl = ctrl;
      ctrl.init(scope, element, options);
    }
  }
}]);
