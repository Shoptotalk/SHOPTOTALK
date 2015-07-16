<?php //Include from process.php?act=getMoreItems ?>
<div class="item_box unseen border mt10 p20 relative" data-post="<?= $post['_id'] ?>">
	
	<div class="post_actions absolute">
		<img src="/images/arrow_down.png" alt="" />
		<div class="relative">
			<div class="post_actions_holder openMenu absolute border p5">
				<?php 
				// if this user write this post				
				if($post['uid'] == $userInfo['_id']) { ?>
					<div class="mb5"><a href="javascript:void(0);" onclick="openItem('<?= $post['_id'] ?>','<?= md5($post['_id'] . $global->encrypWord) ?>')">Edit Post</a></div>
					<div class="mb5"><a href="javascript:void(0);" onclick="deletePost('<?= $post['_id'] ?>')">Delete Post</a></div>
				<?php } else { ?>
					<a href="javascript:void(0);" onclick="addToWishlist('<?= $post['_id'] ?>')">To My Wishlist</a>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="right_in_box img right">
		
		<div class="gallery_box pointer" id="a<?= $post['_id'] ?>">
			<?php 
			if($post['img']) { ?>
				<div class="gallery_img" onclick="openItem('<?= $post['_id'] ?>',0)"><?php if($post['img']) { ?><img src="<?= $post['img'] ?>" /> <?php } ?></div>
			<?php 
				}
			if($post['uploaded_file_name']) { ?>
				<div class="gallery_img" onclick="openItem('<?= $post['_id'] ?>',0)"><img src="<?= $global->filesDir.$post['uploaded_file_name'] ?>" /></div>
			<?php 
			} ?>
		</div>
	</div>
	
	<div class="left_in_box left">
	
		<div class="user_details pb5 mb5 border_bottom">
			<div class="right AR grey_text">
				<span class="fs20"><?= $post['currency'] ?><?= $post['price'] ?></span><br />
				By: <b><?= $post['site'] ?></b>
			</div>
			
			<div class="profilePic left mr10"><a href="/pages/user_box.php?id=<?= $user['_id'] ?>" class="fancy"><img src="<?= $user['profilePic'] ?>" alt="<?= ucfirst($user['fname']. ' '.$user['lname']) ?>" /></a></div>
			<div class="left mt4">
				<div class="name"><a class="reg" href="/users/<?= $user['_id'] ?>"><?= ucfirst($user['fname'].' '.$user['lname']) ?></a></div>
				<div class="post_time graytext fs12"><?= getTime($post['insert_date']) ?></div>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="title <?= $side ?> fs16 mb10"><a href="/post/<?= $post['_id'] ?>" class="noStyle"><?= charLimit($post['title'],100) ?></a></div>
		<div class="desc <?= $side ?> fs14 pt10 pb10"><?= charLimit(nl2br($post['userDesc']),200) ?></div>
		<div class="clear"></div>
	
		<div class="actions mt5 mb5 border_bottom border_top">
			<form action="/process.php" method="post" class="action_form">
				<input type="hidden" name="act" value="item_actions" />
				<input type="hidden" name="action" value="" />
				<input type="hidden" name="actions_params" value='{"post_by":"<?= $user['_id'] ?>","post_id":"<?= $post['_id'] ?>"}' />
				
			
				<div class="action left mr10 pointer" onclick="sendAction(this,'buyit2',$(this).find('.buyit2-num'));">
					<i class="buyit2-sprite left<?= ($userBuyit2 ? ' active' : '') ?>"></i>
					<div class="left buyit2_num ml3 mt4 buyit2-num" data-post="<?= $post['_id'] ?>"><?= number_format($buyit2_num) ?></div>
					<div class="clear"></div>
				</div>
				<div class="action left border_right pr10 mr10 pointer" onclick="openItem('<?= $post['_id'] ?>',0)">
					<i class="sprite1 sprite-comments left mt4"></i>
					<div class="left ml3 mt4 comments_num" rel="<?= $post['_id'] ?>"><?= number_format($comments_num) ?></div>
					<div class="clear"></div>
				</div>
				
				<div class="action left border_right pr10 mr10 lh21">
					<a href="javascript:void(0);" onclick="openItem('<?= $post['_id'] ?>',0)">Write a comment</a>
				</div>
			
				<div class="action left mr10 lh21">
					<a href="/url.php?act=<?= md5("redirect_to_item") ?>&id=<?= $post['_id'] ?>" target="_blank">Go to item sale page</a>
				</div>
				
				<div class="clear"></div>
				
			</form>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="comments_<?= $post['_id'] ?> main_posts_comments">
		<?php 
		// Foreach Like process.php?act=load_comments
		if($comments_num > $global->commentNum) $loadMore = 1;
			else $loadMore = 0;
			
		$i = 0;
		foreach($post_comments AS $comment) {
			$comment_user = $users_db->findOne(Array("_id" => new MongoId($comment['uid'])));
			if(!$comment_user['profilePic']) $comment_user['profilePic'] = '/system/images/profile.jpg';
			
			$side = $langDetect->getLtrRtl($comment['text']);
			
			// change on process.php?act=loadComments - here and there
			$charLimit = 150;
			
			include('pages/comment_box.php');
			$i++;
		}
		
		if(!$i) print '<div class="AC mt20">No Comments</div>';
		?>
	</div>
	<?php if($loadMore) : ?><div class="load_more">Show all...</div><?php endif; ?>
	
	<script>
		$(function(){
			$("#a<?= $post['_id'] ?>").owlCarousel({ lazyLoad : true, singleItem:true }); 
		});
	</script>
</div>