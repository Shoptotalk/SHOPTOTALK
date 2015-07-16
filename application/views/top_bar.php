<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">SHOPTOTALK</a>
		</div>


		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Main</a></li>
				<li><a href="#">Friends</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
					<ul class="dropdown-menu">
                        <?php foreach($categories AS $category) { ?>
                            <li><a href="/<?= $category ?>"><?= $category ?></a></li>
                        <?php } ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Cant find?</a></li>
					</ul>
				</li>
			</ul>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" onclick="getNotification($(this))">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div id="notification-counter" class="counter<?= (!$count_notifications ? ' hide' : '') ?>"><?= $count_notifications ?></div><span class="glyphicon glyphicon-bell"></span> </a>
                    <div class="dropdown-menu notification-dropdown"></div>
                </li>
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/profile/edit">Edit</a></li>
						<li><a href="/profile/notifications">Notification settings</a></li>
						<li><a href="/profile/privacy">Privacy settings</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/Logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>