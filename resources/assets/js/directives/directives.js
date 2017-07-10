app.directive('autoFocus', ['$timeout', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element) {
            if (!isMobile()) {
                $timeout(function () {
                    element[0].focus();
                }, 0);
            }
        }
    };
}]);

app.directive('alphaNumeric', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            ngModelCtrl.$parsers.push(function (text) {
                var transformedInput = text.replace(/[^0-9a-zA-Z\s]/g, '');

                if (transformedInput !== text) {
                    ngModelCtrl.$setViewValue(transformedInput);
                    ngModelCtrl.$render();
                }
                return transformedInput;
            });
        }
    };
});

app.directive('numeric', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            ngModelCtrl.$parsers.push(function (text) {
                var transformedInput = text.replace(/[^0-9\s]/g, '');

                if (transformedInput !== text) {
                    ngModelCtrl.$setViewValue(transformedInput);
                    ngModelCtrl.$render();
                }
                return transformedInput;
            });
        }
    };
});

app.directive('goBack', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            element.bind('click', function () {
                history.back();
                scope.$apply();
            });

        }
    }
});

app.directive('reloadPage', function () {
    return function (scope, element, attrs) {
        element.bind('click', function () {
            location.reload();
        });
    }
});

app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});

