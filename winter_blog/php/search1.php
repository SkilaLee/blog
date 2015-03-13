 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 <html xmlns="http://www.w3.org/1999/xhtml"> 
<?php 
  include"connect.php";
  $searchs=$_POST['search'];
  
    ?>
<head>
  <meta charset="utf-8">
  <title>blog</title>
  <link rel="stylesheet" href="../css/index_style.css">
  <link rel="stylesheet" href="../css/tab.css">
  <link rel="stylesheet" href="../css/timeline.css">
    <script type="text/javascript" src="../js/login.js"></script>
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
    <div id="body_left" style="padding-left:2%;" name="a">
      
      <h4><?php echo $searchs;?></h4><span style="color: #BBDABA;">的搜索结果是:</span>
      <form action='#' method='post' id="form">
        <input name='search' type='text' class='form-control' placeholder='请按Ctrl+F键,谢谢'>
        <input type='submit' value='search'>
      </form>
    </div>
    <div class="body_rightAll">
      
      
<?php
$result=$db->query("SELECT * FROM `blog_content` WHERE content like '%$searchs%' or content_title like '%$searchs%'");
//             $sear1="";
//             $sear2="";
//             $sear3="";
//             $sear4="";
//             $sear5="";
//           foreach ($result as $value) {   
//             $sear1="<div class='right_search_content'><div class='search_content'><h3>{$value['content_title']}</h3>
//               <p id='p'>{$value['content']}</p>              
//               <span>{$value['time']}</span></div>";

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

//            echo $sear1;
         
//           if ($sear3==""&&$sear4=="") {
//             $sear3="没有评论";
//             echo $sear2.$sear3.$sear5;
//           }else{
//             echo $sear2.$sear3.$sear4.$sear5;
//           }
        
//           }
//               if ($sear1=="") {
//                 echo "没有搜索到".$searchs."的相关日志";
//               }
          

$i=0;
$j=0;
           foreach ($result as $value) {   
            $i++;
           print("<div class='right_search_content'>
                    <div class='search_content'>
                      <h3>{$value['content_title']}</h3>
                      <p id='p'>{$value['content']}</p>              
                      <span>{$value['time']}</span>
                    </div>");


              print("
                    <div id='search' style='width:23%;'>
                     
                    <div class='reply'>");
          $content_id=$value['content_id'];
            $content=$value['content'];
          $result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
          foreach ($result1 as $value1) {
                          $j++;
              echo <<<STR
                <p>{$value1['user_name']}说: {$value1['discuss']}</p><span class="span">{$value1['time']}               </span>
              <div class="huifu">
STR;
          $friend_name=$value1['friend_name'];
          $discuss_id=$value1['discuss_id'];
          $result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
          foreach ($result2 as $value2) {
              echo <<<STR
                  <p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><p class="span">
                <span>{$value2['time']}</span></p>
                  
STR;
}
              echo <<<STR
            </div>
STR;
}
if ($j==0) {
  echo "还没有评论哦~";
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

 <div name="login" id="login">
    <span><a href="#" onclick="location.reload()">&times;</a></span>
    <form action="../php/login.php" method="post">
      <table border=0 width='100%' height='100%'>
        <tr>
          <td align='right'>用户ID或者用户名：</td>
          <td><input type='text' name='user_id'></td>
        </tr>
        <tr>
          <td align='right'>密&nbsp;&nbsp;码：</td>
          <td><input type='password' name='password'></td>
        </tr>
        <tr>
          <td colspan=2 align='right' class="log"><input type='submit' value='登录'></td>
        </tr>
      </table>
    </form>
  </div>
  <div name="regi" id="regi">
    <span><a href="#" onclick="location.reload()">&times;</a></span>
    <form action="../php/register.php" method="post">
      <table border=0 width='100%' height='100%'>
        <tr>
          <td align='right'>用户名：</td>
          <td><input type='text' name='username'></td>
        </tr>
        <tr>
          <td align='right'>密&nbsp;&nbsp;码：</td>
          <td><input type='password' name='password'></td>
        </tr>
        <tr>
          <td colspan=2 align='right' class="log"><input type='submit' value='注册'></td>
        </tr>
      </table>
    </form>
  </div><!-- 
<div id="footer">
  <span>It is produced by SkilaLee.</span>
</div> -->
</body>
</html>