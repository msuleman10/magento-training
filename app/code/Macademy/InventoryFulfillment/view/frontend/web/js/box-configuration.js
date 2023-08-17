define([
    'uiComponent',
    'ko'
], function (
    Component,
    ko
) {
    'use strict';
    const boxConfiguration = () => {
        return {
            firstName: ko.observable(),
            lastName: ko.observable(),
            userName: ko.observable(),
            email: ko.observable(),
            password: ko.observable(),
        };
    }
    return Component.extend({
        defaults: {
            boxConfiguration: ko.observableArray([boxConfiguration()])
        },
        initialize() {
            this._super();
            console.log("this is not good")
        },
        handleAdd() {
            this.boxConfiguration.push(boxConfiguration());
        },
        handleDelete(index) {
            this.boxConfiguration.splice(index, 1)
        },
        handleSubmit() {
            console.log("Submit new data");
        }
    });
});
