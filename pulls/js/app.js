var pullsApp = angular.module('pullsApp', [
    'ngRoute',
    'pullsUser',
    'pullsControllers',
    'pullsServices'
]);

pullsApp.config(['$routeProvider',
    function($routeProvider) {
       $routeProvider.
            when('/', {
                templateUrl: 'partials/repo-list.html',
                controller: 'RepoListCtrl'
            }).
            when('/:repo', {
                templateUrl: 'partials/pull-list.html',
                controller: 'PullListCtrl'
            }).
            otherwise({
              redirectTo: '/'
            });
    }
]);
