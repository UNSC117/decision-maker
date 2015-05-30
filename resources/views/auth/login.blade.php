@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><% $error %></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal user-auth" role="form" method="POST" action="<% url('/auth/login') %>">
                            <input type="hidden" name="_token" value="<% csrf_token() %>">

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email"
                                           valduritionue="<% old('email') %>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">

                                        <md-checkbox
                                                class="md-warn"
                                                name="remember"
                                                ng-model="rememberCb"
                                                aria-label="Checkbox"
                                                ng-true-value="' : Yup'"
                                                ng-false-value="' : Nope'">
                                            Remember Me {{ rememberCb }}
                                        </md-checkbox>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <md-button class="md-raised md-accent md-hue-3">
                                        Login
                                    </md-button>

                                    <a class="btn btn-link" href="<% url('/password/email') %>">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
