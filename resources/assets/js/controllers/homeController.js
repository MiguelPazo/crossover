app.controller('homeController', ['$scope', 'eventService', 'uiGmapGoogleMapApi',
    function ($scope, eventService, uiGmapGoogleMapApi) {
        $scope.map = {
            center: {
                latitude: -12.0949219,
                longitude: -77.0237366
            },
            zoom: 15,
            options: {
                scrollwheel: true
            },
            control: {}
        };
        $scope.lstEvents = [];
        $scope.eventSelected = null;

        $scope.eventDetails = function (eventId) {
            eventService.fetchOne(eventId).then(function (response) {
                $scope.eventSelected = response.data;
                $('#btn_event_details').sideNav('show');
            });
        }

        uiGmapGoogleMapApi.then(function (maps) {
            eventService.fetchAll().then(function (response) {
                data = [];
                angular.forEach(response.data, function (value, key) {
                    data.push({
                        id: value.id,
                        coords: {
                            latitude: value.latitude,
                            longitude: value.longitude
                        }
                    });
                });

                $scope.lstEvents = data;
            });
        });
    }
]);