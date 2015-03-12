<?php 
	session_start();
	$user_id =  $_SESSION['id'];
	$user_name =  $_SESSION['name'];
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
			<li>博客好友</li>
			<li>访问统计</li>
			<li>博客设计</li>
			<li>更多<<</li>
			</ul>
		</div>
		<div class="body_right" style="display:block;">
			<div class="container">
				<ul id="timeline" class="timeline">
					<li class="active" onmouseover="document.getElementById('p').style.display='block';"
	onmouseout="document.getElementById('p').style.display='none';">
						<div class="thumb">
							<p>10:00</p>
						</div>
						<div class="check">
						</div>
						<div class="timeline_content">
							<b></b>
							<h3>傻逼傻逼</h3>
							<p id="p">content脉门开垦了妇科偶然买这款妙湛二卷吹么重点是msmdmvsmvklldsm.s算三c.scmkdsd.d.d岑晊,nsckjdwdncak,惺忪耐看从无脑儿<a href="#">全文<<</a></p>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="body_right">
			<div class="write">
				<h4><a class="label label-info" href="">写点什么吧~</a></h4>
				<form action="php/sendMessage.php" method = "post">
					<select class="style" name = "style">
					  <option value="about study">about study</option>
					  <option value="about mood">about mood</option>
					  <option value="Video">Video</option>
					  <option value="Music">Music</option>
					</select>
					<input type="text" name="title" placeholder="标题"/>
					<textarea  name = "message" class="form-control" rows="4" placeholder="正文"></textarea>
					<button type="submit" class="sublime">提交</button>
				</form>
			</div>
		</div>
		<div class="body_right">
			<div id="tab">
				<div id="div1">
					<input class="active" type="button" value="about study"/>
					<input type="button" value="about mood"/>
					<input type="button" value="Video"/>
					<input type="button" value="Music"/>
				</div>
				<div class="journal" style="display:block;">
					<span>xx:</span>
					<div class="content">
						<p>日志内容1</p>
					</div>
					<div class="time">
						<span>时间</span>
						<a class="pinglun" href="#">评论</a>
						<a href="#">编辑</a>
						<a href="#">删除</a>
						<div class="reply">
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
						</div>
						<div class="discu">
							<form name="input" action="#" method="get">
							<input type="text" name="user" />
							<input type="submit" value="发表" />
							</form>
						</div>
					</div>
				</div>
				<div class="journal" 
					<span>xx:</span>
					<div class="content">
						<p>日志内容2</p>
					</div>
					<div class="time">
						<span>时间</span>
						<span><a class="pinglun" href="#">评论</span></a>
						<div class="reply">
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
						</div>
						<div class="discu">
							<form name="input" action="#" method="get">
							<input type="text" name="user" />
							<input type="submit" value="发表" />
							</form>
						</div>
					</div>
				</div>
				<div class="journal" 
					<span>xx:</span>
					<div class="content">
						<p>日志内容3</p>
					</div>
					<div class="time">
						<span>时间</span>
						<span><a class="pinglun" href="#">评论</span></a>
						<div class="reply">
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
						</div>
						<div class="discu">
							<form name="input" action="#" method="get">
							<input type="text" name="user" />
							<input type="submit" value="发表" />
							</form>
						</div>
					</div>
				</div>					
				<div class="journal" 
					<span>xx:</span>
					<div class="content">
						<p>日志内容4</p>
					</div>
					<div class="time">
						<span>时间</span>
						<span><a class="pinglun" href="#">评论</span></a>
						<div class="reply">
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
						</div>
						<div class="discu">
							<form name="input" action="#" method="get">
							<input type="text" name="user" />
							<input type="submit" value="发表" />
							</form>
						</div>
					</div>
				</div>					
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
				<div class="jour" style="display:block;">
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
							<a name="a" href="#a" class="ping">评论</a>
							<a href="#">编辑</a>
							<a href="#">删除</a>
							<div class="reply">
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							</div>
							<div class="discu">
								<form name="input" action="#" method="get">
								<input type="text" name="user" />
								<input type="submit" value="发表" />
								</form>
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
				<div class="jour" >
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
							<a name="a" href="#a" class="ping">评论</a>
							<a href="#">编辑</a>
							<a href="#">删除</a>
							<div class="reply">
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							</div>
							<div class="discu">
								<form name="input" action="#" method="get">
								<input type="text" name="user" />
								<input type="submit" value="发表" />
								</form>
							</div>
						</div>
					</div>
STR;
						if ($i==0) {
							echo "这个栏目没有日志哦~";
						}
					}
					 ?>		
				</div>
				<div class="jour" >
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
							<a name="a" href="#a" class="ping">评论</a>
							<a href="#">编辑</a>
							<a href="#">删除</a>
							<div class="reply">
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							</div>
							<div class="discu">
								<form name="input" action="#" method="get">
								<input type="text" name="user" />
								<input type="submit" value="发表" />
								</form>
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
				<div class="jour" >
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
							<a name="a" href="#a" class="ping">评论</a>
							<a href="#">编辑</a>
							<a href="#">删除</a>
							<div class="reply">
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
								<p>xx回复xx:回复内容<span class="span"><a href="#">回复</a></span></p>
							</div>
							<div class="discu">
								<form name="input" action="#" method="get">
								<input type="text" name="user" />
								<input type="submit" value="发表" />
								</form>
							</div>
						</div>
					</div>
STR;
						if ($i==0) {
							echo "这个栏目没有日志哦~";
						}
					}
					 ?>		
				</div>
			</div>
		</div>
		<div class="body_right">
					var tab=document.getElementById('tab');
 		var aBtn1=tab.getElementsByTagName('input');
 		var iDiv1=document.getElementsByClassName('jour');
 		for(var i=0;i<aBtn1.length;i++)
 		{
 			aBtn1[i].index=i;
 			aBtn1[i].onclick= function ()
 			{
 				for (var i = 0; i <aBtn1.length; i++)
 				{
 					aBtn1[i].className='';
 					iDiv1[i].style.display='none';
 				}
 				//aDiv[i].style.display='block';
 				this.className='active';
 				iDiv1[this.index].style.display='block';
 			};
 		}
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
<div id="login">
	<span><a href="index.html">&times;</a></span>
	<form action="php/login.php" method="post">
		<table border=0 width='100%' height='100%'>
			<tr>
				<td align='right'>用户ID：</td>
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
<div id="regi">
	<span><a href="index.html">&times;</a></span>
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
</div>
<div id="footer">
	<p>This is by SkilsLe.</p>
</div>
</body>
</html>