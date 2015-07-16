<?php
	if(!isUser()) redirect('/login');
    $page_js[] = 'validate/jquery.form.min.js';
    $page_js[] = 'js/main.js';
    $page_js[] = 'uploadImage/html5imageupload.js';
    $page_js[] = 'owl/owl.carousel.min.js';
    $page_js[] = 'autosize/jquery.autosize.js';
?>

<div class="content mt20">
	<div class="container">
		
		<div class="left_side left posts_left_side_bar">
			<?php include('theme/left_bar.php') ?>
		</div>
		
		<div class="left_side right posts_container">
			<div class="new_item">
				<div class="page_title">Post New Item</div>
				<div class="border clear new_item_holder">
					<input type="text" name="item_url" id="item_url" class="input_style" autofocus placeholder="Post new item you just bought (Copy and paste item url here)" data-category="<?= $_GET['var1'] ?>" />
					<i class="sprite1 sprite-camera right mr10 mt8 pointer relative" onclick="fill_add_item_div(null)"></i>
				</div>
				
			</div>
		</div>
		
		<div class="right_side left posts_side_bar">
			<?php include('theme/right_bar.php') ?>
		</div>
		
		<div class="clear"></div>
		
	</div>
</div>

<script>
<?php
	if($_GET['var1']){
		$categorySearch = niceUrl($_GET['var1'],1);
		$cat = $categories_db->findOne(Array("title" => new MongoRegex("/^$categorySearch/i")));
		if($cat['_id']): ?> category = '<?= $cat['_id'] ?>'; <?php endif; ?>
<?php 
	}
?>
</script>




