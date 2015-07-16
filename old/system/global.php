<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
################################## GLOBAL VARS ##################################
$global = new stdClass();
$global->errorAll = 1;
$global->errorAll = 0;
$global->userIP = $_SERVER['REMOTE_ADDR'];
$global->refe = $_SERVER['HTTP_REFERER'];
$global->basepage = trim($_SERVER['SCRIPT_NAME'],"/");
$global->controller = $_GET['page'];
$global->encrypWord = "chipopoSystem";
$global->encWord = "chipopoSystem";
$global->domain = 'shoptotalk.com';
$global->filesDir = '/files/';
$global->commentNum = 5; // Main item_box comments number // need to change in main.js -> updateMainCommentsSection
$global->savePastes = 0; // Save items after user paste
$page_js = Array(); // Javascript files array

// Cookies
$global->cookieTime = time()+10*365*24*60*6;
$global->userCookie = md5("ys_sys_user".$global->encrypWord);
// Cookies

################################## GLOBAL VARS ##################################

ini_set('display_errors', 1);
if($global->errorAll) error_reporting(E_ALL);
	else error_reporting(E_ERROR | E_WARNING | E_PARSE);
	

require_once('system/db.php');
require_once('assets/lang_detect/language_detected.php');
require_once('system/funcs.php');
require_once('system/cookie.php');

$cookie = new cookie();
$langDetect = new lang_detected();

if(isUser()) $userInfo = getUser(decode($_COOKIE[$global->userCookie]));
if(!$userInfo['profilePic']) $userInfo['profilePic'] = '/system/images/profile.jpg';

$allow_ips[] = "84.111.234.28"; // Mor's Home
$allow_ips[] = "31.168.66.132"; // Nagar's Home

if(!in_array($global->userIP,$allow_ips)) die('Chipopo!');
// prePrint($_SERVER,1);
