 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 <html xmlns="http://www.w3.org/1999/xhtml"> 
<?php 
  include"connect.php";
  session_start();
  $user_id =  $_SESSION['id'];
  $user_name =  $_SESSION['name'];
  $searchs=$_POST['search'];

  ?>

<head>
  <meta charset="utf-8">
  <title>blog</title>
  <link rel="stylesheet" href="../css/index_style.css">
  <link rel="stylesheet" href="../css/tab.css">
  <link rel="stylesheet" href="../css/timeline.css">
  <script>
  window.onload=function()
  {
    
  var Index,
    pinglun = document.getElementsByClassName("ping"),
    Input = document.getElementsByClassName("discu");
  //为每个被点击的对象绑定单击事件
  for( var i = 0; i < pinglun.length; i++ ){
    (function( i ){
      pinglun[i].onclick = function(){
        //为被点击的时间点li添加active类
        Input[i].style.display = "block";

        //根据索引号变量的值，去除上一个li的active类
        Input[Index].style.display = "none";

        //将索引号变量值更新为被点击的li的索引号
        Index = i;
      };
    })( i );
  }
  var index,
    reply = document.getElementsByClassName("hui"),
    InputRe = document.getElementsByClassName("reply_sub");
  //为每个被点击的对象绑定单击事件
  for( var i = 0; i < reply.length; i++ ){
    (function( i ){
      reply[i].onclick = function(){
        //为被点击的时间点li添加active类
        InputRe[i].style.display = "block";

        //根据索引号变量的值，去除上一个li的active类
        InputRe[index].style.display = "none";

        //将索引号变量值更新为被点击的li的索引号
        index = i;
      };
    })( i );
  }
  };
</script>
</head>
<body>
<div id="main">
  <div id="header_out">
    <div id="header">
      <div id="header_left">
        <h1>blog</h1>
      </div>
      <div id="header_right">
        
        <li><a href="php/cancel.php">注销登陆</a></li>
        <li><a href="#">消息</a></li>
        <li><a href="#">关于我</a></li>
        <li><a href="#"><?php echo $user_name;?></a></li>
        <a href="../php/upload.php"><img src="../php/pic/pic<?php echo $user_id;?>.jpg"  onError="this.src='../php/pic/default.jpg';"/></a>
      </div>
    </div>
  </div>
  
  <div id="body" class="body">
    <div id="body_left" style="padding-left:2%;">
      <form action='#' method='post' id="form">
        <input name='search' type='text' class='form-control' placeholder='请按Ctrl+F键,谢谢'>
        <input type='submit' value='search'>
      </form>
      <h4><?php echo $searchs;?></h4><span style="color: #BBDABA;">的搜索结果是:</span>
    </div>
    <div class="body_rightAll">
      
<?php
$result=$db->query("SELECT * FROM `blog_content` WHERE content like '%$searchs%' or content_title like '%$searchs%' LIMIT 0,1");
            // $sear1="";
            // $sear2="";
            // $sear3="";
            // $sear4="";
            // $sear5="";
$i=0;
           foreach ($result as $value) {   
            $i++;
           print("<div class='right_search_content'><div class='search_content'><h3>{$value['content_title']}</h3>
              <p id='p'>{$value['content']}</p>              
              <span>{$value['time']}</span></div>");

//           $content_id=$value['content_id'];
//             $content=$value['content'];
//              $sear2="<div id='search' style='width:23%;'>";
//           $result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
//           foreach ($result1 as $value1) {
//              $sear3="<h4>评论:</h4>
//                 <p>{$value1['user_name']}说: {$value1['discuss']}</p><span>{$value1['time']}</span>";
//           $friend_name=$value1['friend_name'];
//           $discuss_id=$value1['discuss_id'];
//           $result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
//           foreach ($result2 as $value2) {
//               $sear4="<p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span>{$value2['time']}</span>";
// }
// }
//               $sear5="</div>
//               </div>";
//           }
//               if ($sear1=="") {
//                 echo "没有搜索到".$searchs."的相关日志";
//               }else{
//            echo $sear1;
         
//           if ($sear3==""&&$sear4=="") {
//             echo $sear2."没有评论".$sear5;
//           }else{
//             echo $sear2.$sear3.$sear4.$sear5;
//           }
              print("
              <div id='search' style='width:23%;'>
    <div id='sear'>
      <form action='search.php?expert_id= &page_t=1' method='post'>
        <input name='search' type='text' class='form-control' placeholder='请按Ctrl+F键,谢谢'>
        <input type='submit' value='search'>
      </form>");
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
                print("<a href='delete_discuss.php?discuss_id={$value1['discuss_id']}'>删除</a>");
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
        if ($i==0) {
         echo "没有搜索到".$searchs."的相关日志";
        }
          

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
  <span>It is produced by SkilaLee.</span>
</div>
</body>
</html>