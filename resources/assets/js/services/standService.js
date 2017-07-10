app.service('standService', ['$http', function ($http) {
    this.fetchOne = function (id) {
        return $http({
            url: BASE_URL + 'api/stand/' + id,
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }

    this.fetchDocuments = function (id) {
        return $http({
            url: BASE_URL + 'api/stand/' + id + '/documents',
            method: 'GET'
        }).success(function (response) {
            return response;
        });
    }

    this.save = function (stand) {
        return $http({
            url: BASE_URL + 'api/stand',
            method: 'POST',
            data: stand
        }).success(function (response) {
            return response;
        })
    }
}]);