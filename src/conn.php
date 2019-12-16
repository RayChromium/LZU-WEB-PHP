<?php
	$conn = @new mysqli('localhost','root','','mydb');

	//把curl操作封装成函数，用来处理ip转换成真实地址
	function geturl($url){
        $headerArray =array("Content-type:application/json;","Accept:application/json");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
	}

	if ($conn->connect_errno!=0) {
		die ("Faild ".$conn->connect_errro);
	}
	else {
		echo "Connected to DB<br>";
	}

	$conn->query("set names utf8");

	//搞IP转换真实地址：
	//配置发送验证码短信相关信息
	if(!isset($_COOKIE["IPinfo"]))
	{
		$host = "https://ipinfo.io";
		$ip_address = $_SERVER['REMOTE_ADDR'];
		// $ip_address = "67.209.177.55";
		$IPinfo_token = "9a19c6540c2b85";
		$request_url = $host . "/" . $ip_address . "?". "token=" . $IPinfo_token;
		
		$realAddressInfo = geturl($request_url);
		// var_dump($realAddressInfo);
		setcookie("IPinfo",$ip_address." Location : ".$realAddressInfo["city"]." , ".$realAddressInfo["region"]." , ".$realAddressInfo["country"]);
		echo "Debug Message - loc COOKIE : ".$_COOKIE["IPinfo"];
	}

?>