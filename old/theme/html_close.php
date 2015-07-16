<script src="/assets/js/lang.js"></script>
<script src="/assets/js/global.js"></script>
<script src="/assets/humanjs/humane.min.js"></script>
<script src="/assets/js/tooltip.js"></script>
<script src="/assets/fancybox/jquery.fancybox.js"></script>
<script src="/assets/js/md5.js"></script>
<?php foreach($page_js AS $js_file) { ?>
<script src="<?= (strstr($js_file, 'http') ? '' : '/assets/').$js_file ?>"></script>
<?php } ?>

<?php if(showMsg()) { ?>
<script> $(function(){ <?= showMsg() ?> }); </script>
<?php } ?>

<script type="text/javascript">
	var vglnk = { key: '709708cc9d306c09412ca1568ff09284' };

	(function(d, t) {
	var s = d.createElement(t); s.type = 'text/javascript'; s.async = true;
	s.src = '//cdn.viglink.com/api/vglnk.js';
	var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
	}(document, 'script'));
</script>

</body>

</html>