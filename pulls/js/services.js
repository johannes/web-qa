var pullsServices = angular.module('pullsServices', ['ngResource']);

pullsServices.factory('RepoList', ['$resource',
    function ($resource) {
        var url = GITHUB_BASEURL+'orgs/'+GITHUB_ORG+'/repos?per_page=100';
        return $resource(url, {}, {
            query: {method:'GET', isArray:true}
        });
    }
]);

pullsServices.factory('User', ['$http',
    function ($http) {
        var user = function() {};

        user.prototype.username = false;
        user.prototype.login = function(username, password) {
        }
        return new user();
    }
]);

