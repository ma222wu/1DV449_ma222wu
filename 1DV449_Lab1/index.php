<?php
require_once("Main.php");



$view = new View();

class View
{
	public function __construct()
	{
		$producers = Main::DeSerializeProducers();
		
		echo '
<!DOCTYPE html>
<html>
	<head>
		<title>
			Scraped producers
		</title>
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<meta charset="utf-8" />
	</head>
	<body>';
		
		echo '<table border="1">
			<tr>
			<th>Name</th>
			<th>Location</th>
			<th>Homepage</th>
			<th>Unique ID</th>
			</tr>';
			
			foreach ($producers as $producer) 
			{
				echo '<tr>
					<td>'.$producer->m_name.'</td>
					<td>'.$producer->m_location.'</td>
					<td>'.$producer->m_url.'</td>
					<td>'.$producer->m_id.'</td>
					</tr>';
			}
			
			echo '</body></html>';
	}
}


?>