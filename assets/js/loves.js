function giveLove(post_id) {
    $.post("/loves", {post_id : post_id}, function(data){
        var json = JSON.parse(data);
        if( !json.success ) return;

        if(json.alertUser) sendSocket('newNotification', data);

        $("span[data-lovesNum="+post_id+"]").html(json.numOfLoves);
    });
}

function giveLoveComment(comment_id) {
    $.post("/loves", {comment_id : comment_id}, function(data){
        var json = JSON.parse(data);
        if( !json.success ) return;

        if(json.alertUser) sendSocket('newNotification', data);

        $("span[data-lovesCommentNum="+comment_id+"]").html(json.numOfLoves);
    });
}
