<?php
class SepPage{
var $db;	//pdo实例
var $sqlStr;	//数据库查询语句
var $nowPg;	//当前页
var $pageSize;	//每页显示的记录数

function ShowPage($db, $sqlStr, $pageSize, $nowPg){
$this->db = $db;
$this->sqlStr = $sqlStr;
$this->pageSize = $pageSize;
if (!isset($nowPg) || ($nowPg == '') || ($nowPg == 0)){
$nowPg = 1;
}
$this->nowPg = $nowPg;
$start = $pageSize * ($nowPg - 1);
$sqlStr .= " limit ".$start." , ".$pageSize;
$rst = $db->query($sqlStr);
if ($db->errorCode() != '00000'){
print_r($db->errorInfo());
exit();
}
$rstArr = $rst->fetchAll();
return $rstArr;
}

function PageNav($name, $unit, $class){
$rst = $this->db->query($this->sqlStr);
if ($this->db->errorCode() != '00000'){
print_r($this->db->errorInfo());
exit();
}
$rstArr = $rst->fetchAll();
$recordCount = count($rstArr);	//总的记录数
$lastPg = ceil($recordCount/$this->pageSize);	//尾页，即总的页数
$lastPg = $lastPg ? $lastPg : 1;	//没有显示条目，置最后页为1
$prePg = $this->nowPg - 1;
$nextPg = (($this->nowPg == $lastPg) ? 0 : ($this->nowPg + 1));

if ($lastPg <= 1){
return false;
}

$str = "共有".$name."&nbsp;".$recordCount."&nbsp;".$unit."，每页显示&nbsp;".$this->pageSize."&nbsp;".$unit;
$str .= "，第<select name='toPg' onchange='window.location=\"?page=\"+this.value'>\n";
for ($i=1; $i<=$lastPg; $i++){
if ($i == $this->nowPg){
$str .= "<option value='http://www.cnblogs.com/hasayaki/archive/2013/02/01/$i' selected>$i</option>\n";
}else{
$str .= "<option value='http://www.cnblogs.com/hasayaki/archive/2013/02/01/$i'>$i</option>\n";
}
}
$str .= "</select>页/共&nbsp;".$lastPg."&nbsp;页";

$str .= "&nbsp;&nbsp;&nbsp;&nbsp;";

if ($prePg){
$str .= "<a href=#?page=1"." class=".$class.">首页</a>";
$str .= "&nbsp;";
$str .= "<a href=#?page=".$prePg." class=".$class.">上一页</a>";
$str .= "&nbsp;";
}else{
$str .= "首页";
$str .= "&nbsp;";
$str .= "上一页";
$str .= "&nbsp;";
}

if ($nextPg){
$str .= "<a href=#?page=".$nextPg." class=".$class.">下一页</a>";
$str .= "&nbsp;";
$str .= "<a href=#?page=".$lastPg." class=".$class.">尾页</a>";
$str .= "&nbsp;&nbsp;&nbsp;&nbsp;";
}else{
$str .= "下一页";
$str .= "&nbsp;";
$str .= "尾页";
$str .= "&nbsp;&nbsp;&nbsp;&nbsp;";
}
return $str;
}
}

 

$dsn = 'mysql:host=localhost;dbname=winter';
$user = 'root';
$pwd = 'lzy';
try{
$db = new PDO($dsn, $user, $pwd, array(PDO::ATTR_PERSISTENT => true));
$db->exec('set names utf8');
}catch (PDOException $e){
echo "Error message:".$e->getMessage();
die();
}
?>