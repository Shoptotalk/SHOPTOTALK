<?php 
	chdir('../');
	require('system/global.php');
	$id = $_GET['id']; 
	$user = $users_db->findOne(Array("_id" => new MongoId($id)));
?>

<div class="p10">
	<div class="border mb10 p10">
		<div class="fs25"><?= ucfirst($user['fname']. ' '.$user['lname']) ?></div>
		<div class="fs14">Buyer Since: <?= date("F d, Y", $user['reg_date']->sec) ?></div>
		<div class="fs14 mt20"><a href="/users/<?= $user['_id'] ?>">Go to <?= ucfirst($user['fname']. ' '.$user['lname']) ?> profile page</a></div>
	</div>
	
	<div class="border mb10 p10"><img src="<?= orgfile($user['profilePic']) ?>" alt="<?= ucfirst($user['fname']. ' '.$user['lname']) ?>" style="width:350px; max-height:250px;" /></div>
</div>