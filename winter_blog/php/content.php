<?php 
	include"../php/connect.php";
	session_start();
	$user_id =  $_SESSION['id'];
	$user_name =  $_SESSION['name'];
    $content_id=$_GET['content_id'];
	?>
	<?php    
    function ff_page($content,$page)    
    {    
    global $expert_id;  
    $content_id=$_GET['content_id'];
    if (empty($page)) {
         $page = 1 ;
    }  //给$page赋初始值
    
    $PageLength = 3000; //每页字数    
    $CLength = strlen($content);  //文章长度  
    $PageCount = floor(($CLength / $PageLength)) + 1; //计算页数    
    $PageArray=array();//断页位置数组      
    $Seperator = array("\n","\r","。","!","?",";",",","”","’",".","！","？","；"); //分隔符号    
    
    //echo "页数：".$PageCount."<br \>";    
    //echo "长度：".$CLength."<br \>";    
    //strpos() 函数返回字符串在另一个字符串中第一次出现的位置    
    
    if($CLength <= $PageLength)    
     {    
        echo $content;    
     }//如果只有一页，直接打印
       else{    
        $PageArray[0]=0;    
        $Pos = 0;    
        $i=0;    
     //第一页，print_r($Seperator);   
    for( $j=0 ; $j < sizeof($Seperator); $j++)    
       {    
      $Pos=strpos($content,$Seperator[$j],$PageArray[$i]+2900);  
      while($Pos > 0 && $Pos<($i+1)*$PageLength && $Pos > $i*$PageLength )    
      {    
     $PageArray[$i] = $Pos ;
     if ($Pos+$PageLength > $CLength)
     {
         $start_p = $CLength-1 ;   
     }
     else{
         $start_p = $Pos+$PageLength ;
     }
     //给一个找寻位置的起始点，防止超过位置总字符数    
     $Pos = strpos($content,$Seperator[$j],$start_p) ;     
      } 
        //如果已经找到分页点，跳出循环
        if($PageArray[$i]>0)    
        {    
         $j = $j + sizeof($Seperator) + 1;
        }    
 }     
  
    for( $i = 1; $i < $PageCount-1; $i++ )
    {    
       for( $j = 0 ; $j < sizeof($Seperator); $j++)    
       {         
         $Pos=strpos($content,$Seperator[$j],$PageArray[$i-1]+2900);   
     while($Pos > 0 && $Pos < ($i+1)*$PageLength && $Pos > $i*$PageLength )    
   {    
      $PageArray[$i] = $Pos ;         
      if ($Pos+$PageLength > $CLength)
      {
         $start_p2 = $CLength-1 ;   
      }
      else{
         $start_p2 = $Pos+$PageLength ;
      } 
      $Pos = strpos($content,$Seperator[$j],$start_p2) ;    
    }    
   if($PageArray[$i]>0)    
   {    
    $j = $j + sizeof($Seperator) + 1;    
   }    
    }    
   }    
    //--PHP长文章分页函数最后一页     
    $PageArray[$PageCount-1] = $CLength; 
    //$page=2;    
  
    if($page==1)    
 {    
     $output=substr($content,0,$PageArray[$page-1]+2);    
 }    
    if($page > 1 && $page <= $PageCount)    
 {    
  $output=substr($content,$PageArray[$page-2]+2,$PageArray[$page-1]-$PageArray[$page-2]);    
  $output=" （上接第".($page-1)."页）\n".$output;    
 }    
    
//  echo str_replace("\n","<br \>&nbsp;&nbsp;&nbsp;",$output); //回车换行，根据需要调整    
    echo $output ;  
        
 if($PageCount > 1)    
 {    
    echo "<br \><center>";    
    echo "<font color='ff0000'>".$page."</font>/".$PageCount."页 &nbsp;";    
    if($page>1)    
     echo "<a href=".$_SERVER['PHP_SELF']."?expert_id=$expert_id&content_id=$content_id&page_t=".($page-1).">上一页</a> ";    
    else    
      echo "上一页 ";    
         
    for( $i=1 ; $i <= $PageCount ; $i++)    
    {    
     echo "<a href=".$_SERVER['PHP_SELF']."?expert_id=$expert_id&content_id=$content_id&page_t=".$i.">[".$i."]</a> ";    
    }    
       
    if($page < $PageCount)    
        echo " <a href=".$_SERVER['PHP_SELF']."?expert_id=$expert_id&content_id=$content_id&page_t=".($page+1).">下一页</a> ";    
  else    
   echo " 下一页 ";    
  echo "</center>";    
    }    
 }    
}
?> 

