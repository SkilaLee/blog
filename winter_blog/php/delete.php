 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta http-equiv="refresh" content="3;url=../html/index.php">
 	<title>删除</title>
 	<style>
	#regi {
		width: 30%;
		height: 200px;
		background: #6689b4;
		border: 1px solid #17375e;
		margin-left: 36.5%;
		margin-top: 100px;
	}
	#div {
		margin: 14% 24%;	}
	h4 {
		margin: 10% 5%;
	}
	</style>
 </head>
 <body>
 	
	<div id="regi">
		<div id="div">
<?php 
	include"connect.php";
	$content_id=$_GET['content_id'];
	$db -> exec("delete from blog_content where content_id = '$content_id'");
 	if ($db) {
 		header("refresh:3;url= ../html/index.php");
 		print('<h4>删除成功!</h4><h4>三秒后自动跳转到主页面!</h4><h4><a href="../html/index.php">返回</a></h4>');
 	}
 ?>
 		</div>
	</div>
 </body>
 </html>
