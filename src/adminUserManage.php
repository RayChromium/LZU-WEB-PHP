<?php

    // 显示所有的用户：
    include "welcome.php";
	include "conn.php";//connect to db
	
	
	//按照nickname搜索用户
	//search
	$search = "";
	if(!empty($_GET['search'])) {

		$search = $_GET['search'];
		$k = "`nickname` like '%$search%'";
		//$sql = "select * from `user` where `title` like '%$search%'";
	}
	else 
		$k= "1";		//Default : 查看所有用户

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<script type="text/javascript">
    function do_User_del(paraString)
    {
        var is=window.confirm("Delete this guy?");
        if(is)
        {
            window.location.href="userDel.php?phone="+paraString;
        }
    }
	function add_admin(paraString)
    {
        var is=window.confirm("Add this user to the manager group?");
        if(is)
        {
            window.location.href="addAdmin.php?phone="+paraString;
        }
    }
	function remove_admin(paraString)
    {
        var is=window.confirm("Remove this user from the manager group?");
        if(is)
        {
            window.location.href="removeAdmin.php?phone="+paraString;
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

<body bgcolor="lavender">
<div id="survey">
    <!-- 搜索用户： -->
    <form method="get" action="adminUserManage.php">
    		<fieldset>
        
    				<label>Search User By Nickname </label>

    				<input type="text" name="search" value="<?php echo $search?>">
    				<br>
        
    				<input type="submit" value="Search">
    		</fieldset>
    </form>
</div>
</body>

<?php

	//设置分页
	$pageNumber = 5;
	//求记录总数
	
	$sql = "select * from `user` where $k"; //search and nono search total record
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

	//存储URL，用于某些操作后返回原页面
	$url = $_SERVER["REQUEST_URI"];
	// $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	// $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url = str_replace("/WEB_SHIT/src/","",$url);
	// $url = str_replace("&","\&",$url);
	echo "Debug Message - Current URL : ".$url."<br>";
	

	$rStart = ($page-1)*$pageNumber;
	
	//var_dump($_GET);

	//取结果，包括search和不search
	$sql = "select * from `user` where $k order by `birthdate` desc limit $rStart,$pageNumber";

	// echo $sql;
	$s = $conn->query($sql);
	// echo $conn->error;
	echo $_COOKIE["logphone"];
	// echo "<br>Debug message:".$sql."<br>";
	// echo "<br>Debug message:".$s ->fetch_array();

?>
<h2> User Management Page</h2>
<p>
    <!-- 返回帖子管理页面 -->
	<a href="adminShow.php">Manage Posts</a>
	<!-- 如果正在搜索状态，添加一个返回查看全部用户的超链接 -->
	<?php
		if(isset($_GET["search"]))
		{
	?>
			|<a href="adminUserManage.php">View All Users</a>
	<?php
		}
	?>
</p>

<?php
	// echo "Debug mesage: ".$sql;
	while ($re = $s->fetch_array()) {
		
?>
<h3>Phone( Primary Key ):<?php echo $re['phone']?></h3>
<h2>Nickname:<?php echo $re['nickname']?></h2> 
<p>Sex:<?php echo $re['sex']?></p> 
<p>Admin? :<?php 
    if($re["admin"] == 1)
    {
        echo "Yes";
    }
    else
    {
        echo "No";
    }
    ?>  </p>
<p>Email:<a href="mailto:<?php echo $re['email']?>"><?php echo $re['email']?></a></p>


<!-- 调用js -->
<!-- TODO：整一个用户管理 -->
<!-- TODO: add admin功能，将特定用户的`admin`字段变为1  -->
<p>
	<!-- admin不能删除自己的账号或者将自己移出admin组 -->
	<?php
		if($re["phone"] != $_COOKIE["logphone"])
		{
	?>
			<a href="javascript:do_User_del('<?php echo $re['phone']."\&returnUrl="."$url" ?>')" >Delete</a>	
	<?php
		}
	?>
	<?php
		if($re['admin'] == 0)
		{
	?>
			|	<a href="javascript:add_admin('<?php echo $re['phone']."\&returnUrl="."$url" ?>')">Add admin</a>
	<?php
		}
		else if($re['phone'] != $_COOKIE["logphone"])
		{
	?>
			|	<a href="javascript:remove_admin('<?php echo $re['phone']."\&returnUrl="."$url" ?>')">Remove admin</a>
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
				else echo "<a href='adminUserManage.php?page=$i&search=$search'>$i</a>";
				echo " ";
		}
	}
	//查看所有用户的分页跳转
	else{
		for($i=1; $i<=$pageTotal ; $i++){
			if($page==$i) echo "$i";
			else echo "<a href='adminUserManage.php?page=$i'>$i</a>";
			echo " ";
		}
	}
?>


<br>
<?php
	if(isset($_GET["search"]))
	{
?>
		<a href="adminUserManage.php?page=1&search=<?php echo $search?>">首页</a>
		<?php 
			if($page!=1) {
		?>
			<a href="adminUserManage.php?page=<?php echo $page-1?>&search=<?php echo $search?>">上一页</a>
		<?php 
			}
			if($page!=$pageTotal){
		?>
		<a href="adminUserManage.php?page=<?php echo $page+1?>&search=<?php echo $search?>">下一页</a>
		<?php
			}
		?>
		<a href="adminUserManage.php?page=<?php echo $pageTotal?>&search=<?php echo $search?>">尾页</a>
<?php
	}
?>

<?php
	if(!isset($_GET["search"]))
	{
?>
		<a href="adminUserManage.php?page=1">首页</a>
		<?php 
			if($page!=1) {
		?>
			<a href="adminUserManage.php?page=<?php echo $page-1?>">上一页</a>
		<?php 
			}
			if($page!=$pageTotal){
		?>
		<a href="adminUserManage.php?page=<?php echo $page+1?>">下一页</a>
		<?php
			}
		?>
		<a href="adminUserManage.php?page=<?php echo $pageTotal?>">尾页</a>
<?php
	}
?>