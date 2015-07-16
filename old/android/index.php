<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$m = new MongoClient();
$db = $m->shaish;

$tasks = $db->tasks;

function mongoNextId($collection){
	global $m,$db,$_REQUEST;
	$currentid = $collection->find(array("imei" => (String) $_REQUEST['imei']));
	$nextid = ($currentid->count()) + 1;
	return $nextid++;
}

switch($_REQUEST['act']){
	
	case "drop":
		$tasks->drop();
		break;
	
	case "deleteTask":
		// $tasks->remove(array("imei" => $_REQUEST['imei'], "id" => (int) $_REQUEST['id']));
		$tasks->update(array("imei" => $_REQUEST['imei'], "id" => (int) $_REQUEST['id']), array('$set' => array("valid" => '0')));
		header('Content-Type: application/json');
		$response['response'] = Array(
				"status" 	=> 'successful',
				"time" 		=> date("d-m-Y H:i:s"),
			);
		print @json_encode($response);
		break;
	
	case "addTask":
		$id = mongoNextId($tasks);
		$arr['id'] = $id;
		$arr['date'] = date("d-m-Y");
		$arr['time'] = date("H:i:s");
		$arr['imei'] = $_REQUEST['imei'];
		$arr['title'] = $_REQUEST['title'];
		$arr['text'] = $_REQUEST['text'];
		$arr['valid'] = '1';
		$arr['done'] = $_REQUEST['done'];
		$tasks->insert($arr);
		break;
	
	case "updateDone":
		$tasks->update(array("imei" => $_REQUEST['imei'], "id" => (int) $_REQUEST['id']), array('$set' => array("done" => $_REQUEST['done'])));
		header('Content-Type: application/json');
		$response['response'] = Array(
				"status" 	=> 'successful',
				"time" 		=> date("d-m-Y H:i:s"),
			);
		print @json_encode($response);
		break;
	
	case "getToDoList":
		$get = $tasks->find(array("imei" => $_REQUEST['imei'], "valid" => '1'));
		foreach($get AS $val){
			$tasksList['tasks'][] = Array(
				"id" 	=> $val['id'],
				"date" 	=> $val['date'],
				"time" 	=> $val['time'],
				"imei" 	=> $val['imei'],
				"title" => $val['title'],
				"text" 	=> $val['text'],
				"done" 	=> $val['done'],
			);
		}
		header('Content-Type: application/json');
		print @json_encode($tasksList);
		break;
		
	/* case "newUser":
		$arr['imei'] = $_REQUEST['imei'];
		$users->insert($arr);
		break;
		
	case "checkUser":
		$chk = $users->findOne(array("imei" => $_REQUEST['imei']));
		if(!empty($chk)) print "true";
			else print "false";
		break; */
		
	default:
		$get = $users->find();
		foreach($get AS $val) echo $val['imei'].'<br />';
		// $get = $tasks->find();
		// foreach($get AS $val) echo $val['title'].'<br />';
		break;
	}

// My imei = 354153063676760
	