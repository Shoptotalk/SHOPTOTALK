var post_id, holder, commentsNum;
var commentsHeight = windowHeight - 200;

function getComments() {
    holder.html(loader);
    post_id = holder.data("id");
    $.post("/comments", {post_id : post_id }, function(data){
        var json = JSON.parse(data);
        $(".userExperienceAndComments").css("height", commentsHeight + "px");
        $(".userExperienceAndComments").css("overflow-y", "scroll");

        if(json.data) holder.html(json.data);
            else holder.html('<div class="AC p10">No comments yet.</div>');

        commentsNum = $("span[data-commentsNum="+post_id+"]");
        commentsNum.html(json.numOfComments);

        fixProfilePics();
    });
}

function deleteComment(id) {
    bootbox.confirm("This comment will be deleted forever...", function(result) {
        if(result) {
            $.post("/comments/delete", {id: id, post_id : post_id}, function (data) {
                var json = JSON.parse(data);

                commentsNum = $("span[data-commentsNum="+post_id+"]");
                commentsNum.html(json.numOfComments);
                $(".commentRow[data-id=" + id +"]").fadeOut();
            });
        }
    });
}

function sendComment(text) {
    $.post("/comments/add", { text : text, post_id : post_id}, function(data){
        var json = JSON.parse(data);
        holder = $(".commentsHolder");
        $(".newComment").val('');
        if(json.alertUser) sendSocket('newNotification', data);
        $.post("/comments", {post_id : post_id, limit : 1 }, function(data){
            var json = JSON.parse(data);
            //holder.css("max-height", commentsHeight + "px");
            //holder.css("overflow-y", "scroll");

            if(json.numOfComments == 1) holder.html(''); // For first comment - hide the no comments msg

            holder.append(json.data);
            fixProfilePics();
            scrollToBottom(holder);

            commentsNum = $("span[data-commentsNum="+post_id+"]");
            commentsNum.html(json.numOfComments);
        });
    });
}

function fixProfilePics() {
    holder.find(".commentRow").each(function(){
        profilePic = $(this).find(".profilePicHolder");
        profilePic.css("height", profilePic.parent().height() + "px");
    });
}

$(function(){
    holder = $(".commentsHolder");
    $(".newComment").on("keydown", function(event){
        if (event.which == 13 || event.keyCode == 13) {
            if($(this).val() != '') sendComment($(this).val());
            event.preventDefault();
        }
    });
});