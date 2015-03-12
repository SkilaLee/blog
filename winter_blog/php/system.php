<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

	require("system.class.inc.php");     
	$connobj=new ConnDB("mysql","localhost","root","lzy","winter");           //数据库连接实例化
	$conn=$connobj->GetConnld();             //执行连接操作,返回连接标识
	$admindb=new AdminDb();          //数据库操作类实例化
	$seppage=new SepPage();            //分页类实例化
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}else{
		$page=1;
	}

	$res = $seppage->ShowData("select * from reply ",$conn,1,$page);      //执行查询语句
	for ($i=0; $i < count($res); $i++) {           //循环输出查询结果
?>
 
<table width="636" height="134" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="35">评论人:<?php echo $res[$i]['user_name'];?></td>
		<td width="156" height="35">被评论人:<?php echo $res[$i]['friend_name'];?></td>
		<td width="157">留言内容:<?php echo $res[$i]['reply'];?></td>
	</tr>


<?php } ?>
	<tr>
		<td height="25"><?php echo $seppage->ShowPage("评论","条",$_GET['page_type'],    '',"a");?></td>
	</tr>
</table>	
</body>
</html>
					<!-- <div class="jour">
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
							<div class="reply">
								<p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}<a href="php/delete_discuss.php?discuss_id={$value1['discuss_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
								<div class="huifu">
									<div name="reply" class="reply_sub">
										<form name="input" action="php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
											<input type="text" name="reply"  placeholder="{$user_name}对{$value1['user_name']}说:"/>
											<input type="submit" value="回复"/>
										</form>
									</div>
									<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span class="span">{$value2['time']}<a href="php/delete_reply.php?reply_id={$value2['reply_id']}">删除</a><a class="hui" href="#reply">回复</a></span>
									<div name="reply" class="reply_sub">
										<form name="input" action="php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
											<input type="text" name="reply"  placeholder="{$user_name}对{$value2['user_name']}说:"/>
											<input type="submit" value="发表"/>
										</form>
									</div>
								</div>
							</div>
							<div name="a" class="discu">
								<form name="input" action="php/discuss.php?content_id={$content_id}" method="post">
									<input type="text" name="discuss" placeholder="{$user_name}说:"/>
									<input type="submit" value="发表" />
								</form>
							</div>
						</div>
					</div>	 -->