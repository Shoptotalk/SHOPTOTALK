<?php require_once('system/global.php') ?>

<?php include('theme/html_open.php') ?>
<?php if(!$global->noTopBar) include('theme/top_bar.php') ?>
	
	<?php
		if ( !$_GET['page'] ) $pageName = 'main';
			else $pageName = $_GET['page'];
		
		if( strstr($pageName, '.php') ) $pageToLoad = $pageName;
			else $pageToLoad = 'pages/'.$pageName.'.php';
			
		if ( file_exists($pageToLoad) ) include($pageToLoad);
			else redirect('/404');
	?>
	
<?php include('theme/html_close.php') ?>