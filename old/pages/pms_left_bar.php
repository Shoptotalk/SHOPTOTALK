<?php // include from pms.php

$find = Array('$and' => Array(
	Array("to" => new MongoId($userInfo['_id'])),
	Array("valid" => 1)
));
$pmss = $pms_db->find($find);
$pmss->sort(Array('insert_date' => -1));
foreach($pmss AS $pms){ 
	// include('pages/pms_menu_box.php');
} 