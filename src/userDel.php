<?php
	include "conn.php";//connect to db
	
	if (empty($_GET)) {
		print("post empty");
		}
	else {
		$phone = $_GET['phone'];
		echo $phone;
		$sql = "delete from user where phone='$phone'";
		$s = $conn->query($sql);
		$sql = "delete from bbs where phone='$phone'";
		$s = $conn->query($sql);

	if (!$s) echo "Faild";
	else {
		//直接回到adminUserManage.php
		header("location:".$_GET["returnUrl"]);
		}

	}
?>