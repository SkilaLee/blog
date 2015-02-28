 <html lang="en">
<head>
	<meta charset="UTF8" http-equiv="refresh" content="3;url=../html/index.php">
	<title>提交</title>
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
$style=$_POST['style'];
// switch($_POST['style']){
// 		case 0:
// 			$style="about study";
// 			break;
// 		case 1:
// 			$style="about mood";
// 			break;
// 		case 2:
// 			$style="Video";
// 			break;
// 		case 3:
// 			$style="Music";
// 			break;
// 	}
$message=$_POST['message'];
$title=$_POST['title'];
if ($message) {
	$count = $db -> exec("INSERT INTO `winter`.`blog_content` (`user_id`,`user_name`, `content_id`,`content_title`, `type`, `content`, `time`) VALUES ('$user_id','$user_name', NULL, '$title','$style', '$message', CURRENT_TIMESTAMP);");
if ($count) {
	header("refresh:3;url= ../html/index.php");
 	print('<h4>提交成功!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
}}else{
	header("refresh:3;url= ../index.php");
 	print('<h4>内容不能为空哦!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
}
 ?>

			
		</div>
	</div>
</body>
</html>