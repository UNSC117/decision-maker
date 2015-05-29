var dmApp = angular.module('dmApp', ['ngMaterial', 'categoriesService']).config(function($mdThemingProvider) {
    $mdThemingProvider.theme('default').primaryPalette('deep-purple').accentPalette('amber');
});

/*
config for angular interperater with laravel blade
 , function($interpolateProvider) {
 $interpolateProvider.startSymbol('<%');
 $interpolateProvider.endSymbol('%>');
 }
 */
