<?php
	
	// 准备数据库
	$dsn = "mysql:host=localhost;dbname=winter";
	$username = "root";
	$password = "lzy";

	// 构造PDO对象
	$db = new PDO(
				$dsn, 
				$username, 
				$password
			);

	// 设置数据库属性(抛出异常方式，数据库格式)
	$db->setAttribute(
				PDO::ATTR_ERRMODE, 
				PDO::ERRMODE_EXCEPTION
			);
	$db->exec('SET NAMES utf8');
 ?>