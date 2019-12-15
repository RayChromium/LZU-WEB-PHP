<?php
	include "conn.php";//connect to db
	
	if (empty($_GET)) {
		print("post empty");
		}
	else {
		$phone = $_GET['phone'];
		echo $phone;
		$sql = "UPDATE `bbs` SET `isRec` = b'0' WHERE `bbs`.`id` = ".$_GET['id'];
	
	$s = $conn->query($sql);
	if (!$s) echo "Faild";
	else {
		//直接回到adminShow.php
		header("location:".$_GET["returnUrl"]);
		}

	}
?>