var pullsServices = angular.module('pullsServices', ['ngResource', 'pullsConfig']);

pullsServices.factory('RepoList', ['$resource', 'Config',
    function ($resource, Config) {
        var url = Config.github.baseurl+'orgs/'+Config.github.org+'/repos?per_page=100';
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

