/*
    cd /var/www/shoptotalk.com/node
 */
var socket = io.connect('http://shoptotalk.com:3017');

function sendSocket(action, data) {
    var json = JSON.parse(data);
    json.socketID = socket.id;

    socket.emit(action, json);
}

socket.on('haveNewNotification', function(data) {
    if(data.alertUser == stt_userID) {
        var msg = data.userMakeAction + data.msg;
        var color = 'blue';
        var onclick = 'showPost(' + data.post_id + ')';
        notification(msg, color, onclick);

        notificationCounterUp();
        addNewNotificationDB(data);

    }
});