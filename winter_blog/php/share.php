<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
</head>
<body>
	<div id="ckepop">
		<span class="jiathis_txt">
			分享到:
		</span>
		<a  class="jiatjia_button_tsina">
			新浪微博
		</a>
		<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
		<a class="jiathis_counter_style"></a>
	</div>
	<script >
	</script>
	<?php 
		include"connect.php";
		// function ShowData($sqlstr,$conn,$pagesize,$nowpage){
		if (!isset($nowpage)||$nowpage=="") {   //判断变量是否为空
			$this->nowpage=1;     //定义每页起始页
		}else{
			$this->nowpage=$nowpage;
			$this->pagesize=$pagesize; //定义每页输出的记录数
			$this->conn=$conn;                //连接数据库返回的标识
			$this->sqlstr=$sqlstr;           //执行的查询语句
		}
			$offset=($this->nowpage-1)*$this->pagesize;
			$sql=$this->sqlstr." limit $offset,$this->page";
			$result=$this->conn->prepare("SELECT * FROM `blog_content`");             //准备查询语句
			$result->execute();             //执行查询语句,并返回结果集
			$this->array=$result->fetchAll(PDO::FETCH_ASSOC);             //获取结果集中的所有数据
	 		if (count($this->array)==0||$this->array==false) {
	 			echo "yes";
				// return false;
			}else{
				// return $this->array;
				echo "no";
			}
// }
	 ?>
</body>
</html>