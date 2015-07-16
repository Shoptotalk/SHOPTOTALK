<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
	
	protected $ci;
	
	public function __construct() {
		$this->ci =& get_instance();
	}
	
	public function load($views,$data=Array()) {
		
		$this->ci->load->view('templates/default/open_html',$data);
		
		if( !isset($data['noTopBar'])) $this->ci->load->view('top_bar',$data);
		
		foreach($views AS $view) $this->ci->load->view($view,$data);
		
		$this->ci->load->view('js/variables',$data);
		$this->ci->load->view('templates/default/close_html',$data);

	}
	
}