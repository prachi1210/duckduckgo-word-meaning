<?php

	require_once 'inc/function.inc.php';

	if(isset($_POST['word'])){
		$word=$_POST['word'];
		$url='https://api.duckduckgo.com/?format=json&pretty=1&q='.$word;
		
		$json = file_get_contents($url);
		$obj = json_decode($json, true);
		echo $obj["Heading"];
		
		foreach ($obj as $key => $value) 
		{
			if($key=="RelatedTopics")
			{

				foreach ($value as $k1 => $v1)
				{
					if($k1=="Text")
					{
						echo "<br>";
						print $v1["Result"];
					}
				}
			}
		}
		die;
	}

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="author" content="">
	<meta name="description" content="">
	<title>DuckDuckGo Word Meaning</title>
</head>
<body bgcolor="#98AFC7">
	<center>			
		<h1><font face ="Tw Cen MT" color="#151b54">Word Definition</h1>
		<h3><font face ="Tw Cen MT" color="#151b54">Powered By</h3>
		<img src="images/abc.png" alt="DuckDuckGo" >
	</center>
	<br>
	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
		<tr>
			<form method="POST">
				<td>
					<table width="100%" border="0"  cellspacing="1" bgcolor="#ffffff">
						<tr>
							<td colspan="3"><strong><center>Enter word definition to search</cemter></strong></td>
						</tr>
						<tr>
							<td width="78">Word</td>
							<td width="6">:</td>
							<td width="294"><input name="word" type="text" id="word"></td>
						</tr>
						<tr></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" name="Submit" value="GO"></td>
						</tr>
					</table>
				</td>
			</form>
		</tr>
	</table>
</body>
</html>
