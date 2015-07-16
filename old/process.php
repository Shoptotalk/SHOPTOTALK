<?php
require_once('system/global.php');

if(!$_REQUEST['act']) redirect('/main');

switch($_REQUEST['act']) {
	
	case "postsToShow":
		global $global;
		if($_REQUEST['t'] != token()) redirect('\main');
		$cookie->set('postsToShow',$_REQUEST['v']);
		redirect($global->refe);
		break;
	
	case "unFriend":
		if($_REQUEST['t'] == md5($_REQUEST['friendWith'].$userInfo['_id'].$global->encWord)){
			// Users table
			$relationship_db->update(
				Array("uid" => new MongoId($userInfo['_id']), "friendWith" => new MongoId($_REQUEST['friendWith'])),
				Array('$set' => Array('valid' => 0))
			);
			$data['status'] = "success";
		} else {
			$data['status'] = "failed";
		}
		print json_encode($data);
		die();
		break;
		
	case "addFriend":
		if($_REQUEST['t'] == md5($_REQUEST['friendWith'].$userInfo['_id'].$global->encWord)){
			$find = array('$and' => Array(
				Array("uid" =>  new MongoId($userInfo['_id'])),
				Array("friendWith" => new MongoId($_REQUEST['friendWith']))
			));
			$exist = $relationship_db->findOne($find);
			if($exist['_id']) $data['_id'] = $exist['_id'];
			$data['uid'] = new MongoId($userInfo['_id']);
			$data['friendWith'] = new MongoId($_REQUEST['friendWith']);
			$data['follow'] = true;
			$data['valid'] = 1;
			$lastID = dbAdd($data,"relationship_db");
			$data['status'] = "success";
		} else {
			$data['status'] = "failed";
		}
		print json_encode($data);
		die();
		break;
	
	case "get_pms_topMenu":
		$find = Array('$and' => Array(
			Array("to" => new MongoId($userInfo['_id'])),
			Array("valid" => 1)
		));
		$pmss = $pms_db->find($find);
		$pmss->sort(Array('insert_date' => -1));
		foreach($pmss AS $pms){ 
			include('pages/pms_menu_box.php');
		} 
		break;
	
	case "sendPm":
		if($_REQUEST['reply']) $reply = new MongoId($_REQUEST['reply']); else $reply = 0;
		$data['to'] = new MongoId($_REQUEST['toid']);
		$data['from'] = new MongoId($userInfo['_id']);
		$data['text'] = $_REQUEST['text'];
		$data['read'] = false;
		$data['valid'] = 1;
		$data['reply'] = $reply;
		$lastID = dbAdd($data,"pms_db");
		
		if($lastID){
			$response['operation_status'] = 'success';
			$response['id'] = $lastID;
		} else {
			$response['operation_status'] = 'success';
		}
		print(json_encode($response));
		die;
		break;
	
	case "getWishlist":
		// Same wishlist get in: /theme/right_bar.php
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
		break;
	
	case "updateCommentNum":
		$comments_num = $comments_db->count(Array('valid' => 1,'post_id' => new MongoId($_REQUEST['id'])));
		print($comments_num);
		break;
	
	case "uploadProfilePic":

		// Profiles Pics table
		$data['file'] = $global->filesDir.$_REQUEST['uploaded_file_name'];
		$data['uid'] = decode($_COOKIE[$global->userCookie]);
		$data['valid'] = 1;
		try {
			dbAdd($data,"profilePics_db");
		} catch (MongoCursorException $e) {
			$err = $e->getCode();
			die($err.'');
		}
		
		// Users table
		$users_db->update(
			Array("_id" => new MongoId(decode($_COOKIE[$global->userCookie]))),
			Array('$set' => Array('profilePic' => $global->filesDir.$_REQUEST['uploaded_file_name']))
		);
		break;
	
	// main.js
	case "addToWishlist":
		$data['uid'] = decode($_COOKIE[$global->userCookie]);
		$data['post_id'] = $_REQUEST['id'];
		$data['valid'] = 1;
		dbAdd($data,"wishlist_db");
		die('item added');
		break;
	
	// main.js
	case "deletePost":
		$post = $items_db->findOne(Array("_id" => new MongoId($_REQUEST['id'])));
		if($post['uid'] != decode($_COOKIE[$global->userCookie])) die('Error');
		$items_db->update(
			Array("_id" => new MongoId($_REQUEST['id'])),
			Array('$set' => Array('valid' => 0))
		);
		die('post deleted');
		break;
	
	case "deleteComment":
		$comment = $comments_db->findOne(Array("_id" => new MongoId($_REQUEST['id'])));
		if($comment['uid'] != decode($_COOKIE[$global->userCookie])) die('Error');
		$comments_db->update(
			Array("_id" => new MongoId($_REQUEST['id'])),
			Array('$set' => Array('valid' => 0))
		);
		die('comment deleted');
		break;
		
	case "removeFromWishlist":
		$wishlist = $wishlist_db->findOne(Array("_id" => new MongoId($_REQUEST['id'])));
		if($wishlist['uid'] != decode($_COOKIE[$global->userCookie])) die('Error');
		$wishlist_db->update(
			Array("_id" => new MongoId($_REQUEST['id'])),
			Array('$set' => Array('valid' => 0))
		);
		die('wishlist removed');
		break;
	
	case "loadComments":
		$find = Array('$and' => Array(
			Array("valid" => 1),
			Array("post_id" => new MongoId($_REQUEST['post_id'])),
		));
		
		if($_REQUEST['limit']) $comments = $comments_db->find($find)->limit($_REQUEST['limit']);
			else $comments = $comments_db->find($find);
		$comments->sort(Array('insert_date' => -1));
		
		$i = 0;
		foreach($comments AS $comment) {
			$comment_user = $users_db->findOne(Array("_id" => new MongoId($comment['uid'])));
			if(!$comment_user['profilePic']) $comment_user['profilePic'] = '/system/images/profile.jpg';
			
			$side = $langDetect->getLtrRtl($comment['text']);
			
			// if comment on open_item - update the main page with new comments
			if($_REQUEST['limit']) $charLimit = 150;
			
			include('pages/comment_box.php');
			$i++;
		}
		
		if(!$i) print '<div class="AC mt20">No Comments</div>';
		break;
	
	case "addComment":
		$params = json_decode($_REQUEST['actions_params']);
		$data['valid'] = 1;
		$data['uid'] = new MongoId(decode($_COOKIE[$global->userCookie]));
		$data['post_id'] = new MongoId($params->post_id);
		$data['text'] = $_REQUEST['text'];
		$lastID = dbAdd($data,"comments_db");
		print_r($lastID);
		die();
		break;

	case "getMoreItems":
			
			$find['$and'][] = Array("valid" => 1);
			if($_REQUEST['q']){
				$GETqSearch = $_REQUEST['q'];
				preg_match_all("/[a-z0-9A-Z]/",$GETqSearch,$EXPqSearch);
				$qSearch = implode('\s*',$EXPqSearch[0]);
				// prePrint($qSearch,1);
				$find['$and'][0]['$or'][] = Array("title" => new MongoRegex("//*$qSearch/i"));
				$find['$and'][0]['$or'][] = Array("site" => new MongoRegex("//*$qSearch/i"));
			}
			
			if($_REQUEST['user_id']) $find['$and'][] = Array("uid" => new MongoId($_REQUEST['user_id']));
			if($_REQUEST['category']) $find['$and'][] = Array("category" => $_REQUEST['category']);
			
			$postsToShow = $cookie->get('postsToShow');
			if($postsToShow AND $postsToShow != "showAll" AND !$_REQUEST['user_id']){
				$find['$and'][0]['$or'][] = Array("uid" => new MongoId($userInfo['_id']));
				switch($postsToShow) {
					case "friendsOnly":
						$friends = $relationship_db->find(Array('$and' => Array(
							Array('valid' => 1),
							Array('uid' => new MongoId($userInfo['_id'])),
						)));
						
						foreach($friends AS $friend) $find['$and'][0]['$or'][] = Array("uid" => new MongoId($friend['friendWith']));
						
						break;
						
					case "hot":
						
						break;
				}
			}
			
			$items_posts = $items_db->find($find)->limit($_REQUEST['limit'])->skip($_REQUEST['skip']);
			$items_posts->sort(Array('insert_date' => -1));
			// prePrint($find,1);
			foreach($items_posts AS $post){
				
				// Post RTL \ LTR
				$side = $langDetect->getLtrRtl($post['title']);
				
				// User Details
				$user = $users_db->findOne(Array("_id" => new MongoId($post['uid'])));
				if(!$user['profilePic']) $user['profilePic'] = '/system/images/profile.jpg';
				$userBuyit2 = $buyit2_db->count(Array('uid' => new MongoId($userInfo['_id']),'valid' => 1,'post_id' => new MongoId($post['_id'])));
				
				// Actions Details
				$buyit2_num = $buyit2_db->count(Array('valid' => 1,'post_id' => new MongoId($post['_id'])));
				$comments_num = $comments_db->count(Array('valid' => 1,'post_id' => new MongoId($post['_id'])));
				
				// Comments
				$find = Array('$and' => Array(
					Array('valid' => 1),
					Array('post_id' => new MongoId($post['_id']))
				));
				$post_comments = $comments_db->find($find)->limit($global->commentNum);
				$post_comments->sort(Array('insert_date' => -1));
				
				include('pages/item_box.php');
			}
			
		break;
	
	case "item_actions":
		$params = json_decode($_REQUEST['actions_params']);
		
		switch($_REQUEST['action']) {
			case "buyit2":
				$check = $buyit2_db->findOne(Array(
					'$and' => Array(
						Array("uid" => new MongoId(decode($_COOKIE[$global->userCookie]))),
						Array("post_id" => new MongoId($params->post_id)),
						Array("valid" => 1)
					)
				));
				
				if(!empty($check)) {
					$approve = 0;
					$buyit2_db->update(
						Array("_id" => new MongoId($check['_id'])),
						Array('$set' => Array('valid' => 0))
					);
				} else {
					$approve = 1;
					$data['valid'] = 1;
					$data['post_id'] = new MongoId($params->post_id);
					$data['post_by'] = new MongoId($params->post_by);
					$data['uid'] = new MongoId(decode($_COOKIE[$global->userCookie]));
					
					$lastID = dbAdd($data,'buyit2_db');
				}
				
				$response['count'] = $buyit2_db->count(Array('valid' => 1,'post_id' => new MongoId($params->post_id)));
				$response['approve'] = $approve;
				$response['action'] = $_REQUEST['action'];
				$response['lastID'] = $lastID;
				$response['userToAlert'] = $params->post_by;
				print(json_encode($response));
				die;
				break;
		}
		
		redirect('/main');
		break;
	
	case "add_item":
		// prePrint($_REQUEST,1);
		$data['title'] = $_REQUEST['title'];
		$data['site'] = $_REQUEST['site'];
		$data['siteDesc'] = $_REQUEST['siteDesc'];
		$data['userDesc'] = $_REQUEST['userDesc'];
		$data['url'] = $_REQUEST['url'];
		$data['img'] = $_REQUEST['img'];
		$data['category'] = $_REQUEST['category'];
		$data['currency'] = $_REQUEST['currency'];
		$data['price'] = $_REQUEST['price'];
		$data['uploaded_file_name'] = $_REQUEST['uploaded_file_name'];
		$data['uploaded_original_name'] = $_REQUEST['uploaded_original_name'];
		$data['valid'] = 1;
		$data['uid'] = new MongoId(decode($_COOKIE[$global->userCookie]));
		if($_REQUEST['itemID']){
			// $item_id = explode('_',decrypt($_REQUEST['itemID']));
			$data['_id'] = $_REQUEST['itemID'];
		}
		dbAdd($data,'items_db');
		redirect('/main');
		break;
	
	case "login":
		$data['email'] = $_REQUEST['email'];
		$data['password'] = $_REQUEST['password'];
		
		if(connectUser($data)) die("true");
			else die("false");
		
		break;
	
	case "logout":
		logoutUser();
		redirect('/main');
		break;
	
	case "register":
		$data['_id'] = new MongoId();
		$data['fname'] = ucfirst(strtolower(trim($_REQUEST['fname'])));
		$data['lname'] = ucfirst(strtolower(trim($_REQUEST['lname'])));
		$data['email'] = trim($_REQUEST['email']);
		$data['password'] = $_REQUEST['password'];
		$data['gender'] = $_REQUEST['gender'];
		$data['age'] = $_REQUEST['age'];
		$data['valid'] = 1;
		$data['reg_date'] = new MongoDate();
		try {
			$users_db->insert($data);
		} catch (MongoCursorException $e) {
			$err = $e->getCode();
			die($err.'');
		}
		
		if(connectUser($data)) die("true");
			else die("false");
		break;
		
}