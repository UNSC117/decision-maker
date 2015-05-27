
<md-dialog aria-label="Mango (Fruit)" style="width: 20%;">
    <form name="itemForm">
        <md-dialog-content class="sticky-container">
            <md-subheader class="md-sticky-no-effect">Mango (Fruit)</md-subheader>
            <div>
                <md-input-container>
                    <label>Items</label>
                    <textarea name="items" ng-model="userCategoryItems"></textarea>
                </md-input-container>
            </div>
        </md-dialog-content>
        <div class="md-actions" layout="row">
            <md-button ng-click="answer(false)" class="md-primary">
                Cancel
            </md-button>
            <md-button ng-click="answer(true)" class="md-primary">
                Save
            </md-button>
        </div>
    </form>
</md-dialog>