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
            boxConfiguration: ko.observableArray([
                {
                    firstName: "Mark",
                    lastName: "Shost"
                },
                {
                    firstName: "jhon",
                    lastName: "Sina"
                }
            ])
        },
        initialize() {
            this._super();
            console.log("this is not good")
        }
    });
});
