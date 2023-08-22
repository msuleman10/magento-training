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
        data.dimensionelWeight = ko.computed(() => {
            const result = data.height() * data.length() * data.width() / divisor;
            return Math.round(result * data.numberOfBoxes());
        });
        data.totalWeight = ko.computed(() => {
            return data.numberOfBoxes() * data.weight();
        });
        data.billableWeight = ko.computed(() => {
            return data.totalWeight() > data.dimensionelWeight() ? data.totalWeight() : data.dimensionelWeight();
        });
        data.shipmentWeight = ko.computed(() => {
            return data.length() + data.width() + data.height();
        });
        return data;
    }
    return {
        boxConfiguration: ko.observableArray([boxConfigurations()]),
        isSuccess: ko.observable(false),
        numberOfBoxes: function () {
            return ko.computed(() => {
                return this.boxConfiguration().reduce((runningTotal, boxConfiguration) => {
                    return runningTotal + (boxConfiguration.numberOfBoxes() || 0);
                }, 0);
            });
        },
        shipmentWeight: function () {
            return ko.computed(() => {
                return this.boxConfiguration().reduce(function (runningTotal, boxConfiguration) {
                    return runningTotal + (boxConfiguration.weight() || 0);
                }, 0);
            })
        },
        billableWeight: function () {
            return ko.computed(() => {
                return this.boxConfiguration().reduce(function (runningTotal, boxConfiguration) {
                    return runningTotal + (boxConfiguration.billableWeight() || 0);
                }, 0);
            })
        },
        add: function () {
            this.boxConfiguration.push(boxConfigurations());
        },
        delete: function (index) {
            this.boxConfiguration.splice(index, 1)
        }
    }
})


