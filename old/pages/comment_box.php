<? // process.php?act=loadComments ?>

<div class="p10 pt15 border_bottom relative comment_holder_all" rel="<?= $comment['_id'] ?>">
	<?php 
	if($comment_user['_id'] == $userInfo['_id']) { ?>
		<div class="comment_actions absolute">
			<img src="/images/arrow_down.png" alt="" />
			<div class="relative">
				<div class="comment_actions_holder openMenu absolute border p5">
					<a href="javascript:void(0);" onclick="deleteComment('<?= $comment['_id'] ?>')">Delete comment</a>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="profilePic left mr10"><a href="/pages/user_box.php?id=<?= $comment_user['_id'] ?>" class="fancy"><img src="<?= $comment_user['profilePic'] ?>" alt="<?= ucfirst($comment_user['fname']. ' '.$comment_user['lname']) ?>" /></a></div>
	<div class="left mt4 comment_text_holder">
		<div class="name left mr5">
				<a class="reg" href="/users/<?= $comment_user['_id'] ?>"><?= $comment_user['fname'].' '.$comment_user['lname'] ?></a> 
				<span class="<?= $side ?>"><?= ($charLimit ? charLimit($comment['text'],$charLimit) : $comment['text']) ?></span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="post_time graytext fs12 mt10"><?= getTime($comment['insert_date']) ?></div>
	</div>
	<div class="clear"></div>
</div>