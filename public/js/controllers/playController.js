(function() {
    'use strict';
    dmApp.controller('playCtrl', function($scope, $interval, $mdDialog, Category) {
        $scope.tabs = {};
        $scope.placeHolder = 'Select a Category';
        $scope.btnText = 'PLAY';
        $scope.playing = false;
        var play = false, self = this, stop, currentCategory;

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
        $scope.select = function(ev, category) {
            if (!play) {
                if (!category) {
                    $mdDialog.show(
                        $mdDialog.alert()
                            .parent(angular.element(document.body))
                            .title('Alert')
                            .content('Please pick a Category!')
                            //.ariaLabel('Play Button')
                            .ok('Got it!')
                            .targetEvent(ev)
                    );
                } else {
                    var length = (self.items).length;

                    $scope.btnText = 'Stop';
                    $scope.playing = true;
                    play = true;
                    stop = $interval(function() {
                        var min = 0;
                        var max = length;
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
        $scope.changeOption = function(category) {

            Category.getItems(category).success(function(data) {
                $scope.result = data.name;
                currentCategory = data.name;
                $scope.placeHolder = data.name;
                // convert items from string(in DB) to array
                self.items = (data.items).split(',');
                $scope.btnText = 'PLAY';
            }).error(function(data) {
                console.log(data);
            });
        };

        /**
         * If guest, request to login then edit categories
         * @param ev
         */
        $scope.showConfirm = function(ev) {
            // Appending dialog to document.body to cover sidenav in docs app
            var confirm = $mdDialog.confirm()
                .title('Would you like to login and enjoy more feature?')
                .content('After login your with account, you can create customized categories and list as many item options as you want!')
                .ariaLabel('Edit Categories')
                .ok('Sounds great, Login!')
                .cancel('Cancel')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                window.location = '/auth/login';
            });
        };

        /**
         * Popup for edit items
         * @param ev
         */
        $scope.showItems = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                locals: {name: currentCategory, items: self.items},
                templateUrl: 'items',
                targetEvent: ev,
            })
                .then(function(updateData) { // true
                    if (updateData) {
                        Category.update($scope.category, updateData).success(function(data) {
                            $scope.alert = data;
                            Category.get().success(function(data) {
                                if (data) {
                                    $scope.tabs = data;
                                }
                            });
                            $scope.changeOption($scope.category);
                        });
                    } else {
                        $scope.alert = 'You\'ve canceled the edit.';
                    }
                }, function() { // false
                    $scope.alert = 'You cancelled the dialog.';
                });
        };

    });

    /**
     * template html controller for angular popup dialog
     * @param $scope
     * @param $mdDialog
     * @constructor
     */
    function DialogController($scope, $mdDialog, locals) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(updateData) {
            $mdDialog.hide(updateData);
        };

        $scope.category = locals;
    }

})();