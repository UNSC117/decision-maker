angular.module('categoriesService', []).factory('Category', function($http) {
    return {
        get: function() {
            return $http.get('/api/categories');
        },

        getItems: function(id) {
            return $http.get('/api/categories/' + id);
        },

        store: function(category) {
            return $http({
                method: 'POST',
                url: '/api/categories',
                data: category
            });
        },

        update: function(id, category) {
            return $http.put('/api/categories/' + id, {'name': category.name, 'items': category.items});
        },

        destory: function(id) {
            return $http.delete('/api/categories');
        }
    }
});