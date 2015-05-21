<html ng-app="welcomeApp">
    <head>
        <title>Laravel</title>

        <link href='//fonts.googleapis.com/css?family=Lato:100,400,500' rel='stylesheet' type='text/css'>
        <!-- Angular Material CSS now available via Google CDN; version 0.9 used here -->
        <link rel="stylesheet"
              href="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.0/angular-material.min.css">
        <link rel="stylesheet" href="/css/welcome.css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Welcome to Decision Maker</div>

                    <section layout="row" layout-sm="column" layout-align="center center">
                        <md-button href="{{ url('/auth/login') }}"
                                   title="Login to enjoy more feature!"
                                   class="md-raised md-primary">Login & Enjoy more Feature
                        </md-button>
                        <md-button href="{{ url('/categories') }}"
                                   title="Try it for fun!"
                                   class="md-raised">Play as a Guest
                        </md-button>
                    </section>

            </div>
        </div>

        <!-- Angular Material Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.min.js"></script>
        <!-- Angular Material Javascript now available via Google CDN; version 0.9 used here -->
        <script src="https://ajax.googleapis.com/ajax/libs/angular_material/0.9.0/angular-material.js"></script>

        <script src="js/welcomeApp.js"></script>
    </body>
</html>
