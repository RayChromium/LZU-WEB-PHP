
<!--  -->
<?php
	//include "visittime.php";
	//function visit();
	include "welcome.php";
	include "conn.php";//connect to db
	
	
	//是否搜索
	//search
	$search = "";
	if(!empty($_GET['search'])) {

		$search = $_GET['search'];
		$k = "`title` like '%$search%'";
		//$sql = "select * from `bbs` where `title` like '%$search%'";
	}
	//不search
	else if(isset($_GET["filter"]))
	{
		//显示自己发布的内容
		if($_GET["filter"] == "self")
		{
			$k = " `phone` = '".$_COOKIE['logphone']."'";
		}
		//显示特定用户发布的内容
		else
		{
			$k = "`phone` = '".$_GET["filter"]."'";
		}
	}
	else 
		$k= "`isRec` = 1";		//Default : 推荐内容
?>


<!DOCTYPE html>
<html>
<meta charset="utf-8">
<script type="text/javascript">
	function do_del(id) {
		var is=window.confirm("Confirm delete");
		if(is){
			// 重新定向
			window.location.href="del.php?id="+id;
		}

	}


</script>
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
	<form method="post" action="recive.php">
		
			<fieldset>
			<section>
				<legend>Message</legend>

				<label>Titile</label>
				<input type="text" name="title">
				<br>

				<label>Text Area</label>
				<textarea type="text" name="content"></textarea>
				<br>

				
			</section>
			
			<input type="submit" value="Submit">
		</fieldset>
	</form> 
	<br>
	<!-- search部分 -->
	<form method="get" action="show.php">
		<fieldset>
			
				<label>Search</label>

				<input type="text" name="search" value="<?php echo $search?>">
				<br>
			
				<input type="submit" value="Search">
		</fieldset>
	</form>
</div>
</body>



</html>


<!-- 显示表单 -->
<?php
	// include "conn.php";//connect to db

	// //是否搜索
	// //search
	// $search = "";
	// if(!empty($_GET['search'])) {

	// 	$search = $_GET['search'];
	// 	$k = "`title` like '%$search%'";
	// 	//$sql = "select * from `bbs` where `title` like '%$search%'";
	// }
	// //不search
	// else $k=1;


	//设置分页
	$pageNumber = 5;
	//求记录总数
	
	$sql = "select * from `bbs` where $k"; //search and nono search total record
	$s = $conn->query($sql);
	$recordTotal = $s->num_rows;
	$pageTotal = ceil($recordTotal/$pageNumber); //总页数，向上取整

	if(empty($_GET['page'])){
		$page = 1;	//默认第一页
	}
	else{ 
		$page = $_GET['page'];
	}
	if($page>$pageTotal) $page = $pageTotal;	//下一页尾页限制


	$rStart = ($page-1)*$pageNumber;
	
	//var_dump($_GET);

	//取结果，包括search和不search
	$sql = "select * from `bbs` where $k order by time desc limit $rStart,$pageNumber";

	// echo $sql;
	$s = $conn->query($sql);
	// echo $conn->error;
	// echo $_COOKIE["logphone"];
	// echo "<br>Debug message:".$_COOKIE["nickname"]."<br>";
	
?>

	<p>
		<a href="show.php?filter=self">My posts</a>		| 	 
		<a href="show.php">Return to recommendations</a> 	| 	
	</p>
	
<?php
	

	//忽略在空表状态下fetch_array()产生的Error
	while (@$re = $s->fetch_array()) {
		
?>
<h3>Tittle:<?php echo $re['title']?></h3>
<!-- 在Author上添加超链接，用GET传递这个人的phone进行筛选 -->
<p>Nickname:  <a href = "show.php?filter=<?php echo $re["phone"] ?>"><?php echo $re['nickname']?></a> | Publish time:<?php echo $re['time']?> | IP:<?php echo $re['address']?></p>
<p>Content:  <?php echo $re['content']?></p>
<!-- TODO: 如果查看的不是自己发布的内容就根本不显示Edit与Delete连接 -->
<?php
	if($re["phone"]==$_COOKIE["logphone"])
	{
?>
<!-- 调用js -->
<p>
	<a href="edit.php?id=<?php echo $re['id'] ?>" >Edit</a>|
	<a href="javascript:do_del(<?php echo $re['id'] ?>)" >Delete</a></p>
<?php
	}
?>
<hr>

<?php
	}

	for($i=1; $i<=$pageTotal ; $i++){
			if($page==$i) echo "$i";
			else echo "<a href='show.php?page=$i&search=$search'>$i</a>";
			echo " ";
	}
?>


<br>
<a href="show.php?page=1&search=<?php echo $search?>">首页</a>
<?php 
	if($page!=1) {
?>
	<a href="show.php?page=<?php echo $page-1?>&search=<?php echo $search?>">上一页</a>
<?php 
	}
	if($page!=$pageTotal){
?>
<a href="show.php?page=<?php echo $page+1?>&search=<?php echo $search?>">下一页</a>
<?php
	}
?>
<a href="show.php?page=<?php echo $pageTotal?>&search=<?php echo $search?>">尾页</a>

  