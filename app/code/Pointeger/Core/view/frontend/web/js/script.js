require(["jquery"], function ($) {
    let header = $(".header");
    header.click(function () {
        if (header.hasClass("red")) {
            header.removeClass("red");
            header.addClass("blue");
        } else if (header.hasClass("blue")) {
            header.removeClass("blue");
            header.addClass("orange");
        } else if (header.hasClass("orange")) {
            header.removeClass("orange");
        } else {
            header.addClass("red");
        }
    })
});