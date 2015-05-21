var dmApp = angular.module('dmApp', ['ngMaterial', 'categoriesController'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});