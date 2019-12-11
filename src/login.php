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
		.block{
        width: 400px;
        display: block;
        margin:5px 0;
    }
	.center{
        text-align: center;
	}
	label {
        display: inline-block;
        width: 100px;
        text-align: right;
	}
	input,textarea{
        vertical-align: top;
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
				<!-- phone -->
				<div class="block">
					<label for="Phone">Phone:</label>
					<input type="text" name="phone" maxlength="11" required>*
				</div>
				<div class="block">
					<label for="Password">Password:</label>
					<input type="password" name="password">
				</div>
				<div class="center">
					<input type="submit" value="Login">
				</div>
		</fieldset>
	</form>
</div>
</body>
</html>

<?php
	function clearCookie(){
		setcookie( 'logphone', '', time()-3600);
		setcookie("isLoggedIn", '', time()-3600);
		//setcookie('visit','',time()-3600);
		//setcookie('lasttime','',time()-3600);
	}
	include "conn.php";
	//degug
	//var_dump($_POST);
	if(!empty($_GET["action"])){
		if($_GET["action"] == "login"){
			clearCookie();
			//验证密码,sql
			
			$sql = "SELECT * FROM `user` WHERE `phone` = '".$_POST['phone']."'";
			$result = $conn->query($sql);
			//判断用户是否注册
			$nums=$result->num_rows;
			if ($nums==0) echo "This phone is't registered."."<br>";
			else {
				$checkpass = $result->fetch_array();
				//degug
				// var_dump($checkpass);
				// echo "<br>";
				// echo $checkpass['phone'];
				// echo $_POST['phone'];
				if (!($checkpass['phone']==$_POST['phone']&&$checkpass['password']==$_POST['password'])){
					//echo "密码zhengque"."<br>";
					echo "Wrong password"."<br>";
				}
				//密码正确
				else {
					//echo "密码错误"."<br>";
					echo "Correct password"."<br>";
					setcookie("logphone", $_POST["phone"],time()+60*60*24*7);
					
					//不设时间，浏览器关闭就没有了
					setcookie("isLoggedIn","1", time()+60*	60*24*7);
					//是否为admin
					if ($checkpass['admin']=="1") {
						setcookie("nickname",'Admin',time()+60*60*24*7);
						//header("Location:welcome.php");
						header("Location:adminshow.php");
					}
					else {
						setcookie("nickname", $checkpass['nickname'],time()+60*60*24*7);
						//header("Location:welcome.php");
						header("Location:show.php");
					}

				}
				

			}
			
		}
			//else if header
			
		else if($_GET["action"] == "logout"){
			clearCookie();
		}
	}
?>