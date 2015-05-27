angular.module('categoriesService', []).factory('Category', function($http) {
    return {
        get: function(){
            return $http.get('/api/categories');
        },

        getItems: function(id) {
            return $http.get('/api/categories/' + id);
        },

        save:function(category) {
            return $http({
               method:'POST',
                url:'/api/categories',
                data: category
            });
        },

        destory:function(id){
            return $http.delete('/api/categories');
        }
    }
});