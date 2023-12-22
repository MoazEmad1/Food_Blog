<?php

require 'config2.php';

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
$sql="
insert into post(img_url,title,published_at,is_veg,caption,user_id)
values('Users/test/images/$imgUrl','$title',now(),$veg,'$desc','$user')
";
$ret = mysqli_query($conn,$sql);
if($ret){
    echo"Successful";
}else{
    echo"failed";
}
$conn -> close();
?>
