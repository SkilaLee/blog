<?php 
// class SepPage{
// 	var $rs;
// 	var $pagesize;
// 	var $nowpage;
// 	var $array;
// 	var $conn;
// 	var $sqlstr;

// 	//数据分页处理,并以数据形式返回分页信息

// 	//参数说明:
// 	//$sqlstr:所要执行的sql语句
// 	//$conn: 数据库连接ID
// 	//$pagesize:每页显示数据的条款
// 	//$nowpage: 当前显示的页数



// 	function ShowData($sqlstr,$conn,$pagesize,$nowpage){
// 		if (!isset($nowpage)||$nowpage=="") {   //判断变量是否为空
// 			$this->nowpage=1;     //定义每页起始页
// 		}else{
// 			$this->nowpage=$nowpage;
// 			$this->pagesize=$pagesize; //定义每页输出的记录数
// 			$this->conn=$conn;                //连接数据库返回的标识
// 			$this->sqlstr=$sqlstr;           //执行的查询语句
// 		}
// 			$offset=($this->nowpage-1)*$this->pagesize;
// 			$sql=$this->sqlstr." limit $offset,$this->page";
// 			$result=$this->conn->prepare($sql);             //准备查询语句
// 			$result->execute();             //执行查询语句,并返回结果集
// 			$this->array=$result->fetchAll(PDO::FETCH_ASSOC);             //获取结果集中的所有数据
// 			if (count($this->array)==0||$this->array==false) {
// 				return false;
// 			}else{
// 				return $this->array;
// 			}
// 	}
// }









$cat=isset($_GET['cat'])?$_GET['cat']:"1";
$pg=isset($_GET['pg'])?$_GET['pg']:"1";
$limit=10;
$dbname='shelf.sqlite';
try{
	$db=new PDO("sqlite:".$dbname);
	$sth=$db->prepare('select * from blog_content',array(
		PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
	$result=$sth->execute(array(
		':id'=>$cat,
		':offset'=>($pg-1)*$limit,
		':limit'=>$limit
		));
	$list=array();
	$query=$db->query('select count(*) from blog_content'.$cat)->fetch();    //only 1 row
	$list["count"]=$query[0];
	if ($result) {
		while ($row=$sth->fetch(PDO::FETCH_ASSOC)) {
			$list["bokks"][]=$row;
		}
	}else{
		print_r($db->errorinfo());
	}
	$db=NULL;
	echostr_replace('   /','/',json_encode($list);
}catch(PDOException $ex){
	print_r($ex);
}

 ?>