<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends MY_Shoptotalk {

    public function __construct() {
        parent::__construct();
    }
    
    public function changeRelationWith() {
    	
    	$friend_id = $this->input->post("friend_id");
    	
    	$this->db->where("user_id", $this->userInfo->_id);
    	$this->db->where("friend_id", $friend_id);
    	
    	$chkExist = $this->db->get("friends")->row();
    	
    	if($chkExist) {
    		$data['_id'] = $chkExist->_id;
    		if($chkExist->valid) $data['valid'] = 0; 
    			else $data['valid'] = 1;
    	} else {
    		$data['valid'] = 1;
    		$data['user_id'] = $this->userInfo->_id;
    		$data['friend_id'] = $friend_id;
    	}
    	
    	$return['friends'] = $data['valid'];
    	
    	$this->dbAdd("friends", $data);
    	
    	$friend = $this->getUser($friend_id);
    	$return['friendName'] = $friend->fname.' '.$friend->lname;
    	
    	$return['success'] = "successful";
    	$return['user_to_alert'] = $friend_id;
    	
    	die(json_encode($return));
    }
}