define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data'
], function (
    Component,
    ko,
    customerData
) {
    'use strict';
    return Component.extend({
        defaults: {
            // subtotal: ko.observable(49.9999),
            subtotal: 49.9999,
            template: "Macademy_FreeShippingPromo/free-shipping-banner",
            tracks: {
                subtotal: true
            }
        },
        initialize: function () {
            this._super();
            let self = this;
            setTimeout(function () {
                // self.subtotal(60.3465);
                self.subtotal = self.subtotal + 5;
                console.log(self.message + " " + self.currencyFormat(self.subtotal));
            }, 4000);
        },
        currencyFormat: function (value) {
            // return '$' + value().toFixed(2);
            return '$' + value.toFixed(2);
        }
    })
});
