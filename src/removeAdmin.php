<?php
	include "conn.php";//connect to db
	
	if (empty($_GET)) {
		print("post empty");
		}
	else {
		$phone = $_GET['phone'];
		echo $phone;
		$sql = "UPDATE `user` SET `admin` = b'0' WHERE `user`.`phone` = '$phone'";
	
	$s = $conn->query($sql);
	if (!$s) echo "Faild";
	else {
		//直接回到adminUserManage.php
		header("location:adminUserManage.php");
		}

	}
?>