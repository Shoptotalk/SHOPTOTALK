/**
 * Created by yshaish1 on 05/07/2015.
 */

var leftSideWidth;

function initializeProfileShow() {
    leftSideWidth = $(".left-side").width();
    $(".profile_fixed").css("width", leftSideWidth + "px");
    $(".profile_fixed").fadeIn();
}

function friends(friend_id) {
	$.post("/friends/changeRelationWith", {friend_id : friend_id}, function(data){
		var json = JSON.parse(data);
		if(json.success == "successful") {
			if(json.friends) $("#friendsBtn").html("Unfriend with " + json.friendName);
				else $("#friendsBtn").html("Be friend with " + json.friendName);
		}
	});
}

$(window, document).on("resize", function(){
    initializeProfileShow();
});

$(function(){
    initializeProfileShow();
});
