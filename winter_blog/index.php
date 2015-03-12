<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>blog</title>
	<link rel="stylesheet" href="css/index_style.css">
	<link rel="stylesheet" href="css/timeline.css">
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div id="main">
	<div id="header_out">
		<div id="header">
			<div id="header_left">
				<h1>blog</h1>
			</div>
			<div id="header_right">
				<li><button type="submit" href="#" id="zhuce">注册</button></li>
				<li><button type="submit" href="#" id="denglu">登陆</button></li>
			</div>
		</div>
	</div>
	<div id="body">
		<div id="body_left">
			<ul>
				<li><a href="#">日志管理</a></li>
				<li><a href="#">博客好友</a></li>
				<li><a href="#">访问统计</a></li>
				<li><a href="#">博客装扮</a></li>
				<li><a href="#">博客设计</a></li>
				<li><a href="#">更多<<</a></li>
			</ul>
		</div>
				<div class="body_right" style="display:block;">
			<div class="container">
				<ul id="timeline" class="timeline">
												<li class="active">
						<div class="thumb">
							<span>2015-02-20 08:08:08</span>
						</div>
						<s class="check">
						</s>
						<div class="timeline_content">
							<b></b>
							<h3>初始</h3>
							<p id="p" style="display:block;">welcome</p>
						</div>
					</li>
					<?php 
					include"php/connect.php";
					$result = $db->query("SELECT * FROM `blog_content`");
					foreach ($result as $value) {
						$content=$value['content'];
							echo <<<STR
							<li class="active">
						<div class="thumb">
							<span>{$value['time']}</span>
						</div>
						<s class="check">
						</s>
						<div class="timeline_content">
							<b></b>
							<h3>{$value['content_title']}</h3>
STR;
					print("<p id='p'> ".substr($content,0,80)."<a href='php/content1.php?content_id=".$value['content_id']."&expert_id=&page_t=1'>全文<<</a></p>
						</div>
					</li>");
							
					}
					 ?>					
				</ul>
			</div>
		</div>
		<div id="search">
			<form action="php/search1.php?expert_id= &page_t=1" method="post">
				<input name="search" type="text" class="form-control" placeholder="请按Ctrl+F键,谢谢">
				<input type="submit" value="search">
			</form>
		</div>
	</div>
</div>
	<div name="login" id="login">
		<span><a href="index.php">&times;</a></span>
		<form action="php/login.php" method="post">
			<table border=0 width='100%' height='100%'>
				<tr>
					<td align='right'>用户ID或者用户名：</td>
					<td><input type='text' name='user_id'></td>
				</tr>
				<tr>
					<td align='right'>密&nbsp;&nbsp;码：</td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td colspan=2 align='right' class="log"><input type='submit' value='登录'></td>
				</tr>
			</table>
		</form>
	</div>
	<div name="regi" id="regi">
		<span><a href="index.php">&times;</a></span>
		<form action="php/register.php" method="post">
			<table border=0 width='100%' height='100%'>
				<tr>
					<td align='right'>用户名：</td>
					<td><input type='text' name='username'></td>
				</tr>
				<tr>
					<td align='right'>密&nbsp;&nbsp;码：</td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td colspan=2 align='right' class="log"><input type='submit' value='注册'></td>
				</tr>
			</table>
		</form>
	</div><!-- 
	<div id="footer">
		It is produced by SkilaLee.
	</div> -->
</body>
</html>