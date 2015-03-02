 <html lang="en">
<head>
	<meta charset="UTF8" http-equiv="refresh" content="3;url=../html/index.php">
	<title>修改</title>
	<style>
	#sub {
		width: 30%;
		height: 200px;
		background: #6689b4;
		border: 1px solid #17375e;
		margin-left: 36.5%;
		margin-top: 100px;
	}
	#div {
		margin: 7% 26%;	}
	h4 {
		margin: 16% 1%;
	}
	</style>
</head>
<body>
	<div id="sub">
		<div id="div">
<?php 
include"connect.php";
session_start();
$user_id =  $_SESSION['id'];
$user_name =  $_SESSION['name'];
$reply=$_POST['reply'];
$discuss_id=$_GET['discuss_id'];
$friend_id=$_GET['friend_id'];
// echo $discuss_id.$friend_id;
	$result = $db->query("SELECT * FROM `blog_user` WHERE `user_id` = '$friend_id'");
	foreach ($result as $value) {
		$friend_name=$value['user_name'];
		// echo $friend_name ;
}
	$count = $db -> exec("INSERT INTO `winter`.`reply` (`discuss_id`,`user_id`,`user_name`, `friend_id`,`friend_name`, `reply`,  `time`) VALUES ('$discuss_id','$user_id','$user_name','$friend_id','$friend_name','$reply',  CURRENT_TIMESTAMP);");
	if ($count) {
		header("refresh:3;url= ../html/index.php");
 		print('<h4>回复成功!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
	}else{
	header("refresh:3;url= ../index.php");
 	print('<h4>回复失败!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
}
 ?>
		</div>
	</div>
</body>
</html>