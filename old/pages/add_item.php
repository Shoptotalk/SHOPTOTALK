<?php 
	$randnum = md5(time());
	if(!$item) {
		
		// If its edit so you have $item. if not its without paste url. its include from /pages/open_item.php;
		chdir('../');
		require('system/global.php'); 
		
		// prePrint($_GET,1);
		
		$itemSite = $_GET['itemSite'];
		$itemUrl = $_GET['itemUrl'];
		$itemImage = $_GET['itemImage'];
		$itemDesc = $_GET['itemDesc'];
		$itemTitle = $_GET['itemTitle'];
		$itemPrice = $_GET['itemPrice'];
		$itemImage = $_GET['itemImage'];
		$itemCategory = $_GET['itemCategory'];
		$moreImages = $_GET['moreImages'];
		$userDesc = '';
		
	} else {
	
		$itemSite = $item['site'];
		$itemUrl = $item['url'];
		$itemImage = $item['img'];
		$itemDesc = $item['siteDesc'];
		$itemTitle = $item['title'];
		$itemPrice = $item['price'];
		$itemImage = $item['img'];
		$itemCategory = $item['category'];
		$userDesc = $item['userDesc'];
		$moreImages = Array();
		
	}
?>
<div class="add_item_holder">
	<!--<div class="logo_letter"><img src="images/logo_letter.png" alt="" /></div>-->
	<form action="/process.php" method="post">
		<input type="hidden" name="act" value="add_item" />
		<?= ($item['_id'] ? '<input type="hidden" name="itemID" value="'.$item['_id'].'" />' : '') ?>
		<input type="hidden" name="url" value="<?= $itemUrl ?>" />
		<input type="hidden" name="img" id="itemImg" value="<?= $itemImage ?>" />
		<input type="hidden" name="siteDesc" value="<?= $itemDesc ?>" />
		<div class="left w50 add_item_side">
			<div class="holder">
				
				<div class="side_title greentext fs18">The system was able to collect data</div>
				<div class="side_title greentext fs12 mb10">Feel free to write your own text</div>
				
				<?php if(!$_GET['itemSite']) { ?>
					<div class="input">
						<input type="text" name="site" class="mt3 fs25 p10 input_style w100" placeholder="You bought it on..." value="" />
						<div class="clear"></div>
					</div>
				<?php } else { ?>
					<input type="hidden" name="site" value="<?= $itemSite ?>" />
				<?php } ?>
				
				<div class="input">
					<input type="text" name="title" class="mt3 fs25 p10 input_style w100" placeholder="Item Name" value="<?= $itemTitle ?>" />
					<div class="clear"></div>
				</div>
				<div class="input">
					<textarea name="userDesc" placeholder="Your own shopping experience..." class="input_style w100 p10 mt3"><?= $userDesc ?></textarea>
					<div class="clear"></div>
				</div>
				
				<div class="price_holder">
				
					<div class="input left mr10" style="width:90px;">
						<input type="text" name="price" placeholder="Price" class="input_style w100 AC fs22 p10" value="<?= $itemPrice ?>" />
						<div class="clear"></div>
					</div>
					<div class="input left" style="width:65px;">
						<select name="currency" class="input_style w100 AC fs22 p11">
							<?php foreach(currencies() AS $currency) { ?>
								<option value="<?= $currency['sign'] ?>"><?= $currency['sign'] ?></option>
							<?php } ?>							
						</select>
						<div class="clear"></div>
					</div>
					
					<div class="clear"></div>
				</div>
				
				<div class="relative">
					<div class="image mt20" id="adi<?= $randnum ?>">
						<?php 
						if($moreImages) { 
							foreach($moreImages AS $image){ 
						?>
							<img src="<?= $image ?>" alt="" />
						<?php
							}
						} else { ?>
							<img src="<?= $itemImage ?>" alt="" />
						<?php } ?>
					</div>
					<div class="btn" id="useImage">USE CURRENT IMAGE</div>
				</div>
			</div>
		</div>
		
		<div class="left w50 add_item_side">
			<div class="holder">
				<div class="input left w100">
					<select name="category" class="input_style w100 AC fs16 p5">
						<?php foreach($categories_db->find(Array("valid" => 1)) AS $cat) { ?>
							<option value="<?= $cat['_id'] ?>" <?= (strtolower($itemCategory) == strtolower($cat['title']) ? 'selected' : '') ?>><?= $cat['title'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="input left w100">
					<div class="dropzone" data-width="300" data-ghost="false" data-height="300" data-save-original="true" data-originalsize="false" data-url="upload.php" style="width:380px;">
						<input type="hidden" name="uploaded_file_name" class="uploaded_file_name" />
						<input type="hidden" name="uploaded_original_name" class="uploaded_original_name" />
						<input type="file" name="buyer_pic" />
					</div>
				</div>
				<input type="submit" class="btn w100 pt10 pb10" value="SHARE YOUR BUY" />
			</div>
		</div>
		
		<div class="clear"></div>
	</form>
</div>

<script>
	$(function(){
		$('.dropzone').html5imageupload({
			onAfterProcessImage: function(data) {
				// console.log(data.image);
			}
		});
		
		var currentOwl;
		$("#adi<?= $randnum ?>").owlCarousel({
			lazyLoad : true, singleItem:true,
			afterAction : afterAction
		}); 
		
		function afterAction() {
			currentOwl = $("#adi<?= $randnum ?>").find(".owl-item").eq(this.owl.currentItem).find("img").attr("src");
		}
		
		$("#useImage").on("click", function(){
			$("#itemImg").val(currentOwl);
			$(".owl-pagination").find(".owl-page").eq(currentOwl).find("span").css("background","#1FAE00");
		});
		
	});
</script>