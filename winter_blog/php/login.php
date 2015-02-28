	<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF8" http-equiv="refresh" content="3;url=../index.php">
	<title>登陆</title>
	<style>
	#logi {
		width: 30%;
		height: 200px;
		background: #6689b4;
		border: 1px solid #17375e;
		margin-left: 36.5%;
		margin-top: 100px;
	}
	#div {
		margin: 5px 24%;	}
	h4 {
		margin: 13% 1%;
	}
	</style>
</head>
<body>
	<div id="logi">
		<div id="div">
<?php 
	include"connect.php";
	$user_id = $_POST['user_id'];
	$password = md5(md5($_POST['password'].'lizeyue'));
	session_start();
	   
	// 可以发给两个
	// setcookie("user_id", $user_id, time()+360000);
	// $result = $db->query("select user_name from blog_user where user_id = '$user_id'");
	// foreach ($result as $value) {
	// 	$name = $value['user_name'];
	// }
		
	// setcookie("user_name", $name, time()+360000);
	//把数据拿出来
	$result = $db->query('select * from blog_user');
	foreach ($result as $value) {
		$user_id1  = $value['user_id'];
		$user_name  = $value['user_name'];
		$password1 =  $value['password'];
		//登陆验证
		if ($user_id == $user_name && $password == $password1 ) {
			$name=$user_name;
			// echo $name;
			$_SESSION["id"]=$user_id1;
			$_SESSION["name"]=$name;
			header('Location: ../html/index.php');
			break;
		}
		if ($user_id == $user_id1 && $password == $password1 ) {
			$name=$user_name;
			// echo $name;
			$_SESSION["id"]=$user_id;
			$_SESSION["name"]=$name;
			header('Location: ../html/index.php');
			break;
		}
		// elseif($user_id=$user_name && $password == $password1){
		// 	$name1=$user_name;
		// 	echo $name1;
		// 	$_SESSION["id"]=$user_id;
		// 	$_SESSION["name"]=$name1;
		// 	// header('Location: ../html/index.php');
		// 	break;
		// }else{
		// 	continue;;
		// }
			

	}
			header("refresh:3;url= ../index.php");
		 	print('<h4>用户名或者密码错误!</h4><h4>三秒后自动跳转到登陆页面!</h4>');

	?>
			<h4><a href="../index.php">返回登陆</a></h4>
		</div>
	</div>
</body>
</html>
