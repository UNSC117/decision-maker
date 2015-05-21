@extends('master')

@section('customizeCSS')
    <style>
        md-content {
            background-color: transparent !important;
            min-height: 500px;
        }

        md-content md-tabs {
            border: 1px solid #e1e1e1;
        }

        md-content h1:first-child {
            margin-top: 0;
        }

        md-input-container {
            padding-bottom: 0;
        }

        .cate-tab > div > div {
            padding: 25px;
            box-sizing: border-box;
        }

        .edit-form input {
            width: 100%;
        }

        md-tabs {
            border-bottom: 1px solid rgba(0, 0, 0, 0.12);
            min-height: 500px;
        }

        #categoriesTabs {
            min-height: 500px;
        }

        md-tab[disabled] {
            opacity: 0.5;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div ng-controller="categoriesCtrl" class="sample" layout="column">
            <!-- Start: Form to create new tab -->
            <form ng-submit="addTab(tTitle)" layout="column" class="md-padding" style="padding-top: 0;">
                <div layout="row" layout-sm="column">
                    <div flex style="position: relative;">
                        <h2 class="md-subhead"
                            style="position: absolute; bottom: 0; left: 0; margin: 0; font-weight: 500; text-transform: uppercase; line-height: 35px; white-space: nowrap;">
                            Create a new Category:</h2>
                    </div>
                    <md-input-container>
                        <label for="label">Category Name</label>
                        <input type="text" id="label" ng-model="tTitle">
                    </md-input-container>
                    <md-button class="add-tab md-primary md-raised" ng-disabled="!tTitle" type="submit"
                               style="margin-right: 0;">Create
                    </md-button>
                </div>
            </form>
            <!-- End: Form to create new tab -->
            <!-- Angular material tabs -->

            <md-content class="md-padding">
                <md-tabs id="categoriesTabs" md-selected="selectedIndex" md-border-bottom foo="bar">
                    <md-tab ng-repeat="tab in tabs"
                            ng-disabled="tab.disabled"
                            label="<%tab.title%>">
                        <div class="cate-tab tab<% $index%4 %>" style="padding: 25px; text-align: center;">
                            <div ng-bind="tab.content"></div>
                            <br/>
                            <md-button class="md-primary md-raised" ng-click="removeTab( tab )"
                                       ng-disabled="tabs.length <= 1">Remove Tab
                            </md-button>
                        </div>
                    </md-tab>
                </md-tabs>
            </md-content>

        </div>

    </div>
@stop

@section('customizeJS')
    <script src='js/controllers/categoriesController.js'></script>
@stop