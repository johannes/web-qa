var pullsControllers = angular.module('pullsControllers', []);

pullsControllers.controller('RepoListCtrl', ['$scope', 'RepoList',
    function ($scope, RepoList) {
        $scope.repos = RepoList.query();
	$scope.orderProp = 'id';
    }
]);

pullsControllers.controller('PullListCtrl', ['$scope', '$http', '$routeParams', 
    function ($scope, $http, $routeParams) {
        $scope.repo = $routeParams.repo;
    }
]);

pullsControllers.controller('UserCtrl', ['$scope', '$http', 'User',
    function ($scope, $http, User) {
        $scope.user = User;
	$scope.loginuser = "";
	$scope.loginpassword = "";

        $scope.doLogin = function() {
           $http({
               method: 'POST',
               url:    'api.php?action=login',
               data:   'user='+escape($scope.loginuser)+'&pass='+escape($scope.loginpassword),
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           })
           .success(function(data) {
               User.username = data.user;
           });
       }
    }
]);

