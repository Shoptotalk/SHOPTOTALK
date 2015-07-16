<?php
	$postsToShow = $cookie->get('postsToShow');
?>
<div class="side_bar_holder left_bar">
	
	<div class="left_side_box">
		<div class="profilePic left mr10"><a href="/users/<?= $userInfo['_id'] ?>"><img src="<?= $userInfo['profilePic'] ?>" alt="<?= ucfirst($userInfo['fname']. ' '.$userInfo['lname']) ?>" /></a></div>
		<div class="left mt13">
			<div class="name"><a class="reg" href="/users/<?= $userInfo['_id'] ?>"><?= ucfirst($userInfo['fname'].' '.$userInfo['lname']) ?></a></div>
			<div class="post_time graytext fs12"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="left_side_box">
		<div class="title">Items to show</div>
		<div class="item<?= ($postsToShow == "showAll" || !$postsToShow ? ' active' : '') ?>"><a href="/process.php?act=postsToShow&v=showAll&t=<?= token() ?>" class="noStyle">Show All Items</a></div>
		<div class="item<?= ($postsToShow == "friendsOnly" ? ' active' : '') ?>"><a href="/process.php?act=postsToShow&v=friendsOnly&t=<?= token() ?>" class="noStyle">Only Friends Items</a></div>
		<div class="item<?= ($postsToShow == "hot" ? ' active' : '') ?>"><a href="/process.php?act=postsToShow&v=hot&t=<?= token() ?>" class="noStyle">HOT Items</a></div>
	</div>
	
	<div class="left_side_box">
		<div class="title">Items Today</div>
		<div class="item<?= ($_GET['show'] == "top10" ? ' active' : '') ?>">
			<a href="/?show=top10" class="noStyle">Top 10</a>
			<?php if($_GET['show'] == "top10"): ?><a href="/" class="noStyle fs10">x</a><?php endif; ?>
		</div>
		<div class="item<?= ($_GET['show'] == "mostPopular" ? ' active' : '') ?>">
			<a href="/?show=mostPopular" class="noStyle">Most Popular</a>
			<?php if($_GET['show'] == "mostPopular"): ?><a href="/" class="noStyle fs10">x</a><?php endif; ?>
		</div>
	</div>
	
	<div class="left_side_box">
		<div class="title">Items Today</div>
		<div class="item"><a href="" class="noStyle">Closest Firends</a></div>
		<div class="item"><a href="" class="noStyle">Groups</a></div>
	</div>
</div>