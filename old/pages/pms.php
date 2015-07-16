<?php
	if(!isUser()) redirect('/login');
    $page_js[] = 'https://cdn.socket.io/socket.io-1.3.4.js';
    $page_js[] = 'validate/jquery.form.min.js';
    $page_js[] = 'uploadImage/html5imageupload.js';
    $page_js[] = 'owl/owl.carousel.min.js';
    $page_js[] = 'autosize/jquery.autosize.js';
	
	$pms_id = $_GET['var1'];
	
	$pms = dbGet($pms_id,"pms_db");
	if($pms['reply']) $main_pms = $pms['reply'];
		else $main_pms = $pms['_id'];
	
	// prePrint($main_pms);
	// $find = Array('$and' => Array(
			// Array('valid' => 1),
			// Array('_id' => $main_pms),
			// Array('$or' => 
				// Array('reply' => $main_pms),
			// )
		// )
	// );
	
	$find = Array('$and' =>
		Array('valid' => 1),
		Array('_id' => new MongoId($main_pms)),
	);
	$pmss = $pms_db->find($find);
	$pmss->sort(Array('insert_date' => -1));
	
?>


<div class="content mt20">
	<div class="container">
		
		<div class="left_side left posts_left_side_bar">
			<?php include('pages/pms_left_bar.php') ?>
		</div>
		
		<div class="left_side right posts_container pms_page" data-pms="<?= $onePms['_id'] ?>">
			<div class="border p10">
			<?php
			foreach($pmss AS $onePms){ 
				$from = $users_db->findOne(Array('_id' => new MongoId($onePms['from'])));
			?>
				<div class="mb10">From: <a href="/users/<?= $from['_id'] ?>"><?= $from['fname'].' '.$from['lname'] ?></a> Sent <?= getTime($onePms['insert_date']) ?></div>
				<div class="border mt3 p5"><?= nl2br($onePms['text']) ?></div>
			<?php
			}
			?>
			</div>
			
			<div class="reply mt10">
				<form action="/process.php" method="post" id="pmForm">
					<input type="hidden" name="toid" value="<?= $from['_id'] ?>" />
					<input type="hidden" name="reply" value="<?= $main_pms ?>" />
					<input type="hidden" name="act" value="sendPm" />
					<textarea class="input_style w100" placeholder="Reply..." id="reply" name="text"></textarea>
					<input type="submit" class="btn" value="Send" />
					<div id="errors"></div>
				</form>
			</div>
		</div>
		
		<div class="right_side left posts_side_bar">
			<?php include('theme/right_bar.php') ?>
		</div>
		
		<div class="clear"></div>
		
	</div>
</div>

<script>
	$(function(){
		$("#pmForm").ajaxForm({success: sendPms});
		$("#reply").autosize();
	});
	
	function sendPms(responseText, statusText, xhr, $form)  { 
		socket.emit('pms_send', { toid : '<?= $from['_id'] ?>' });
		var json = JSON.parse(responseText);
		if(json.operation_status == "success") msg = "Message was sent successfully";
			else msg = "Error! Please try again";
			
		$("#errors").html(msg);
	}
</script>