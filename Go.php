<?php

	require_once 'functionc.php';

	$word=$_POST['word'];
	//echo $word;
	$url='https://api.duckduckgo.com/?format=json&pretty=1&q='.$word;
	//echo $url;
	$json = get_curl($url);
	echo $json;
?>

