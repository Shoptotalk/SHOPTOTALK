$(function(){
	$("form.valid").submit(function(){
		if($(this).valid()) {
			$(this).find("input[type='submit']").after('<img src="images/loader.gif" alt="" id="loader" />');
			$(this).find("input[type='submit']").attr("disabled","disabled");
		}
	});
	
	$(".fancy").fancybox({
		closeBtn : true,
		type: 'ajax',
		helpers : {
			overlay : {
				closeClick : true,
				css : { 'background' : 'rgba(0,0,0,0.5)' }
			}
		},
		keys : {
			close  : null
		}
	});
	
	fix_side_bar();
	ajaxForms();
	
	 $('.item_box').bind('DOMSubtreeModified',function(e){
		$(".action_form").ajaxForm({
            success: makeAction
        });
		$(".post_actions").on("click", function(){
			$(this).find(".post_actions_holder").toggle();
		});
		$(".comment_actions").on("click", function(){
			$(this).find(".comment_actions_holder").toggle();
		});
	})
	
});

$(window).scroll(function(){
	fix_side_bar();
});

function enabledInput(e){
	$(e).next().removeAttr("readonly");
	$(e).next().removeClass("disabled");
}

$(document).mouseup(function (e) {
	var container = $(".openMenu");
	if (!container.is(e.target) && container.has(e.target).length === 0) {
		container.hide();
		container.parent().removeClass("active");
	}
});

function fix_side_bar() {
	var windowHeight = $(window).height();
	var rightSideBar = $(".right_side").height();
	var scroll = $(window).scrollTop();
	if(windowHeight >= rightSideBar && scroll >= 28) { 
		$(".side_bar_holder").css("position","fixed");
		$(".side_bar_holder").css("top","70px");
	} else {
		$(".side_bar_holder").css("position","");
		$(".side_bar_holder").css("top","");
	}
}

// posts

function ajaxForms() {
	$(".action_form").ajaxForm({success: makeAction});
}

function addToWishlist(post_id) {
	$.post("/process.php", { act: "addToWishlist", id : post_id }, function(data){
		$(".item_box[data-post="+ post_id +"]").find(".wishlist").show();
		updateWishlist();
	});
}

function deletePost(post_id) {
	$.post("/process.php", { act: "deletePost", id : post_id }, function(data){
		$(".item_box[data-post="+ post_id +"]").remove();
	});
}

var updateAct;
function sendAction(e,action,updateElement){
	$(e).parent().find("input[name=action]").val(action);
	$(e).parent().submit();
	updateAct = updateElement;
}

function makeAction(responseText, statusText, xhr, $form)  { 
	var post_id = $(updateAct).data("post");
	var json = JSON.parse(responseText);
	if(json.approve) $(updateAct).prev().addClass("active");
		else $(updateAct).prev().removeClass("active");
	$(updateAct).html(json.count);
	
	socket.emit('action_made', { action : json.action, userToAlert : json.userToAlert });
	
	// Update all items with same id
	var more2update = $(".buyit2_num[data-post='"+ post_id +"']");
	$(more2update).html(json.count);
	if(json.approve) $(more2update).prev().addClass("active");
		else $(more2update).prev().removeClass("active");
}

function loadComments(post_id){
	$.post("/process.php", {act : "loadComments", post_id : post_id}, function(data){
		$(".comments_" + post_id + "_openItem").html(data);
		updateCommentNum(''+ post_id +'');
		$(".comment_actions").on("click", function(){
			$(this).find(".comment_actions_holder").toggle();
		});
	});
}

function deleteComment(comment_id) {
	var post_id = $(".comment_holder_all[rel="+comment_id+"]").parent().parent().data("post");
	$.post("/process.php", { act: "deleteComment", id : comment_id }, function(data){
		$(".comment_holder_all[rel="+comment_id+"]").remove();
		updateCommentNum(post_id);
	});
}

function updateMainCommentsSection(post_id){
	$.post("/process.php", {act : "loadComments", post_id : post_id, limit : 5}, function(data){
		$(".comments_" + post_id).html(data);
	});
}

function updateCommentNum(post_id){
	$.post("/process.php", { act: "updateCommentNum", id : post_id }, function(data){
		$(".comments_num[rel="+post_id+"]").html(data);
	});
}

function updateWishlist(){
	$.post("/process.php", { act: "getWishlist" }, function(data){
		$(".wishlist_holder").html(data);
		ajaxForms();
	});
}

function removeFromWishlist(wishlist_id){
	$.post("/process.php", { act: "removeFromWishlist", id : wishlist_id }, function(data){
		$(".wishlist_box[rel="+wishlist_id+"]").remove();
	});
}

// posts