var pullsServices = angular.module('pullsServices', ['ngResource']);

pullsServices.factory('RepoList', ['$resource',
    function ($resource) {
        var url = GITHUB_BASEURL+'orgs/'+GITHUB_ORG+'/repos?per_page=100';
        return $resource(url, {}, {
            query: {method:'GET', isArray:true}
        });
    }
]);

pullsServices.filter('pullsHideEmpty', function() {
    return function(array, hide) {
        if (!hide) {
            return array;
        }
        var filtered = [];
        for ( var i = 0; i < array.length; i++) {
            if (array[i].open_issues_count) {
                filtered.push(array[i]);
            }
        }
        return filtered;
    }
});

