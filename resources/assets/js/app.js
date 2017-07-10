String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, "");
}

var cancelAjax = false;
var app = angular.module('events', ['ui.router', 'ui.materialize', 'uiGmapgoogle-maps']);

app.config(['$stateProvider', '$urlRouterProvider', '$interpolateProvider', '$httpProvider', 'uiGmapGoogleMapApiProvider',
    function ($stateProvider, $urlRouterProvider, $interpolateProvider, $httpProvider, uiGmapGoogleMapApiProvider) {
        $interpolateProvider.startSymbol('[[').endSymbol(']]');

        uiGmapGoogleMapApiProvider.configure({
            key: MAPS_KEY,
            libraries: 'weather,geometry,visualization'
        });

        $httpProvider.interceptors.push(['$q', '$rootScope', function ($q, $rootScope) {
            var isView = function (config) {
                return config.url.indexOf('view') != -1 || config.headers.Accept.indexOf('html') != -1;
            };

            return {
                'request': function (request) {
                    if (!cancelAjax) {
                        $rootScope.loading = true;
                        return request;
                    }

                    return false;
                },
                'response': function (response) {
                    $rootScope.loading = false;

                    return response;
                },
                'responseError': function (response) {
                    $rootScope.showContextualMessage(true, "Error processing request with code: " + response.status);

                    return $q.reject(response);
                }
            }
        }]);

        $stateProvider
            .state('home', {
                url: '',
                templateUrl: BASE_URL + 'view/home',
                controller: 'homeController'
            })
            .state('home_other', {
                url: '/',
                templateUrl: BASE_URL + 'view/home',
                controller: 'homeController'
            })
            .state('event', {
                url: '/event/:id',
                templateUrl: BASE_URL + 'view/event',
                controller: 'eventController'
            })
            .state('stand_reserve', {
                url: '/event/stand/:idEvent/:id',
                templateUrl: BASE_URL + 'view/stand',
                controller: 'standController'
            });

        $urlRouterProvider.otherwise('/');
    }
]);


app.run(['$rootScope', '$timeout',
    function ($rootScope, $timeout) {
        $rootScope.idToken = null;
        $rootScope.user = null;
        $rootScope.contextualMessage = false;
        $rootScope.messageSuccess = false;
        $rootScope.messageForm = null;

        $rootScope.getImage = function (standId) {
            return BASE_URL + 'api/stand/' + standId + '/photo';
        }

        $rootScope.getLogoCompany = function (companyId) {
            if (companyId != 0) {
                return BASE_URL + 'api/company/' + companyId + '/logo';
            } else {
                return false;
            }
        }

        $rootScope.showContextualMessage = function (error, message) {
            $rootScope.contextualMessage = true;
            $rootScope.messageSuccess = !error;
            $rootScope.messageForm = message;

            $timeout(function () {
                $rootScope.contextualMessage = false;
            }, 3000);
        }
    }
]);
