define([
    'uiComponent',
    'ko',
    'mage/storage'
], function (
    Component,
    ko,
    storage
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: "Macademy_InventoryFulfillment/sku-lookup",
            sku: ko.observable("24-MB01"),
            placeholder: "Example: 24-MB01",
            massageResponse: ko.observable('')
        },
        initialize() {
            this._super();
            console.log("some thing is different")
        },
        submitHandler() {
            storage.get(`rest/V1/products/${this.sku()}`)
                .done(response => {
                    this.massageResponse(`Product found! <strong>${response.name}</strong>`);
                }).fail(() => {
                this.massageResponse("Product is not found!")
            })
        }
    });
});
