define(['jquery'],function ($) {
    return function (className , duration){
        $(className).hide().fadeIn(duration || 2000)
    }
})
