<?php
	function get_curl($url)
	{
		$curl_handle=curl_init();
		
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);
		$result= curl_exec($curl_handle);

		curl_close($curl_handle);

		return $result;
	}
?>
		