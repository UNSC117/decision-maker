@extends('master')

@section('customizeCSS')
    <link href='//fonts.googleapis.com/css?family=Lato:100,200,400,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
@stop

@section('content')

    <div class="content" ng-controller="playCtrl">
        <div class="title">{{ hintText }}</div>
        <form name="categoryForm">
            <md-input-container>
                <md-select name="category" ng-model="category" ng-change="changeOption(category)">
                    <md-select-label>{{ placeHolder }}</md-select-label>
                    <md-option value="{{ tab.id }}" ng-repeat="tab in tabs">{{ tab.name }}</md-option>
                </md-select>



            <div class="editBtn" layout="row" layout-align="end center">
                @if (Auth::guest())
                    <md-button ng-click="showConfirm($event)" ng-disabled="playing || !category" class="md-accent md-raised  md-hue-1" layout
                               layout-align="center center">Edit
                    </md-button>
                @else
                    <md-button ng-click="showItems($event)" ng-disabled="playing || !category" class="md-accent md-raised  md-hue-1" layout
                               layout-align="center center">Edit
                    </md-button>
                    <md-button ng-click="addCategory($event)" ng-disabled="playing" class="md-primary md-raised" layout
                               layout-align="center center">New
                    </md-button>
                    <md-button ng-click="removeCategory($event)" ng-disabled="playing || !category" class="md-warn md-raised" layout
                               layout-align="center center">remove
                    </md-button>
                @endif

            </div>
        </form>
        <div class="result">
            <h2>I would like to help you decide...{{ result }}</h2>
            <md-button ng-click="select($event, category)" ng-disabled="false" class="md-accent md-raised  md-hue-2"
                       layout
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