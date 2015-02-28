<?php 
	include"connect.php";
	session_start();
	$user_id =  $_SESSION['id'];
	$user_name =  $_SESSION['name'];
	$content_id=$_GET['content_id'];
	?>
<html>
<head>
	<meta charset="utf-8">
	<title>blog</title>
	<link rel="stylesheet" href="../css/index_style.css">
	<link rel="stylesheet" href="../css/tab.css">
	<link rel="stylesheet" href="../css/timeline.css">
</head>
<body>
<div id="main">
	<div id="header_out">
		<div id="header">
			<div id="header_left">
				<h1>blog</h1>
			</div>
			<div id="header_right">
				
				<li><a href="php/cancel.php">注销登陆</a></li>
				<li><a href="#">消息</a></li>
				<li><a href="#">关于我</a></li>
				<li><a href="#"><?php echo $user_name;?></a></li>
				<a href="../php/upload.php"><img src="../php/pic/pic<?php echo $user_id;?>.jpg"  onError="this.src='../php/pic/default.jpg';"/></a>
			</div>
		</div>
	</div>
	<div id="body">
		<div id="body_left">
			<ul>
			<li class="active">主页</li>
			<li>写日志</li>
			<li>日志管理</li>
			<li>好友博客</li>
			<li>访问统计</li>
			<li>博客设计</li>
			<li>更多<<</li>
			</ul>
		</div>
		<div class="body_right" style="display:block;">
			<div class="write">
				<h4><a class="label label-info" href="">修改</a></h4>
				<form action="editPHP.php?content_id=<?php echo $content_id;?>" method = "post">
					<select class="style" name = "style">
					  <option value="about study">about study</option>
					  <option value="about mood">about mood</option>
					  <option value="about video">about video</option>
					  <option value="about music">about music</option>
					</select>
					<?php 
					$result = $db->query("SELECT * FROM `blog_content` WHERE `content_id` = '$content_id'");
					foreach ($result as $value) {
							echo <<<STR
					<input type="text" name="title" value="{$value['content_title']}"/>
					<textarea  name = "message" class="form-control" rows="29">{$value['content']}</textarea>
STR;
}
?>
					<button type="submit" class="sublime">提交</button>
				</form>
			</div>
		</div>
		<div id="search">
			<input type="text" class="form-control" placeholder="请按Ctrl+F键,谢谢">
	    	<button type="submit" class="btn btn-default">Submit</button>
		</div>		
	</div>
</div>
<div id="footer">
	<p>This is by SkilsLe.</p>
</div>
</body>
</html>