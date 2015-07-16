<?php
require_once('system/global.php');

header('Content-Type: application/json');
//ini_set('memory_limit','16M');

$error					= false;

$absolutedir			= dirname(__FILE__);
$dir					= '/files/';
$serverdir				= $absolutedir.$dir;

$tmp					= explode(',',$_POST['data']);
$imgdata 				= base64_decode($tmp[1]);

$extension				= strtolower(end(explode('.',$_POST['name'])));

$filename				= substr(sha1(time()),0,8).'_'.$_COOKIE[$global->userCookie].'.'.$extension;

$handle					= fopen($serverdir.$filename,'w');
fwrite($handle, $imgdata);
fclose($handle);

$response = array(
		"status" 		=> "success",
		"url" 			=> $dir.$filename.'?'.time(), //added the time to force update when editting multiple times
		"filename" 		=> $filename
);

$tmp				= explode(',',$_POST['original']);
$originaldata		= base64_decode($tmp[1]);
$original			= substr(sha1(time()),0,8).'_'.$_COOKIE[$global->userCookie].'_original.'.$extension;

$handle				= fopen($serverdir.$original,'w');
fwrite($handle, $originaldata);
fclose($handle);

$response['original']	= $original;


print json_encode($response);