<html>
<head>
	<meta charset="utf-8">
	<title>blog</title>
	<link rel="stylesheet" href="../css/index_style.css">
	<link rel="stylesheet" href="../css/tab.css">
	<link rel="stylesheet" href="../css/timeline.css">
	<!-- // <script type="text/javascript" src="../js/tab.js"></script> -->

</head>
<div class="bdsharebuttonbox" data-tag="share_1">
  <a class="bds_mshare" data-cmd="mshare"></a>
  <a class="bds_qzone" data-cmd="qzone" href="#"></a>
  <a class="bds_tsina" data-cmd="tsina"></a>
  <a class="bds_baidu" data-cmd="baidu"></a>
  <a class="bds_renren" data-cmd="renren"></a>
  <a class="bds_tqq" data-cmd="tqq"></a>
  <a class="bds_more" data-cmd="more">更多</a>
  <a class="bds_count" data-cmd="count"></a>
</div>
<script>
  window._bd_share_config = {
    common : {
      bdText : '自定义分享内容', 
      bdDesc : '自定义分享摘要', 
      bdUrl : '自定义分享url地址',   
      bdPic : '自定义分享图片'
    },
    share : [{
      "bdSize" : 16
    }],
    slide : [{     
      bdImg : 0,
      bdPos : "right",
      bdTop : 100
    }],
    image : [{
      viewType : 'list',
      viewPos : 'top',
      viewColor : 'black',
      viewSize : '16',
      viewList : ['qzone','tsina','huaban','tqq','renren']
    }],
    selectShare : [{
      "bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
    }]
  }
  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<body>

<div id="main">
	<div id="header_out">
		<div id="header">
			<div id="header_left">
				<h1>blog</h1>
			</div>
			<div id="header_right">
				
				<li><a href="../php/cancel.php">注销登陆</a></li>
				<li><a href="#">消息</a></li>
				<li><a href="#">关于我</a></li>
				<li><a href="#"><?php echo $user_name;?></a></li>
				<a href="../php/upload.php"><img src="../php/pic/pic<?php echo $user_id;?>.jpg"  onError="this.src='../php/pic/default.jpg';"/></a>
			</div>
		</div>
	</div>
	<div id="body">
		<div id="body_left">
			<ul style="display:none;">
			<li class="active">主页</li>
			<li>写日志</li>
			<li>日志管理</li>
			<li>好友博客</li>
			<li>访问统计</li>
			<li>博客设计</li>
			<li>更多<<</li>
			</ul>
		</div>
		<div class="body_right2" style="display:block;">
			<div id="log">
				<?php 
					$result = $db->query("SELECT * FROM `blog_content` WHERE `content_id` = '$content_id'");
					foreach ($result as $value) {   
						print("<h3>{$value['content_title']}</h3>
							<p id='p'>");
					    $content1=$value['content'];   
					    $current=$_REQUEST['page_t']; 
					    $result= ff_page($content1,$current);
					    print("{$result}</p>              <span>{$value['time']}</span>

                </div>
    </div>
    <div id='search'>
      <input type='text' class='form-control' placeholder='请按Ctrl+F键,谢谢'>
        <button type='submit' class='btn btn-default'>Submit</button>");

          $content_id=$value['content_id'];
            $content=$value['content'];
              echo <<<STR
            <div class="time" >
              <a href="#a" class="ping">评论</a>
              <div name="a" class="discu">
                <form name="input" action="../php/discuss.php?content_id={$content_id}" method="post">
                <input type="text" name="discuss" placeholder="{$user_name}说:"/>
                <input type="submit" value="发表" />
                </form>
              </div>
              <div class="reply">
STR;
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
                  <form name="input" action="../php/reply.php?discuss_id={$value1['discuss_id']}&friend_id={$value1['user_id']}" method="post">
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
                print("<a href='../php/delete_reply.php?reply_id={$value2['reply_id']}'>删除</a>");
              }
                echo <<<STR
                <a class="hui" href="#reply">回复</a><span>{$value2['time']}</span></p>
                  <div name="reply" class="reply_sub">
                  <form name="input" action="../php/reply.php?discuss_id={$discuss_id}&friend_id={$value2['user_id']}" method="post">
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


					?>
			
		</div>		
	</div>
</div>
<div id="footer">
	<p>This is by SkilsLe.</p>
</div>
</body>
</html>