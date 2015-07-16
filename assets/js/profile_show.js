/**
 * Created by yshaish1 on 05/07/2015.
 */

var leftSideWidth;

function initializeProfileShow() {
    leftSideWidth = $(".left-side").width();
    $(".profile_fixed").css("width", leftSideWidth + "px");
    $(".profile_fixed").fadeIn();
}

$(window, document).on("resize", function(){
    initializeProfileShow();
});

$(function(){
    initializeProfileShow();
});
