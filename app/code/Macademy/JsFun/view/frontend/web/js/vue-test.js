define(['vue','jquery','Macademy_JsFun/js/jquery-log'], function (Vue,$) {
    $.log("Tasting output to the console ")
    return function (config, element) {
        return new Vue({
            el: '#' + element.id,
            data: {
                message: config.massage
            }
        });
    }

});
3

