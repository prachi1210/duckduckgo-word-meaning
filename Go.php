<?php

	require_once 'functionc.php';

	$word=$_POST['word'];
	//echo $word;
	$url='https://api.duckduckgo.com/?format=json&pretty=1&q='.$word;
	//echo $url;
	$json = file_get_contents($url);
	//echo($json);
	$obj = json_decode($json, true);
	//print_r($obj);
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
?>

