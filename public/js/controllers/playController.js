(function() {
    'use strict';
    dmApp.controller('playCtrl', function($scope, $interval, $mdDialog, $timeout, Category) {
        const HOLDER_INIT = 'My Categories...';
        $scope.tabs = {};
        $scope.placeHolder = HOLDER_INIT;
        dmApp
        $scope.btnText = 'PLAY';
        $scope.playing = false;

        var play = false, playTimes = 0, stop, currentCategory, self = this;
        if (playTimes == 0) {
            $scope.hintText = 'Welcome to Decision Maker';
            $timeout(function() {
                $scope.hintText = '1) Select a Category';
            }, 2000);

        } else {
            $scope.hintText = 'So many options...';
        }
        // Get categories from backend
        Category.get().success(function(data) {
            if (data) {
                $scope.tabs = data;
            }
        });

        /**
         * Start random selection
         * @param ev
         * @param category category id from select option
         */
        $scope.select = function(ev, category) {
            if (!play) {
                if (!category) {
                    $scope.showAlert(ev, angular.element(document.body), 'Alert', 'Please select a Category!', 'Alert', 'Got it');
                } else {
                    if (playTimes != 3) {
                        var length = (self.items).length;
                        if (length == 0) {
                            $scope.showAlert(ev, angular.element(document.body), 'Alert', 'There is no item in the list XD', 'Alert', 'Got it');
                        } else if (length == 1) {
                            $scope.showAlert(ev, angular.element(document.body), 'Alert', 'Hey →_→, there is only one item in the category!', 'Alert', 'Got it');
                        } else {
                            if (playTimes == 0) {
                                $scope.hintText = '3) Stop any time :)';
                            }

                            $scope.btnText = 'Stop';
                            $scope.playing = true;
                            play = true;
                            stop = $interval(function() {
                                var min = 0;
                                var max = length;
                                var pos = randomInt(max, min);
                                $scope.result = self.items[pos];
                            }, 80);

                            $scope.flashItems();

                            playTimes++;
                        }
                    } else {
                        $scope.showAlert(ev, angular.element(document.body), 'Hint', 'Didn\'t get what you want? You can create or edit options!', 'Hint', 'Got it');
                        $scope.btnText = 'Continue';
                        playTimes++;
                    }
                }
            } else {
                if (playTimes == 1) {
                    $scope.hintText = 'Great! Hope you enjoyed it :)';
                    $timeout(function() {
                        $scope.hintText = 'Decision Maker';
                    }, 5000);
                }
                $scope.stopSelect();
                $scope.stopFlash();
                $scope.btnText = 'Play, again!';
                play = false;
                $scope.playing = false;
            }
        };

        /**
         * function for material design alert
         * @param ev event target
         * @param parent alert parent element
         * @param title alert title
         * @param content alert content
         * @param ariaLabel
         * @param ok
         */
        $scope.showAlert = function(ev, parent, title, content, ariaLabel, ok) {
            $mdDialog.show(
                $mdDialog.alert()
                    .parent(parent)
                    .title(title)
                    .content(content)
                    .ariaLabel(ariaLabel)
                    .ok(ok)
                    .targetEvent(ev)
            );
        }

        // Stop random selection interval
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
         * @param category category id form select options
         */
        $scope.changeOption = function(category) {
            self.items = [];
            Category.getItems(category).success(function(data) {
                $scope.result = data.name;
                currentCategory = data.name;
                $scope.placeHolder = data.name;

                var items = (data.items).split(/,+/);
                for (var i = 0; i < items.length; i++) {
                    if (items[i].trim() != "") {
                        (self.items).push(items[i]);
                    }
                }

                $scope.btnText = 'PLAY';
                if (playTimes == 0) {
                    $scope.hintText = '2) Hit Play!!!';
                }
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
                .content('After login with your account, you can create customized categories and list as many item options as you need!')
                .ariaLabel('Edit Categories')
                .ok('Sounds great, Login!')
                .cancel('Cancel')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                window.location = '/auth/login';
            });
        };

        /**
         * Popup, call service to edit items in current category
         * @param ev
         */
        $scope.showItems = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                locals: {'name': currentCategory, 'items': self.items},
                templateUrl: 'items',
                targetEvent: ev,
            })
                .then(function(updateData) { // true
                    Category.update($scope.category, updateData).success(function(data) {
                        Category.get().success(function(data) {
                            if (data) {
                                $scope.tabs = data;
                            }
                        });
                        $scope.changeOption($scope.category);
                        $scope.alert = data;
                        $scope.clearAlertMsg(2500);
                    });
                });
        };

        /**
         * Popup, call service to create category and item options
         * @param ev event target
         */
        $scope.addCategory = function(ev) {
            $mdDialog.show({
                controller: CreateController,
                templateUrl: 'items',
                targetEvent: ev,
            })
                .then(function(createDate) { // true
                    Category.store(createDate).success(function(lastInsertId) {
                        Category.get().success(function(data) {
                            if (data) {
                                $scope.tabs = data;
                            }
                        });
                        $scope.changeOption(lastInsertId);
                        $scope.alert = 'You\'ve successfully created a new category!';
                        $scope.clearAlertMsg(2500);
                        $scope.category = lastInsertId;
                    });
                });
        };

        /**
         * call category service to remove one category
         * @param ev
         */
        $scope.removeCategory = function(ev) {
            var prevName = $scope.placeHolder;
            var c = $mdDialog.confirm()
                .title('Confirm')
                .content('Do you want to remove "' + prevName + '" ?')
                .ok('Yes')
                .cancel('Cancel')
                .targetEvent(ev);
            $mdDialog.show(c).then(function() {
                Category.destory($scope.category).success(function(data) {
                    if (data) {
                        $scope.alert = prevName + ' removed!';
                        Category.get().success(function(data) {
                            if (data) {
                                $scope.tabs = data;
                            }
                        });

                        $scope.category = undefined;
                        $scope.placeHolder = HOLDER_INIT;
                    } else {
                        $scope.alert = 'Oops, something wrong when remove ' + prevName;
                    }
                    $scope.clearAlertMsg(2500);
                });
            }).finally(function() {
                c = undefined;
            });
        };

        //clear alert massage for user after 2500 milliseconds
        $scope.clearAlertMsg = function(durition) {
            $timeout(function() {
                $scope.alert = '';
            }, durition);
        }

        var stopFlash;
        /**
         * temporary items interval flash on window
         */
        $scope.flashItems = function() {
            var body = $("body"), width = body.width(), height = body.height();

            stopFlash = $interval(function() {
                var pos = randomInt((self.items).length),
                    item = (self.items)[pos],
                    top = randomInt(height),
                    left = randomInt(width - 50),
                    alpha = randomInt(8, 4) / 10,
                    font_size = randomInt(40, 15);
                var flashOption = $("<span class='flash'>" + item + "</span>").css({
                    top: top,
                    left: left,
                    color: "rgba(0,0,0," + alpha + ")",
                    fontSize: font_size + "px"
                }).appendTo(body);

                flashOption.hide().fadeIn("slow", function() {
                    $(this).fadeOut("slow", function() {
                        $(this).remove();
                    });
                });

            }, 80);
        };

        // Stop random flash interval
        $scope.stopFlash = function() {
            if (angular.isDefined(stopFlash)) {
                $interval.cancel(stopFlash);
                stopFlash = undefined;
            }
        }
    });

    /**
     * template html controller for angular popup dialog
     *
     * @param $scope angular controller scope
     * @param $mdDialog injection for mdDialog module
     * @param locals variables passed from parent
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
            if (updateData.name) {
                $mdDialog.hide(updateData);
            }
        };
        $scope.category = locals;
    }


    /**
     * template html controller for angular popup dialog
     *
     * @param $scope
     * @param $mdDialog
     * @constructor
     */
    function CreateController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(createData) {
            if (createData.name) {
                $mdDialog.hide(createData);
            }
        };
    }

    function randomInt(max, min) {
        max = max || 100;
        min = min || 0;
        return Math.floor(Math.random() * (max - min) + min);
    }
})();