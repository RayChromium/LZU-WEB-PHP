<?php
	include "conn.php";//connect to db
	
	if (empty($_POST)) {
		print("post empty");
		}
	else {
		//ip -> location

		$ip = $_SERVER['REMOTE_ADDR'];
		$access_key = '10e2a46e22c81accc3a522085d49457d';

		// Initialize CURL:
		$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// 执行查询:
		$json = curl_exec($ch);
		curl_close($ch);
	
		// JSON 解码
		$api_result = json_decode($json, true);
		
		
		if (empty($api_result['country_name'])){
			$address = "localhost";
		}
		// Output the "capital" object inside "location"
		else {
			$address = $api_result['country_name']." -> ".$api_result['city'];
		}
		//ip -> location

		//$address = $_SERVER['REMOTE_ADDR'];

		$sql = "INSERT INTO `bbs` (`id`, `phone` , `title`, `nickname`, `content`, `time`, `address`) 
		VALUES (NULL, '".$_COOKIE["logphone"]."' , '$_POST[title]', '".$_COOKIE["nickname"]."', '$_POST[content]', now(), '$address')";
	
	$s = $conn->query($sql);
	if (!$s) echo "Faild";
	else {
		//直接转到show。php
		header("location:show.php?filter=self");
		// echo "Success insert";
		// echo '<a href="show.php">"Check DB"</a>';

		}

	}
?>