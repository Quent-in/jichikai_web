<?php
	require('plugins/original_HatenaSyntax.php');
	$h=new HatenaSyntax();
	$t="|test|aaaa|\n|a|[http://google.com]|";
	echo $h->ConvertHatenaSyntax($t);
?>