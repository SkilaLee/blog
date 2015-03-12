 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 <html xmlns="http://www.w3.org/1999/xhtml"> 
<?php 
  include"connect.php";
  $searchs=$_POST['search'];
  
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
<head>
  <meta charset="utf-8">
  <title>blog</title>
  <link rel="stylesheet" href="../css/index_style.css">
  <link rel="stylesheet" href="../css/tab.css">
  <link rel="stylesheet" href="../css/timeline.css">
</head>
<body>
<div id="main">
  <div id="header_out">
    <div id="header">
      <div id="header_left">
        <h1>blog</h1>
      </div>
      <div id="header_right">
        
        <li><button type="submit" href="#" id="zhuce">注册</button></li>
        <li><button type="submit" href="#" id="denglu">登陆</button></li>
      </div>
    </div>
  </div>
  <div id="body" class="body">
    <div id="body_left" style="padding-left:2%;">
      <p><h4><?php echo $searchs;?></h4>的搜索结果:</p>
    </div>
    <div class="body_rightAll">
      <form action='#' method='post'>
        <input name='search' type='text' class='form-control' placeholder='请按Ctrl+F键,谢谢'>
        <input type='submit' value='search'>
      </form>
<?php

$result=$db->query("SELECT * FROM `blog_content` WHERE content like '%$searchs%' or content_title like '%$searchs%'");
          foreach ($result as $value) {   
            $sear1="<div class='right_search_content'><div class='search_content'><h3>{$value['content_title']}</h3>
              <p id='p'>{$value['content']}</p>              
              <span>{$value['time']}</span></div>";

          $content_id=$value['content_id'];
            $content=$value['content'];
             $sear2="<div id='search'>";
          $result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
          foreach ($result1 as $value1) {
             $sear3="<h4>评论:</h4>
                <p>{$value1['user_name']}说: {$value1['discuss']}</p><span>{$value1['time']}</span>";
          $friend_name=$value1['friend_name'];
          $discuss_id=$value1['discuss_id'];
          $result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
          foreach ($result2 as $value2) {
              $sear4="<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span>{$value2['time']}</span>";
}
}
              $sear5="</div>
              </div>";
          }
          $content_paging=$sear1.$sear2.$sear3.$sear4.$sear5;
          echo $content_paging;
?>
      
    </div>
  </div>
</div>
<script> 
 function SearchHighlight(idVal,keyword) 
 { 
     var pucl = document.getElementById(idVal); 
     if("" == keyword) return; 
     var temp=pucl.innerHTML; 
     var htmlReg = new RegExp("\<.*?\>","i"); 
     var arrA = new Array(); 
     //替换HTML标签 
     for(var i=0;true;i++) 
     { 
         var m=htmlReg.exec(temp); 
         if(m) 
         { 
             arrA[i]=m; 
         } 
         else 
         { 
             break; 
         } 
         temp=temp.replace(m,"{[("+i+")]}"); 
     } 
     words = unescape(keyword.replace(/\+/g,' ')).split(/\s+/); 
     //替换关键字 
     for (w=0;w<words.length;w++) 
     { 
         var r = new RegExp("("+words[w].replace(/[(){}.+*?^$|\\\[\]]/g, "\\$&")+")","ig"); 
         temp = temp.replace(r,"<b style='color:#e97252;'>$1</b>"); 
     } 
     //恢复HTML标签 
     for(var i=0;i<arrA.length;i++) 
     { 
         temp=temp.replace("{[("+i+")]}",arrA[i]); 
     } 
         pucl.innerHTML=temp; 
 } 
 SearchHighlight("body",'<?php echo $searchs;?>'); 
 </script> 
<div id="footer">
  <p>It is produced by SkilsLe.</p>
</div>
</body>
</html>