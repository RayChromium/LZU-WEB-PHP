<?php

$conn = @new mysqli('localhost','root','','mydb');

if ($conn->connect_errno!=0) {
	die ("Faild ".$conn->connect_errro);
}
else {
	echo "Connected to DB<br>";
}

$conn->query("set names utf8");


?>
