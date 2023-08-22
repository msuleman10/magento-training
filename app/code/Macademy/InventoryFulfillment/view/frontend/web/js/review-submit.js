define([
    'uiComponent',
    'ko',
    'Macademy_InventoryFulfillment/js/model/box-configurations',
    'Macademy_InventoryFulfillment/js/model/sku',
    'mage/url',
    'mage/storage'
], function (
    Component,
    ko,
    boxConfigurationModel,
    skuModel,
    url,
    storage
) {
    'use strict';
    return Component.extend({
        defaults: {
            numberOfBoxes: boxConfigurationModel.numberOfBoxes(),
            shipmentWeight: boxConfigurationModel.shipmentWeight(),
            billableWeight: boxConfigurationModel.billableWeight(),
            boxConfigurationIsSuccess: boxConfigurationModel.isSuccess,
            isTermsChecked: ko.observable(false),
            boxConfiguration: boxConfigurationModel.boxConfiguration,
            sku: skuModel.sku
        },
        initialize() {
            this._super()
            console.log('hello world');

            this.canSubmit = ko.computed(() => {
                return skuModel.isSuccess()
                    && boxConfigurationModel.isSuccess()
                    && this.isTermsChecked();
            });
        },
        handleSubmit() {
            if (this.canSubmit()) {
                console.log('The Review Submit form has been submitted.');
                let response;
                storage.post(this.getUrl(), {
                    'sku': this.sku(),
                    'boxConfiguration': ko.toJSON(this.boxConfiguration)
                }).done(response => console.log('Response: ', response)).fail(error => console.log('Error: ', error))
            } else {
                console.log('The Review Submit form has an error.');
            }
        },
        getUrl() {
            return url.build("inventoryFulfillment/index/post")
        }
    })
});
