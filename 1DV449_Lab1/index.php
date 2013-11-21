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
		 curl_setopt($curlHandler, CURLOPT_FOLLOWLOCATION, true);//makes CURLINFO_EFFECTIVE_URL return the end destination of the login script instead of the current page
		
		
		
		$postData = array("username" => "admin",
						"password" => "admin");
		
		curl_setopt($curlHandler, CURLOPT_HEADER, 1);
		curl_setopt($curlHandler, CURLINFO_HEADER_OUT, true);
		curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $postData);
		
		curl_setopt($curlHandler, CURLOPT_COOKIEJAR, dirname(__FILE__) ."/curlCookies.txt");
		
		$data = curl_exec($curlHandler);
		
		
		//var_dump($data);
		//var_dump(curl_error($curlHandler));
		//var_dump(curl_errno($curlHandler));
		
		$htmlLocation = curl_getinfo($curlHandler, CURLINFO_EFFECTIVE_URL);
		
		curl_close($curlHandler);
		
		//header('Location: '.$htmlLocation);
		
		$get_data = curl_get($htmlLocation);
		
		$dom = new DOMDocument();
		
		if($dom->LoadHTML($get_data))
		{
			
			
			$xpath= new DOMXPath($dom);
			$items = $xpath->query('//a');
			
			foreach($items as $item)
			{
				echo $item->nodeValue;
			}
		}
		else 
		{
			die("error when reading html");
		}
	}

	function curl_get($url)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_URL, "https://coursepress.lnu.se/kurser/");
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) ."/curlCookies.txt");
		
		$data2 = curl_exec($ch);
		
		//var_dump($data2);
		
		var_dump(curl_error($ch));
		var_dump(curl_errno($ch));
		
		curl_close($ch);
		
		return $data2;
	}
?>