<?php

	switch($_POST['act']){
		case "addCat":
			$data['valid'] = 1;
			$data['title'] = $_POST['title'];
			dbAdd($data,'categories_db');
			redirect('/admin');
			break;
		
		case "addCurrency":
			$data['valid'] = 1;
			$data['sign'] = $_POST['sign'];
			dbAdd($data,'currencies_db');
			redirect('/admin');
			break;
	}

?>
<div class="content mt20">
	<div class="container">
		<form action="/admin" method="post">
			<input type="hidden" name="act" value="addCat" />
			<input type="text" name="title" />
			<input type="submit" value="ADD CATEGORY" class="btn" />
		</form>
		<hr />
		<form action="/admin" method="post">
			<input type="hidden" name="act" value="addCurrency" />
			<input type="text" name="sign" />
			<input type="submit" value="ADD CURRENCY" class="btn" />
		</form>
	</div>
</div>