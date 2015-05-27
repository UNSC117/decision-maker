@extends('master')

@section('customizeCSS')
    <link href='//fonts.googleapis.com/css?family=Lato:100,200,400,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
@stop

@section('content')

    <div class="content" ng-controller="playCtrl">
        <div class="title">Pick a Category</div>
        <form name="categoryForm">
            <md-input-container>
                <md-select name="category" placeholder="Pick" ng-model="category" ng-change="update(category)" required>
                    <md-option value="{{ tab.id }}" ng-repeat="tab in tabs">{{ tab.name }}</md-option>
                </md-select>
            </md-input-container>


            <div class="editBtn" layout="row" layout-align="end center">
                <md-button ng-click="showItems($event)" ng-disabled="playing || !category" class="md-warn" layout
                           layout-align="center center">Edit Categories
                </md-button>

            </div>
        </form>

        <div class="result">
            <h2>I would like to help you decide...{{ result }}</h2>
            <md-button ng-click="select(category)" ng-disabled="false" class="md-accent md-raised md-hue-1" layout
                       layout-align="start start">{{ btnText }}
            </md-button>
            <b layout="row" layout-align="center center" layout-margin>
                {{alert}}
            </b>
        </div>
    </div>

@stop

@section('customizeJS')

@stop