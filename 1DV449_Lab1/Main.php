<?php


//curl_post("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php");
//curl_post("http://vhost3.lnu.se:20080/~1dv449/demo/login.php");
//curl_post("http://giantbomb.com");

//libxml_use_internal_errors(true);
class Main
{
	public $m_producers;
	
	public function __construct()
	{
		$this->m_producers = array();
		
		$this->curl_post("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php");
		
		var_dump($this->m_producers);
		
		$this->SerializeProducer();
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
		
		
		//var_dump($data);
		//var_dump(curl_error($curlHandler));
		//var_dump(curl_errno($curlHandler));
		
		$htmlLocation = curl_getinfo($curlHandler, CURLINFO_EFFECTIVE_URL);
		
		curl_close($curlHandler);
		
		//header('Location: '.$htmlLocation);
		
		$get_data = $this->curl_get_main_page($htmlLocation);
		
		$dom = new DOMDocument();
		
		if($dom->LoadHTML($get_data))
		{
			$xpath= new DOMXPath($dom);
			$items = $xpath->query('//tr//a');
			
			foreach($items as $item)
			{
				$producerUrl= $item->getAttribute("href");
				
				
				$this->curl_get_producer_page($producerUrl);
				//echo $item->nodeValue . "    " . $item->getAttribute("href") . "<br/>";
			}
		}
		else 
		{
			die("error when reading html");
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
		
		//var_dump($data2);
		
		var_dump(curl_error($ch));
		var_dump(curl_errno($ch));
		
		curl_close($ch);
		
		return $data2;
	}
	
	
	
	function curl_get_producer_page($url)
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
		
		$dom->LoadHTML($data2);
		
		$xpath= new DOMXPath($dom);
			$titles = $xpath->query('//h1');
			
			foreach($titles as $title)
			{
				//echo $title->nodeValue;
				$producer->m_name = $title->nodeValue;
			}
			
			$locations = $xpath->query('//span[@class="ort"]');
			
			foreach($locations as $location)
			{
				//echo $location->nodeValue;
				$producer->m_location = $location->nodeValue;
			}
			
			$siteURLs = $xpath->query('//div[@class="hero-unit"]//a');
			
			foreach($siteURLs as $siteURL)
			{
				//echo $siteURL->nodeValue;
				$producer->m_url = $siteURL->nodeValue;
			}
			
			//echo $producerID;
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