<!DOCTYPE html>
<html>
<meta charset="utf-8">
<!-- <meta http-equiv="refresh" content="10"> -->

<style type="text/css">
	/*简单的一些样式，以及格式控制*/
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
	
		<fieldset>
			
			<label >Sign Up</label>
			<br>
			<!-- 手机号单独输入，要发送验证码 -->
			<form method="post" action="signup1.php?action=check">
				<div class="block">
					<label for="Phone">Phone:</label>
					<?php
						// html中显示的手机号默认为空
						$phone='';
						if(!empty($_GET["action"])){	
							if ($_GET["action"]=='check'&&isset($_POST["phone"])){
								//如果手机号有输入就显示
								$phone = $_POST["phone"];
								$sent = "Send";
							}
						} 
						
						$sent = "Sent";
					?>
					<input type="text" name="phone" maxlength="11" value='<?php echo $phone?>' required>*
					<input type="submit" value='<?php echo $sent?>'>
				</div>
			</form>
			<!-- 除了手机号之外的注册信息 -->
			<form method="post" action="signup1.php?action=signup">	
				<!-- 短信验证码，注意加required表示必须输入 -->
				<div class="block">
					<label for="SMS code">SMS code:</label>
					<input type="text" name="code" required>*
				</div>
				<!-- 圆形单选 -->
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
					<input type="password" name="password1" required>*
				</div>
				<div class="block">
					<label for="Password">ReEnter:</label>
					<input type="password" name="password2" required>*
				</div>
				<!-- 输入格式为date，需要使用chrome浏览器等 -->
				<div class="block">
					<label for="Birthday">Birthday:</label>
					<input type="date" name="birthdate" value='2000-01-01'/>
					
				</div>
				<div class="block">
					<label for="QQ">QQ:</label>
					<input type="text" name="qq">
				</div>
				<!-- 输入格式为email，需要使用chrome浏览器等 -->
				<div class="block">
					<label for="Email">Email:</label>
					<input type="email" name="email">
				</div>
				
				<div class="center">
					<input type="submit" value="Signup">
				</div>
			</form>
		</fieldset>
	
</div>
</body>
</html>

<?php
	include "conn.php";
	//if(isset($_COOKIE)) print_r($_COOKIE);
	echo "<br>";
	
	if(!empty($_GET["action"])){
		//准备完成注册
		if ($_GET["action"]=='signup'){
			//如果已经准备了验证的sms code
			if (isset($_COOKIE["tempcode"])) {
				//判断用户输入的验证码与发送的是否相同
				if ($_POST['code']!=$_COOKIE["tempcode"]){
					echo "SMS code invalid.";
					echo "<br>";
				}else{
					echo "SMS code verified.";
					echo "<br>";
					//检查该手机号是否已经注册
					$phone = $_COOKIE["signphone"];
					$sql = "SELECT * FROM `user` WHERE `phone` = '".$phone."'";
					$result = $conn->query($sql);
					$nums=$result->num_rows;
					if ($nums!=0) {
						echo "This phone is already registered. Please use another phone!";
					}else if ($_POST['password1']!=$_POST['password2']){
						echo "The password your entered twice is't match. Please try again.";
						echo "<br>";
					}
					//完成用户注册的操作，用户数据加入数据库中
					else{
					
						$sql = "INSERT INTO `user` (`phone`, `admin`, `sex`, `birthdate`, `nickname`, `qq`, `email`,`password`) VALUES ('".$phone."', b'0', '".$_POST['sex']."', '".$_POST['birthdate']."', '".$_POST['nickname']."', '".$_POST['qq']."', '". $_POST['email']."','".$_POST['password1']."');";
						//debug
						echo $sql;
						echo "<br>";
						//成功注册后返回登陆界面
						if($conn->query($sql)){
						echo "Successfully signed up!";
						echo "<br>";
						echo "<a href='login.php'>Back to Login</a>";
						}else{
						echo "Retry";
						}
					}

				}
				//
				
			}

		}
		//进行手机验证码发送
		if ($_GET["action"]=='check'){
			//获取手机号
			$phone = $_POST["phone"];
			//随机产生4位验证码
			$tempcode = mt_rand(999, 9999);
			//使用cookie保存验证码和手机号
			setcookie("tempcode", $tempcode, time()+60*60);
			setcookie("signphone", $phone, time()+60*60);
			//debug
			echo "The sms code will be send is ".$tempcode;
			echo "<br>";
			//简单判断手机号是否为11位，避免明显错误还调用api，省钱！！
			if (strlen($phone)!=11) echo "Wrong phone number! Please try again.";
			else {
				//配置发送验证码短信相关信息
    			$host = "http://yzx.market.alicloudapi.com";
    			$path = "/yzx/sendSms";
    			$method = "POST";
    			//阿里云appcode
    			$appcode = "faa4172ab39e4e64b13424ac3409c5fb";
    			$headers = array();
    			array_push($headers, "Authorization:APPCODE " . $appcode);
    			$querys = "mobile=".$phone."&param=code%3A".$tempcode."&tpl_id=TP1710262";
    			$bodys = "";
    			$url = $host . $path . "?" . $querys;
			
    			$curl = curl_init();
    			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    			curl_setopt($curl, CURLOPT_URL, $url);
    			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($curl, CURLOPT_FAILONERROR, false);
    			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($curl, CURLOPT_HEADER, true);
    			if (1 == strpos("$".$host, "https://")){
    			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    			    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    			}
				//执行api调用，并获取返回结果
    			$result = curl_exec($curl);
    			//debug
    			//var_dump($result);
    			//判断是否成功发送
    			if (checkstr($result)) {
    				echo "SMS code successfully sent.";
    			}
    			else echo "Wrong phone number! Please try again.";

    		}
			//
		}


	}
	//设计函数检查api调用返回值，判断短信是否成功发送
	function checkstr($str){
		$needle = '"return_code":"00000"';//若成功会包含"return_code":"00000"
		$tmparray = explode($needle,$str);
		if(count($tmparray)>1){
			return true;
		} else{
			return false;
		}
	}

?>





