define([], function () {
    "use strict";
    return function (Component) {
        return Component.extend({
            defaults:{
                template: "Macademy_CheckoutMessages/summary/cart-items"
            },
            isItemsBlockExpanded: function () {
                // this._super();
                return true;
            }
        })
    }
})
