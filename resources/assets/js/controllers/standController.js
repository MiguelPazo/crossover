app.controller('standController', ['$scope', '$stateParams', 'standService',
    function ($scope, $stateParams, standService) {
        $scope.stand;

        $scope.save = function () {

        }

        $scope.load = function (standId) {
            standService.fetchOne(standId).then(function (response) {
                $scope.stand = response.data;
            });
        }

        $scope.load($stateParams.id);
    }
]);