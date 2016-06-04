angular.module('app.controllers')
    .controller('ProjectViewController',
        ['$scope', '$location', '$routeParams', 'Project',
            function ($scope, $location, $routeParams, Project) {
                $scope.project = new Project.get({id: $routeParams.id});
            }]);