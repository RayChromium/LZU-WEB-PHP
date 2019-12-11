<!DOCTYPE html>
<html>
<meta charset="utf-8">
<!-- <meta http-equiv="refresh" content="10"> -->

<style type="text/css">
		#survey{
			width: 450px;
			margin: 50px auto;
			line-height: 25px;
		}
		label{
			width: 80px;
			display: inline-block;
		}

	</style>
<head>
	<title>Login</title>
</head>
<body bgcolor="lavender">
<div id="survey">	
	<!-- search部分 -->
	<form method="post" action="login.php?action=login">
		<fieldset>
			
				<label>Login</label>
				<br>

				Username<input type="text" name="username">
				<br>
				Password<input type="text" name="password">
				<br>
				<input type="submit" value="Login">
		</fieldset>
	</form>
</div>
</body>
</html>

<?php
	function clearCookie(){
		setcookie( 'username', '', time()-3600);
		setcookie("isLoggedIn", '', time()-3600);
		//setcookie('visit','',time()-3600);
		//setcookie('lasttime','',time()-3600);
	}
	if(!empty($_GET["action"])){
		if($_GET["action"] == "login"){
			clearCookie();
			//验证密码
			if($_POST["username"]=="admin"&&$_POST["password"]=="123456"){
				setcookie("username", $_POST["username"],time()+60*60*24*7);
				//不设时间，浏览器关闭就没有了
				setcookie("isLoggedIn","1", time()+60*	60*24*7);
				header("Location:show.php");
			}else{
				echo("密码错误");
			}
		}else if($_GET["action"] == "logout"){
			clearCookie();
		}
	}
?>