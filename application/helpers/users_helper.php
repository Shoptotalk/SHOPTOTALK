<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
	
	function isUser() {
		$ci=& get_instance();
		$session = $ci->session->user;
		/* print_r($session);
		die; */
		if( isset($session) AND !empty($session) ) return $session;
			else return false;
	}
	
}