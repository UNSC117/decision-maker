<!DOCTYPE html>
<html lang="en" ng-app="dmApp">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Decision Maker --- An Angular, JQuery, Laravel (PHP), MySQL Web Application">
        <meta name="keywords"
              content="decision maker, angular, angularJS, material, material design, laravel, laravel php, php, restful api, javascript app, wei wang">
        <meta name="author" content="Wei Wang">
        <meta name="version" content="beta 1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome to Decision Maker</title>

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>

        <!-- Twitter Bootstrap CSS -->
        <link href="/css/libraries/bootstrap.min.css" rel="stylesheet">

        <!-- Angular Material CSS now available via Google CDN; version 0.9 used here -->
        <link rel="stylesheet" href="/css/libraries/angular-material.min.css">

        <!-- App CSS -->
        <link href="/css/master.css" rel="stylesheet">

        @yield('customizeCSS')
    </head>
    <body>
        @include('partials.nav')

        <div class="container">
            @yield('content')
        </div>

        <!-- Jquery Scripts -->
        <script src="/js/libraries/jquery.min.js"></script>
        <!-- Bootstrap Scripts -->
        <script src="/js/libraries/bootstrap.min.js"></script>

        <!-- Angular Material Dependencies -->
        <script src="/js/libraries/angular.js"></script>
        <script src="/js/libraries/angular-animate.min.js"></script>
        <script src="/js/libraries/angular-aria.min.js"></script>
        <!-- <script src="/js/libraries/angular-messages.js"></script> -->

        <!-- Angular Material Javascript now available via Google CDN; version 0.9 used here -->
        <script src="/js/libraries/angular-material.js"></script>

        <script src="/js/app.js"></script>
        <script src='/js/controllers/playController.js'></script>
        <script src='/js/services/categoriesService.js'></script>

        @yield('customizeJS')

        @yield('footer')
    </body>
</html>
