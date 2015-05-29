<!DOCTYPE html>
<html lang="en" ng-app="dmApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to Decision Maker</title>

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- Twitter Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Angular Material CSS now available via Google CDN; version 0.9 used here -->
        <link rel="stylesheet"
              href="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.0/angular-material.min.css">

        <link href="/css/master.css" rel="stylesheet">

        @yield('customizeCSS')
    </head>
    <body>
        @include('partials.nav')

        <div class="container">
            @yield('content')
        </div>

        <!-- Jquery Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- Bootstrap Scripts -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <!-- Angular Material Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.min.js"></script>

        <!-- Angular Material Javascript now available via Google CDN; version 0.9 used here -->
        <script src="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.4/angular-material.js"></script>

        <script src="/js/app.js"></script>
        <script src='/js/controllers/playController.js'></script>
        <script src='/js/services/categoriesService.js'></script>

        @yield('customizeJS')

        @yield('footer')
    </body>
</html>
