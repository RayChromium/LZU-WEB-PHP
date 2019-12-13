
<!-- admin登陆后应该能够进行两项活动：
1. 将某个post设置为精选
2. 对用户进行管理 -->

<?php

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
		$k= "1";		//Default : 查看所有的帖子
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
	function add_Recommend(id)
    {
        var is=window.confirm("Add this post to recommended list?");
        if(is)
        {
            window.location.href="addRecommend.php?id="+id;
        }
    }
	function remove_Recommend(id)
    {
        var is=window.confirm("Remove this post from the recommended list?");
        if(is)
        {
            window.location.href="removeRecommend.php?phone="+phone;
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
	<!-- search部分 -->
	<form method="get" action="adminShow.php">
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

	//设置分页
	$pageNumber = 5;
	//求记录总数
	
	$sql = "select * from `bbs` where $k"; //search and nono search total record
	// echo "<br>Debug message:".$sql."<br>";
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
	echo $_COOKIE["logphone"];
	// echo "<br>Debug message:".$sql."<br>";
	// echo "<br>Debug message:".$s ->fetch_array();

?>

<p> 
    <a href="adminUserManage.php">Manage Users</a>			

	<?php
		if(isset($_GET["search"]) || isset($_GET["filter"]))
		{
			?>
				|	<a href="adminShow.php">View All</a>
			<?php
		}
	?>
</p>

<?php
	
	while ($re = $s->fetch_array()) {
		
?>
<h3>Tittle:<?php echo $re['title']?></h3>
<!-- 在Author上添加超链接，用GET传递这个人的phone进行筛选 -->
<p>Nickname:  <a href = "adminShow.php?filter=<?php echo $re["phone"] ?>"><?php echo $re['nickname']?></a> | Publish time:<?php echo $re['time']?> | IP:<?php echo $re['address']?></p>
<p>Content:  <?php echo $re['content']?></p>


<!-- 调用js -->
<!-- TODO: 增加add Recommend和remove Recommend功能 -->
<p>
<?php
		if($re['isRec'] == 0)
		{
	?>
			<a href="javascript:add_Recommend(<?php echo $re['id'] ?>)">Add recommend</a>
	<?php
		}
		else
		{
	?>
			<a href="javascript:remove_Recommend(<?php echo $re['id'] ?>)">Remove recommend</a>
	<?php
		}
	?>
</p>
<hr>

<?php
	}

	//搜索状态下的分页跳转
	if(isset($_GET["search"]))
	{
		for($i=1; $i<=$pageTotal ; $i++){
				if($page==$i) echo "$i";
				else echo "<a href='adminShow.php?page=$i&search=$search'>$i</a>";
				echo " ";
		}
	}
	else if(isset($_GET["filter"]))
	{
		// 查看某特定用户（点击Nickname之后）的分页跳转
		for($i=1; $i<=$pageTotal ; $i++){
			if($page==$i) echo "$i";
			else echo "<a href='adminShow.php?page=$i&filter=".$_GET["filter"]."'>$i</a>";
			echo " ";
		}
	}
	// 查看全部Posts的页面跳转
	else
	{
		for($i=1; $i<=$pageTotal ; $i++){
			if($page==$i) echo "$i";
			else echo "<a href='adminShow.php?page=$i'>$i</a>";
			echo " ";
		}
	}
?>


<br>
<!-- 搜索状态下的首尾上下页 -->
<?php
	if(isset($_GET["search"]))
	{
?>
		<a href="adminShow.php?page=1&search=<?php echo $search?>">首页</a>
		<?php 
			if($page!=1) 
			{
		?>
				<a href="adminShow.php?page=<?php echo $page-1?>&filter=<?php echo $search?>">上一页</a>
		<?php 
			}
			if($page!=$pageTotal)
			{
		?>
				<a href="adminShow.php?page=<?php echo $page+1?>&search=<?php echo $search?>">下一页</a>
		<?php
			}
		?>
		<a href="adminShow.php?page=<?php echo $pageTotal?>&search=<?php echo $search?>">尾页</a>
<?php
	}
?>

<!-- 查看某特定用户post时的首尾上下页 -->
<?php
	if(isset($_GET["filter"]))
	{
?>
		<a href="adminShow.php?page=1&filter=<?php echo $_GET["filter"]?>">首页</a>
		<?php 
			if($page!=1) 
			{
		?>
				<a href="adminShow.php?page=<?php echo $page-1?>&filter=<?php echo $_GET["filter"]?>">上一页</a>
		<?php 
			}
			if($page!=$pageTotal)
			{
		?>
				<a href="adminShow.php?page=<?php echo $page+1?>&filter=<?php echo $_GET["filter"]?>">下一页</a>
		<?php
			}
		?>
		<a href="adminShow.php?page=<?php echo $pageTotal?>&filter=<?php echo $_GET["filter"]?>">尾页</a>
<?php
	}
?>

<!-- 查看所有Post状态下推荐的首尾上下页 -->
<?php
	if(!isset($_GET["filter"]) && !isset($_GET["search"]))
	{
?>
	<a href="adminShow.php?page=1">首页</a>
	<?php 
		if($page!=1) 
		{
	?>
			<a href="adminShow.php?page=<?php echo $page-1?>">上一页</a>
	<?php 
		}
		if($page!=$pageTotal)
		{
	?>
			<a href="adminShow.php?page=<?php echo $page+1?>">下一页</a>
	<?php
		}
	?>
	<a href="adminShow.php?page=<?php echo $pageTotal?>">尾页</a>
<?php
	}
?>