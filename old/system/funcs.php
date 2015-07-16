<?php

function token(){
	global $global,$userInfo;
	$t = md5($global->encrypWord.$userInfo['_id'].$global->encrypWord);
	return $t;
}

function isMyfriend($uid) {
	global $global,$relationship_db,$userInfo;

	$check = $relationship_db->count(Array(
		"valid" => 1,
		"uid" => new MongoId($userInfo['_id']),
		"friendWith" => new MongoId($uid),
	));
	
	if($check) return true;
		else return false;
}

function recentsNum(){
	return 0;
}

function pmsNum(){
	global $pms_db, $userInfo;
	$pmsNum = $pms_db->count(Array('to' => new MongoId($userInfo['_id']),'read' => false));
	return $pmsNum;
}

function getUser($id){
	global $users_db;
	$userInfo = $users_db->findOne(Array("_id" => new MongoId($id)));
	return $userInfo;
}

function currencies(){
	global $global,$currencies_db;
	$find = Array("valid" => 1);
	return $currencies_db->find($find);
}

function orgFile($url) {
	$urlEXP = explode(".",$url);
	$ext = end($urlEXP);
	$orgFile = $urlEXP[0].'_original.'.$ext;
	
	return $orgFile;
}

function profilePic($user_id){
	global $users_db;
	$find = Array("_id" => new MongoId($user_id));
	$user = $users_db->findOne($find);
	if(!$user['profilePic']) $user['profilePic'] = '/system/images/profile.jpg';
	
	return $user['profilePic'];
}

function niceUrl($txt,$revers=0){
	global $golbal;
	
	$find = Array(' ');
	$replace = Array('_');
	
	if($revers) return str_replace($replace,$find,$txt);
		else return str_replace($find,$replace,$txt);
}

function getTime($time,$mongo="1"){
	// $time = strtotime($time);
	$delta = time() - $time->sec;
	if ($delta < 30) {
		return 'Right now';
	} else if ($delta < 60) {
		return 'Less than a minute ago';
	} else if ($delta < 120) {
		return 'About a minute ago';
	} else if ($delta < (45 * 60)) {
		return floor($delta / 60) . ' minutes ago';
	} else if ($delta < (90 * 60)) {
		return 'About an hour ago';
	} else if ($delta < (24 * 60 * 60)) {
		return floor($delta / 3600) . ' hours ago';
	} else if ($delta < (48 * 60 * 60)) {
		return 'One day before';
	} else {
		return floor($delta / 86400) . ' days before';
	}
}

function charLimit($string,$length=100,$append="&hellip;") {
  $string = trim($string);

  if(strlen($string) > $length) {
    $string = wordwrap($string, $length);
    $string = explode("\n", $string, 2);
    $string = $string[0] . $append;
  }

  return $string;
}

function dbGet($id,$cursor) {
	global $global,${$cursor};
	$find = Array('$and' => Array(
		Array('_id' => new MongoId($id)),
		Array('valid' => 1)
	));
	
	$return = ${$cursor}->findOne($find);
	return $return;
}

function dbAdd($data,$cursor) {
	global $global,${$cursor};
	// Update
	if(array_key_exists('_id',$data)) {
		$id = $data['_id'];
		unset($data['_id']);
		foreach($data AS $key => $val){
			$updateData[$key] = $val;
		}
		
		${$cursor}->update(
			Array("_id" => new MongoId($id)),
			Array('$set' => $updateData)
		);
	} else {
		// Insert
		$data['_id'] = new MongoId();
		$data['insert_date'] = new MongoDate();
		$lastID = ${$cursor}->insert($data);
	}
	return $data['_id'];
}

function showMsg() {
	global $_SESSION;
	if($_SESSION[md5('ys_sys_message')]) {
		$msg = decrypt($_SESSION[md5('ys_sys_message')]);
		$html 	= 'humane.timeout = 5000;'."\n";
		$html  .= 'humane.log("'.$msg.'")'."\n";
		unset($_SESSION[md5('ys_sys_message')]);
		return $html;
	} else return false;
}

function msg($message) {
	global $_SESSION;
	$_SESSION[md5('ys_sys_message')] = encrypt($message);
}

function isUser() {
	global $_COOKIE, $global;
	if($_COOKIE[$global->userCookie] AND isUserExist(Array("_id" => decode($_COOKIE[$global->userCookie])))) return true;
		else return false;
}

function logoutUser() {
	global $global;
	setcookie($global->userCookie, $_COOKIE[$global->userCookie], time() - 3600, '/', $global->domain);
	return true;
}

function connectUser($arr) {
	global $global,$users_db;
	if(!$arr['_id']){
		$user = $users_db->findOne(Array('$and' => Array(Array("email" => $arr['email']), Array("password" => $arr['password']))));
		$arr['_id'] = $user['_id'];
	}
	
	if( isset($arr['_id']) ) {
		setcookie($global->userCookie, encode($arr['_id']), $global->cookieTime, '/', $global->domain);
		return true;
	}
	
	return false;
}

function isUserExist($arr) {
	global $users_db;
	if(isset($arr['_id'])) $find = Array("_id" => new MongoId($arr['_id']));
	elseif(isset($arr['email']) AND isset($arr['password'])) $find = Array('$and' => Array(Array("email" => $arr['email']), Array("password" => $arr['password'])));
	else $find = Array("email" => $arr['email']);
	$exist = $users_db->findOne($find);
	
	if(empty($exist)) return false;
		else return true;
}

function prePrint($print,$die = 0) {
	print '<pre style="background:#000; color:#fff; z-index:999999999999999999; position:relative; padding:10px; float:left; border:2px solid #aeaeae;">';
	print_r($print);
	print '</pre><div style="clear:both;"></div>';
	if($die) die();
}

function redirect($url = 0) {
	if(!$url) $url = "index.php";
	header("Location: ".$url,303);
	die();
}

function encode($pure_string) {
	global $global;
	return trim(base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $global->encrypWord ), $pure_string, MCRYPT_MODE_CBC, md5( md5( $global->encrypWord ))))); 
}

function decode($encrypted_string) {
	global $global;
    return rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5($global->encrypWord), base64_decode( $encrypted_string ), MCRYPT_MODE_CBC, md5( md5( $global->encrypWord))), "\0"); 
}

?>