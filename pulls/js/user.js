var pullsUser = angular.module('pullsUser', []);

pullsUser.controller('UserCtrl', ['$scope', '$http', 'User',
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

pullsUser.factory('User', ['$http',
    function ($http) {
        var user = function() {};

        user.prototype.username = false;
        user.prototype.login = function(username, password) {
        }
        return new user();
    }
]);

