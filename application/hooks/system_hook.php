<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class System {
	
    public function systemSettings()
	{
		$ci=& get_instance();
		// die($ci->input->ip_address());
		
		$userInfo = $ci->session->userdata('user');
		
		// $ips[] = '212.179.221.137';
		$ips[] = '84.111.234.28';
		//if(!in_array($ci->input->ip_address(),$ips)) die();
    }
}
