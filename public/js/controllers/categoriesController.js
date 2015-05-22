(function() {
    'use strict';
    angular
        .module('categoriesController', ['ngMaterial'])
        .controller('categoriesCtrl', function($scope, $log, $interval, Category) {
            var self = this;
            $scope.tabs = {};
            $scope.btnText = 'PLAY';
            $scope.playing = false;

            Category.get().success(function(data) {
                $scope.tabs = data;

            });
            self.items = ['asd', 'fff', 'ytut'];
            /*
             var tabs = [
             {title: 'One', content: "Tabs will become paginated if there isn't enough room for them."},
             {title: 'Two', content: "You can swipe left and right on a mobile device to change tabs."},
             {
             title: 'Three',
             content: "You can bind the selected tab via the selected attribute on the md-tabs element."
             }
             ];
             */

            var selected = null, previous = null;
            $scope.$watch('selectedIndex', function(current, old) {
                previous = selected;
                selected = $scope.tabs[current];
                if (old && (old != current)) $log.debug('Goodbye ' + previous.title + '!');
                if (current)                $log.debug('Hello ' + selected.title + '!');
            });
            $scope.addTab = function(title) {
                $scope.tabs.push({title: title, content: "Empty", disabled: false});
            };
            $scope.removeTab = function(tab) {
                var index = $scope.tabs.indexOf(tab);
                $scope.tabs.splice(index, 1);
            };

        });
})();