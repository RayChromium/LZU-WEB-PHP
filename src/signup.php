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
	<title>Signup</title>
</head>
<body bgcolor="lavender">
<div id="survey">	
	<!-- search部分 -->
	<form method="post" action="signup.php?action=signup">
		<fieldset>
			
				<label >Signup</label>
				<br>
				<div class="block">
					<label for="Phone">Phone:</label>
					<input type="text" name="phone" required>*
				</div>
				<div class="block">
					
					<label for="Sex">Sex:</label>
					<input type="radio" name="sex" value="M">Male
        			<input type="radio" name="sex" value="F">Female
				</div>
				<div class="block">
					<label for="Nickname">Nickname:</label>
					<input type="text" name="nickname" required>*
				</div>
				<div class="block">
					<label for="Password">Password:</label>
					<input type="text" name="password">
				</div>
				<div class="block">
					<label for="Birthday">Birthday:</label>
					<input type="date" name="birthdate" />
					
				</div>
				<div class="block">
					<label for="QQ">QQ:</label>
					<input type="text" name="qq">
				</div>
				<div class="block">
					<label for="Email">Email:</label>
					<input type="email" name="email">
				</div>
				
				<div class="center">
					<input type="submit" value="Signup">
				</div>
				
		</fieldset>
	</form>
</div>
</body>
</html>

<?php
	include "conn.php";

	if(!empty($_GET["action"])){


		$sql = "SELECT * FROM `user` WHERE `phone` = '".$_POST['phone']."'";
		$result = $conn->query($sql);
		$nums=$result->num_rows;
		if ($nums!=0) {
			echo "This phone is already registered. Please use another phone!";
		}else{
			
			$sql = "INSERT INTO `user` (`phone`, `admin`, `sex`, `birthdate`, `nickname`, `qq`, `email`) VALUES ('".$_POST['phone']."', b'0', '".$_POST['sex']."', '".$_POST['birthdate']."', '".$_POST['nickname']."', '".$_POST['qq']."', '".$_POST['email']."');";
			if($conn->query($sql)){
				echo "Successfully signed up!";
				echo "<br>";
				echo "<a href='login.php'>Back to Login</a>";
			}else{
				echo "Retry";
			}

		}
	}
?>



