<?php 

class ConnDB{
	var $dbtype;
	var $host;
	var $user;
	var $pwd;
	var $dbname;



	// 参数说明:
	// $dbtype:连接数据库类型
	// $host:数据库服务器主机名或IP地址
	// $user:用户名
	// $pwd:密码
	// $dbname:数据库名称

	function ConnDB($dbtype,$host,$user,$pwd,$dbname){
		$this->dbtype=$dbtype;
		$this->host=$host;
		$this->user=$user;
		$this->pwd=$pwd;
		$this->dbname=$dbname;

	}
	function GetConnld(){
		if($this->dbtype=="mysql" || $this->dbtype=="mysql"){
			//判断数据库类型,根据类型定义DSN的值
			$dsn="$this->dbtype:host=$this->host;dbname=$this->dbname";
		}else{
			$dsn="$this->dbtype:dbname=$this->dbname";
		}
		try{
			$conn =new PDO($dsn,$this->user,$this->pwd);
			//初始化PDO对象,创建数据库连接对象$pdo
			$conn->query("set names utf8");   //设置编码格式
			return $conn;
		} catch(PDOException $e){
			die ("error!:".$e->getMessage()."<br/>");
		}
	}
}



class AdminDB{
	



	// 方法说明:
	//   执行sql语句

	//  参数说明:
	//  $sql:所要执行的sql语句
	//  $conn:数据库连接ID

	function ExecSQL($sqlstr,$conn){
		$sqltype=strtolower(substr(trim($sqlstr),0,6));
		$rs=$conn->prepare($sqlstr);          //准备查询语句
		$rs->execute();             //执行查询语句,并返回结果集
		if ($sqltype=="select"){
			$array=$rs->fetchAll(PDO::FETCH_ASSOC);          //获取结果集中的所有数据
			if (count($array)==0|| $rs==false) 
				return false;        //返回结果
			else
				return $array;           //返回数组结果集
			}elseif($sqltype=="update"||$sqltype=="insert" ||$sqltype=="delete"){     //如果是此类语句
		if ($rs) 
			return true;              //执行成功则返回true
		else
			return false;
		}
	}
}

class SepPage{
	var $rs;
	var $pagesize;
	var $nowpage;
	var $array;
	var $conn;
	var $sqlstr;

	//数据分页处理,并以数据形式返回分页信息

	//参数说明:
	//$sqlstr:所要执行的sql语句
	//$conn: 数据库连接ID
	//$pagesize:每页显示数据的条款
	//$nowpage: 当前显示的页数



	function ShowData($sqlstr,$conn,$pagesize,$nowpage){
		if (!isset($nowpage)||$nowpage=="") {   //判断变量是否为空
			$this->nowpage=1;     //定义每页起始页
		}else{
			$this->nowpage=$nowpage;
		}
			$this->pagesize=$pagesize; //定义每页输出的记录数
			$this->conn=$conn;                //连接数据库返回的标识
			$this->sqlstr=$sqlstr;           //执行的查询语句
			$offset=($this->nowpage-1)*$this->pagesize;
			$sql=$this->sqlstr." limit $offset,$this->pagesize";
			$result=$this->conn->prepare($sql);             //准备查询语句
			$result->execute();             //执行查询语句,并返回结果集
			$this->array=$result->fetchAll(PDO::FETCH_ASSOC);             //获取结果集中的所有数据
			if (count($this->array)==0||$this->array==false) {
				return false;
			}else{
				return $this->array;
			}
	}



	//方法说明:
	//创建数据分页输出的超级链接
	//参数说明:
	// $contentname:超级链接总称
	// $utits:超级链接中数据的单位
	// $anothersearchstr:超级链接传递的第一个参数
	// $anothersearchstrs:超级链接传递的第二个参数
	// $class:超级链接传递的样式
	function ShowPage($contentname,$utits,$anothersearchstr,$anothersearchstrs,$class){
		$str="";
		$res=$this->conn->prepare($this->sqlstr);          //准备查询语句
		$res->execute();                //执行查询语句  并返回结果集
		$this->array=$res->fetchAll(PDO::FETCH_ASSOC);          //获取结果集中的所有数据 
		$record=count($this->array);              //统计记录总数
		$pagecount=ceil($record/$this->pagesize);         //计算共有几页
		$str.=$contentname." ".$record." ".$utits."每页      ".$this->pagesize." ".$utits."第 ".$this->nowpage."   页/共 ".$pagecount."  页";
		$str.="   ";
		if ($this->nowpage!=1) {
			$str.="<a href=".$_SERVER['PHP_SELF']."?page=1&page_type=".$anothersearchstr."&parameter2=".$anothersearchstrs." class=".$class.">首页</a>";
		}else{
			$str.="<font color='#555555'>首页</font>";
		}
		$str.=" ";
		if ($this->nowpage!=1) {
			$str.="<a href=".$_SERVER['PHP_SELF']."?page=".($this->nowpage-1).  "&page_type=".$anothersearchstr."&parameter2=".$anothersearchstrs." class=".$class.">上一页</a>";
		}else{
			$str.="<font color='#555555'>上一页</font>";
		}
		$str.=" ";
		if ($this->nowpage!=$pagecount) {
			$str.="<a href=".$_SERVER['PHP_SELF']."?page=".($this->nowpage+1).  "&page_type=".$anothersearchstr."&parameter2=".$anothersearchstrs." class=".$class.">下一页</a>";
		}else{
			$str.="<font color='#555555'>下一页</font>";
		}
		$str.=" ";
		if ($this->nowpage!=$pagecount) {
			$str.="<a href=".$_SERVER['PHP_SELF']."?page=".$pagecount.  "&page_type=".$anothersearchstr."&parameter2=".$anothersearchstrs." class=".$class.">尾页</a>";
		}else{
			$str.="<font color='#555555'>尾页</font>";
		}
		if (count($this->array)==0||$this->array==false) {
			return "无数据!";
		}else{
			return $str;
		}
		
	}
	
}

?>









<!-- 

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
 -->