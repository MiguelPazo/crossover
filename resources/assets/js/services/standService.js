app.service('standService', ['$http', function ($http) {
    this.fetchOne = function (id) {
        return $http({
            url: BASE_URL + 'api/stand/' + id,
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }
}]);