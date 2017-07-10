app.service('eventService', ['$http', function ($http) {
    this.fetchAll = function () {
        return $http({
            url: BASE_URL + 'api/events',
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }

    this.fetchOne = function (id) {
        return $http({
            url: BASE_URL + 'api/events/' + id,
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }

    this.fetchStands = function (id) {
        return $http({
            url: BASE_URL + 'api/events/' + id + '/stands',
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }
}]);