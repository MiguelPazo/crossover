app.controller('eventController', ['$scope', '$stateParams', 'eventService', 'standService',
    function ($scope, $stateParams, eventService, standService) {
        $scope.event;
        $scope.lstStands;
        $scope.standSelected;
        $scope.lstDocuments;

        $scope.standDetails = function (standId) {
            standService.fetchOne(standId).then(function (response) {
                $scope.standSelected = response.data;
                $('#btn_stand_details').sideNav('show');

                if ($scope.standSelected.status == 'reserved') {
                    standService.fetchDocuments(standId).then(function (response) {
                        $scope.lstDocuments = response.data;
                    });
                }
            });
        }

        $scope.downloadDocument = function (document) {
            location.href = BASE_URL + 'api/document/' + document.id + '/download';
        }

        $scope.isReserved = function (status) {
            if (status == 'reserved') {
                return true;
            } else {
                return false;
            }
        }

        $scope.load = function (eventId) {
            eventService.fetchOne(eventId).then(function (response) {
                $scope.event = response.data;
            });

            eventService.fetchStands(eventId).then(function (response) {
                $scope.lstStands = response.data;
            });
        }

        $scope.load($stateParams.id);
    }
]);