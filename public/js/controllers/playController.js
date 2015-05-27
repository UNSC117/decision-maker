(function() {
    'use strict';
    dmApp.controller('playCtrl', function($scope, $interval, $mdDialog, Category) {
        $scope.tabs = {};
        $scope.btnText = 'PLAY';
        $scope.playing = false;
        var play = false;
        var stop;

        // Get categories from backend
        Category.get().success(function(data) {
            if (data) {
                $scope.tabs = data;
            }
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
                console.log(data);
                $scope.result = data.name;
                // convert items from string(in DB) to array
                self.items = (data.items).split(',');
            }).error(function(data) {
                console.log(data);
            });
        };
        $scope.alert = '';
        $scope.showItems = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'items',
                targetEvent: ev,
            })
                .then(function(answer) {
                    if (answer) {
                        $scope.alert = 'You\'ve saved this category.';
                    } else {
                        $scope.alert = 'You\'ve canceled the edit.';
                    }

                }, function() {
                    $scope.alert = 'You cancelled the dialog.';
                });
        };
    });

    function DialogController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
    }
})();