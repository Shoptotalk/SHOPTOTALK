<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 hidden-xs"></div>
		<div class="col-md-4 col-xs-12">
			<h1>SHOPTOTALK <small>Login</small></h1>
			<div class="well center-block">
				<form action="/users/login" method="post" id="loginForm">
					<input name="email" type="hidden">
					<input name="password" type="hidden">
					<div class="form-group">
						<label for="email">Email address</label>
						<input name="email" type="email" class="form-control" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input name="password" type="password" class="form-control" id="password" placeholder="Password">
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember Me
						</label>
					</div>
					<input type="submit" class="btn btn-primary" value="Submit" data-loading-text="Login into your account..." />
				</form>
			</div>
		</div>
		<div class="col-md-4 hidden-xs"></div>
	</div>
</div>
