<?php 
	chdir('../');
	require('system/global.php'); 
	if($_REQUEST['t'] != md5($_REQUEST['toid'].$userInfo['_id'].$global->encWord)) die(); 
	
	$toUser = getUser($_REQUEST['toid']);
?>

<form action="/process.php" method="post" id="pmForm">
	<input type="hidden" name="toid" value="<?= $_REQUEST['toid'] ?>" />
	<input type="hidden" name="act" value="sendPm" />
	<label>Send message to<br /><input type="text" name="sendTo" placeholder="Send To" class="input_style w100 fs16 p5" value="<?= $toUser['fname'] .' '.$toUser['lname'] ?>" /></label>
	<br />
	<label>Message<br /><textarea name="text" id="txt" placeholder="Message..." class="input_style w100 fs16 p5"></textarea></label>
	<input type="submit" value="Send Message" />
	<div id="errors"></div>
</form>

<script>
	$(function(){
		$("#pmForm").ajaxForm({success: sendPms});
	});
	
	function sendPms(responseText, statusText, xhr, $form)  { 
		socket.emit('pms_send', { toid : '<?= $_REQUEST['toid'] ?>' });
		var json = JSON.parse(responseText);
		if(json.operation_status == "success") {
			msg = "Message was sent successfully";
			setTimeout(function(){$.fancybox.close();},1000);
		} else msg = "Error! Please try again";
			
		$("#errors").html(msg);
	}
</script>