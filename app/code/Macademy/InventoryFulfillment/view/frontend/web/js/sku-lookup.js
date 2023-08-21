define([
    'uiComponent',
    'ko',
    'mage/storage',
    'jquery',
    'Macademy_InventoryFulfillment/js/model/sku'
], function (
    Component,
    ko,
    storage,
    $,
    skuModel
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: "Macademy_InventoryFulfillment/sku-lookup",
            sku: skuModel.sku,
            placeholder: "Example: 24-MB01",
            massageResponse: ko.observable(''),
            isSuccess: skuModel.isSuccess
        },
        initialize() {
            this._super();
            console.log("some thing is different")
        },
        submitHandler() {
            $("body").trigger("processStart");
            this.massageResponse("");
            this.isSuccess(false);
            storage.get(`rest/V1/products/${this.sku()}`)
                .done(response => {
                    this.massageResponse(`Product found! <strong>${response.name}</strong>`);
                    this.isSuccess(true)
                }).fail(() => {
                this.massageResponse("Product is not found!")
                this.isSuccess(false);
            }).always(() => {
                $("body").trigger("processStop");
            })
        }
    });
});
