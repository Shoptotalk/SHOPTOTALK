<?php $active = ($_GET['var1'] ? $_GET['var1'] : 'personal_details'); ?>
<div class="content mt20">
	<div class="container">
		
		<div class="left_side_menu mr10 left">
			<div class="page_title">Settings</div>
			<div class="clear"></div>
			<div class="border pb30">
				<div class="menu_cat">
					<div class="menu_title fs14 bold border_bottom"><i class="left mr7 mt1 sprite1 sprite-cogs_small"></i> General</div>
					<div class="menu_items mt10">
						<a href="/settings/personal_details" class="menu_item<?= ($active == "personal_details" ? ' active' : '') ?>">Personal Details</a>
						<a href="/settings/email_notification" class="menu_item<?= ($active == "email_notification" ? ' active' : '') ?>">Email Notification</a>
						<a href="/settings/secure" class="menu_item<?= ($active == "secure" ? ' active' : '') ?>">Secure</a>
					</div>
				</div>
				<div class="menu_cat mt25">
					<div class="menu_title fs14 bold border_bottom"><i class="left mr7 mt2 sprite1 sprite-privacy_small"></i> Privacy</div>
					<div class="menu_items mt10">
						<a href="/settings/blocked_list" class="menu_item<?= ($active == "blocked_list" ? ' active' : '') ?>">Blocked List</a>
						<a href="/settings/my_items" class="menu_item<?= ($active == "my_items" ? ' active' : '') ?>">My Publish Item</a>
					</div>
				</div>
				<div class="menu_cat mt25">
					<div class="menu_title fs14 bold border_bottom"><i class="left mr7 mt1 sprite1 sprite-cogs_small"></i> Support</div>
					<div class="menu_items mt10">
						<a href="/settings/contact_us" class="menu_item<?= ($active == "contact_us" ? ' active' : '') ?>">Contact Us</a>
						<a href="/settings/videos" class="menu_item<?= ($active == "videos" ? ' active' : '') ?>">Videos</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="right_side with_menu_content left">
			
			<div class="tabs_content" id="email_notification">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					<div class="border">
						<label><input type="checkbox" name=""></input> Friend BUYIT2 your item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will BUY your item too, you will get an emaill with all the details<br /> about the item, and about the freind.</div>
					</div>
				</form>
			</div>
			
			<div class="tabs_content" id="personal_details">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					
				</form>
			</div>
			
			<div class="tabs_content" id="secure">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					
				</form>
			</div>
			
			<div class="tabs_content" id="blocked_list">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
				</form>
			</div>
			
			<div class="tabs_content" id="my_items">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					
				</form>
			</div>
			
			<div class="tabs_content" id="contact_us">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					
				</form>
			</div>
			
			<div class="tabs_content" id="videos">
				<form action="" method="post">
					<div class="border no_border_bottm">
						<div class="input"><label><input type="checkbox" name=""></input> New Comment on your items</label></div>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If your friend or someone else is commented on item that you post, an email will be<br /> send to you with all the details.</div>
					</div>
					<div class="border no_border_bottm">
						<label><input type="checkbox" name=""></input> New Friend Item</label>
						<div class="dark_grey_text fs12 mt10 pl4 lh22"><b>Note:</b> If one of your friend will publish a new item, you will recive an Email with all the<br /> details.</div>
					</div>
					
				</form>
			</div>
			
		</div>
		
		<div class="clear"></div>
		
		<div class="mt20 AC">
			<i class="sprite1 sprite-logo_small" style="width:34px; margin:0 auto;"></i>
		</div>
		
	</div>
</div>

<script>
	$(function(){
		$("#<?=  $active ?>").show();
		var menuHeight = $(".left_side_menu").height() - 19;
		var contentHeight =  $(".right_side.with_menu_content").height();
		if(contentHeight < menuHeight){
			$(".right_side.with_menu_content").css("height", menuHeight + "px");
		}
	});
</script>