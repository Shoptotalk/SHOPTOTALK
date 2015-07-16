var windowHeight, windowWidth, documentHeight, documentWidth;
var loader, url;
var page = 0;
var toolTipOptions;

function initialize() {
    windowHeight = $(window).height();
    windowWidth = $(window).width();
    documentHeight = $(document).height();
    documentWidth = $(document).width();
    loader = '<div class="AC p10"><img src="/images/loader.gif" alt="" /></div>';
    toolTipOptions = {container: 'body', 'selector': '', 'placement': 'top'};
}

function loadMoreImages() {
    $.post("posts/getMoreImagesFromPaste", {url : url}, function(data){
        var json = JSON.parse(data);
        if(!json.success) return;

        var owl = $(".owlNewPost");

        owl.html('');
        for(i=0; i < json.moreImages.length; i++) {
            owl.append('<img src="' + json.moreImages[i] + '" alt="" class="img-responsive" />');
            $("#newPostForm").append('<input type="hidden" name="itemMoreImages[]" value="' + json.moreImages[i] + '" />');
        }

        $(".loadMoreImagesLink").remove();
        owl.owlCarousel({
            singleItem: true
        });
    });
}

function AddPostPopup(json, input){
	$.post("/posts/add", {data : JSON.stringify(json)}, function(data) {
		$("#AddPostModalLabel").html('New item from: <strong>' + json.site_name + '</strong>');
		$("#AddPostModalBody").html(data);
	});
	$("#AddPostButton").trigger("click");
	input.removeAttr("disabled");
}

$(window).resize(function(){
    initialize();
});

$(function() {

    initialize();

	$("#item_url").on('paste', function() {
		var input = $(this);
		setTimeout(function() {
			url = input.val();
			input.attr("disabled","disabled");
			$.post("/url/paste", { url : url }, function(data){
				var json = JSON.parse(data);
				AddPostPopup(json, input);
				input.val('');
			});
		},100);
	});
});

function scrollToBottom(element) {
    element.animate({
        scrollTop: element[0].scrollHeight
    }, 500);
}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop())+ "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}