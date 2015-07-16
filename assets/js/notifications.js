var notificationShowNumber = 5;
var notificationsNumber = 0;
var counter = $("#notification-counter");

function notification(text, color, onclick) {
    if(notificationsNumber >= notificationShowNumber) return;

    notificationsNumber++;
    var html, time = '5000', $container = $('#notifications');

    html = $('<div class="alert alert-' + color + '">' + text + '</div>').fadeIn('fast');
    $container.append(html);

    html.on('click', function() {
        if (onclick) eval(onclick);
        notificationClose($(this));
    });

    setTimeout(function() {
        notificationClose($container.children('.alert').first());
    }, time);
}

function notificationClose(element) {
    notificationsNumber--;

    if (typeof element !== "undefined") {
        element.fadeOut('fast', function() {
            $(this).remove();
        });
    } else {
        $('.alert').fadeOut('fast', function() {
            $(this).remove();
        });
    }
}

function addNewNotificationDB(data) {
    console.log(data);
    $.post('/notifications', {data : data}, function(response) {

    });
}

function notificationCounterUp() {
    var count = parseInt(counter.html()) + 1;
    counter.html(count);
    counter.removeClass("hide");
    counter.css("display", "block");
}

function resetCount() {
    counter = $("#notification-counter");
    counter.fadeOut(function(){
        counter.html(0);
        counter.addClass("hide");
    });

}

function getNotification(element)
{
    resetCount();
    if( !$(element).hasClass("open") ) {
        $(".notification-dropdown").html(loader);
        $.post('/notifications/getNotifications', {}, function(data){
            var json = JSON.parse(data);
            $(".notification-dropdown").html(json.data);
        });
    } else {
        $(".notification-dropdown").html('');
    }

}