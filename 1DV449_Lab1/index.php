<?php

curl_post("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php");
//curl_post("http://vhost3.lnu.se:20080/~1dv449/demo/login.php");
//curl_post("http://giantbomb.com");

		function curl_post($url)
	{
		$curlHandler = curl_init();
		
		curl_setopt($curlHandler, CURLOPT_URL, $url);
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandler, CURLOPT_POST, 1);
		
		
		
		
		$postData = array("username" => "admin",
						"password" => "admin");
		
		curl_setopt($curlHandler, CURLOPT_HEADER, 1);
		curl_setopt($curlHandler, CURLINFO_HEADER_OUT, true);
		curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $postData);
		
		curl_setopt($curlHandler, CURLOPT_COOKIEJAR, dirname(__FILE__) ."/curlCookies.txt");
		
		$data = curl_exec($curlHandler);
		
		
		var_dump($data);
		var_dump(curl_error($curlHandler));
		var_dump(curl_errno($curlHandler));
		
		curl_close($curlHandler);
	}
?>