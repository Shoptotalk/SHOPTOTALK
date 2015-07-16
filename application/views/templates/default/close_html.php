<div id="notifications"></div>

<script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/assets/js/global.js"></script>
<script src="/assets/js/bootbox.js"></script>
<script src="/assets/js/sockets.js"></script>

<script src="/assets/js/owl/owl.carousel.min.js"></script>
<link rel="stylesheet" href="/assets/js/owl/owl.carousel.css" />
<link rel="stylesheet" href="/assets/js/owl/owl.theme.css" />

<script src="/assets/js/notifications.js"></script>

<?php if( isset($page_js) ) { ?>
<?php foreach($page_js AS $js_file) { ?>
<script src="<?= (strstr($js_file, 'http') ? '' : '/assets/').$js_file ?>"></script>
<?php } } ?>

<div id="bottomPage"></div>

</body>

</html>
