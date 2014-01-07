var pullsControllers = angular.module('pullsControllers', []);

pullsControllers.controller('RepoListCtrl', ['$scope', 'RepoList',
    function ($scope, RepoList) {
        $scope.repos = RepoList.query();
        $scope.orderProp = 'id';
        $scope.hideNoOpen = true;
    }
]);

pullsControllers.controller('PullListCtrl', ['$scope', '$http', '$routeParams', 
    function ($scope, $http, $routeParams) {
        $scope.repo = $routeParams.repo;
    }
]);

