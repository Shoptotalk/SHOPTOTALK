<?php // include from top_bar.php

$pms_user = getUser($pms['from']);

?>

<div class="open_menu_link p10 lh10 pointer" onclick="location.href='/pms/<?= $pms['_id'] ?>'">
	<div class="profilePic left mr10"><img src="<?= $pms_user['profilePic'] ?>" alt="<?= $pms_user['fname']. ' '.$pms_user['lname'] ?>" /></div>
	<div class="graytext fs12"><?= getTime($pms['insert_date']) ?></div>
	<div class="mt2"><?= $pms['text'] ?></div>
	<div class="clear"></div>
</div>
<div class="sep"></div>