<!--  -->
<?php
	//如果没有登陆
	if(!(isset($_COOKIE["isLoggedIn"])&&$_COOKIE["isLoggedIn"]==1)){
		header("Location:login.php");
	}
?>

<html>

	<?php
		//var_dump($_COOKIE);
		echo "<br>";
		echo "Welcome ".$_COOKIE['username'];
	?>
	<br>
	<a href="login.php?action=logout">Logout</a>
	<br>
	<p></p>
		
</html>


