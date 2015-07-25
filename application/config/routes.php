<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Login'] = 'users/login';
$route['Logout'] = 'users/logout';

require_once( BASEPATH .'database/DB.php' );
$db =& DB();
$query = $db->get( 'categories' );
$result = $query->result();
foreach($result AS $row) {
    $route['(?i)' . str_replace(" ", "", $row->title)] = 'main/index/' . $row->_id;
}

//$route['(?i)fashion'] = 'main/index/1';
//$route['(?i)computers'] = 'main/index/2';