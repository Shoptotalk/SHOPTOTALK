var added = false;
var scrollTop = 800;
var loadTheItems = true;
var waiting_html, pasteElement;

if(typeof category === 'undefined') var category = 0;
if(typeof user_id === 'undefined') var user_id = 0;

/* var socket = io.connect("http://80.85.84.201:3000");
socket.on('newUser', function(data){}); */
$(function(){	
	$("#item_url").on('paste', function(){
		pasteElement = this;
		if(added) return false;
		added++;
		var category = $(pasteElement).data("category");
		setTimeout(function () {
			$(pasteElement).attr("disabled","disabled");
			var text = $(pasteElement).val();
			$.post("/url.php",{act:"get_url",url:text,category:category},function(data){
				var json = JSON.parse(data);
				waiting_html = $('<div class="AC border_top p10">The system loading the data from <b>' + json.site + '</b><br />It will take a while... <img src="/images/loader.gif" alt="Loading" /></div>').appendTo(".new_item_holder");
				fill_add_item_div(data);
			});
		}, 100);
	});
	
	if(loadTheItems) loadItems(user_id);
	
	$(".gallerybox").owlCarousel();
	
});

// t = Token for Edit
function openItem(itemID,t){
	var hiddenLink = $('<a href="/pages/open_item.php?id=' + itemID + (t ? '&t=' + t : '') +'" class="fancy" style="display:none; font-size:0px;">new item</a>').appendTo("body");
	$(hiddenLink).trigger("click");
	setTimeout(function(){ $(hiddenLink).remove(); },300);
}

function fill_add_item_div(item_data) {
	var json = JSON.parse(item_data);
	var hiddenLink;
	if(json) {
		$.ajax({
			method: "POST",
			url: "/url.php",
			dataType: 'json',
			data: { act: "get_item_details", url: json.url, category : json.category }
		}).done(function( response ) {
			var moreImages = '';
			if(response.moreImages.length){
				for(i=0;i<response.moreImages.length;i++){
					moreImages = moreImages + '&moreImages[]=' + encodeURIComponent(response.moreImages[i]);
				}
			}
			hiddenLink = $('<a href="/pages/add_item.php?' +
				'itemTitle=' + encodeURIComponent(response.title) +
				'&itemPrice=' + encodeURIComponent(response.price) +
				'&itemSite=' + encodeURIComponent(response.site_name) +
				'&itemImage='+ encodeURIComponent(response.image) +
				'&itemDesc='+ encodeURIComponent(response.description) +
				'&itemCategory='+ encodeURIComponent(response.category) +
				'&itemUrl='+ encodeURIComponent(response.url) + moreImages +'" class="fancy" style="display:none; font-size:0px;">new item</a>').appendTo("body");
				
			$(hiddenLink).trigger("click");
			setTimeout(function(){
				$(waiting_html).remove(); 
				$(hiddenLink).remove(); 
				$(pasteElement).val("");
				$(pasteElement).removeAttr("disabled");
				added = false;
			},300);	
		});
	} else {
		hiddenLink = $('<a href="/pages/add_item.php" class="fancy" style="display:none; font-size:0px;">new item</a>').appendTo("body");
		$(hiddenLink).trigger("click");
		setTimeout(function(){ $(hiddenLink).remove(); },300);	
	}
}

$(window).scroll(function(){
	if($(window).scrollTop() > scrollTop){
		loadItems(user_id);
		scrollTop += scrollTop;
	}
});

var limit = 10;
var skip = 0;
function loadItems(user_id) {
	$(".posts_container").append('<div class="bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>');
	$.post("/process.php", {act : "getMoreItems", limit : limit, skip : skip, category : category, user_id : user_id, q : q}, function(data){
		// Javascript Function && Actions on post box item box
		$(".posts_container").append(data);
		$(".bubblingG").remove();
        $(".action_form").ajaxForm({
            success: makeAction
        });
		$(".post_actions").on("click", function(){
			$(this).find(".post_actions_holder").toggle();
		});
		$(".comment_actions").on("click", function(){
			$(this).find(".comment_actions_holder").toggle();
		});
		// Javascript Function && Actions on post box item box
	});
	skip = skip + limit;
}