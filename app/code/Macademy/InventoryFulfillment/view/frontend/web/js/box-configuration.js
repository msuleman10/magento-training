define([
    'uiComponent',
    'ko'
], function (
    Component,
    ko
) {
    'use strict';

    return Component.extend({
        defaults: {
            boxConfiguration: ko.observableArray(['abcd', 1234, 'i18n'])
        },
        initialize() {
            this._super();
            console.log("this is not good")
        }
    });
});
