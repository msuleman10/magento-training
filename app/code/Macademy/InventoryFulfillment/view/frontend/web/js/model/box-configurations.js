define([
    'ko',
    'Macademy_InventoryFulfillment/js/ko/extenders/numeric'
], function (
    ko
) {
    const boxConfigurations = () => {
        const divisor = 139;
        const data = {
            length: ko.observable().extend({numeric: true}),
            width: ko.observable().extend({numeric: true}),
            height: ko.observable().extend({numeric: true}),
            weight: ko.observable().extend({numeric: true}),
            unitsPerBox: ko.observable().extend({numeric: true}),
            numberOfBoxes: ko.observable().extend({numeric: true}),
        };
        data.dimensionelWhight = ko.computed(() => {
            const result = data.height() * data.length() * data.width() / divisor;
            return Math.round(result * data.numberOfBoxes());
        });
        data.totalWhight = ko.computed(() => {
            return data.numberOfBoxes() * data.weight();
        });
        data.billingWhight = ko.computed(() => {
            return data.totalWhight() > data.dimensionelWhight() ? data.totalWhight() : data.dimensionelWhight();
        });
        return data;
    }
    return {
        boxConfiguration: ko.observableArray([boxConfigurations()]),
        isSuccess: ko.observable(false),
        add: function () {
            this.boxConfiguration.push(boxConfigurations());
        },
        delete: function (index) {
            this.boxConfiguration.splice(index, 1)
        }
    }
})
