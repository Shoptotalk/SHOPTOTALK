<?php
	if(isUser()) redirect('/main');
	$page_js[] = 'js/login.js';
	$page_js[] = 'validate/jquery.validate.js';
	$page_js[] = 'validate/jquery.form.min.js';
?>
<div class="content mt20">
	<div class="container">
		<div class="white_box p20">
			<p>
				BUYIT2 offers you to share with your friends what you bought now and the distribution of new social world online shopping! 
				Come and share with friends what you just bought and see who else bought, when, where and how much it coast him!
			</p>
			<p>
				BUYIT2 is not responsible for the prices listed on the site or product images. Responsibility lies solely with the user, 
				But do your best to show you credibility
			</p>
		</div>
		
		<div class="white_box login_box mt30 p20">
			<div class="login_holder border_left pt10 pb10">
				<div class="fs16 mb10">You already have an account?</div>
				<form action="process.php" class="validate" method="post" id="loginForm" novalidate="novalidate" autocomplete="off">
					<input type="hidden" name="act" value="login" />
					
					<input style="display:none" type="text" name="email"/>
					<input style="display:none" type="password" name="password"/>
					<div class="mb6">
						<div class="left mr5"><input type="email" name="email" placeholder="Email" class="input_style" id="login_email" required autocomplete="off" autofocus /></div>
						<div class="left"><input type="password" name="password" placeholder="Password" class="input_style" id="login_password" required autocomplete="off" /></div>
						<div class="clear"></div>
					</div>
					<div>
						<input type="submit" class="simple_btn" value="Login" />
						<label class="fs12"><input type="checkbox" name="remember" class="input_style" />Keep me logged in</label>
					</div>
				</form>
			</div>
			
			<div class="register_holder border_left mt15 pt10 pb10">
				<div class="fs16 mb10">Create an account</div>
				<form action="process.php" class="validate" method="post" id="registerForm">
					<input type="hidden" name="act" value="register" />
					
					<input style="display:none" type="text" name="fname"/>
					<input style="display:none" type="text" name="fname"/>
					<input style="display:none" type="text" name="email"/>
					<input style="display:none" type="text" name="password"/>
					<input style="display:none" type="text" name="age"/>
					
					<div class="mb5">
						<div class="left mr5"><input type="text" name="fname" placeholder="First Name" class="input_style" required autocomplete="off" /></div>
						<div class="left"><input type="text" name="lname" placeholder="Last Name" class="input_style" required autocomplete="off" /></div>
						<div class="clear"></div>
					</div>
					<div class="mb10">
						<div class="left mr5"><input type="email" name="email" placeholder="Email" class="input_style" required autocomplete="off" /></div>
						<div class="left"><input type="password" name="password" placeholder="Password" class="input_style" required autocomplete="off" /></div>
						<div class="clear"></div>
					</div>
					<div class="fs12">Personal Details</div>
					<select class="input_style"><option>Gender</option><option value="male">Male</option><option value="female">Female</option></select>
					<input type="text" name="age" placeholder="Age" class="input_style" id="register_age" autocomplete="off" />
					<div class="mt10">
						<input type="submit" value="Register" class="simple_btn" />
					</div>
				</form>
			</div>
		</div>
		<div class="mt20 AC">
			<i class="sprite1 sprite-logo_small" style="width:34px; margin:0 auto;"></i>
		</div>
	</div>
</div>