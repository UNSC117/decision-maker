@extends('master')

@section('customizeCSS')
    <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>

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

        #editItems {
            font-family: 'Architects Daughter', cursive;
        }

    </style>
@stop

@section('content')
    <div id="editItems" class="row">
        <div ng-controller="categoriesCtrl as ctrl" class="sample" layout="column">
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
                <md-tabs id="categoriesTabs" md-selected="selectedIndex" md-border-bottom>
                    <md-tab ng-repeat="tab in tabs" label="{{tab.title}}">
                        <div class="cate-tab tab{{ $index%4 }}" style="padding: 25px; text-align: center;">
                            <div layout="column" layout-align="end center">
                                <div>{{ tab.content }}</div>
                                <md-chips
                                        ng-model="ctrl.items"
                                        readonly="ctrl.readonly"
                                        placeholder="Enter a tag"
                                        delete-button-label="Remove Tag"
                                        delete-hint="Press delete to remove tag"
                                        secondary-placeholder="+Tag"></md-chips>

                                <div layout="row">
                                    <md-button class="md-primary md-raised" ng-click="removeTab( tab )"
                                               ng-disabled="tabs.length <= 1">Remove Tab
                                    </md-button>
                                </div>
                            </div>
                        </div>
                    </md-tab>
                </md-tabs>
            </md-content>

        </div>

    </div>
@stop

@section('customizeJS')
    <script src='/js/controllers/categoriesController.js'></script>
@stop