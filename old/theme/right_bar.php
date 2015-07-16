<div class="side_bar_holder">
	<div class="border side_bar_box mb10 highlight">
		<div class="title border_bottom pl10 pt3 pb3 fs16 dark_grey_text">Complete you profile</div>
		<div class="content pl10 pt3 pb3">Content</div>
	</div>

	<div class="border side_bar_box mb10">
		<div class="title border_bottom pl10 pt3 pb3 fs16 dark_grey_text">Categories</div>
		<div class="content pt3 pb3">
			<?php foreach($categories_db->find(Array("valid" => 1)) AS $cat) { ?>
				<div class="open_menu_link lh25<?= (niceUrl(strtolower($cat['title'])) == $_GET['var1'] ? ' active' : '') ?>"><a href="/main/<?= niceUrl(strtolower($cat['title'])) ?>"><?= $cat['title'] ?></a></div>
			<?php } ?>
		</div>
	</div>

	<div class="border side_bar_box mb10">
		<div class="title border_bottom pl10 pt3 pb3 fs16 dark_grey_text">Wish List</div>
		<div class="content pt3 pb3 wishlist_holder">
			<?php
			// Same wishlist get in: process.php?act=getWishlist
			$find = Array('$and' => Array(
				Array("valid" => 1),
				Array("uid" => decode($_COOKIE[$global->userCookie]))
			));
			foreach($wishlist_db->find($find) AS $wishlist) { 
				$post = $items_db->findOne(Array("_id" => new MongoId($wishlist['post_id'])));
				
				// User Details
				$user = $users_db->findOne(Array("_id" => new MongoId($post['uid'])));
				$userBuyit2 = $buyit2_db->count(Array('uid' => new MongoId($userInfo['_id']),'valid' => 1,'post_id' => new MongoId($post['_id'])));
				
				// Actions Details
				$buyit2_num = $buyit2_db->count(Array('valid' => 1,'post_id' => new MongoId($post['_id'])));
				$comments_num = $comments_db->count(Array('valid' => 1,'post_id' => new MongoId($post['_id'])));
				
				include('pages/wishlist_item.php');
				
			} 
			?>
		</div>
	</div>

	<div class="border side_bar_box mb10">
		<div class="title border_bottom pl10 pt3 pb3 fs16 dark_grey_text">Hot Friends Items</div>
		<div class="content pl10 pt3 pb3">Content</div>
	</div>

	<div class="border side_bar_box mb10">
		<div class="title border_bottom pl10 pt3 pb3 fs16 dark_grey_text">People may you know</div>
		<div class="content pl10 pt3 pb3">Content</div>
	</div>
</div>