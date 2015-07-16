<?php 
	chdir('../');
	require('system/global.php');
	$id = $_GET['id']; 
	
	$find = Array('$and' => Array(
		Array("valid" => 1),
		Array("_id" => new MongoId($id)),
	));
	$item = $items_db->findOne($find);
	$side = $langDetect->getLtrRtl($item['title']);
	$userDescSide = $langDetect->getLtrRtl($item['userDesc']);
	
	// User Details
	$user = $users_db->findOne(Array("_id" => new MongoId($item['uid'])));
	if(!$user['profilePic']) $user['profilePic'] = '/system/images/profile.jpg';
	
	// Actions Details
	$buyit2_num = $buyit2_db->count(Array('valid' => 1,'post_id' => new MongoId($item['_id'])));
	$comments_num = $comments_db->count(Array('valid' => 1,'post_id' => new MongoId($item['_id'])));
	
	$userBuyit2 = $buyit2_db->count(Array('uid' => new MongoId($userInfo['_id']),'valid' => 1,'post_id' => new MongoId($item['_id'])));
	
	if($_REQUEST['t'] AND $_REQUEST['t'] == md5($item['_id'].$global->encrypWord)) $canEdit = True; else $canEdit = False;
	if($canEdit) {
		include('pages/add_item.php');
		die;
	}
?>

<div class="item_show_holder">
	<div class="left left_side_item_show">
		
		<div class="item_title fs18 mb5 <?= $side ?>"><?= charLimit($item['title'],100) ?></div>
		<div class="fs25 mb10 strong <?= $side ?>"><?= $item['currency'] ?><?= $item['price'] ?></div>
		<div class="fs14 mb10"><a href="/url.php?act=<?= md5("redirect_to_item") ?>&id=<?= $item['_id'] ?>" target="_blank">Go to item sale page</a></div>
		<div class="item_img gallery_box" id="b<?= $id ?>">
			<?php if($item['img']) { ?><img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" /><?php } ?>
			<?php if($item['uploaded_file_name']) { ?><img src="<?= $global->filesDir.$item['uploaded_file_name'] ?>" /><?php } ?>
		</div>
		<div class="mt20">By: <b><?= $item['site'] ?></b></div>
		
	</div>

	<div class="left right_side_item_show">
		
		<div class="scroller">
			<div class="border p10">
				<div class="left">
					<div class="profilePic left mr10"><img src="<?= $user['profilePic'] ?>" alt="<?= $user['fname']. ' '.$user['lname'] ?>" /></div>
					<div class="left mt4">
						<div class="name"><a class="reg" href="/users/<?= $user['_id'] ?>"><?= $user['fname'].' '.$user['lname'] ?></a></div>
						<div class="post_time graytext fs12"><?= getTime($item['insert_date']) ?></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="right mt8">
					<form action="/process.php" method="post" class="action_form">
						<input type="hidden" name="act" value="item_actions" />
						<input type="hidden" name="action" value="" />
						<input type="hidden" name="actions_params" value='{"post_by":"<?= $item['uid'] ?>","post_id":"<?= $item['_id'] ?>"}' />
						<div class="action left mr10 pointer" onclick="sendAction(this,'buyit2',$(this).find('.buyit2-num'));">
							<i class="buyit2-sprite left<?= ($userBuyit2 ? ' active' : '') ?>"></i>
							<div class="left buyit2_num ml3 mt4 buyit2-num" data-post="<?= $item['_id'] ?>"><?= number_format($buyit2_num) ?></div>
							<div class="clear"></div>
						</div>
						
						<div class="action left pr10">
							<i class="sprite1 sprite-comments left mt4"></i>
							<div class="left ml3 mt4 comments_num" rel="<?= $item['_id'] ?>"><?= number_format($comments_num) ?></div>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<div class="clear"></div>
				<div class="userDesc mt5 <?= $userDescSide ?>"><?= nl2br($item['userDesc']) ?></div>
			</div>
			
			<div class="border mt5 noBg comments_holder comments_<?= $item['_id'] ?>_openItem"></div>
		
		</div>
		
		<div class="border noBg p10 item_popup_add_comment">
			<form action="/process.php" method="post" id="commentForm">
				<input type="hidden" name="act" value="addComment" />
				<input type="hidden" name="actions_params" value='{"post_id":"<?= $item['_id'] ?>","key":"<?= md5($item['_id'].$global->encrypWord) ?>"}' />
				<div class="profilePic left mr10"><img src="<?= $userInfo['profilePic'] ?>" alt="<?= $userInfo['fname']. ' '.$userInfo['lname'] ?>" /></div>
				<div class="input_holder left mt5 relative">
					<textarea class="input_style w100 pr40" placeholder="Write a comment..." id="addComment" name="text"></textarea>
					<i class="sprite1 sprite-camera pointer absolute" tooltip="off" data-tooltip="Attach your own photo"></i>
				</div>
				<div class="clear"></div>
			</form>
		</div>
		
	</div>
	
</div>

<script>
$(function(){
	$("#commentForm").ajaxForm({success: addComment});
	$("#b<?= $id ?>").owlCarousel({ lazyLoad : true, singleItem:true }); 
	$("#addComment").autosize();
	$("#addComment").on("keypress", function(e){
		if(e.keyCode == 13){
			$("#commentForm").submit();
			e.preventDefault();
		}
	});
	loadComments('<?= $item['_id'] ?>');
	setTimeout(function(){
		$("#addComment").focus();
	},300);
	ajaxForms();
});

function addComment(responseText, statusText, xhr, $form)  { 
	loadComments('<?= $item['_id'] ?>');
	updateCommentNum('<?= $item['_id'] ?>');
	updateMainCommentsSection('<?= $item['_id'] ?>');
	$("#addComment").val('');
}
</script>