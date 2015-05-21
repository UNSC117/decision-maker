@extends('master')

@section('customizeCSS')
    <link href='//fonts.googleapis.com/css?family=Lato:100,400,500' rel='stylesheet' type='text/css'>
    <style>

        .content {
            text-align: center;
            display: block;
            margin: 0 auto;
        }

        .title {
            margin: 0 auto;
            font-size: 96px;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        md-select {
            font-weight: 400;
            font-family: 'Lato';
        }
    </style>
@stop

@section('content')

    <div class="content" ng-controller="categoriesCtrl">
        <div class="title">Pick a Category</div>
        <form name="categoryForm">
            <md-input-container>
                <md-select name="category" placeholder="Pick" ng-model="category" required>
                    <md-option value="<% tab.title %>" ng-repeat="tab in tabs"><% tab.title %></md-option>
                </md-select>
            </md-input-container>

            <div layout="row">
                <md-button ng-click="save()" ng-disabled="!category" class="md-primary" layout
                           layout-align="center end">Select
                </md-button>
                <md-button ng-click="edit()" ng-disabled="!category" class="md-primary" layout
                           layout-align="center end">Edit
                </md-button>
            </div>
        </form>
    </div>

@stop

@section('customizeJS')
    <script src='js/controllers/categoriesController.js'></script>
@stop