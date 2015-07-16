<?php

class cookie {
	
	public $domain = 'shoptotalk.com';
	public $cookieExp;
	public $encrypWord = "chipopoSystem";
	
	function __construct() {
		$this->cookieExp = 10*365*24*60*6;
	}
	
	public function set($cookieName,$cookieValue) {
		setcookie(md5($cookieName), encode($cookieValue), time()+$this->cookieExp, '/', $this->domain);
	}
	
	public function get($cookieName) {
		if ($_COOKIE[md5($cookieName)]) return decode($_COOKIE[md5($cookieName)]);
			else return false;
	}
	
	public function remove($cookieName) {
		setcookie(md5($cookieName), encode($cookieValue), time()+$this->cookieExp - 100 * 10, '/', $this->domain);
	}
	
}