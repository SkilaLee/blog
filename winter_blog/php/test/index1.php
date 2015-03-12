<?php 
	include"php/connect.php";
	session_start();
	$user_id =  $_SESSION['id'];
	$user_name =  $_SESSION['name'];
		require("php/system.class.inc.php");     
	$connobj=new ConnDB("mysql","localhost","root","lzy","winter");           //数据库连接实例化
	$conn=$connobj->GetConnld();             //执行连接操作,返回连接标识
	$admindb=new AdminDb();          //数据库操作类实例化
	$seppage=new SepPage();            //分页类实例化
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}else{
		$page=1;
	}

	?>
<html>
<head>
	<meta charset="utf-8">
	<title>blog</title>
	<link rel="stylesheet" href="css/index_style.css">
	<link rel="stylesheet" href="css/tab.css">
	<link rel="stylesheet" href="css/timeline.css">
	<script type="text/javascript" src="js/tab.js"></script>
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
				<a href="php/upload.php"><img src="php/pic/pic<?php echo $user_id;?>.jpg"  onError="this.src='php/pic/default.jpg';"/></a>
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
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` = '$user_id'");
					foreach ($result as $value) {
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
							<p id="p">{$value['content']}<a href="#">全文<<</a></p>
						</div>
					</li>
STR;
					}
					 ?>					
				</ul>
			</div>
		</div>
		<div class="body_right">
			<div class="write">
				<h4 class="label label-info">写点什么吧~</h4>
				<form action="php/sendMessage.php" method = "post">
					<select class="style" name = "style">
					  <option value="about study">about study</option>
					  <option value="about mood">about mood</option>
					  <option value="about video">about video</option>
					  <option value="about music">about music</option>
					</select>
					<input type="text" name="title" placeholder="标题"/>
					<textarea  name = "message" class="form-control" rows="29" placeholder="正文"></textarea>
					<button type="submit" class="sublime">提交</button>
				</form>
			</div>
		</div>

		<div class="body_right">
			<div id="tab">
				<div id="div1">
					<input class="active" type="button" value="about study"/>
					<input type="button" value="about mood"/>
					<input type="button" value="about video"/>
					<input type="button" value="about music"/>
				</div>
				<div class="journal" style="display:block;">
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` = '$user_id' AND `type` LIKE 'about study'");
					foreach ($result as $value) {
						$i++;
							echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<a href="php/edit.php?content_id={$value['content_id']}">编辑</a>
							<a href="php/delete.php?content_id={$value['content_id']}">删除</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
							<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}<a href="php/delete_discuss.php?discuss_id={$value1['discuss_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
								<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$value2['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
						
// }对{$value['user_name']
}
if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>
				</div>
				<div class="journal" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` = '$user_id' AND `type` LIKE 'about mood'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<a href="php/edit.php?content_id={$value['content_id']}">编辑</a>
							<a href="php/delete.php?content_id={$value['content_id']}">删除</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
							<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}<a href="php/delete_discuss.php?discuss_id={$value1['discuss_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
								<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$value2['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}
						if ($i==0) {
							echo "这个栏目没有日志哦~";
						}
					
					 ?>		
				</div>
				<div class="journal" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` = '$user_id' AND `type` LIKE 'about video'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<a href="php/edit.php?content_id={$value['content_id']}">编辑</a>
							<a href="php/delete.php?content_id={$value['content_id']}">删除</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
							<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}<a href="php/delete_discuss.php?discuss_id={$value1['discuss_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
								<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$value2['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}
if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>
				</div>
				<div class="journal" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` = '$user_id' AND `type` LIKE 'about music'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<a href="php/edit.php?content_id={$value['content_id']}">编辑</a>
							<a href="php/delete.php?content_id={$value['content_id']}">删除</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
							<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}<a href="php/delete_discuss.php?discuss_id={$value1['discuss_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
								<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$value2['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}
						if ($i==0) {
							echo "这个栏目没有日志哦~";
						}
					 ?>		
				</div>
			</div>	
		</div>
		<div class="body_right">
			<div id="tab">
				<div id="div2">
					<input class="active" type="button" value="about study"/>
					<input type="button" value="about mood"/>
					<input type="button" value="about video"/>
					<input type="button" value="about music"/>
				</div>
				<div class="journ" style="display:block;">
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` != '$user_id' AND `type` LIKE 'about study'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
								<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}
STR;
							if ($user_id==$value1['user_id']) {
								print("<a href='php/delete_discuss.php?discuss_id={$value1['discuss_id']}'>删除</a>");
							}
								echo <<<STR
							<a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
									<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><p class="span">
