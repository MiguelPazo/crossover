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

                    if (!isView(response.config)) {
                        if (response.data.success != undefined) {
                            var showMessageForm = (response.data.message != null) ? true : false;

                            if (showMessageForm) {
                                $rootScope.showContextualMessage(!response.data.success, response.data.message);
                            }

                            if (!response.data.success) {
                                return $q.reject(response);
                            }
                        }
                    }

                    return response;
                },
                'responseError': function (response) {
                    switch (response.status) {
                        case 500:
                            alert('500');
                            // $('#modal_general_error').openModal({dismissible: false});
                            break;
                        case 401:
                            cancelAjax = true;
                            alert('401');
                            // $('#modal_session').openModal({dismissible: false});
                            break;
                        case 422:
                            alert('422');
                            break;
                        default:
                            alert(response.status);
                            break;
                    }

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
                url: '/event/stand/:id',
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

        $rootScope.showContextualMessage = function (error, message) {
            $rootScope.contextualMessage = true;
            $rootScope.messageSuccess = !error;
            $rootScope.messageForm = message;

            $timeout(function () {
                $rootScope.contextualMessage = false;
            }, 3000);
        }

        $rootScope.getDate = function (date) {
            if (date != undefined) {
                var day = date.substring(8, 10);
                var month = date.substring(5, 7);
                var year = date.substring(0, 4);

                return day + '/' + month + '/' + year;
            } else {
                return '--';
            }
        }

        $rootScope.getDateFull = function (date) {
            if (date != undefined) {
                var day = date.substring(8, 10);
                var month = date.substring(5, 7);
                var year = date.substring(0, 4);
                var time = date.substring(11);

                return day + '/' + month + '/' + year + ' ' + time;
            } else {
                return '--';
            }
        }
    }
]);
