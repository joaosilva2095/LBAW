/*global $ */

var green = '#DFF0D8';
var red = '#A94442';

/**
 * Animate a element with a color
 * @param highlightColor color to highlight
 * @param duration duration of the animation
 */
$.fn.highlightAnimation = function (highlightColor, duration) {
    "use strict";

    this.css("background-color", ""); // Reset color of the row

    var highlightBg = highlightColor || "#DFF0D8",
        animateMs = duration || 1500,
        originalBg = this.css("background-color");
    this.stop().css("background-color", highlightBg)
        .animate({
            backgroundColor: originalBg
        }, animateMs);
};

/**
 * Enable the tooltips
 */
function enableTooltips() {
    "use strict";

    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
    });
}

/**
 * Configure the elements
 */
function config() {
    enableTooltips();

    $('.date-picker').datepicker();
}

$(document).ready(config);
