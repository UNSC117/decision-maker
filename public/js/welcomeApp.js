var welcomeApp = angular.module('welcomeApp', ['ngMaterial']).config(function($mdThemingProvider) {
    $mdThemingProvider.theme('default').primaryPalette('deep-purple').accentPalette('amber');
});
