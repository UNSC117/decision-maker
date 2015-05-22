(function() {
    'use strict';
    dmApp.controller('playCtrl', function($scope, $interval, Category) {
        $scope.tabs = {};
        $scope.btnText = 'PLAY';
        $scope.playing = false;
        var play = false;
        var stop;

        // Get categories from backend
        Category.get().success(function(data) {
            $scope.tabs = data;
        });

        /**
         * Start random selection
         * @param category
         */
        $scope.select = function(category) {
            if (!play) {
                if (!category) {
                    alert('Please pick a Category!');
                } else {
                    $scope.btnText = 'Stop';
                    $scope.playing = true;
                    play = true;
                    stop = $interval(function() {
                        var min = 0;
                        var max = (self.items).length;
                        var pos = Math.floor(Math.random() * (max - min)) + min;
                        $scope.result = self.items[pos];
                    }, 80);
                }
            } else {
                $scope.stopSelect();
                $scope.btnText = 'Continue';
                play = false;
                $scope.playing = false;
            }
        };

        /**
         *  Stop random selection interval
         */
        $scope.stopSelect = function() {
            if (angular.isDefined(stop)) {
                $interval.cancel(stop);
                stop = undefined;
            }
        }

        // Make sure that the interval is destroyed too
        $scope.$on('$destroy', function() {
            $scope.stopSelect();
        });

        /**
         * Select option on change, set item list under this option
         * @param category
         */
        $scope.update = function(category) {
            Category.getItems(category).success(function(data) {
                $scope.result = category;
                self.items = data;
            }).error(function(data) {
                console.log(data);
            });
        };
    });
})();