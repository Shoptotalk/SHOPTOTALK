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
		<div class="item"><a href="" class="noStyle">Show All Items</a></div>
		<div class="item"><a href="" class="noStyle">Only Friends Items</a></div>
		<div class="item"><a href="" class="noStyle">HOT Items</a></div>
	</div>
	
	<div class="left_side_box">
		<div class="title">Items Today</div>
		<div class="item">
			<a href="/?show=top10" class="noStyle">Top 10</a>
			<a href="/" class="noStyle fs10">x</a>
		</div>
		<div class="item">
			<a href="/?show=mostPopular" class="noStyle">Most Popular</a>
			<a href="/" class="noStyle fs10">x</a>
		</div>
	</div>
	
	<div class="left_side_box">
		<div class="title">Items Today</div>
		<div class="item"><a href="" class="noStyle">Closest Firends</a></div>
		<div class="item"><a href="" class="noStyle">Groups</a></div>
	</div>
</div>