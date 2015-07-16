<?php //include from /theme/right_bar.php ?>
<div class="right_bar_post wishlist_box border_bottom pl10 mb10 pt5 pb5 relative" rel="<?= $wishlist['_id'] ?>">
	<div class="left img_side mr10">
		<div class="img"><a href="/post/<?= $post['_id'] ?>"><img src="<?= ($post['img'] ? $post['img'] : $global->filesDir.$post['uploaded_file_name']) ?>" alt="<?= $post['title'] ?>" title="<?= $post['title'] ?>" /></a></div>
	</div>
	<div class="left text_side mt10">
		<div class="title"><a href="/post/<?= $post['_id'] ?>" class="noStyle"><?= charLimit($post['title'],35) ?></a></div>
		<div class="by">by <a href="/users/<?= $user['_id'] ?>"><?= $user['fname'] .' '. $user['lname'] ?></a></div>
	</div>
	<div class="left buy_side mt15">
		<form action="/process.php" method="post" class="action_form">
			<input type="hidden" name="act" value="item_actions" />
			<input type="hidden" name="action" value="" />
			<input type="hidden" name="actions_params" value='{"post_by":"<?= $post['uid'] ?>","post_id":"<?= $post['_id'] ?>"}' />
			<div class="action left mr10 pointer AC" onclick="sendAction(this,'buyit2',$(this).find('.buyit2-num'));">
				<i class="buyit2-sprite<?= ($userBuyit2 ? ' active' : '') ?>"></i>
				<div class="buyit2_num ml3 mt4 buyit2-num" data-post="<?= $post['_id'] ?>"><?= number_format($buyit2_num) ?></div>
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<div class="remove_from_wishlist fs10" onclick="removeFromWishlist('<?= $wishlist['_id'] ?>')">x</div>
	<div class="clear"></div>
</div>