let config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/summary/cart-items': {
                'Macademy_CheckoutMessages/js/view/summary/cart-items': true
            }
        }
    },
    map: {
        '*': {
            'Magento_Checkout/template/sidebar': 'Macademy_CheckoutMessages/template/sidebar'
        }
    }
};
