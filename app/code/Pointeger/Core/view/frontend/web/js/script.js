require(["jquery"], function ($) {
    let header = $(".header");
    header.click(function () {
        if (header.hasClass("red")) {
            header.removeClass("red").addClass("blue");
        } else if (header.hasClass("blue")) {
            header.removeClass("blue").addClass("orange");
        } else if (header.hasClass("orange")) {
            header.removeClass("orange");
        } else {
            header.addClass("red");
        }
    })
});