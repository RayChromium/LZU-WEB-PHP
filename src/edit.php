<?php 

	include "conn.php";//connect to db
	if (!empty($_GET)) { 
		$id = $_GET['id'];


		$sql = "select * from bbs where id='$id'";
	
		$s = $conn->query($sql);
		if (!$s) echo "Faild";
		
		$re = $s->fetch_array();

 ?>

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
	<title>Message</title>

</head>
<body bgcolor="lavender">
<div id="survey">	
	<form method="post" action="edit.php">
	
			<fieldset>
			<section>
				<legend>Message</legend>

				<label>Titile</label>
				<input type="text" name="title" value="<?php echo $re['title']?>">
				<br>

				<input type="hidden" name="id" value="<?php echo$id?>">
				

				<label>Auther</label>
				<input type="text" name="auther"
				value="<?php echo $re['auther']?>"
				>
				<br>

				<label>Text Area</label>
				<textarea type="text" name="content"><?php echo $re['content']?>
				</textarea>
				<br>

				
			</section>
			
			<input type="submit" value="Submit">
		</fieldset>
	</form> 
</div>
</body>
</html>

<?php
	} //如果不空才有上面的html

	else if(!empty($_POST)){
		
		$sql = "update bbs
		set title='$_POST[title]',content='$_POST[content]', auther='$_POST[auther]'
		where id='$_POST[id]'";
		
		// echo $sql;
		$s = $conn->query($sql);
		if (!$s) echo "Faild";
		else {
		//直接转到show。php
		header("location:show.php");
		}

	}
	else echo 'Error!'

?>