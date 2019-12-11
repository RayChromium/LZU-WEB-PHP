<?php
	include "conn.php";//connect to db
	
	if (empty($_POST)) {
		print("post empty");
		}
	else {
		$address = $_SERVER['REMOTE_ADDR'];

		$sql = "INSERT INTO `bbs` (`id`, `title`, `auther`, `content`, `time`, `address`) 
		VALUES (NULL, '".$_COOKIE["logphone"]."' , '$_POST[title]', '$_POST[auther]', '$_POST[content]', now(), '$address')";
	
	$s = $conn->query($sql);
	if (!$s) echo "Faild";
	else {
		//直接转到show。php
		header("location:show.php");
		// echo "Success insert";
		// echo '<a href="show.php">"Check DB"</a>';

		}

	}
?>