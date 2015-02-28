<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" http-equiv="refresh" content="3;url=../html/index.php">
	<title>注册成功!</title>
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
		margin: 5px 33%;	}
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
			$username = $_POST['username'];
			$password = md5(md5($_POST['password'].'lizeyue'));
			if (!$username||!$password) {
				echo <<<STR
				<h4>用户名或密码不能为空!</h4>
				<form action="../index.php">
				<h4><input type="submit" name="submit" value="返回"/></h4>
			</form>
STR;
			header("refresh:3;url= ../html/index.php");
		 	print('<h4>三秒后自动跳转到注册页面!</h4>');
			}else{

			$count = $db -> exec("insert into blog_user(user_name,password) values('$username','$password')");
			if($count){
				$id=$db -> lastinsertid();
				echo <<<STR
			<h4>注册成功！</h4><br/>
			<h4>你的ID&nbsp;=&nbsp;{$id}</h4><br/>
			<form action="../html/index.php">
				<h4><input type="submit" name="submit" value="直接登录"/></h4>
			</form>
STR;
			}
			session_start();
			$_SESSION["id"]=$id;
			$_SESSION["name"]=$username;
			// setcookie("user_name", $username, time()+3600);
			// setcookie("user_id", $id, time()+3600);
		}
			?>
		</div>
	</div>
</body>
</html>