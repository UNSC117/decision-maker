<md-dialog aria-label="Items" style="width: 30%;">
    <md-content layout-padding>
        <form name="itemForm">
            <md-dialog-content class="sticky-container">
                <md-subheader class="md-sticky-no-effect">Edit items, divide by comma...</md-subheader>
                <div>
                    <md-input-container>
                        <label>Category Name</label>
                        <input type="text" ng-model="category.name">
                    </md-input-container>
                    <md-input-container>
                        <label>Item Options</label>
                        <textarea name="items" ng-model="category.items"></textarea>
                    </md-input-container>
                </div>
            </md-dialog-content>
            <div class="md-actions" layout="row">
                <md-button ng-click="cancel()" class="md-primary">
                    Cancel
                </md-button>
                <md-button ng-click="answer(category)" class="md-primary">
                    Save
                </md-button>
            </div>
        </form>
    </md-content>
</md-dialog>
