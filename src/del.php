<?php
	include "conn.php";//connect to db
	
	if (empty($_GET)) {
		print("post empty");
		}
	else {
		$id = $_GET['id'];
		echo $id;
		$sql = "delete from bbs where id='$id'";
	
	$s = $conn->query($sql);
	if (!$s) echo "Faild";
	else {
		//直接转到show。php
		header("location:show.php");
		}

	}
?>