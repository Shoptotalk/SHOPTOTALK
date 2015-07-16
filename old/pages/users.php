<?php
	if(!isUser()) redirect('/login');
    $page_js[] = 'https://cdn.socket.io/socket.io-1.3.4.js';
    $page_js[] = 'validate/jquery.form.min.js';
    $page_js[] = 'js/main.js';
    $page_js[] = 'uploadImage/html5imageupload.js';
    $page_js[] = 'owl/owl.carousel.min.js';
    $page_js[] = 'autosize/jquery.autosize.js';
	
	$user_id = $_GET['var1'];
	
	$user = $users_db->findOne(Array("_id" => new MongoId($user_id)));
	if(!$user['profilePic']) $user['profilePic'] = '/system/images/profile.jpg';
		else $orgFile = orgFile($user['profilePic']);
	
?>

<div class="content mt20">
	<div class="container">
		<div class="left_side left posts_container user_profile">
			<div class="top_profile_zone w100 border p20 highlight">
				<div class="left mr10">
					<?php if($userInfo['_id'] == $user_id) { ?>
						<form action="/process.php" method="post" id="uploadProfilePic">
							<input type="hidden" name="act" value="uploadProfilePic" />
							<div class="dropzone no_text round" data-width="130" data-ghost="false" data-height="130" data-save-original="true" data-originalsize="false" data-url="/upload.php" style="width:130px;">
								<input type="hidden" name="uploaded_file_name" class="uploaded_file_name" />
								<input type="hidden" name="uploaded_original_name" class="uploaded_original_name" />
								<input type="file" name="buyer_pic" />
							</div>
						</form>
					<?php } else { ?>
						<div class="bigProfilePic left mr10"><img src="<?= $user['profilePic'] ?>" alt="<?= ucfirst($user['fname']. ' '.$user['lname']) ?>" /></div>
					<?php } ?>
				</div>
				<div class="left white_text">
					<div class="fs30"><?= $user['fname']. ' '.$user['lname'] ?></div>
					<div class="fs16">Buyer Since: <?= date("F d, Y", $user['reg_date']->sec) ?></div>
				</div>
				<div class="clear"></div>
				<div class="right mt_minus_16">
					<?php if($userInfo['_id'] == $user_id) { ?>
						<div><a href="" class="white_text">Edit Your Profile</a></div>
					<?php } else { ?>
						<div><a href="javascript:void(0);" onclick="pmsg('<?= $user['_id'] ?>','<?= md5($user['_id'].$userInfo['_id'].$global->encWord) ?>')" class="white_text">Send <?= $user['fname'] ?> a private message</a></div>
						<div id="f_<?= $user['_id'] ?>_l">
							<?php if(isMyfriend($user['_id'])){ ?>
								<a href="javasctipt:void(0);" onclick="unFirend('<?= $user['_id'] ?>','<?= md5($user['_id'].$userInfo['_id'].$global->encWord) ?>')" class="white_text">Unfriend</a>
							<?php } else { ?>
								<a href="javasctipt:void(0);" onclick="addFirend('<?= $user['_id'] ?>','<?= md5($user['_id'].$userInfo['_id'].$global->encWord) ?>')" class="white_text">Add Friend</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="right_side left posts_side_bar">
			<?php include('theme/right_bar.php') ?>
		</div>
		
		<div class="clear"></div>
		
	</div>
</div>

<script>
	var user_id = '<?= $user_id ?>';
	$(function(){
		$('.dropzone').html5imageupload({
			onAfterProcessImage: function(data) {
				$("#uploadProfilePic").submit();
			}
		});
		
		$("#uploadProfilePic").ajaxForm({
			success: changePic
		});
	});
	
	function changePic(responseText, statusText, xhr, $form) {
		
	}
	
	function pmsg(to_user_id,t){
		var hiddenLink = $('<a href="/pages/private_msg.php?toid=' + to_user_id + (t ? '&t=' + t : '') +'" class="fancy" style="display:none; font-size:0px;">private msg</a>').appendTo("body");
		$(hiddenLink).trigger("click");
		setTimeout(function(){ $(hiddenLink).remove(); },300);	
	}
	
	function addFirend(friendWith,t){
		$.post("/process.php", {act : "addFriend", friendWith : friendWith, t : t}, function(data){
			var json = JSON.parse(data);
			if(json.status == "success") {
				$("#f_<?= $user['_id'] ?>_l").html('<a href="javasctipt:void(0);" onclick="unFirend(\'<?= $user['_id'] ?>\',\'<?= md5($user['_id'].$userInfo['_id'].$global->encWord) ?>\')" class="white_text">Unfriend</a>');
			}
		});
	}
	
	function unFirend(friendWith,t){
		$.post("/process.php", {act : "unFriend", friendWith : friendWith, t : t}, function(data){
			var json = JSON.parse(data);
			if(json.status == "success") {
				$("#f_<?= $user['_id'] ?>_l").html('<a href="javasctipt:void(0);" onclick="addFirend(\'<?= $user['_id'] ?>\',\'<?= md5($user['_id'].$userInfo['_id'].$global->encWord) ?>\')" class="white_text">Add Friend</a>');
			}
		});
	}
</script>