define(['uiComponent'], function (Component) {
    'use strict';
    return Component.extend({
        defaults: {
            imports: {
                countryId: 'checkoutProvider:shippingAddress.country_id'
            },
            tracks: {
                countryId: true
            }
        },
        showMessage: function () {
            return this.countryId === 'PK';
        }
    })
})
