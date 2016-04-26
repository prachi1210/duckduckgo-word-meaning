<?php

	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	include('inc/header.inc.php');
	include('inc/body.inc.php');
	if(!isset($_POST['word']))
		header("Location : index.php");
	else 
	{
		
		$word=$_POST['word'];
		$q1 = "SELECT `freq` FROM `words` WHERE `word`='$word'";
		
		if($query_run = mysqli_query($connection,$q1))
		{
			
			if(mysqli_num_rows($query_run) == 1 )
			{
					while($query_row = mysqli_fetch_assoc($query_run)){
					$freq = $query_row['freq'];
					$freq+=1;
					$q2="UPDATE `words` SET `freq`='$freq' WHERE `word`='$word'";
					(mysqli_query($connection,$q2));						
				}
			}
			else 
			{
				
				$freq=1;
				$q2= "INSERT INTO `words` (`word`,`freq`) VALUES ('$word','$freq')";
				(mysqli_query($connection,$q2));
			}		
			
		} 
		

		$url='https://api.duckduckgo.com/?format=json&pretty=1&q='.$word;
		
		$json = file_get_contents($url);
		$obj = json_decode($json, true);
		
		if($obj["Heading"] == "")
			echo "No meaning found";
		else
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
		echo "<br><br>"."<b>Frequency of search of </b><i>". $word. "</i><b> is </b>". $freq."</i>";
		$q3="SELECT * FROM `words` ORDER BY `freq` DESC";
		if($query_run = mysqli_query($connection,$q3))
		{
			$row = mysqli_fetch_assoc($query_run);	//select first row	
				echo "<br><br>"."<b>Word with max search frequency : </b><i>". $row['word']. "</i><b> with frequency </b>". $row['freq']."</i";				
		} 
		die;
	}
?>
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
	