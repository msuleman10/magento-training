define([
    'uiComponent',
    'ko',
    'Macademy_InventoryFulfillment/js/model/box-configurations',
    'Macademy_InventoryFulfillment/js/model/sku',
    'jquery'
], function (
    Component,
    ko,
    boxConfigurationModel,
    sku,
    $
) {
    'use strict';
    return Component.extend({
        defaults: {
            boxConfiguration: boxConfigurationModel.boxConfiguration
        },
        initialize() {
            this._super();
            sku.isSuccess.subscribe((value) => {
                console.log("New value is " + value)
            });
            sku.isSuccess.subscribe((value) => {
                console.log("Old value is " + value)
            }, null, 'beforeChange');
        },
        handleAdd() {
            boxConfigurationModel.add();
        },
        handleDelete(index) {
            boxConfigurationModel.delete(index)
        },
        handleSubmit() {
            $('.box-configurations form input').removeAttr('aria-invalid');

            if ($('.box-configurations form').valid()) {
                boxConfigurationModel.isSuccess(true);
            } else {
                boxConfigurationModel.isSuccess(false);
            }
        }
    });
});
