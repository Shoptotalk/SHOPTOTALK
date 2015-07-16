function getPosts() {
    var loaderAppend = $(loader)
        .css("left", Math.max(0, (($("#PostsContainer").width() - $(loader).outerWidth()) / 2) + $(window).scrollLeft()) + "px")
        .css("position", "absolute")
        .appendTo("#PostsContainer");
    $.post("/posts/getPosts", {page : page, category : category, user_id : show_user_post}, function(data) {
        var json = JSON.parse(data);

        if(page) $("#PostsContainer").append(json.data);
        else $("#PostsContainer").hide().html(json.data).fadeIn('slow');

        $(".post").each(function(){
            var owl = $(this).find(".owl");
            owl.owlCarousel({
                singleItem: true
            });
        });

        $('[data-toggle="tooltip"]').tooltip(toolTipOptions);
        $(loaderAppend).remove();
    });
}

$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height()  >= $(document).height()) {
        page++;
        getPosts();
        return;
    }
});

$(function(){
    getPosts();
});

function deletePost(id) {
    bootbox.confirm("Are you sure?", function(result) {
        if(result){
            $.post("/posts/delete", {id : id}, function(data){
                if(data) DoDeletePost(id);
                else return false;
            });
        }
    });
}

function DoDeletePost(id) {
    $(".post[data-id=" + id +"]").fadeOut();
}

function fixImage(){
    $("#PostModalBody").find(".imageHolder img").css("max-height", (windowHeight - 200) + "px");
}

function showPost(id) {
    $.post("/posts/show", {id : id}, function(data) {
        var json = JSON.parse(data);
        var experienceHeight = $("#PostModalBody").find(".user_experience").height();

        $("#PostModalBody").css("min-height", (windowHeight - 200 ) + "px");

        $("#PostModalLabel").html(json.item_title);
        $("#PostModalBody").html(json.postData);
        fixImage();
    });
    $("#PostButton").trigger("click");

}