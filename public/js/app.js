var dmApp = angular.module('dmApp', ['ngMaterial', 'categoriesController', 'categoriesService']).config(function($mdThemingProvider) {
    $mdThemingProvider.theme('default').primaryPalette('deep-purple').accentPalette('amber');
});

/*
config for angular interperater with laravel balde
 , function($interpolateProvider) {
 $interpolateProvider.startSymbol('<%');
 $interpolateProvider.endSymbol('%>');
 }
 */
