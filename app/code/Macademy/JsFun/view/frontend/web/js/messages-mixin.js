define([], function () {
    'use strict';

    return function (originalMessages) {
        return originalMessages.extend({
            defaults: {
                hideTimeout: 2000,
                hideSpeed: 100
            }
        });
    }
});
