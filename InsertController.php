<?php

require 'config.php';

$user = $_GET['hide'];
$ingredients = [];
$imgUrl = $_GET['img_url'];
$title = $_GET['title'];
$desc = $_GET['desc'];
$veg = $_GET['is_veg'];
$num = $_GET['numIng'];
for($i=0;$i<$num;$i++){
    $ingredients[$i] = $_GET['item'.$i+1]; 
}
$sql1="
insert into post(img_url,title,published_at,is_veg,caption,user_id)
values('$imgURL','$title',now(),$veg,'$desc','$user')
";

$conn -> close();
?>
