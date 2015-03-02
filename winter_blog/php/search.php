<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<?php
include"connect.php";
$searchs=$_POST['search'];

$result=$db->query("SELECT * FROM `blog_content` WHERE content like '%$searchs%' or content_title like '%$searchs%'");
					foreach ($result as $value) {   
						print("<h3>{$value['content_title']}</h3>
              <p id='p'>{$value['content']}</p>              <span>{$value['time']}</span>

                </div>
    </div>
    <div id='search'>
    <div id='sear'>");

          $content_id=$value['content_id'];
            $content=$value['content'];
             
          $result1 = $db->query("SELECT * FROM `discuss` WHERE `content_id` = '$content_id'");
          foreach ($result1 as $value1) {
              echo <<<STR
                <p>{$value1['user_name']}说: {$value1['discuss']}</p><span>{$value1['time']}</span>
STR;
          $friend_name=$value1['friend_name'];
          $discuss_id=$value1['discuss_id'];
          $result2 = $db->query("SELECT * FROM `reply` WHERE `discuss_id` = '$discuss_id'");
          foreach ($result2 as $value2) {
              echo <<<STR
                  <p>{$value2['user_name']}对{$value2['friend_name']}说: {$value2['reply']}</p><span>{$value2['time']}</span>
STR;
}
              echo <<<STR
            </div>
STR;
}
              echo <<<STR
              </div>
              
            </div>
          </div>  
STR;
					}
?>

</body>
</html>