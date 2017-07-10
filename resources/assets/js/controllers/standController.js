app.controller('standController', ['$scope', '$state', '$stateParams', '$rootScope', 'standService',
    function ($scope, $state, $stateParams, $rootScope, standService) {
        $scope.stand;
        $scope.lstDocuments = [];
        $scope.uploading = false;

        $scope.save = function () {
            $scope.stand.lstDocuments = $scope.lstDocuments;
            required = 6;
            count = 0;

            angular.forEach($scope.stand, function (value, key) {
                switch (key) {
                    case 'company':
                        count = value.trim() != '' ? ++count : count;
                        break;
                    case 'email':
                        count = value.trim() != '' ? ++count : count;
                        break;
                    case 'phone':
                        count = value.trim() != '' ? ++count : count;
                        break;
                    case 'address':
                        count = value.trim() != '' ? ++count : count;
                        break;
                    case 'logo':
                        count = value != null ? ++count : count;
                        break;
                    case 'lstDocuments':
                        count = value.length > 0 ? ++count : count;
                        break;
                }
            });

            if (count == required) {
                standService.save($scope.stand).then(function (response) {
                    $rootScope.showContextualMessage(false, "Stand reserved");
                    $state.go('event', {id: $stateParams.idEvent});
                });
            } else {
                $rootScope.showContextualMessage(true, "All fields are required!");
            }
        }

        $('#upload_files').dropzone({
            url: BASE_URL + 'api/stand/upload/documents',
            clickable: '#btn_upload_files',
            maxFilesize: 5,
            parallelUploads: 5,
            autoProcessQueue: true,
            previewsContainer: '.preview-upload',
            acceptedFiles: 'application/pdf',
            processing: function (file) {
                $scope.$apply(function () {
                    $scope.uploading = true;
                });
            },
            error: function (file, errorMessage) {
                if (!file.accepted) {
                    this.removeFile(file);

                    $scope.$apply(function () {
                        $rootScope.showContextualMessage(true, "Can't upload file: " + file.name);
                    });
                } else {
                    $rootScope.showContextualMessage(true, "Error uploading file: " + file.name);
                }

                $scope.$apply(function () {
                    $scope.uploading = false;
                });
            },
            success: function (file, response) {
                $scope.$apply(function () {
                    $scope.lstDocuments.push({
                        code: response.document,
                        name: file.name
                    });
                    $scope.uploading = false;
                });
            }
        });

        $('#upload_logo').dropzone({
            url: BASE_URL + 'api/stand/upload/logo',
            clickable: '#btn_upload_logo',
            maxFilesize: 5,
            parallelUploads: 5,
            autoProcessQueue: true,
            previewsContainer: '.preview-upload',
            acceptedFiles: 'image/jpeg',
            processing: function (file) {
                $scope.$apply(function () {
                    $scope.uploading = true;
                });
            },
            error: function (file, errorMessage) {
                if (!file.accepted) {
                    this.removeFile(file);

                    $scope.$apply(function () {
                        $rootScope.showContextualMessage(true, "Can't upload image: " + file.name);
                    });
                } else {
                    $rootScope.showContextualMessage(true, "Error uploading image: " + file.name);
                }

                $scope.$apply(function () {
                    $scope.uploading = false;
                });
            },
            success: function (file, response) {
                $scope.$apply(function () {
                    $scope.stand.logo = {
                        code: response.logo,
                        name: file.name
                    };
                    $scope.uploading = false;
                });
            }
        });

        $scope.load = function (standId) {
            standService.fetchOne(standId).then(function (response) {
                $scope.stand = response.data;
            });
        }

        $scope.load($stateParams.id);
    }
]);