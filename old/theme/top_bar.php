<header>
	<div class="top_site">
		<div class="container">
			<a href="/main"><img src="/images/logo.png" alt="" style="width: 170px; margin-top: 5px;" /></a>
			<div class="right">
				<?php if(isUser()) { ?>
					<div class="actions">
						<div class="menu_item right border_left">
							<i class="sprite1 sprite-profile"></i>
							<div class="top_open_menu openMenu">
								<div class="open_menu_link p10 lh10">
									<div class="profilePic left mr10"><img src="<?= $userInfo['profilePic'] ?>" alt="<?= $userInfo['fname']. ' '.$userInfo['lname'] ?>" /></div>
									<div class="left mt18">
										<a href="/users/<?= $userInfo['_id'] ?>">
											Your profile
										</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="sep"></div>
								<div class="open_menu_link"><a href="/process.php?act=logout"><i class="fa fa-sign-out"></i> Logout</a></div>
							</div>
						</div>
						
						<div class="menu_item right border_left">
							<i class="notif_count red" id="recent_num"><?= recentsNum() ?></i><i class="sprite1 sprite-recent"></i>
						</div>
							
						<div class="menu_item right border_left" onclick="get_pms_topMenu();">
							<i class="notif_count red" id="pms_num"><?= pmsNum() ?></i><i class="sprite1 sprite-chat"></i>
							<div class="top_open_menu openMenu" id="pms_openMenu"></div>
						</div>
						
						<div class="menu_item right border_left<?= ($global->controller == "settings" ? ' active' : '') ?>" onclick="mis()">
							<i class="sprite1 sprite-cogs"></i>
							
						</div>
						
						<div class="menu_item right border_left" onclick="st();"><i class="sprite1 sprite-search"></i></div>
						<div id="search" class="left" <?= ($_GET['q'] ? 'style="display:block;"' : '') ?>>
							<form action="/" method="get" autocomplete="off">
								<input type="hidden" name="q" />
								<input type="text" name="q" onkeyup="searchit();" value="<?= $_GET['q'] ?>" placeholder="Search for items, peoples, groups or sites" />
							</form>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</header>

<script>
	var category = '';
	var q = '<?= $_GET['q'] ?>';
	var socket = io.connect("http://yossi-shaish.co.il:3000");
	
	socket.on('alert_user', function(data){
		if(data.recive_id == '<?= $userInfo['_id'] ?>') $("#pms_num").html( parseInt($("#pms_num").html()) + 1 );
	});
	
	socket.on('action_recive', function(data){
		if(data.recive_id == '<?= $userInfo['_id'] ?>') $("#recent_num").html( parseInt($("#recent_num").html()) + 1 );
	});
	
	function searchit(){
	
	}
	
	$(function(){
		$(".menu_item").click(function(){
			if($(this).hasClass("active")) {
				$(this).removeClass("active");
				$(this).find(".top_open_menu").hide();
			} else {
				$(this).addClass("active");
				$(this).find(".top_open_menu").show();
			}
		});
	});
	
	function get_pms_topMenu(){
		$.post("/process.php", {act : "get_pms_topMenu"}, function(data){
			$("#pms_openMenu").html(data);
		});
	}
	
	function mis() {
		location.href = '/settings';
	}
	
	function st(){
		$("#search").toggle();
		$("#search input").focus();
	}
</script>