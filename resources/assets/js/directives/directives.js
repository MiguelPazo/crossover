app.directive('autoFocus', ['$timeout', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element) {
            $timeout(function () {
                element[0].focus();
            }, 0);
        }
    };
}]);

app.directive('backImage', function () {
    return function (scope, element, attrs) {
        attrs.$observe('backImage', function (value) {
            element.css({
                'background-image': 'url(' + value + ')',
                'background-size': 'cover'
            });
        });
    };
});