STR;
							if ($user_name==$value2['user_name']) {
								print("<a href='php/delete_reply.php?reply_id={$value2['reply_id']}'>删除</a>");
							}
								echo <<<STR
								<a class="hui" href="#reply">回复</a><span>{$value2['time']}</span></p>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}
if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>
				</div>
				<div class="journ" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` != '$user_id' AND `type` LIKE 'about mood'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
								<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}
STR;
							if ($user_id==$value1['user_id']) {
								print("<a href='php/delete_discuss.php?discuss_id={$value1['discuss_id']}'>删除</a>");
							}
								echo <<<STR
							<a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
									<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><p class="span">
STR;
							if ($user_name==$value2['user_name']) {
								print("<a href='php/delete_reply.php?reply_id={$value2['reply_id']}'>删除</a>");
							}
								echo <<<STR
								<a class="hui" href="#reply">回复</a><span>{$value2['time']}</span></p>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>		
				</div>
				<div class="journ" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` != '$user_id' AND `type` LIKE 'about video'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
								<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}
STR;
							if ($user_id==$value1['user_id']) {
								print("<a href='php/delete_discuss.php?discuss_id={$value1['discuss_id']}'>删除</a>");
							}
								echo <<<STR
							<a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
						$res = $seppage->ShowData("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'",$conn,2,$page);      //执行查询语句
	for ($i=0; $i < count($res); $i++) {           //循环输出查询结果
		$echo=$seppage->ShowPage("评论","条",$_GET['page_type'],    '',"a");
         
echo <<<STR
			<p>{$res[$i]['user_name']}对{$res[$i]['friend_name']}说: {$res[$i]['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$res[$i]['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
			<div name="reply" class="reply_sub">
				<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$res[$i]['user_id']}" method="post">
					<input type="text" name="reply"  placeholder="{$user_name}对{$res[$i]['user_name']}说:"/>
					<input type="submit" value="发表"/>
				</form>
			</div>



STR;
} echo $echo;

					
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}
if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>
				</div>
				<div class="journ" >
					<?php 
					$i=0;
					$result = $db->query("SELECT * FROM `blog_content` WHERE `user_id` != '$user_id' AND `type` LIKE 'about music'");
					foreach ($result as $value) {
						$i++;
								echo <<<STR
					<div class="jour">
						<span>{$value['user_name']}:</span>
						<div class="content">
							<h3>{$value['content_title']}</h3>
							<p>{$value['content']}</p>
						</div>
						<div class="time" >
							<span>{$value['time']}</span>
							<a href="#a" class="ping">评论</a>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
								<input type="text" name="discuss" placeholder="{$user_name}说:"/>
								<input type="submit" value="发表" />
								</form>
							</div>
							<div class="reply">
STR;
					$content_id=$value['content_id'];
					$result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
					foreach ($result1 as $value1) {
							echo <<<STR
								<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}
STR;
							if ($user_id==$value1['user_id']) {
								print("<a href='php/delete_discuss.php?discuss_id={$value1['discuss_id']}'>删除</a>");
							}
								echo <<<STR
							<a class="hui" href="#reply">回复</a></span>
							<div class="huifu">
								<div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
									<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
									<input type="submit" value="回复"/>
								</form>
							</div>
STR;
					$friend_name=$value1['friend_name'];
					$discuss_id=$value1['discuss_id'];
					$result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
					foreach ($result2 as $value2) {
							echo <<<STR
									<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><p class="span">
STR;
							if ($user_name==$value2['user_name']) {
								print("<a href='php/delete_reply.php?reply_id={$value2['reply_id']}'>删除</a>");
							}
								echo <<<STR
								<a class="hui" href="#reply">回复</a><span>{$value2['time']}</span></p>
							    <div name="reply" class="reply_sub">
									<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
										<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
										<input type="submit" value="发表"/>
									</form>
								</div>
STR;
}
							echo <<<STR
						</div>
STR;
//难点啊!!!!!到底是对谁说嘛??!!!!
}
							echo <<<STR
							</div>
							
						</div>
					</div>	
STR;
}if ($i==0) {
	echo "这个栏目没有日志哦~";
}
					 ?>
				</div>
			</div>	
		</div>
		<div class="body_right">
			第五段<p>ndidjsdvj</p>
		</div>
		<div class="body_right">
			第六段<p>ndidjsdvj</p>
		</div>
		<div class="body_right">
			第七段<p>ndidjsdvj</p>
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