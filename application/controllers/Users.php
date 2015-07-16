<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Shoptotalk {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if(!isUser()) redirect('/users/login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
	
	public function login() {
		if(isUser()) redirect('/');
		if( isset($_POST['email']) AND isset($_POST['password']) ){
			$exist = $this->db->get_where('users', array('email' => $this->encrypt->enc($_POST['email']), 'password' => $this->encrypt->enc($_POST['password'])))->row(0);
			if( isset($exist->_id) ) {
				$this->connectUser( (Array) $exist);
				die('true');
			} else {
				die('false');
			}
		}
		$data['noTopBar'] = TRUE;
		$data['page_js'][] = 'js/login.js';
		$data['page_js'][] = 'validate/jquery.validate.js';
		$data['page_js'][] = 'validate/jquery.form.min.js';
		$views = Array('login');
		$this->template->load($views,$data);
	}
	
	public function register() {
		// Ajax
		$data = Array();
		$data['fname'] = $_POST['fname'];
		$data['lname'] = $_POST['lname'];
		$data['email'] = $this->encrypt->enc($_POST['email']);
		$data['password'] = $this->encrypt->enc($_POST['password']);
		$data['gender'] = $_POST['gender'];
		$data['age'] = $_POST['age'];
		$data['regDate'] = date("Y-m-d H:i:s");
		$data['profilePic'] = '';
		$this->db->insert('users',$data);
		$userID = $this->db->insert_id();
		$data['_id'] = $userID;
		if($userID) {
			$this->connectUser($data);
			die('true');
		}
		
		die('false');
	}
	
	private function connectUser($userData) {
		$data['user'] = $userData;
		$this->session->set_userdata($data);
		return true;
	}
	
}