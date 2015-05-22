@extends('master')

@section('customizeCSS')
    <link href='//fonts.googleapis.com/css?family=Lato:100,200,400,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
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
            font-weight: 200;
            font-family: 'Lato';
        }

        md-select {
            font-weight: 400;
            font-family: 'Lato';
        }

        .result {
            margin-top: 8%;
            font-family: 'Architects Daughter', cursive;
        }

        .result md-button {
            width: 20em;
            height: 2em;
        }

    </style>
@stop

@section('content')

    <div class="content" ng-controller="playCtrl">
        <div class="title">Pick a Category</div>
        <form name="categoryForm">
            <md-input-container>
                <md-select name="category" placeholder="Pick" ng-model="category" ng-change="update(category)" required>
                    <md-option value="{{ tab.title }}" ng-repeat="tab in tabs">{{ tab.title }}</md-option>
                </md-select>
            </md-input-container>


            <div layout="row" layout-align="end center">
                <md-button href="<% url('categories/edit')  %>" ng-disabled="playing" class="md-warn" layout
                           layout-align="center center">Edit Categories
                </md-button>
            </div>
        </form>

        <div class="result">
            <h2>I would like to help you decise...{{ result }}</h2>
            <md-button ng-click="select(category)" ng-disabled="false" class="md-accent md-raised md-hue-1" layout
                       layout-align="start start">{{ btnText }}
            </md-button>
        </div>
    </div>



@stop

@section('customizeJS')

@stop