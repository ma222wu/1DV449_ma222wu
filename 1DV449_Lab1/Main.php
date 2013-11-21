<?php

class Main
{
	public $m_producers;
	
	public function __construct()
	{
		echo '
		<!DOCTYPE html>
		<html>
			<head>
				<title>
				</title>
				<meta charset="utf-8" />
			</head>
			<body>';
		
		$this->m_producers = array();
		
		$this->curl_post("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php");
		
		var_dump($this->m_producers);
		
		$this->SerializeProducer();
		
		echo '</body></html>';
	}
	
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
		
		$htmlLocation = curl_getinfo($curlHandler, CURLINFO_EFFECTIVE_URL);
		
		curl_close($curlHandler);
		
		
		
		
		
		$get_data = $this->curl_get_main_page($htmlLocation);
		
		$dom = new DOMDocument();
		
		$dom->LoadHTML('<?xml encoding="UTF-8">' . $get_data);
		
		$xpath= new DOMXPath($dom);
		$items = $xpath->query('//tr//a');
		
		foreach($items as $item)
		{
			$producerUrl= $item->getAttribute("href");
			
			$this->curl_get_producer_page($producerUrl,$item->nodeValue);
		}
		
	}

	function curl_get_main_page($url)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) ."/curlCookies.txt");
		
		$data2 = curl_exec($ch);
		
		curl_close($ch);
		
		return $data2;
	}
	
	function curl_get_producer_page($url, $name)
	{
		$producer = new Producer();
		$producerID = preg_replace("/[^0-9]/", "", $url);
		$producer->m_id = $producerID;
		
		$ch = curl_init();
		
		$url = "http://vhost3.lnu.se:20080/~1dv449/scrape/secure/" . $url;
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) ."/curlCookies.txt");
		
		$data2 = curl_exec($ch);
		
		curl_close($ch);
		
		$dom = new DOMDocument();
		
		$dom->LoadHTML('<?xml encoding="UTF-8">'.$data2);
		
		$xpath= new DOMXPath($dom);
			$titles = $xpath->query('//h1');
			
			foreach($titles as $title)
			{
				$producer->m_name = $name;
			}
			
			$locations = $xpath->query('//span[@class="ort"]');
			
			foreach($locations as $location)
			{
				$producer->m_location = $location->nodeValue;
				$producer->m_location = preg_replace("/Ort: /", "", $location->nodeValue);
			}
			
			$siteURLs = $xpath->query('//div[@class="hero-unit"]//a');
			
			foreach($siteURLs as $siteURL)
			{
				$producer->m_url = $siteURL->nodeValue;
			}
			
			array_push($this->m_producers, $producer);
	}
	
	public function SerializeProducer()
	{
		$s = serialize($this->m_producers);
		file_put_contents('producers', $s);
	}
	
	public static function DeSerializeProducers()
	{
		$savedProducers = file_get_contents('producers');
  		return unserialize($savedProducers);
	}
}
	
	class Producer
	{
		public $m_name;
		public $m_location;
		public $m_url;
		public $m_id;
		
		public function __construct()
		{
			
		}
		
	}
?>