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
$content_id=$_GET['content_id'];
$user_id =  $_SESSION['id'];
$user_name =  $_SESSION['name'];
$style=$_POST['style'];
$message=$_POST['message'];
$title=$_POST['title'];
if ($message) {
	$count = $db -> exec("UPDATE `winter`.`blog_content` SET `content_title` = '$title', `type` = '$style', `content` = '$message' WHERE `blog_content`.`content_id` = '$content_id';");
if ($count) {
	header("refresh:3;url= ../html/index.php");
 	print('<h4>修改成功!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
}}else{
	header("refresh:3;url= ../index.php");
 	print('<h4>内容不能为空哦!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
}
 ?>

			
		</div>
	</div>
</body>
</html>