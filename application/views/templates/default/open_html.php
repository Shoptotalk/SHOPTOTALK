<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>

<title>ShoptoTalk</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-flaty.css">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/style_more.css">

<?php if( isset($page_css) ) { ?>
<?php foreach($page_css AS $css_file) { ?>
    <link rel="stylesheet" href="<?= (strstr($css_file, 'http') ? '' : '/assets/').$css_file ?>">
<?php } } ?>

<meta name="theme-color" content="#2C3E50">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>

<body>